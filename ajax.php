<?php
header('Content-Type: application/json');

$query = urlencode(stripslashes($_POST['q']));

$keywords = $query;
$xmlurl   = "https://backend.deviantart.com/rss.xml?q=boost%3Apopular+in%3Acustomization%2Ficons%2Fsigbanners+".$keywords;

$xmlrss = file_get_contents($xmlurl);
$xmlrss = str_replace('<media:', '<', $xmlrss);
$xmlrss = str_replace('</media:', '</', $xmlrss);
$xmlrss = preg_replace('#&(?=[a-z_0-9]+=)#', '&amp;', $xmlrss);
$object = simplexml_load_string($xmlrss);

// setup return array
$return = array();
$i = 0;

// get total number of results, max 60
$total = count($object->channel->item);
$return["total"] = $total;


foreach($object->channel->item as $item) {
	$title = (string) $item->title[0];
	$url   = (string) $item->link;
	
	$authorname = (string) $item->credit[0];
	$authorpic  = (string) $item->credit[1];
	
	// check if the content only has one thumbnail
	if(!is_object($item->thumbnail[1])) {
		// use the 1st image if there is only one to choose
		$thumburl = (string) $item->thumbnail[0]->attributes()->url;
	} else {
		// otherwise we have 2 thumbs and choose the larger one
		$thumburl = (string) $item->thumbnail[1]->attributes()->url;
	}	
	
	$fullurl = (string) $item->content[0]->attributes()->url;
	
	// configure array data for each item
	$return[$i]["title"]  = $title;
	$return[$i]["url"]    = $url;
	$return[$i]["author"] = $authorname;
	$return[$i]["avatar"] = $authorpic;
	$return[$i]["thumb"]  = $thumburl;
	$return[$i]["full"]   = $fullurl;
	
	$i++;
}

$json = json_encode($return);
die($json);

?>