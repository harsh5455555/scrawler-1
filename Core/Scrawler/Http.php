<?php

/**
 * The http helper class.
 * 
 * @author : Pranjal Pandey
 * @package : Scrawler
 */

namespace Scrawler;

class Http {

    /**
     * function to get header of http request.
     * @return string
     */
    function getallheaders() {
        if (function_exists('getallheaders')) {
            return getallheaders();
        }

        $headers = '';
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }

    //---------------------------------------------------------------//

    /**
     * function to get the url of the application.
     * @return string
     */
    public function url() {
        if (isset($_SERVER['SERVER_NAME'])) {
            if (defined('SUBDIR')) {
                $url = "http://" . $_SERVER['SERVER_NAME'] . '/' . SUBDIR;
            } else {
                $url = "http://" . $_SERVER['SERVER_NAME'] . '/';
            }
        } else {
            if (defined('SUBDIR')) {
                $url = '/' . SUBDIR . '/';
            } else {
                $url = '/';
            }
        }

        return $url;
    }

    //---------------------------------------------------------------//

    /**
     * function for redirecting to a specific URL.
     * @param string $uri
     */
    public function redirect($uri) {

        $url = $this->url() . $uri;
        header("Location:" . $url);
    }

    //----------------------------------------------------------------//
}
