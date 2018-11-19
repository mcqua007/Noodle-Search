<?php

include("classes/DomDocumentParser.php");

$alreadyCrawled = array();
$crawling = array();

function createLink($src, $url){
  //if the link postion 0 from 2 so the first two postions contain // then add a http: to the front

   $scheme = parse_url($url)['scheme'];//parse url parses the url and returns an associated array will b e the http part of url
   $host = parse_url($url)["host"];//parse url parses the url and returns an associated array which will be the www.bbc.com (the host part of url)

   if(substr($src,0, 2) == "//"){
     $src = $scheme . ":" . $src;
   }
   else if(substr($src, 0, 1)=="/"){
     $src = $scheme . "://" . $host . "/" . $src;
   }
   else if(substr($src, 0, 2)=="./"){
     $src = $scheme . "://" . $host . "/" . direname(parse($url)['path'] . substr($src, 1));   //gets directory name or url then parses url to grab the path, only start form first character ignore the .
   }
   else if(substr($src, 0, 3)=="../"){
     $src = $scheme . "://" . $host . "/" . $src;
   }
   else if(substr($src, 0, 5) != "https" && substr($src, 0, 4) != "http"){
      $src = $scheme . "://" . $host . "/" . $src;  //takes care of the src wiht ex. about/index.html
   }

   return $src; //returning updated url
}

function getDetails($url) {

	$parser = new DomDocumentParser($url);

	$titleArray = $parser->getTitleTags();

	if(sizeof($titleArray) == 0 || $titleArray->item(0) == NULL) {
		return;
	}

	$title = $titleArray->item(0)->nodeValue;
	$title = str_replace("\n", "", $title);

	if($title == "") {
		return;
	}


  $description = "";
  $keywords = "";

  $metaArray = $parser->getMetaTags();



	echo "URL: $url, Title: $title<br>";

}
function followLinks($url){

  global $alreadyCrawled;
  global $crawling;

   $parser = new DomDocumentParser($url);

   $linksList = $parser->getLinks();

   foreach($linksList as $link ){
     $href = $link->getAttribute("href");// this gets the href attributes in the startUrl's url then displays it with a page break

     if(strpos($href,"#") !== false){ //skips displaying anything that is just # in the href tag
       continue;   //continue on the loop
     } //going from position 0, to position 11 and that containts javascript as below skip
     else if(substr($href, 0, 11) == "javascript:"){
       continue;
     }
     $href = createLink($href, $url);

     if (!in_array($href, $alreadyCrawled)){
       $alreadyCrawled[] = $href;
       $crawling[] =  $href;
       getDetails($href);  //calls et details function to get title from all the links recursivly
     }
     else return;
    // echo $href . "<br />";
    }

    array_shift($crawling);

    foreach($crawling as $site){
      followLinks($site);
     }
}

$startUrl = "http://bbc.com";

followLinks($startUrl);

?>
