<?php

/**
 * This class handles the templates 
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 * @subpackage : Canvas Templating Engine
 */

namespace Scrawler;

class Templates {

    //---------------------------------------------------------------// 
    /**
     * Stores the template instance
     * @var object
     */
    public $template;

    /**
     * Stores the parameter passed 
     * @var array
     */
    public $data = array();

    /**
     * Stores url of application
     * @var array
     */
    public $url;

    /**
     * Stores the template type to render
     * @var array
     */
    public $templateType = 'default';

    //---------------------------------------------------------------//  

    function __construct() {
        $http = new Http();
        $this->url = $http->url();
    }

    //---------------------------------------------------------------//  

    /**
     * Function detects the template and draws it.
     * @param string $template
     * @param array $vars
     * @return string
     */
    public function render($template, $data = array()) {

        $template = __DIR__ . '/../../App/Templates/' . $this->templateType . '/' . $template . '.sct.php';
        if (file_exists($template)) {

            $this->data = array_merge($this->data, $data);
            extract($this->data);
            $t = $this;

            ob_start();
            include $template;
            return ob_get_clean();
        } else {
            return 'Error template you are trying to load does not exist';
        }
    }

    //---------------------------------------------------------------//  

    /**
     * This functions set's the current template type 
     */
    public function setType($type) {

        $this->templateType = $type;
    }

    //---------------------------------------------------------------//  

    /**
     * Helper function to draw the errors templates
     */
    public function error($template, $data = array()) {
        $body=$this->render('error/' . $template, $data);
        $this->draw();
    }

    //---------------------------------------------------------------//  

    /**
     * This functions draw the shell
     */
    public function draw() {
        echo $this->render('shell');
    }

    //---------------------------------------------------------------// 
    /**
     * overloading to set array values
     * @param string $name
     * @param string $value
     */
    function __set($name, $value) {
        if (!empty($name)) {
            $this->data[$name] = $value;
        }
    }

    //---------------------------------------------------------------//  
    /**
     * Overloading to get array values 
     * @param string $name
     * @return string
     */
    function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        return null;
    }

    //---------------------------------------------------------------//

    /**
     * function to hook a css to template
     * @param string $filename
     * @return string
     */
    public function css($filename) {

        $css = "<link href= " . $this->url . "App/Public/css/" . $filename . ".css rel=\"stylesheet\" >";

        return $css;
    }

    //---------------------------------------------------------------//  

    /**
     * function to hook a js to template
     * @param string $filename
     * @return string
     */
    public function js($filename) {

        $js = "<script src=" . $this->url . "App/Public/js/" . $filename . ".js ></script>";
        return $js;
    }

    //---------------------------------------------------------------//  

    /**
     * function to hook a css to template
     * @param string $filename
     * @return string
     */
    public function image($filename) {

        $image = $this->url . "App/Public/images/" . $filename;
        return $image;
    }

    //---------------------------------------------------------------//  
}
