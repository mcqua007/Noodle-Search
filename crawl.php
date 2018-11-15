<?php

include("classes/DomDocumentParser.php");
function followLinks($url){

   $parser = new DomDocumentParser($url);

}

$startUrl = "http://decrypteddesign.com";

followLinks($startUrl);

?>
