<?php
global $wpdb;
$table_name_slider = $wpdb->prefix . 'GenerationPlugin_SLIDER';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }

//if admin is logged in
if ($user_level>9) { $sliderstopmargin = "128px"; } else { $sliderstopmargin = "100px"; }


$DSlider_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
$DSlider_display = explode("|", $DSlider_displays);
$DSlider_showsub = $DSlider_display[3];
if ($DSlider_showsub=="on" && $_COOKIE["gpsubscribed_slider"]=="subscribed") { /* STOP HERE */ } 
else { //START IF 'SUBSCRIBED' IS NOT ACTIVE


$DSlider_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_slider.' WHERE id='.$Duniqueid);
if ($DSlider_active_tmp=="on") { //START IF ACTIVATED


$DSlider_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
$DSlider_display = explode("|", $DSlider_display);
if ($DSlider_display[6]=='' || ($DSlider_display[6]!="" && strtotime($DSlider_display[6]) <= strtotime(date("Y-m-d")))) {
	$DSlider_ddays_1="1";
} else {$DSlider_ddays_1="0";}
if ($DSlider_display[7]=='' || ($DSlider_display[7]!="" && strtotime($DSlider_display[7]) > strtotime(date("Y-m-d")))) {
	$DSlider_ddays_2="1";
} else {$DSlider_ddays_2="0";}
if ($DSlider_ddays_1=="1" && $DSlider_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$DSlider_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_theme = preg_replace("/\\\/","",$DSlider_theme);
if ($DSlider_theme=="") {$DSlider_theme = "slider1";} //default
$DSlider_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_link = preg_replace("/\\\/","",$DSlider_link);
if ($DSlider_link=="") {$DSlider_link = "#";} //default
$DSlider_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
if ($DSlider_link_blank!="") {$Slider_link_blank = 'target="_blank"';} else {$Slider_link_blank = 'target="_parent"';}

$DSlider_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_image = preg_replace("/\\\/","",$DSlider_image);
if ($DSlider_image=="") {$DSlider_image = GenerationPlugin_images.'/boxes/book-2.png';} //default
else { $DSlider_image = $DSlider_image;}
$DSlider_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_bgimage = preg_replace("/\\\/","",$DSlider_bgimage);

$DSlider_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_btncolor = preg_replace("/\\\/","",$DSlider_btncolor);
$DSlider_btncolor = explode("|", $DSlider_btncolor);
$DSlider_btncolor = $DSlider_btncolor[3];
if ($DSlider_btncolor=="" || $DSlider_btncolor=="Stripe design") {$DSlider_btncolor = "stripe_red";}
if ($DSlider_btncolor=="Simple design") {$DSlider_btncolor = "simple_red";}

$DSlider_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_form_tmp = preg_replace("/\\\/","",$DSlider_form);
    $DSlider_formx = explode("|", $DSlider_form_tmp);
	$DSlider_form = $DSlider_formx[0];
	$DSlider_bookmarkclr = $DSlider_formx[12];
	
$DSlider_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_background = preg_replace("/\\\/","",$DSlider_background);
if (($DSlider_form!='custom') && ($DSlider_theme=='slider1' || $DSlider_theme=='slider2' || $DSlider_theme=='slider3' || $DSlider_theme=='slider4' || $DSlider_theme=='slider5' || $DSlider_theme=='slider6' || $DSlider_theme=='slider7' || $DSlider_theme=='slider8' || $DSlider_theme=='slider9' || $DSlider_theme=='slider10' || $DSlider_theme=='slider11' || $DSlider_theme=='slider12' || $DSlider_theme=='slider13' || $DSlider_theme=='slider14' || $DSlider_theme=='slider15' || $DSlider_theme=='slider16' || $DSlider_theme=='slider17' || $DSlider_theme=='slider18' || $DSlider_theme=='slider19' || $DSlider_theme=='slider20')) {
	$DSlider_bgcolor = '#222';
    if ($DSlider_bgimage!="") {$DSlider_bgimage = $DSlider_bgimage;}
    elseif ($DSlider_background=='bg2') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DSlider_background=='bg3') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DSlider_background=='bg4') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} elseif ($DSlider_form=='custom' && $DSlider_bookmarkclr=='dark') {
	$DSlider_bgcolor = '#222';
    if ($DSlider_background=='bg2') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DSlider_background=='bg3') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DSlider_background=='bg4') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} elseif ($DSlider_form=='custom' && $DSlider_bookmarkclr=='light') {
	$DSlider_bgcolor = '#CCC';
    if ($DSlider_background=='bg12') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DSlider_background=='bg13') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DSlider_background=='bg14') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
} else {
	$DSlider_bgcolor = '#CCC';
    if ($DSlider_bgimage!="") {$DSlider_bgimage = $DSlider_bgimage;}
    elseif ($DSlider_background=='bg12') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DSlider_background=='bg13') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DSlider_background=='bg14') {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DSlider_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
}

$DSlider_bookmark = stripslashes($wpdb->get_var('SELECT Slidelink FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_bookmark = preg_replace("/\\\/","",$DSlider_bookmark);
if ($DSlider_bookmark=="") {$DSlider_bookmark = "Your Awesome Offer";} //default
$DSlider_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_title_tmp = preg_replace("/\\\/","",$DSlider_title_tmp);
    $DSlider_title = explode("|", $DSlider_title_tmp);
	$DSlider_headclr = $DSlider_title[0];
	if ($DSlider_headclr=="" || $DSlider_headclr=="#") {$DSlider_headclr = "#CC3300";} //default
	$DSlider_headtxt = $DSlider_title[1];
	if ($DSlider_headtxt=="") {$DSlider_headtxt = "Header Title Goes Here!";} //default
	if (strpos($DSlider_headtxt,"(")!==false) {
		$DSlider_headtxt=explode("(",$DSlider_headtxt);
		$DSlider_headtxtF=$DSlider_headtxt[0]; //front
		$DSlider_headtxt=explode(")",$DSlider_headtxt[1]);
		$DSlider_headtxtT=$DSlider_headtxt[0]; //time
		$DSlider_headtxtE=$DSlider_headtxt[1]; //end
		$DSlider_countdown="on";
	}
    function gpcountdown_slider($atts) {
    	extract(shortcode_atts(array("time" => "10", "front" => "", "end" => "", "type" => "slider"),$atts));
    	return gpcountdownreturn($time,$front,$end,$type);
    }
    add_shortcode("gpcountdown_slider", "gpcountdown_slider");
$DSlider_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_text = preg_replace("/\\\/","",$DSlider_text);
if ($DSlider_text=="") {$DSlider_text = "This is an example of subtitle or description text. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt quasi architecto beatae vitae dicta sunt explicabo.";} //default
$DSlider_formtitle = stripslashes($wpdb->get_var('SELECT Formtitle FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_formtitle = preg_replace("/\\\/","",$DSlider_formtitle);
if ($DSlider_formtitle=="") {$DSlider_formtitle = "Your Details";} //default
$DSlider_formtext = stripslashes($wpdb->get_var('SELECT Formtext FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_formtext = preg_replace("/\\\/","",$DSlider_formtext);
if ($DSlider_formtext=="") {$DSlider_formtext = "This is an example of form text, edit it in admin panel.";} //default

$DSlider_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_form_tmp = preg_replace("/\\\/","",$DSlider_form);
    $DSlider_formx = explode("|", $DSlider_form_tmp);
	$DSlider_form = $DSlider_formx[0];
	$DSlider_formtype = $DSlider_formx[1];
	$DSlider_clink = $DSlider_formx[2];
	$DSlider_cclick1 = $DSlider_formx[3];
	$DSlider_cblank = $DSlider_formx[4];
	if ($DSlider_cblank=="_blank") {$DSlider_cblank="_blank";} else {$DSlider_cblank="_top";}
	$DSlider_cbgimage = $DSlider_formx[5];
	if ($DSlider_cbgimage!='') {$DSlider_cimage = $DSlider_cbgimage;} else {$DSlider_cimage = $DSlider_cclick1;}
	$DSlider_cclick2 = $DSlider_formx[6];
	$DSlider_cwidth = $DSlider_formx[7];
	if ($DSlider_cwidth=="") {$DSlider_cwidth="760";} //default
	$DSlider_cwidth_i = $DSlider_cwidth + 24;
	$DSlider_cheight = $DSlider_formx[8];
	if ($DSlider_cheight=="") {$DSlider_cheight="360";} //default
	$DSlider_cheight_i = $DSlider_cheight - 30;
	$DSlider_cscroll = $DSlider_formx[9];
	if ($DSlider_cscroll=="scroll") {$DSlider_cscroll="scroll";} else {$DSlider_cscroll="hidden";}
	if ($DSlider_form=="") {$DSlider_form="link";} //default
	$DSlider_orientation = $DSlider_formx[10];
	$DSlider_cfullw = $DSlider_formx[11];
	$DSlider_bookmarkclr = $DSlider_formx[12];
	
$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
	$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
	$gp_d56 = explode("|", $gp_d56_tmp);
	$gp_d5 = $gp_d56[0];
	$gp_d6 = $gp_d56[1];
	if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
	if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default
	
$DSlider_listpoint_tmp = stripslashes($wpdb->get_var('SELECT Listpoint FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_listpoint_tmp = preg_replace("/\\\/","",$DSlider_listpoint_tmp);
    $DSlider_listpoint = explode("|", $DSlider_listpoint_tmp);
	if ($DSlider_listpoint[0]!="") { $DSlider_point1 = "<li>".$DSlider_listpoint[0]."</li>"; } else { $DSlider_point1=""; }
	if ($DSlider_listpoint[1]!="") { $DSlider_point2 = "<li>".$DSlider_listpoint[1]."</li>"; } else { $DSlider_point2=""; }
	if ($DSlider_listpoint[2]!="") { $DSlider_point3 = "<li>".$DSlider_listpoint[2]."</li>"; } else { $DSlider_point3=""; }
	if ($DSlider_listpoint[3]!="") { $DSlider_point4 = "<li>".$DSlider_listpoint[3]."</li>"; } else { $DSlider_point4=""; }
	if ($DSlider_listpoint[4]!="") { $DSlider_point5 = "<li>".$DSlider_listpoint[4]."</li>"; } else { $DSlider_point5=""; }
	if ($DSlider_listpoint[5]!="") { $DSlider_point6 = "<li>".$DSlider_listpoint[5]."</li>"; } else { $DSlider_point6=""; }
	$DSlider_pointall = $DSlider_listpoint[0].$DSlider_listpoint[1].$DSlider_listpoint[2].$DSlider_listpoint[3].$DSlider_listpoint[4].$DSlider_listpoint[5];
	if (preg_replace("/<li><\/li>/","",$DSlider_pointall)=="") {
    	$DSlider_point1 = "<li>Sample list point number 1 goes here</li>";
    	$DSlider_point2 = "<li>Sample list point number 2 goes here</li>";
    	$DSlider_point3 = "<li>Sample list point number 3 goes here</li>";
    	$DSlider_point4 = "<li>Sample list point number 4 goes here</li>";
    	$DSlider_point5 = "<li>Sample list point number 5 goes here</li>";
    	$DSlider_point6 = "<li>Sample list point number 6 goes here</li>";
	}

if ($DSlider_form=='regular' || $DSlider_form=='') {
	$DSliderf1_view='style="display:block"'; $DSliderf2_view='style="display:none"'; $DSliderf3_view='style="display:none"';
}
elseif ($DSlider_form=='social') {
	$DSliderf1_view='style="display:none"'; $DSliderf2_view='style="display:block"'; $DSliderf3_view='style="display:none"';
}
elseif ($DSlider_form=='both') {
	$DSliderf1_view='style="display:block"'; $DSliderf2_view='style="display:none"'; $DSliderf3_view='style="display:none"';
}
elseif ($DSlider_form=='link') {
	$DSliderf1_view='style="display:none"'; $DSliderf2_view='style="display:none"'; $DSliderf3_view='style="display:block"';
}

$DSlider_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_regular_tmp = preg_replace("/\\\/","",$DSlider_regular_tmp);
    $DSlider_regular = explode("|", $DSlider_regular_tmp);
	$Slider_fname = $DSlider_regular[0];
	if ($Slider_fname=="") {$Slider_fname = "Insert your name";} //default
	$Slider_femail = $DSlider_regular[1];
	if ($Slider_femail=="") {$Slider_femail = "Insert your email";} //default
	$Slider_fbtntxt = $DSlider_regular[2];
	if ($Slider_fbtntxt=="") {$Slider_fbtntxt = "SUBSCRIBE";} //default
	if ($DSlider_regular[4]=="1") {$Slider_name_disabled="style='display:none'"; $Slider_name_padding="style='padding-left:110px!important'";}
	
$DSlider_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_spam = preg_replace("/\\\/","",$DSlider_spam);
if ($DSlider_spam=="") {$DSlider_spam = "We will not share your details with anyone, we promise!";} //default
$DSlider_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_optin = preg_replace("/\\\/","",$DSlider_optin);
	$DSlider_optin = preg_replace("/<br>/","\n",$DSlider_optin);
	$DSlider_optin = preg_replace("/\\\/","",$DSlider_optin);
	$DSlider_optin = explode("|",$DSlider_optin);
	$DSlider_optinsubmit = $DSlider_optin[8];
	
$DSlider_video = stripslashes($wpdb->get_var('SELECT Video FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
	$DSlider_video = preg_replace("/\\\/","",$DSlider_video);
$DSlider_video480 = $DSlider_video;
if ($DSlider_video=="") {$DSlider_video = '<iframe width="640" height="360" src="http://player.vimeo.com/video/50556989" frameborder="0" allowfullscreen></iframe>';} //default
if ($DSlider_video480=="") {$DSlider_video480 = '<iframe width="480" height="360" src="http://player.vimeo.com/video/50556989" frameborder="0" allowfullscreen></iframe>';} //default

$DSlider_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_slider.' WHERE id='.$Duniqueid));
    $DSlider_display = explode("|", $DSlider_display);
	$DSlider_dpages = $DSlider_display[0];
	$DSlider_dcats = $DSlider_display[1];
	$DSlider_dposts = $DSlider_display[2];
	$DSlider_showsub = $DSlider_display[3];
	if ($DSlider_showsub=="on") {$DSlider_showsub="checked";}
	$DSlider_ddelay = $DSlider_display[4];
	if ($DSlider_ddelay<0 || $DSlider_ddelay=="0" || $DSlider_ddelay=="") { $DSlider_ddelay="0"; }
	$DSlider_ddays = (strtotime($DSlider_display[5]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	if ($DSlider_ddays<0 || $DSlider_ddays=="0") { $DSlider_ddays="0"; }
?>

<?php
//DISPLAYING

//prepare page list in array
$DSlider_dpages_explode=explode(",",$DSlider_dpages);
foreach ($DSlider_dpages_explode as $DSlider_dpages_explode_element) { $DSlider_dpages_array[]=$DSlider_dpages_explode_element; }
//prepare category list in array
$DSlider_dcats_explode=explode(",",$DSlider_dcats);
foreach ($DSlider_dcats_explode as $DSlider_dcats_explode_element) { $DSlider_dcats_array[]=$DSlider_dcats_explode_element; }
//prepare posts list in array
$DSlider_dposts_explode=explode(",",$DSlider_dposts);
foreach ($DSlider_dposts_explode as $DSlider_dposts_explode_element) { $DSlider_dposts_array[]=$DSlider_dposts_explode_element; }

if (((strpos($DSlider_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DSlider_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DSlider_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DSlider_dpages.',',',author,')!==false) || //author page
	 (is_page($DSlider_dpages_array)))) || //pages and subpages
   ((strpos($DSlider_dcats,'allcats')!==false) &&
	 (is_category($DSlider_dcats_array))) || //category pages
   ((strpos($DSlider_dposts,'allposts')!==false) &&
	 (is_single($DSlider_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>

        <script type="text/javascript">
    	var $jj = jQuery.noConflict();
    	function isValidUserCHECK_slider() {
    		var user_slider = $jj("#gpuserinput_slider").val();
    		var email_slider = $jj("#gpemailinput_slider").val();
    		if(user_slider != 0) {
    			if(isValidUser_slider(user_slider)) {
    				$jj("#gpuserinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				if(isValidEmailAddress_slider(email_slider)) {
    					document.getElementById('verified_slider').type="submit";
    				}
    			} else {
    				$jj("#gpuserinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_slider').type="button";
    			}
    		} else {
    			$jj("#gpuserinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_slider').type="button";
    		}
    	}
    	function isValidEmailCHECK_slider() {
    		var user_slider = $jj("#gpuserinput_slider").val();
    		var email_slider = $jj("#gpemailinput_slider").val();
    		if(email_slider != 0) {
    			if(isValidEmailAddress_slider(email_slider)) {
    				$jj("#gpemailinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				if(isValidUser_slider(user_slider)) {
    					document.getElementById('verified_slider').type="submit";
    				}
    			} else {
    				$jj("#gpemailinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_slider').type="button";
    			}
    		} else {
    			$jj("#gpemailinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_slider').type="button";
    		}
    	}
    	function isValidUser_slider(user_slider) {
     		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
     		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
     		return patternone.test(user_slider);
    	}
    	function isValidEmailAddress_slider(email_slider) {
     		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
     		return pattern.test(email_slider);
    	}
    	</script>
		<?php
		if ($DLivecheck=='on') {
			?>
			<script type="text/javascript">
         	var $jj = jQuery.noConflict();
    		$jj(document).ready(function(){
         		var user_slider = $jj("#gpuserinput_slider").val();
         		var email_slider = $jj("#gpemailinput_slider").val();
        		if(isValidUser_slider(user_slider) && isValidEmailAddress_slider(email_slider)) {
    				$jj("#gpuserinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				$jj("#gpemailinput_slider").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				document.getElementById('verified_slider').type="submit";
    			}
    		});
			</script>
			<?php
        	$gpnameinput_slider='onkeyup="isValidUserCHECK_slider();" onblur="isValidUserCHECK_slider();" onclick="isValidUserCHECK_slider();" onfocus="isValidUserCHECK_slider();"';
        	$gpemailinput_slider='onkeyup="isValidEmailCHECK_slider();" onblur="isValidEmailCHECK_slider();" onclick="isValidEmailCHECK_slider();" onfocus="isValidEmailCHECK_slider();"';
        	$gpformbtn_slider='button';
        } else {
        	$gpnameinput_slider='';
        	$gpemailinput_slider='';
        	$gpformbtn_slider='submit';
        }
		if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
			$gpmydataslidercookie = explode("|",$_COOKIE['gpmydetails']);
			$Slider_fname = $gpmydataslidercookie[0];
			$Slider_femail = $gpmydataslidercookie[1];
		}
		?>
		
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
        $jj(document).ready(function(){
			//default values in form
			$jj('input[type=text]').each(function(){ $jj(this).data('default', this.value); });
			$jj('input[type=text]').focusin(function(){ if (this.value==$jj(this).data('default')) {this.value='';} });
			$jj('input[type=text]').focusout(function(){ if (this.value=='') {this.value=$jj(this).data('default');} });
			setTimeout(function(){
                var open = false;
				<?php
				if (($DSlider_form=='custom' && $DSlider_orientation=='top') ||
				($DSlider_theme=='slider1' || $DSlider_theme=='slider31' ||
				$DSlider_theme=='slider5' || $DSlider_theme=='slider35' || 
				$DSlider_theme=='slider7' || $DSlider_theme=='slider37' || 
				$DSlider_theme=='slider9' || $DSlider_theme=='slider39' || 
				$DSlider_theme=='slider11' || $DSlider_theme=='slider41' || 
				$DSlider_theme=='slider13' || $DSlider_theme=='slider43' || 
				$DSlider_theme=='slider17' || $DSlider_theme=='slider47' || 
				$DSlider_theme=='slider19' || $DSlider_theme=='slider49') && ($DSlider_form!='custom')) {
				?>
        			//TOP
                    var $blockheight = null;
                    $blockheight_start = $jj("#GP_sliders").height()+100;
                    $blockheight = $jj("#GP_sliders").height()-10;
                    $jj("#GP_sliders").css({"display": "block", "position": "fixed", "top": "-"+$blockheight_start+"px", "z-index": "99999"});
                    $jj("#GP_sliders").animate({"top": "+=<?php echo $sliderstopmargin; ?>"}, 500);
                    $jj("#GP_bookmark").click(function(){
                        if(open === false) { $jj("#GP_sliders").animate({"top": "+="+$blockheight}, 400);
                        					 $jj("#GP_sliders").animate({"top": "-=20px"}, 300); open = true; }
                        else { $jj("#GP_sliders").animate({"top": "+=20px"}, 300);
                        	   $jj("#GP_sliders").animate({"top": "-="+$blockheight}, 400); open = false; }
                    });
				<?php }
				if (($DSlider_form=='custom' && $DSlider_orientation=='bottom') ||
				($DSlider_theme=='slider2' || $DSlider_theme=='slider32' ||
				$DSlider_theme=='slider6' || $DSlider_theme=='slider36' || 
				$DSlider_theme=='slider8' || $DSlider_theme=='slider38' || 
				$DSlider_theme=='slider10' || $DSlider_theme=='slider40' || 
				$DSlider_theme=='slider12' || $DSlider_theme=='slider42' || 
				$DSlider_theme=='slider14' || $DSlider_theme=='slider44' || 
				$DSlider_theme=='slider18' || $DSlider_theme=='slider48' || 
				$DSlider_theme=='slider20' || $DSlider_theme=='slider50') && ($DSlider_form!='custom')) { 
				?>
    				//BOTTOM
                    var $blockheight = null;
                    $blockheight_start = $jj("#GP_sliders").height()+100;
                    $blockheight = $jj("#GP_sliders").height()-10;
                	$jj("#GP_sliders").css({"display": "block", "position": "fixed", "bottom": "-"+$blockheight_start+"px", "z-index": "99999"});
                	$jj("#GP_sliders").animate({"bottom": "+=100px"}, 500);
                    $jj("#GP_bookmark").click(function(){
                    	if(open === false) { $jj("#GP_sliders").animate({"bottom": "+="+$blockheight}, 400);
                    						 $jj("#GP_sliders").animate({"bottom": "-=20px"}, 300); open = true; }
                    	else { $jj("#GP_sliders").animate({"bottom": "+=20px"}, 300);
                    		   $jj("#GP_sliders").animate({"bottom": "-="+$blockheight}, 400); open = false; }
                    });
				<?php }
				if (($DSlider_form=='custom' && $DSlider_orientation=='left') ||
				($DSlider_theme=='slider3' || $DSlider_theme=='slider33' ||
				$DSlider_theme=='slider15' || $DSlider_theme=='slider45') && ($DSlider_form!='custom')) { 
				?>
    				//LEFT
                    var $blockwidth = null;
                    $blockwidth_start = $jj("#GP_sliders").width()+100;
                    $blockwidth = $jj("#GP_sliders").width();
                	$jj("#GP_sliders").css({"display": "block", "position": "fixed", "left": "-"+$blockwidth_start+"px", "z-index": "99999"});
                	$jj("#GP_sliders").animate({"left": "+=100px"}, 500);
                    $jj("#GP_bookmark").click(function(){
                    	if(open === false) { $jj("#GP_sliders").animate({"left": "+="+$blockwidth}, 400);
                    						 $jj("#GP_sliders").animate({"left": "-=20px"}, 300); open = true; }
                    	else { $jj("#GP_sliders").animate({"left": "+=20px"}, 300);
                    		   $jj("#GP_sliders").animate({"left": "-="+$blockwidth}, 400); open = false; }
                    });
					
					//height 100% for left and right sliding panel
        			var gpdoch = null;
        			$gpdoch = $jj(window).height();
        			$jj(".GP_inside").css({"height": +$gpdoch+"px", "margin-top": "10px"});
        			$jj(window).resize(function() {
        				var gpdoch = null;
        				$gpdoch = $jj(window).height();
        				$jj(".GP_inside").css({"height": +$gpdoch+"px", "margin-top": "10px"});
                    });
        			//vertical center displaying for left and right sliding panel
        			var gpinsh = null;
        			$gpinsh = $jj(".GP_inside_custom").height();
        			$gptoph = ($gpdoch - $gpinsh)/2;
        			$gpbooh = ($gpdoch)/2;
        			$jj(".GP_container").css({"padding-top": +$gptoph+"px"});
        			$jj(".GP_your-free-book").css({"top": +$gpbooh+"px", "margin-top": "-90px"});
        			$jj(window).resize(function() {
        				var gpdoch = null;
            			$gpinsh = $jj(".GP_inside_custom").height();
            			$gptoph = ($gpdoch - $gpinsh)/2;
            			$gpbooh = ($gpdoch)/2;
            			$jj(".GP_container").css({"padding-top": +$gptoph+"px"});
            			$jj(".GP_your-free-book").css({"top": +$gpbooh+"px", "margin-top": "-90px"});
                    });
				<?php }
				if (($DSlider_form=='custom' && $DSlider_orientation=='right') ||
				($DSlider_theme=='slider4' || $DSlider_theme=='slider34' ||
				$DSlider_theme=='slider16' || $DSlider_theme=='slider46') && ($DSlider_form!='custom')) {
				?>
    				//RIGHT
                    var $blockwidth = null;
                    $blockwidth_start = $jj("#GP_sliders").width()+100;
                    $blockwidth = $jj("#GP_sliders").width();
                	$jj("#GP_sliders").css({"display": "block", "position": "fixed", "right": "-"+$blockwidth_start+"px", "z-index": "99999"});
                	$jj("#GP_sliders").animate({"right": "+=100px"}, 500);
                    $jj("#GP_bookmark").click(function(){
                    	if(open === false) { $jj("#GP_sliders").animate({"right": "+="+$blockwidth}, 400);
                    						 $jj("#GP_sliders").animate({"right": "-=20px"}, 300); open = true; }
                    	else { $jj("#GP_sliders").animate({"right": "+=20px"}, 300);
                    		   $jj("#GP_sliders").animate({"right": "-="+$blockwidth}, 400); open = false; }
                    });
					
					//height 100% for left and right sliding panel
        			var gpdoch = null;
        			$gpdoch = $jj(window).height();
        			$jj(".GP_inside").css({"height": +$gpdoch+"px", "margin-top": "10px"});
        			$jj(window).resize(function() {
        				var gpdoch = null;
        				$gpdoch = $jj(window).height();
        				$jj(".GP_inside").css({"height": +$gpdoch+"px", "margin-top": "10px"});
                    });
        			//vertical center displaying for left and right sliding panel
        			var gpinsh = null;
        			$gpinsh = $jj(".GP_inside_custom").height();
        			$gptoph = ($gpdoch - $gpinsh)/2;
        			$gpbooh = ($gpdoch)/2;
        			$jj(".GP_container").css({"padding-top": +$gptoph+"px"});
        			$jj(".GP_your-free-book").css({"top": +$gpbooh+"px", "margin-top": "-90px"});
        			$jj(window).resize(function() {
        				var gpdoch = null;
            			$gpinsh = $jj(".GP_inside_custom").height();
            			$gptoph = ($gpdoch - $gpinsh)/2;
            			$gpbooh = ($gpdoch)/2;
            			$jj(".GP_container").css({"padding-top": +$gptoph+"px"});
            			$jj(".GP_your-free-book").css({"top": +$gpbooh+"px", "margin-top": "-90px"});
                    });
				<?php } ?>
			},<?php echo $DSlider_ddelay;?>*1000);
        });
		//Form switch
		$jj(document).ready( function(){ 
        	$jj(".GP_s_en_slider").click(function(){
        		var parent = $jj(this).parents('.GP_s_slider');
        		$jj('.GP_s_di_slider',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Slider_s_show2').fadeOut(500);
        		$jj('#Slider_s_show1').delay(505).fadeIn(500);
        	});
        	$jj(".GP_s_di_slider").click(function(){
        		var parent = $jj(this).parents('.GP_s_slider');
        		$jj('.GP_s_en_slider',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Slider_s_show1').fadeOut(500);
        		$jj('#Slider_s_show2').delay(505).fadeIn(500);
        	});
			var switchwidth1 = $jj('.GP_s_en_slider').width();
			var switchwidth2 = $jj('.GP_s_di_slider').width();
			var switchwidth = switchwidth1+switchwidth2;
			$jj('.GP_s_slider').css({'width': ''+switchwidth+''});
        });
        </script>
		<div style="position:fixed; top:-9999; visibility:hidden" class="GP_s_slider">
            <label class="GP_s_en_slider"><span><?php echo $gp_d5; ?></span></label>
            <label class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
        </div>
		
		<style>
		.Generation_plug.GP_slidebox h2 strong span {
		  color:<?php echo $DSlider_headclr; ?>;
		}
		</style>

		<?php
		if ($DSlider_theme=='slider31' || $DSlider_theme=='slider32' || $DSlider_theme=='slider33' || $DSlider_theme=='slider34' || $DSlider_theme=='slider35' || $DSlider_theme=='slider36' || $DSlider_theme=='slider37' || $DSlider_theme=='slider38' || $DSlider_theme=='slider39' || $DSlider_theme=='slider40' || $DSlider_theme=='slider41' || $DSlider_theme=='slider42' || $DSlider_theme=='slider43' || $DSlider_theme=='slider44' || $DSlider_theme=='slider45' || $DSlider_theme=='slider46' || $DSlider_theme=='slider47' || $DSlider_theme=='slider48' || $DSlider_theme=='slider49' || $DSlider_theme=='slider50' || ($DSlider_form=='custom' && $DSlider_bookmarkclr=='light')) {
			wp_enqueue_style('style user_light-2', GenerationPlugin_style.'/style-light-2.css');
			$GP_lighter = "on";
		} else {
			$GP_lighter = "off";
		}
		$DSlider_bgrepeat = 'repeat center center';
		?>
		

		<?php if ($DSlider_form=="custom") { ?>
		<!-- vertical -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_orientation=='top') { $DSpos = "top"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width665" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_orientation=='bottom') { $DSpos = "bottom"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width665" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_orientation=='left') { $DSpos = "left"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_left-top GP_vertical" id="GP_sliders" style="width:1200px!important; position:fixed; left:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>; max-width:<?php echo $DSlider_cwidth_i; ?>px!important; height:105%!important">
			<?php } if ($DSlider_orientation=='right') { $DSpos = "right"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_right-top GP_vertical" id="GP_sliders" style="width:1200px!important; position:fixed; right:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>; max-width:<?php echo $DSlider_cwidth_i; ?>px!important; height:105%!important">
			<?php } ?>
                <div class="GP_content" style="padding:0!important; padding-left:0!important; height:105%!important">
					<?php 
					if ($DSpos=='top') {$DSlider_cmargin = 'margin-top:30px!important; max-height:'.$DSlider_cheight_i.'px!important';} 
					elseif ($DSpos=='bottom') {$DSlider_cmargin = 'max-height:'.$DSlider_cheight_i.'px!important';}
					if ($DSlider_cfullw=="fullw" && ($DSpos=='top' || $DSpos=='bottom')) {$DSlider_cwidth = '100%';} 
					else {$DSlider_cwidth = $DSlider_cwidth.'px';} 
					?>
					<?php if ($DSlider_formtype=='link' || $DSlider_formtype=='') { ?>
    					<div class="GP_container_custom" style="width:100%!important; padding:0!important; padding-left:0!important; height:105%!important">
                        <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="margin-top:-46px; background:<?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
        					<div class="GP_inside" style="margin:0 auto!important; background:#FFF; 
        						width:<?php echo $DSlider_cwidth; ?>!important;
    							height:<?php echo $DSlider_cheight; ?>px!important; overflow:hidden"
            				>
            					<iframe class="GP_pmzero" src="<?php echo $DSlider_clink; ?>" width="100%" style="height:100%; width:100%; overflow-x:hidden; overflow-y:<?php echo $DSlider_cscroll; ?>; <?php echo $DSlider_cmargin; ?>" ></iframe>
            				</div>
						</div>
					<?php } elseif ($DSlider_formtype=='image') { ?>
						<div class="GP_container" style="width:100%!important; padding:0!important; padding-left:0!important; height:105%!important">
                    	<a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book GP_image" style="margin-top:-46px; background:<?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
        					<div class="GP_inside" style="margin:0 auto!important; background:#FFF;
        						width:<?php echo $DSlider_cwidth; ?>!important; 
        						height:<?php echo $DSlider_cheight; ?>px!important; overflow:hidden;
								background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>;"
            				>
    							<div class="GP_inside_custom">
                					<a href="<?php echo $DSlider_cclick2; ?>" target="<?php echo $DSlider_cblank; ?>">
                						<img style="overflow:hidden; display:block; margin:0 auto" src="<?php echo $DSlider_cimage; ?>">
                					</a>
            					</div>
            				</div>
            			</div>
					<?php } ?>

            	</div>
            	</div>
        </div>
		<?php } elseif ($DSlider_theme=='slider1' || $DSlider_theme=='slider31' ||
		$DSlider_theme=='slider2' || $DSlider_theme=='slider32' ||
		$DSlider_theme=='slider3' || $DSlider_theme=='slider33' ||
		$DSlider_theme=='slider4' || $DSlider_theme=='slider34') {
		?>
		<!-- vertical -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider1' || $DSlider_theme=='slider31') { $DSpos = "top"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width665" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider2' || $DSlider_theme=='slider32') { $DSpos = "bottom"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width665" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider3' || $DSlider_theme=='slider33') { $DSpos = "left"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_left-top GP_vertical" id="GP_sliders" style="position:fixed; left:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider4' || $DSlider_theme=='slider34') { $DSpos = "right"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_right-top GP_vertical" id="GP_sliders" style="position:fixed; right:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
                <div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>		
                    <div class="GP_inside">
						<div class="GP_inside_custom">
                        <h2 style="margin-top:-10px" class="GP_a-center"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php if ($DSlider_countdown=="on") {do_shortcode("[gpcountdown_slider time=".$DSlider_headtxtT." front='".$DSlider_headtxtF."' end='".$DSlider_headtxtE."']");} else {echo $DSlider_headtxt;} ?></strong></h2>       
                        <p class="GP_fs12 GP_a-center"><?php echo $DSlider_text; ?></p>
                        <div class="GP_o-hidden">
                            <img src="<?php echo $DSlider_image; ?>" alt="" class="GP_f-right" />
                            <ul class="GP_list">
                                <?php echo $DSlider_point1; ?>
                                <?php echo $DSlider_point2; ?>
                                <?php echo $DSlider_point3; ?>
                                <?php echo $DSlider_point4; ?>
                                <?php echo $DSlider_point5; ?>
                                <?php echo $DSlider_point6; ?>
                            </ul>
                        </div>
                        <div class="GP_bar-3"></div>
                        <div class="GP_form-login-inline">

    						<?php if ($DSlider_form=='both') { ?>
                				<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                    <input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                    <input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                                   	<br/>
                                    <label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                    <label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                            	</div>
                			<?php } ?>

							<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                            <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                                <ul class="GP_f-left" <?php echo $Slider_name_padding; ?>>
        							<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                    <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DSlider_optin[7]; ?></li>
                                    <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                </ul>
                            </form>
        					<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
        					if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_slider").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
        					}
                            //save user data to cookies
                            $jj("#verified_slider").click(function(){
                                $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                            });
        					</script>
							</div>
                			<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
                				<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        		</a>
        						<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
                          		</script>
                			</div>
              				<div class="GP_linkv" <?php echo $DSliderf3_view; ?>>
                        		<a id="verifiedlink_slider" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                        			<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
                        			<li style="display:inline"><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                        		</a>
        						<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
                          		</script>
                      		</div>
                        </div> 
                        <p class="GP_icon GP_padlock GP_w-auto GP_type-2"><?php echo $DSlider_spam; ?></p>
					</div>
				</div>
				</div>
            </div>
            </div>
        </div>
		<?php } 
		if ($DSlider_theme=='slider5' || $DSlider_theme=='slider35' ||
		$DSlider_theme=='slider6' || $DSlider_theme=='slider36') { 
		?>
		<!-- product plus -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider5' || $DSlider_theme=='slider35') { $DSpos = "top"; ?>
				<div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width855" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider6' || $DSlider_theme=='slider36') { $DSpos = "bottom"; ?>
            	<div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width855" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
            	<div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
                    <div class="GP_two-columns">
                        <div class="GP_col-left">
                            <div class="GP_bar-4"></div>
                            <h2><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php if ($DSlider_countdown=="on") {do_shortcode("[gpcountdown_slider time=".$DSlider_headtxtT." front='".$DSlider_headtxtF."' end='".$DSlider_headtxtE."']");} else {echo $DSlider_headtxt;} ?></strong></h2>    
                            <p class="GP_fs12"><?php echo $DSlider_text; ?></p>
                            <ul class="GP_list GP_f-right">
                                <?php echo $DSlider_point1; ?>
                                <?php echo $DSlider_point2; ?>
                                <?php echo $DSlider_point3; ?>
                                <?php echo $DSlider_point4; ?>
                                <?php echo $DSlider_point5; ?>
                                <?php echo $DSlider_point6; ?>
                            </ul>
                            <img src="<?php echo $DSlider_image; ?>" alt="" class="GP_f-left" />
                        </div>                        
                        <div class="GP_col-right">
    						<h2 class="GP_a-center"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php echo $DSlider_formtitle; ?></strong></h2>       
                            <p class="GP_a-center GP_fs12"><?php echo $DSlider_formtext; ?></p>
                            <div class="GP_form-login-block">
							 							
        						<?php if ($DSlider_form=='both') { ?>
                    				<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                        <input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                        <input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                                       	<br/>
                                        <label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                        <label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                                	</div>
                    			<?php } ?>
								
								<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                                <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                                    <ul class="GP_f-left">
            							<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                        <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                        <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
            							<li><?php echo $DSlider_optin[7]; ?></li>
                                        <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                    </ul>
                                </form>
        						<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
            					<script type="text/javascript">
                           		var $jj = jQuery.noConflict();
            					if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                                    //save user data to cookies
                                    $jj("#gpformsubmit_slider").submit(function(){
                                        var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                        $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                    });
            					}
                                //save user data to cookies
                                $jj("#verified_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
            					</script>
								</div>
            					<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
            						<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        				<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        			</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedfb_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
            					</div>
          						<div <?php echo $DSliderf3_view; ?>>
                    				<a id="verifiedlink_slider" class="GP_nodecor" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                    					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                    					<li><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                    				</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedlink_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
                  				</div>
                            </div>  
                            <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DSlider_spam; ?></p>
                        </div>
                        <div class="GP_clear"></div>
                    </div> 
					</div>             
                </div>
            	</div>
		</div>
		<?php }
		if ($DSlider_theme=='slider7' || $DSlider_theme=='slider37' ||
		$DSlider_theme=='slider8' || $DSlider_theme=='slider38') { 
		?>
		<!-- product -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider7' || $DSlider_theme=='slider37') { $DSpos = "top"; ?>
				<div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width855" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider8' || $DSlider_theme=='slider38') { $DSpos = "bottom"; ?>
            	<div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width855" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
                <div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
                    <div class="GP_two-columns">
                        <div class="GP_col-left">
                            <div class="GP_bar-5"></div>
                            <h2 class="GP_margin-left" style="margin-bottom:20px"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php if ($DSlider_countdown=="on") {do_shortcode("[gpcountdown_slider time=".$DSlider_headtxtT." front='".$DSlider_headtxtF."' end='".$DSlider_headtxtE."']");} else {echo $DSlider_headtxt;} ?></strong></h2>
                            <ul class="GP_list GP_f-right">
                                <?php echo $DSlider_point1; ?>
                                <?php echo $DSlider_point2; ?>
                                <?php echo $DSlider_point3; ?>
                                <?php echo $DSlider_point4; ?>
                                <?php echo $DSlider_point5; ?>
                                <?php echo $DSlider_point6; ?>
                            </ul>
    						<img src="<?php echo $DSlider_image; ?>" alt="" class="GP_f-left GP_margin-top" />
                        </div>
                        <div class="GP_col-right">
                            <h2 class="GP_a-center" style="margin-bottom:30px"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php echo $DSlider_formtitle; ?></strong></h2>                           
                            <div class="GP_form-login-block">
							 							
        						<?php if ($DSlider_form=='both') { ?>
                    				<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                        <input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                        <input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                                       	<br/>
                                        <label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                        <label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                                	</div>
                    			<?php } ?>
							
								<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                                <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                                    <ul class="GP_f-left">
            							<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                        <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                        <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
            							<li><?php echo $DSlider_optin[7]; ?></li>
                                        <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                    </ul>
                                </form>
        						<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
            					<script type="text/javascript">
                           		var $jj = jQuery.noConflict();
            					if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                                    //save user data to cookies
                                    $jj("#gpformsubmit_slider").submit(function(){
                                        var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                        $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                    });
            					}
                                //save user data to cookies
                                $jj("#verified_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
            					</script>
								</div>
            					<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
            						<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        				<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        			</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedfb_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
            					</div>
          						<div <?php echo $DSliderf3_view; ?>>
                    				<a id="verifiedlink_slider" class="GP_nodecor" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                    					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                    					<li><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                    				</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedlink_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
                  				</div>
                            </div>  
    						<p class="GP_icon GP_padlock GP_w-auto"><?php echo $DSlider_spam; ?></p>
                        </div>
                        <div class="GP_clear"></div>
                    </div>
					</div>         
                </div>
            	</div>
		</div>
		<?php }
		if ($DSlider_theme=='slider9' || $DSlider_theme=='slider39' ||
		$DSlider_theme=='slider10' || $DSlider_theme=='slider40') { 
		?>
		<!-- standard -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider9' || $DSlider_theme=='slider39') { $DSpos = "top"; ?>
				<div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width855" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider10' || $DSlider_theme=='slider40') { $DSpos = "bottom"; ?>
            	<div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width855" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
                <div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
                    <div class="GP_two-columns">
                        <div class="GP_col-left">
                            <div class="GP_bar-4"></div>
                            <h2><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php if ($DSlider_countdown=="on") {do_shortcode("[gpcountdown_slider time=".$DSlider_headtxtT." front='".$DSlider_headtxtF."' end='".$DSlider_headtxtE."']");} else {echo $DSlider_headtxt;} ?></strong></h2>     
                            <p class="GP_fs12"><?php echo $DSlider_text; ?></p>
                            <ul class="GP_list GP_w-auto">
                                <?php echo $DSlider_point1; ?>
                                <?php echo $DSlider_point2; ?>
                                <?php echo $DSlider_point3; ?>
                                <?php echo $DSlider_point4; ?>
                                <?php echo $DSlider_point5; ?>
                                <?php echo $DSlider_point6; ?>
                            </ul>
                        </div>                        
                        <div class="GP_col-right">
                            <h2 class="GP_a-center"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php echo $DSlider_formtitle; ?></strong></h2>          
                            <p class="GP_a-center GP_fs12"><?php echo $DSlider_formtext; ?></p>                         
                            <div class="GP_form-login-block">
							 							
        						<?php if ($DSlider_form=='both') { ?>
                    				<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                        <input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                        <input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                                       	<br/>
                                        <label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                        <label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                                	</div>
                    			<?php } ?>
								
								<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                                <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                                    <ul class="GP_f-left">
            							<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                        <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                        <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
            							<li><?php echo $DSlider_optin[7]; ?></li>
                                        <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                    </ul>
                                </form>
        						<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
            					<script type="text/javascript">
                           		var $jj = jQuery.noConflict();
            					if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                                    //save user data to cookies
                                    $jj("#gpformsubmit_slider").submit(function(){
                                        var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                        $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                    });
            					}
                                //save user data to cookies
                                $jj("#verified_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
            					</script>
								</div>
            					<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
            						<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        				<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        			</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedfb_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
            					</div>
          						<div <?php echo $DSliderf3_view; ?>>
                    				<a id="verifiedlink_slider" class="GP_nodecor" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                    					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                    					<li><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                    				</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedlink_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
                  				</div>
                            </div> 
                            <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DSlider_spam; ?></p>
                        </div>
                        <div class="GP_clear"></div>
                    </div>
					</div> 
                </div>
            	</div>
		</div>
		<?php }
		if ($DSlider_theme=='slider11' || $DSlider_theme=='slider41' ||
		$DSlider_theme=='slider12' || $DSlider_theme=='slider42') { 
		?>
		<!-- mini -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider11' || $DSlider_theme=='slider41') { $DSpos = "top"; ?>
				<div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width855" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider12' || $DSlider_theme=='slider42') { $DSpos = "bottom"; ?>
            	<div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width855" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
                <div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
                    <div class="GP_two-columns">
                        <div class="GP_col-left">
                            <div class="GP_bar-5"></div>
                            <h2 style="margin-bottom:30px"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php if ($DSlider_countdown=="on") {do_shortcode("[gpcountdown_slider time=".$DSlider_headtxtT." front='".$DSlider_headtxtF."' end='".$DSlider_headtxtE."']");} else {echo $DSlider_headtxt;} ?></strong></h2>     
                            <ul class="GP_list GP_w-auto">
                                <?php echo $DSlider_point1; ?>
                                <?php echo $DSlider_point2; ?>
                                <?php echo $DSlider_point3; ?>
                                <?php echo $DSlider_point4; ?>
                                <?php echo $DSlider_point5; ?>
                                <?php echo $DSlider_point6; ?>
                            </ul>
                        </div>                        
                        <div class="GP_col-right">
                            <h2 class="GP_a-center" style="margin-bottom:30px"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php echo $DSlider_formtitle; ?></strong></h2>                            
                            <div class="GP_form-login-block">
							 							
        						<?php if ($DSlider_form=='both') { ?>
                    				<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                        <input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                        <input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                                       	<br/>
                                        <label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                        <label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                                	</div>
                    			<?php } ?>
								
								<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                                <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                                    <ul class="GP_f-left">
            							<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                        <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                        <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
            							<li><?php echo $DSlider_optin[7]; ?></li>
                                        <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                    </ul>
                                </form>
        						<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
            					<script type="text/javascript">
                           		var $jj = jQuery.noConflict();
            					if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                                    //save user data to cookies
                                    $jj("#gpformsubmit_slider").submit(function(){
                                        var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                        $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                    });
            					}
                                //save user data to cookies
                                $jj("#verified_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
            					</script>
								</div>
            					<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
            						<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        				<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        			</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedfb_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
            					</div>
          						<div <?php echo $DSliderf3_view; ?>>
                    				<a id="verifiedlink_slider" class="GP_nodecor" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                    					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                    					<li><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                    				</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedlink_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
                  				</div>
                            </div>  
                            <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DSlider_spam; ?></p>
                        </div>
                        <div class="GP_clear"></div>
                    </div> 
					</div>                 
                </div>
            	</div>
		</div>
		<?php } 
		if ($DSlider_theme=='slider13' || $DSlider_theme=='slider43' ||
		$DSlider_theme=='slider14' || $DSlider_theme=='slider44' || 
		$DSlider_theme=='slider15' || $DSlider_theme=='slider45' || 
		$DSlider_theme=='slider16' || $DSlider_theme=='slider46') { 
		?>
		<!-- video vertical -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider13' || $DSlider_theme=='slider43') { $DSpos = "top"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width665" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider14' || $DSlider_theme=='slider44') { $DSpos = "bottom"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width665" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider15' || $DSlider_theme=='slider45') { $DSpos = "left"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_left-top GP_vertical" id="GP_sliders" style="position:fixed; left:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider16' || $DSlider_theme=='slider46') { $DSpos = "right"; ?>
                <div class="GP_box GP_slide_box GP_fixed GP_right-top GP_vertical" id="GP_sliders" style="position:fixed; right:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
            	<div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
                    <div class="GP_inside">  
					<div class="GP_inside_custom">
                    <h2 class="GP_a-center" style="line-height:20%!important"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php if ($DSlider_countdown=="on") {do_shortcode("[gpcountdown_slider time=".$DSlider_headtxtT." front='".$DSlider_headtxtF."' end='".$DSlider_headtxtE."']");} else {echo $DSlider_headtxt;} ?></strong></h2>
                    <div class="GP_o-hidden">
                        <div style="text-align:center" class="GP_video640">
                            <?php echo $DSlider_video; ?>
                        </div>
                    </div>
                    <div class="GP_bar-3"></div>
                    <div class="GP_form-login-inline">
							 							
						<?php if ($DSlider_form=='both') { ?>
            				<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                <input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                <input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                               	<br/>
                                <label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                <label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                        	</div>
            			<?php } ?>
								
						<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                        <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                            <ul class="GP_f-left" <?php echo $Slider_name_padding; ?>>
        						<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        						<li><?php echo $DSlider_optin[7]; ?></li>
                                <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                            </ul>
                        </form>
        				<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
        				<script type="text/javascript">
                        var $jj = jQuery.noConflict();
        				if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                        	//save user data to cookies
                            $jj("#gpformsubmit_slider").submit(function(){
                                var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            });
        				}
                        //save user data to cookies
                        $jj("#verified_slider").click(function(){
                            $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                        });
        				</script>
						</div>
            			<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
            				<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        		<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        	</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedfb_slider").click(function(){
                            	$jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
            			</div>
          				<div class="GP_linkv" <?php echo $DSliderf3_view; ?>>
                    		<a id="verifiedlink_slider" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                    			<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
                    			<li style="display:inline"><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                    		</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedlink_slider").click(function(){
                            	$jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
                  		</div>
  					</div>
    				<p class="GP_icon GP_padlock GP_w-auto GP_type-2"><?php echo $DSlider_spam; ?></p>
                    </div>
					</div>
					</div>
                </div>
            	</div>
		</div>
		<?php }
		if ($DSlider_theme=='slider17' || $DSlider_theme=='slider47' ||
		$DSlider_theme=='slider18' || $DSlider_theme=='slider48') { 
		?>
		<!-- video 640 -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider17' || $DSlider_theme=='slider47') { $DSpos = "top"; ?>
				<div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width930" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider18' || $DSlider_theme=='slider48') { $DSpos = "bottom"; ?>
            	<div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width930" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
                <div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
                    <div class="GP_two-columns">
                        <div class="GP_col-left">
                            <div class="GP_bar-4"></div>
                            <div class="GP_video">
                                <?php echo $DSlider_video; ?>
                            </div>
    						<div style="height:8px"></div>
                        </div>                        
                        <div class="GP_col-right">
                            <h2 class="GP_a-center"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php echo $DSlider_formtitle; ?></strong></h2>       
    						<p class="GP_a-center GP_fs12"><?php echo $DSlider_formtext; ?></p>
                            <div class="GP_form-login-block">  
							 								
								<?php if ($DSlider_form=='both') { ?>
            						<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                    	<input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                    	<input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                               			<br/>
                                    	<label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                    	<label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                                    </div>
            					<?php } ?>
								
								<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                                <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                                    <ul class="GP_f-left">
            							<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                        <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                        <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
            							<li><?php echo $DSlider_optin[7]; ?></li>
                                        <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                    </ul>
                                </form>
        						<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
            					<script type="text/javascript">
                           		var $jj = jQuery.noConflict();
            					if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                                    //save user data to cookies
                                    $jj("#gpformsubmit_slider").submit(function(){
                                        var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                        $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                    });
            					}
                                //save user data to cookies
                                $jj("#verified_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
            					</script>
								</div>
            					<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
            						<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        				<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        			</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedfb_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
            					</div>
          						<div <?php echo $DSliderf3_view; ?>>
                    				<a id="verifiedlink_slider" class="GP_nodecor" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                    					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                    					<li><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                    				</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedlink_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
                  				</div>
                            </div>
                            <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DSlider_spam; ?></p>
                        </div>
                        <div class="GP_clear"></div>
                    </div>       
					</div>                
                </div>
            	</div>
		</div>
		<?php } 
		if ($DSlider_theme=='slider19' || $DSlider_theme=='slider49' ||
		$DSlider_theme=='slider20' || $DSlider_theme=='slider50') { 
		?>
		<!-- video 480 -->
		<div class="Generation_plug GP_slidebox">
			<?php if ($DSlider_theme=='slider19' || $DSlider_theme=='slider49') { $DSpos = "top"; ?>
				<div class="GP_box GP_slide_box GP_fixed GP_top GP_auto GP_width785" id="GP_sliders" style="position:fixed; top:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } if ($DSlider_theme=='slider20' || $DSlider_theme=='slider50') { $DSpos = "bottom"; ?>
            	<div class="GP_box GP_slide_box GP_fixed GP_bottom GP_auto GP_width785" id="GP_sliders" style="position:fixed; bottom:-99999px; background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') <?php echo $DSlider_bgrepeat; ?>">
			<?php } ?>
                <div class="GP_content">
					<div class="GP_container">
                    <a id="GP_bookmark" title="<?php echo $DSlider_bookmark; ?>" class="GP_your-free-book" style="background: <?php echo $DSlider_bgcolor; ?> url('<?php echo $DSlider_bgimage; ?>') repeat center center;"><span><?php echo $DSlider_bookmark; ?></span></a>
                    <div class="GP_two-columns">
                        <div class="GP_col-left">
                            <div class="GP_bar-4"></div>
                            <div class="GP_video">
                                <?php echo $DSlider_video480; ?>
                            </div>
    						<div style="height:8px"></div>
                        </div>                        
                        <div class="GP_col-right">
                            <h2 class="GP_a-center"><strong style="color:<?php echo $DSlider_headclr; ?>;"><?php echo $DSlider_formtitle; ?></strong></h2>       
    						<p class="GP_a-center GP_fs12"><?php echo $DSlider_formtext; ?></p>
                            <div class="GP_form-login-block">
							
								<?php if ($DSlider_form=='both') { ?>
            						<div id="GP_s_slider" class="GP_f_slider GP_s_slider">
                                    	<input style="display:none" type="radio" id="GP_s_r1_slider" name="GP_f_slider" checked />
                                    	<input style="display:none" type="radio" id="GP_s_r2_slider" name="GP_f_slider" />
                               			<br/>
                                    	<label for="GP_s_r1_slider" class="GP_s_en_slider selected"><span><?php echo $gp_d5; ?></span></label>
                                    	<label for="GP_s_r2_slider" class="GP_s_di_slider"><span><?php echo $gp_d6; ?></span></label>
                                    </div>
            					<?php } ?>
						
								<div id="Slider_s_show1" <?php echo $DSliderf1_view; ?>>
                                <form id="gpformsubmit_slider" action="<?php echo $DSlider_optin[4]; ?>" method="post">
                                    <ul class="GP_f-left">
            							<li style="display:none"><?php echo $DSlider_optin[5]; ?></li>
                                        <li <?php echo $Slider_name_disabled; ?>><input id="gpuserinput_slider" <?php echo $gpnameinput_slider; ?> name="<?php echo $DSlider_optin[1]; ?>" type="text" value="<?php echo $Slider_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                        <li><input id="gpemailinput_slider" <?php echo $gpemailinput_slider; ?> name="<?php echo $DSlider_optin[2]; ?>" type="text" value="<?php echo $Slider_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
            							<li><?php echo $DSlider_optin[7]; ?></li>
                                        <li><input id="verified_slider" name="<?php echo $DSlider_optinsubmit; ?>" type="<?php echo $gpformbtn_slider; ?>" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" style="padding:0!important; min-width:100%!important" /></li>
                                    </ul>
                                </form>
        						<input type="hidden" id="gpkeepuserdetails_slider" value="<?php echo $DAutoins; ?>">
            					<script type="text/javascript">
                            	var $jj = jQuery.noConflict();
            					if ($jj("#gpkeepuserdetails_slider").val()=="on") {
                                    //save user data to cookies
                                    $jj("#gpformsubmit_slider").submit(function(){
                                        var gpmydetails = $jj("#gpuserinput_slider").val() + '|' + $jj("#gpemailinput_slider").val();
                                        $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                    });
            					}
                                //save user data to cookies
                                $jj("#verified_slider").click(function(){
                                    $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                });
            					</script>
								</div>
            					<div id="Slider_s_show2" class="GP_f-left-fb" <?php echo $DSliderf2_view; ?>>
            						<a id="verifiedfb_slider" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        				<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        			</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedfb_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
            					</div>
          						<div <?php echo $DSliderf3_view; ?>>
                    				<a id="verifiedlink_slider" class="GP_nodecor" href="<?php echo $DSlider_link; ?>" <?php echo $Slider_link_blank; ?>>
                    					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                    					<li><input type="button" value="<?php echo $Slider_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DSlider_btncolor; ?>" /></li>
                    				</a>
        							<script type="text/javascript">
                                   	var $jj = jQuery.noConflict();
                                    //save user data to cookies
                                    $jj("#verifiedlink_slider").click(function(){
                                        $jj.cookie("gpsubscribed_slider", "subscribed", {expires: 7, path: '/'});
                                    });
                          			</script>
                  				</div>
                            </div>
                            <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DSlider_spam; ?></p>
                        </div>
                        <div class="GP_clear"></div>
                    </div>   
					</div>              
                </div>
            	</div>
		</div>
		<?php } ?>


<?php 
} //displaying settings
} //STOP IF DAYS OK
} //STOP IF ACTIVATED
} //START IF 'SUBSCRIBED' IS NOT ACTIVE
?>
