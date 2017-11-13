<?php

function getData()
{
	$cities = array();
	$data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/form/datafile.txt');
	$needle = '<property city="';
	$data = explode($needle,$data);
	for($i=1;$i<count($data);$i++){
	  $start = 0;
		$end = strpos($data[$i],'"');
		$city = substr($data[$i],$start,$end);
		if(!in_array($city,$cities)) $cities[] = $city;
		
		$haystack = $data[$i];
				
		$needle = 'id="';
		$start = strpos($haystack,$needle)+strlen($needle);
    $end = strpos($haystack,'"',$start);
    $property_name = substr($haystack,$start,$end-$start);
		$cities['cityinfo'][$city][] = $property_name;
		
		$needle = '>';
		$start = strpos($haystack,$needle)+strlen($needle);
    $end = strpos($haystack,'</property>',$start);
    $number = substr($haystack,$start,$end-$start);
		$cities['citynumbers'][$city][$property_name] = $number;
	}
	return $cities;
}

function retrieve($city,$id)
{
  $data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/form/datafile.txt');
  $needle = '<property city="'.$city.'" id="'.$id.'">';
  $haystack = $data;
  if(stristr($haystack, $needle))
    {
    $start = strpos($haystack,$needle)+strlen($needle);
    $end = strpos($haystack,"</property>",$start);
    $result = substr($haystack,$start,$end-$start);
    }
  $result = "The check number for ".$id." in ".$city." is ".$result;
	return $result;
}

function replace($city,$id,$data)
{
  $needle = '<property city="'.$city.'" id="'.$id.'">';
  $haystack = $data;
  if(stristr($haystack, $needle))
    {
    $start = strpos($haystack,$needle)+strlen($needle);
    $end = strpos($haystack,"</property>",$start);
    $oldcontent = substr($haystack,$start,$end-$start);
		$newcontent = $oldcontent + 1;
		$oldcontent = $needle.$oldcontent."</property>";
		$newcontent = $needle.$newcontent."</property>";
		$post_data = str_replace($oldcontent,$newcontent,$data);		
    }
  else
    {
    exit('The chosen property was not found in the data file');
    }
	return $post_data;
}
	 
?>
