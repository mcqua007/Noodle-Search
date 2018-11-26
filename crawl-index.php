<?php if(isset($_GET['crawlquery'])){
$startUrl  =  $_GET['crawlquery'];
}
if(isset($startUrl)){
 followLinks($startUrl);
} ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Noodle Crawler </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <div class="center-align">
      <div class="card center-align" style="margin:15%;">
        <div class="card-content center">
          <form action="">
            <label class="field"> Enter Url To Crawl</label>
            <input type="text" name="crawlquery" class="field" />
            <button type="submit" class="btn wave-effect wave-effect-light red">Crawl</button>
          </form>
            <p>
            <?php
               if(isset($href)){
                echo $href;
              }
              //if(isset($startUrl)){
                echo $startUrl;
              }
              ?>

            </p>
        </div>
      </div>
    </div>
  </body>
</html>
