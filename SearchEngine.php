<?php 
include './simple_html_dom.php';
// ini_set('memory_limit', '-1');
class SearchEngine {
    // Properties
    public $domain;
    public $searchEngine;

    public function setEngine($searchEngine)
    {
      $this->searchEngine = $searchEngine;
    }

    public function setDomain($domain)
    {
      $this->domain = $domain;
    }

    public function search($keywords){
      for($k=0; $k<count($keywords);$k++){
      
      $keyword = $keywords[$k];

      for($page = 0; $page<=40;$page=($page+10) ){
        $keyword = str_replace(' ','+',$keyword); // space is a +
        $url = $this->searchEngine."/search?output=search&start=".$page."&q=".urlencode($keyword);

        $html = file_get_html($url);

        $i=0;
        $linkObjs = $html->find('div a'); 

        foreach ($linkObjs as $linkObj) {

            $title = trim($linkObj->plaintext);
            $link  = trim($linkObj->href);

            if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
                $link = $matches[1];
            } else if (!preg_match('/^https?/', $link)) { 
                continue;
            }
            $descr = $html->find('div > div > span',$i);
            trim($descr);
            if(empty($descr)){
              $descr = 'no description';
            }

            $keyword = str_replace('+',' ',$keyword);
            $title = strtolower(trim((string)$title));
            $keyword = strtolower(trim((string)$keyword));
            $promoted = false;
        
            if (strpos($title,$keyword) !== false)
            {
              if (strpos(trim($link),'http://www.google.ae/aclk') !== false)
              {
                  $promoted = true;
              } 
              $arr[] = array(
                  'keyword' => $keyword,
                  'ranking' => ($i+$page),
                  'url' => $link,
                  'title' =>$title,
                  'description' => $descr,
                  'promoted' => $promoted,
                    );
                    $i++;  

            }
          }
        }
}


return $arr;
    }


  }