<div class='well'>
    <div class="row">

        <div class="col-md-3 col-sm-3">
            <?= $this->image('s.jpg') ?>
        </div>
        <div class="col-md-8 col-sm-8 ">
            <h1>Welcome to Scrawler</h1>
            <p> Scrawler has hit first stable <b>version 0.1.x</b> we would like you to contribute to take journey further <a href="www.github.com/GoStalk/Scrawler">www.github.com/GoStalk/Scrawler</a> is place for everything you need.  </p><br>
            <p> Scrawler is a combination of tools designed to work with each other and make your development easy unlike other big framework it has very less functions and libraries are very small.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 ">
        <div class="well">
            <h1> Let's get started </h1>
            <p> Before starting your development you need to mention you configurations in <b>/App/config.ini</b> and also don't forget to enable development mode to display errors.</p>
            <p> If all your configuration are right you will receive  further instruction else you would end up in a database error . <b> You dont need to config SMTP server if you don't need it</b> </p>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 ">
        <?php if(isset($_SESSION['dberror'])){ ?>
        <div class="panel panel-danger">
            
            <div class="panel-heading"> Could not connect to database. </div>
           <div class="panel-body"><?= $_SESSION['dberror'];?> <br> Please check weather you have set your database config correctly.</div>
        </div>
        <?php } elseif(file_exists(__DIR__.'/../../config.ini')) {?>
        <div class="panel panel-success">
            <div class="panel-heading"> Successfully Connected to database</div>
            <div class="panel-body"> Bravo! moving right along . Now its time to dig into documents found at  <a href="https://www.gitbook.com/book/physcocode/scrawler" > https://www.gitbook.com/book/physcocode/scrawler/details </a> and began developing your awesome app </div>
            
        </div>
        <?php } ?>
    </div>
</div>