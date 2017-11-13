<?php require_once("gilsfunctions.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>EVBCO ET Number Generator</title>
<link rel="stylesheet" type="text/css" href="tools.css">
</head>
<body>

<h1>Check Number Generator</h1>

<?php

if ($_POST["submit"])
{
	$pre_data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/form/datafile.txt');
	
	if($_POST["the_columbus_list"]!='none') $it=$_POST["the_columbus_list"];
	elseif($_POST["the_cleveland_list"]!='none') $it=$_POST["the_cleveland_list"];
	elseif($_POST["the_pittsburgh_list"]!='none') $it=$_POST["the_pittsburgh_list"];
	else exit('Please choose a property');
	
	$parts = explode('_',$it);
	$chosen_city = $parts[0];
	for($i=1;$i<count($parts);$i++)
	  {
		$chosen_property .= $parts[$i].' ';
		}
	$chosen_property = trim($chosen_property);	
	$post_data = replace($chosen_city,$chosen_property,$pre_data);
	
	echo "It is in ".$chosen_city." and it is called ".$chosen_property."<br><br>";	
	
	$readwrite = fopen($_SERVER['DOCUMENT_ROOT'].'/form/datafile.txt',"w");
	fwrite($readwrite,$post_data);
	fclose($readwrite);
	//$success = true;
}	
?>

<?php $data = getData(); //print_r($data); ?>

<script language="JavaScript" type="text/javascript">
<!--
  function updateNumber(thevar,city)
	{
	document.getElementById('theNumber').innerHTML = thevar;
	switch (city)
  	{
  	case 1:
  	  {
  	  document.getElementById('cle_one').selected='selected';
			document.getElementById('pit_one').selected='selected';
			break;
  		}
		case 2:
  	  {
  	  document.getElementById('col_one').selected='selected';
			document.getElementById('pit_one').selected='selected';
			break;
  		}
		case 3:
  	  {
  	  document.getElementById('col_one').selected='selected';
			document.getElementById('cle_one').selected='selected';
			break;
  		}
  	}
	}

  <?php	
	foreach($data['citynumbers']['Columbus'] as $property=>$num)
	  {
		$prop = str_replace(' ','_',$property);
		$r = 'var Columbus_'.$prop.' = '.$num.';';
		echo $r." ";
		}
	foreach($data['citynumbers']['Cleveland'] as $property=>$num)
	  {
		$prop = str_replace(' ','_',$property);
		$r = 'var Cleveland_'.$prop.' = '.$num.';';
		echo $r." ";
		}
	foreach($data['citynumbers']['Pittsburgh'] as $property=>$num)
	  {
		$prop = str_replace(' ','_',$property);
		$r = 'var Pittsburgh_'.$prop.' = '.$num.';';
		echo $r." ";
		}
	?>
//-->
</script>

<form id="form1" method="post" action="" enctype="multipart/form-data">
<fieldset class="main">
<?php

  echo '<div><label>Columbus Properties&nbsp; </label><select name="the_columbus_list">';
	echo '<option id="col_one" value="none">Choose Below</option>';
  foreach ($data['cityinfo']['Columbus'] as $city)
    {
  	$cityvar = str_replace(' ','_',$city);
		echo '<option value="Columbus_'.$cityvar.'" onClick="updateNumber(Columbus_'.$cityvar.',1)">'.$city.'</option>';
  	}
  echo "</select></div>";
	
	echo '<div><label>Cleveland Properties&nbsp; </label><select name="the_cleveland_list">';
	echo '<option id="cle_one" value="none">Choose Below</option>';
  foreach ($data['cityinfo']['Cleveland'] as $city)
    {
  	$cityvar = str_replace(' ','_',$city);
		echo '<option value="Cleveland_'.$cityvar.'" onClick="updateNumber(Cleveland_'.$cityvar.',2)">'.$city.'</option>';
  	}
  echo "</select></div>";
	
	echo '<div><label>Pittsburgh Properties&nbsp; </label><select name="the_pittsburgh_list">';
	echo '<option id="pit_one" value="none">Choose Below</option>';
  foreach ($data['cityinfo']['Pittsburgh'] as $city)
    {
  	$cityvar = str_replace(' ','_',$city);
		echo '<option value="Pittsburgh_'.$cityvar.'" onClick="updateNumber(Pittsburgh_'.$cityvar.',3)">'.$city.'</option>';
  	}
  echo "</select></div>";

?>
</fieldset>
<fieldset class="buttons">
<input id="submit" name="submit" class="button" type="submit" value="Submit" />
</fieldset>
</form>

<div>The Magic Number is <span id="theNumber"></span></div>

</body>
</html>
