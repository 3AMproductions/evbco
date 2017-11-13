<?php

function menu($p){
	// when $p comes in, a '/' is the first character. the ltrim function below removes that
	// then str_replace replaces the '.htm' extension with '' (thus removing it) so $p is now the filename with no extension
	// then the next variables check to see which page is active by checking to see if the requested page ($p) is in the 
	// list of pages
	
	$p = str_replace('.html','',ltrim($p,'/'));
  $columbus = in_array($p,array('ColsRE','33N3rd','85EGay','35EGay','BLPlaza','HmltnCtr','100n5th','155n5th','ColsMaps'));
  $cleveland = in_array($p,array('ClevOfce','SupBldg','CtyClb','ClevelMediation','ClevMap'));
  $pittsburgh = in_array($p,array('PghOffce','ParkBldg','InvstBlg','100-5th','PittMedical','PITCMap','Mediation'));
  $event = in_array($p,array('EventSpace','ColsEvent1','ColsEvent2'));
  $restaurant = in_array($p,array('RestaurantSpace','CleveResturant.htm','PittRestaurant'));
	$central_exchange = in_array($p,array('PITC','Central Exchange(NewER)','Central Exchange(Cleveland)'));
  $employment = in_array($p,array('Emplymt','EmpAcctExec'));
	$customer_center = in_array($p,array('Customer Service Center','I need office or storage space','Submit your automatic debit form','Tenant Referral program','maintenance requests','Submit an article for newsletter','Where do I mail my rent','Service Directory','Parking','FAQs'));
	
	// now we have booleans, for each menu item, if the associated boolean is true, add the location class
	// so it is technically possible to have more than one tab 'active' by having the same page name be in
	// more than one of the arrays above
  
  // .'<li>'.$p.'</li>'
	
	$n = '<li><a href="index.html"'.($p=='index' ? ' class="location"' : '').'>Home</a></li>';
	$n .= '<li><a href="ColsRE.html"'.($p=='ColsRE' ? ' class="location"' : '').'>Columbus Real Estate</a>';
  if($columbus)
		{$n .= '<ul>';
		$n .= '<li><a href="33N3rd.html"'.($p=='33N3rd' ? ' class="location"' : '').'>Charles Schwab Building</a></li>';
		$n .= '<li><a href="85EGay.html"'.($p=='85EGay' ? ' class="location"' : '').'>Law and Finance Building</a></li>';
    $n .= '<li><a href="35EGay.html"'.($p=='35EGay' ? ' class="location"' : '').'>Commerce Building</a></li>';
    $n .= '<li><a href="BLPlaza.html"'.($p=='BLPlaza' ? ' class="location"' : '').'>Blacklick Plaza</a></li>';
    $n .= '<li><a href="HmltnCtr.html"'.($p=='HmltnCtr' ? ' class="location"' : '').'>Hamilton Center</a></li>';
    $n .= '<li><a href="100n5th.html"'.($p=='100n5th' ? ' class="location"' : '').'>100 North Fifth Street</a></li>';
    $n .= '<li><a href="155n5th.html"'.($p=='155n5th' ? ' class="location"' : '').'>155 North Fifth Street</a></li>';
    $n .= '<li><a href="ColsMaps.html"'.($p=='ColsMaps' ? ' class="location"' : '').'>Maps</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="ClevOfce.html"'.($p=='ClevOfce' ? ' class="location"' : '').'>Cleveland Real Estate</a>';
  if($cleveland)
		{$n .= '<ul>';
		$n .= '<li><a href="SupBldg.html"'.($p=='SupBldg' ? ' class="location"' : '').'>Superior Building</a></li>';
		$n .= '<li><a href="CtyClb.html"'.($p=='CtyClb' ? ' class="location"' : '').'>City Club Building</a></li>';
    $n .= '<li><a href="ClevelMediation.html"'.($p=='ClevelMediation' ? ' class="location"' : '').'>Conflict Resolution</a></li>';
    $n .= '<li><a href="ClevMap.html"'.($p=='ClevMap' ? ' class="location"' : '').'>Maps</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="PghOffce.html"'.($p=='PghOffce' ? ' class="location"' : '').'>Pittsburgh Real Estate</a>';
	if($pittsburgh)
		{$n .= '<ul>';
		$n .= '<li><a href="ParkBldg.html"'.($p=='ParkBldg' ? ' class="location"' : '').'>Park Building</a></li>';
		$n .= '<li><a href="InvstBlg.html"'.($p=='InvstBlg' ? ' class="location"' : '').'>Investment Building</a></li>';
    $n .= '<li><a href="100-5th.html"'.($p=='100-5th' ? ' class="location"' : '').'>Diamond Building</a></li>';
    $n .= '<li><a href="PittMedical.html"'.($p=='PittMedical' ? ' class="location"' : '').'>Pittsburgh Medical Space</a></li>';
    $n .= '<li><a href="PITCMap.html"'.($p=='PITCMap' ? ' class="location"' : '').'>Map and Sonnet Ring</a></li>';
    $n .= '<li><a href="Mediation.html"'.($p=='Mediation' ? ' class="location"' : '').'>Mediation Space</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="InstantOffices.html"'.($p=='InstantOffices' ? ' class="location"' : '').'>Instant Office</a></li>';
	$n .= '<li><a href="cbdFlier.html"'.($p=='cbdFlier' ? ' class="location"' : '').'>C.B.D. Office Lofts</a></li>';
	$n .= '<li><a href="ClssRmSp.html"'.($p=='ClssRmSp' ? ' class="location"' : '').'>Classrooms &amp; Conference Rooms</a></li>';
	$n .= '<li><a href="ColsWarehouse.html"'.($p=='ColsWarehouse' ? ' class="location"' : '').'>Warehouse Space</a></li>';
	$n .= '<li><a href="EventSpace.html"'.($p=='EventSpace' ? ' class="location"' : '').'>Event Space</a>';
  if($event)
		{$n .= '<ul>';
		$n .= '<li><a href="ColsEvent1.html"'.($p=='ColsEvent1' ? ' class="location"' : '').'>The Vault</a></li>';
		$n .= '<li><a href="ColsEvent2.html"'.($p=='ColsEvent2' ? ' class="location"' : '').'>Penninsula Warehouse</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="RestaurantSpace.html"'.($p=='RestaurantSpace' ? ' class="location"' : '').'>Restaurant Space</a>';
  if($restaurant)
		{$n .= '<ul>';
		$n .= '<li><a href="CleveResturant.htm"'.($p=='CleveResturant.htm' ? ' class="location"' : '').'>Cleveland Space</a></li>';
		$n .= '<li><a href="PittRestaurant.html"'.($p=='PittRestaurant' ? ' class="location"' : '').'>Pittsburgh Space</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="DesignCntr.html"'.($p=='DesignCntr' ? ' class="location"' : '').'>Design Center</a></li>';
	$n .= '<li><a href="PITC.html"'.($p=='PITC' ? ' class="location"' : '').'>Central Exchange</a>';
	if($central_exchange)
		{$n .= '<ul>';
		$n .= '<li><a href="Central%20Exchange(NewER).htm"'.($p=='Central Exchange(NewER)' ? ' class="location"' : '').'>Pittsburgh</a></li>';
		$n .= '<li><a href="Central%20Exchange(Cleveland).htm"'.($p=='Central Exchange(Cleveland)' ? ' class="location"' : '').'>Cleveland</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="RoylFin.html"'.($p=='RoylFin' ? ' class="location"' : '').'>Royal Financing</a></li>';
	$n .= '<li><a href="AboutUs.html"'.($p=='AboutUs' ? ' class="location"' : '').'>About Us</a></li>';
	$n .= '<li><a href="Clients.html"'.($p=='Clients' ? ' class="location"' : '').'>Company Clients</a></li>';
	$n .= '<li><a href="Emplymt.html"'.($p=='Emplymt' ? ' class="location"' : '').'>Employment</a>';
  if($employment)
		{$n .= '<ul>';
		$n .= '<li><a href="EmpAcctExec.html"'.($p=='EmpAcctExec' ? ' class="location"' : '').'>Account Executives</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="Customer%20Service%20Center.html"'.($p=='Customer Service Center' ? ' class="location"' : '').'>Customer Center</a>';
	if($customer_center)
		{$n .= '<ul>';
    $n .= '<li><a href="I%20need%20office%20or%20storage%20space.htm"'.($p=='I need office or storage space' ? ' class="location"' : '').'>Space Request</a></li>';
    $n .= '<li><a href="Submit%20your%20automatic%20debit%20form.htm"'.($p=='Submit your automatic debit form' ? ' class="location"' : '').'>Debit Form</a></li>';
    $n .= '<li><a href="Tenant%20Referral%20program.htm"'.($p=='Tenant Referral program' ? ' class="location"' : '').'>Referral Program</a></li>';
    $n .= '<li><a href="maintenance%20requests.htm"'.($p=='maintenance requests' ? ' class="location"' : '').'>Maintenance Requests</a></li>';
    $n .= '<li><a href="Submit%20an%20article%20for%20newsletter.htm"'.($p=='Submit an article for newsletter' ? ' class="location"' : '').'>Submit An Article</a></li>';
    $n .= '<li><a href="Where%20do%20I%20mail%20my%20rent.htm"'.($p=='Where do I mail my rent' ? ' class="location"' : '').'>Where To Mail Rent</a></li>';
    $n .= '<li><a href="Service%20Directory.htm"'.($p=='Service Directory' ? ' class="location"' : '').'>Service Directory</a></li>';
		$n .= '<li><a href="Parking.htm"'.($p=='Parking' ? ' class="location"' : '').'>Parking</a></li>';
		$n .= '<li><a href="FAQs.htm"'.($p=='FAQs' ? ' class="location"' : '').'>FAQ</a></li>';
		$n .= '</ul>';}
		$n .= '</li>';
	$n .= '<li><a href="Contact.html"'.($p=='Contact' ? ' class="location"' : '').'>Contact Us</a></li>';
	
	return $n;
}
?>
