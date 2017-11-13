<?php require_once("gilsfunctions.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>EVBCO Electronic Transfer Form</title>
<link rel="stylesheet" type="text/css" href="formcss.css">
</head>
<body>

<div id="container">

<h1>EVBCO Electronic Transfer Form</h1>
<p>This form is used for reimbursements processed 
through the Cash Analyzer System for the transfer of funds. All information will 
remain confidential and will be used for the sole purpose of processing 
electronic reimbursements. This form must be accompanied by available 
documentation as necessary.</p>

<div id="magic"><p>ET# <span id="theNumber"></span></p></div>

<?php

if ($_POST["submit"])
{
	$pre_data = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/form/datafile.txt');
	
	if($_POST["the_Columbus_list"]!='none') $it=$_POST["the_Columbus_list"];
	elseif($_POST["the_Cleveland_list"]!='none') $it=$_POST["the_Cleveland_list"];
	elseif($_POST["the_Pittsburgh_list"]!='none') $it=$_POST["the_Pittsburgh_list"];
	else exit('Please choose a property. <a href="/form/evbcoV2.php">go back</a>');
	
  $first = explode(',',$it);
  $it = $first[1];
  $ETnumber = $first[0];
	$parts = explode('_',$it);
	$chosen_city = $parts[0];
	for($i=1;$i<count($parts);$i++)
	  {
		$chosen_property .= $parts[$i].' ';
		}
	$chosen_property = trim($chosen_property);	
	$post_data = replace($chosen_city,$chosen_property,$pre_data);
	
	//echo "It is in ".$chosen_city." and it is called ".$chosen_property."<br><br>";	
	
	$readwrite = fopen($_SERVER['DOCUMENT_ROOT'].'/form/datafile.txt',"w");
  $readwrite_backup = fopen($_SERVER['DOCUMENT_ROOT'].'/form/datafile_backup.txt',"w");
	fwrite($readwrite,$post_data);
  fwrite($readwrite_backup,$pre_data);
	fclose($readwrite);
  fclose($readwrite_backup);
  
  $address = "RenegadeLatino@gmail.com";
  $subject = "EVBCO Electronic Transfer Form";
  
  $message  = "Hello. This message was sent from the EVBCO Electronic Transfer Form.\n\n";
  $message .= "The ET number for this transaction is ".$ETnumber.".\n\n";
  $message .= "The Chosen Property:\n";
  $message .= "     City: ".$chosen_city."\n";
  $message .= "     Property: ".$chosen_property."\n\n";
  $message .= "Backup Attached?\n";
  $message .= "     ".$_POST["backup"]."\n";
  $message .= "     Date: ".$_POST["backup_date"]."\n\n";
  $message .= "Reimbursement Information\n";
  $message .= "     Payee: ".$_POST["payee"]."\n";
  $message .= "     For: ".$_POST["for"]."\n";
  $message .= "     Authorized Signature: ".$_POST["sig"]."\n";
  $message .= "     Date: ".$_POST["date_sig"]."\n\n";
  $message .= "Action Items\n";
  if($_POST["approval"]=='Yes') $message .= "     Approval/Signature: ".$_POST["approval"]."\n";
  if($_POST["return"]=='Yes') $message .= "     Return with Details: ".$_POST["return"]."\n";
  if($_POST["transferred"]=='Yes') $message .= "     Transferred: ".$_POST["transferred"]."\n";
  if($_POST["as_requested"]=='Yes') $message .= "     As Requested: ".$_POST["as_requested"]."\n";
  if($_POST["investigate"]=='Yes') $message .= "     Investigate/Report: ".$_POST["investigate"]."\n";
  if($_POST["void"]=='Yes') $message .= "     Void: ".$_POST["void"]."\n";
  $message .= "\nComments\n";
  $message .= "     ".$_POST["comments"]."\n\n";
  
  $headers = "From: EVBCO <info@evbco.com>";
  
  if(mail($address,$subject,$message,$headers)) echo "<p><strong>Thank you.</strong></p><p>Your transaction has sucessfully been submitted.</p><br />";
  else echo "<p><strong>Error:</strong> Message Not Sent</p><br />";
}	
?>

<?php $data = getData(); //print_r($data); ?>

<script type="text/javascript">

  function gos(thecity,t)
{
  //alert(thecity);
  thevar = thecity.options[thecity.selectedIndex].value;
	//alert(thevar);
  updateNumber(thevar,t);
}

  function updateNumber(thevar,city)
	{
	//alert("youre in");
  
  num = thevar.indexOf(",")
  thenumber = thevar.substring(0,num);
  document.getElementById('theNumber').innerHTML = thenumber;
  
  //alert("youre in");

	switch (city)
  	{
  	case 1:
  	  {
  	  document.getElementById('Cleveland_one').selected='selected';
			document.getElementById('Pittsburgh_one').selected='selected';
			break;
  		}
		case 2:
  	  {
  	  document.getElementById('Columbus_one').selected='selected';
			document.getElementById('Pittsburgh_one').selected='selected';
			break;
  		}
		case 3:
  	  {
  	  document.getElementById('Columbus_one').selected='selected';
			document.getElementById('Cleveland_one').selected='selected';
			break;
  		}
  	}
	}

</script>

<form id="form1" method="post" action="" enctype="multipart/form-data">
<fieldset class="main">
  <legend>Property Information</legend>
<?php
  for($i=0;$i<count($data)-2;$i++)
	  {
		$thecity = $data[$i];
		$t=$i+1;
		echo '<div class="tri"><label> '.$thecity.' Properties </label><br/><select id="'.$thecity.'" name="the_'.$thecity.'_list" onChange="gos('.$thecity.','.$t.')">';
  	echo '<option id="'.$thecity.'_one" value="none">Choose Below</option>';
    foreach ($data['cityinfo'][$thecity] as $city)
      {
    	$cityvar = str_replace(' ','_',$city);
  		//echo '<option value="'.$thecity.'_'.$cityvar.'" onClick="updateNumber('.$thecity.'_'.$cityvar.','.$t.')">'.$city.'</option>';
      //echo '<option value="'.$data['citynumbers'][$thecity][$city].'" >'.$city.'</option>';
      echo '<option value="'.$data['citynumbers'][$thecity][$city].','.$thecity.'_'.$cityvar.'" >'.$city.'</option>';
    	}
    echo "</select></div>";
		}
?>
</fieldset>
<br />
<fieldset>
  <legend>Backup Attached?</legend>
    <label>Yes: </label><input type="radio" name="backup" value="Yes" />
    <label>No: </label><input type="radio" name="backup" value="No" />
    <br />
    <label>Date: </label><input type="text" name="backup_date" value="<?php echo date('D M j Y G:i:s T'); ?>" id="date" />
</fieldset>
<br />
<fieldset>
  <legend>Reimbursement Information</legend>
	<label>Payee: </label><input type="text" id="payee" name="payee" />
  <br />
	<label>For: &nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" id="for" name="for" />
  <br />
	<label>Authorized Signature: </label><input type="text" id="sig" name="sig" />
	<label>Date: </label><input type="text" name="date_sig" />
</fieldset>
<br />
<fieldset>
  <legend>Action Items</legend>
	<div class="tri"><label>Approval/Signature: </label><input type="checkbox" value="Yes" name="approval" /></div>
	<div class="tri"><label>Return with Details: </label><input type="checkbox" value="Yes" name="return" /></div>
	<div class="tri"><label>Transferred: </label><input type="checkbox" value="Yes" name="transferred" /></div>
	<br /><br />
  <div class="tri"><label>As Requested: </label><input type="checkbox" value="Yes" name="as_requested" /></div>
	<div class="tri"><label>Investigate/Report: </label><input type="checkbox" value="Yes" name="investigate" /></div>
	<div class="tri"><label>Void: </label><input type="checkbox" value="Yes" name="void" /></div>
</fieldset>
<br />
<fieldset>
  <legend>Comments</legend>
	<p>Please enter your comments in the space provided below:</p>
	<textarea name="comments" rows=15 cols=90></textarea>
</fieldset>
<br />
<fieldset class="buttons">
<input id="submit" name="submit" class="button" type="submit" value="Submit" />
<input id="reset" name="reset" class="button" type="reset" value="Reset" />
</fieldset>
</form>
<br /><br />

</div>

</body>
</html>
