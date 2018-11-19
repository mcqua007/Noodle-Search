<?php
class DomDocumentParser {

  private $doc;

  public function __construct($url){
   $options = array(
     'http' => array('method' => "GET", 'header' => "User-Agent: noodleBot/0.1\n")
   );
   $context = stream_context_create($options);

   $this->doc = new DomDocument(); //built in php class that allows you to do things on webpages
   @$this->doc->loadHTML(file_get_contents($url, false, $context));  // the '@' symbol supresses the warnings usually not good to use this but now we need to

  }

  public function getLinks(){
    return $this->doc->getElementsByTagName("a"); //this function getsElementsByTagName is a built in php functino grabs html tags by name, grabbing all anchor tags
  }

  public function getTitleTags(){
    return $this->doc->getElementsByTagName("title"); //this function getsElementsByTagName is a built in php functino grabs html tags by name, grabbing all anchor tags
  }

  public function getMetaTags(){
    return $this->doc->getElementsByTagName("meta"); //this function getsElementsByTagName is a built in php functino grabs html tags by name, grabbing all anchor tags
  }
}
 ?>
