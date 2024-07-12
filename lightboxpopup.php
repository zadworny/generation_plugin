<?php
global $wpdb;
$table_name_lightbox = $wpdb->prefix . 'GenerationPlugin_LIGHTBOX';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }


if ($_COOKIE["gpds_popup"]!="1") { //START IF 'DONT SHOW' IS NOT ACTIVE


$DPopup_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
$DPopup_display = explode("|", $DPopup_displays);
$DPopup_showsub = $DPopup_display[3];
if ($DPopup_showsub=="on" && $_COOKIE["gpsubscribed_popup"]=="subscribed") { /* STOP HERE */ } 
else { //START IF 'SUBSCRIBED' IS NOT ACTIVE


$DPopup_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid);
if ($DPopup_active_tmp=="on") { //START IF ACTIVATED

$DPopup_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
$DPopup_display = explode("|", $DPopup_display);
if ($DPopup_display[6]=='' || ($DPopup_display[6]!="" && strtotime($DPopup_display[6]) <= strtotime(date("Y-m-d")))) {
	$DPopup_ddays_1="1";
} else {$DPopup_ddays_1="0";}
if ($DPopup_display[7]=='' || ($DPopup_display[7]!="" && strtotime($DPopup_display[7]) > strtotime(date("Y-m-d")))) {
	$DPopup_ddays_2="1";
} else {$DPopup_ddays_2="0";}
if ($DPopup_ddays_1=="1" && $DPopup_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$dontshowagain = $wpdb->get_var('SELECT Dontshowagain FROM '.$table_name_general.' WHERE id=1');
	$dontshowagain = preg_replace("/\\\/","",$dontshowagain);
	if ($dontshowagain=="") {$dontshowagain = "Don't show again";} //default
$DPopup_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_theme = preg_replace("/\\\/","",$DPopup_theme);
if ($DPopup_theme=="") {$DPopup_theme = "popup1";} //default
$DPopup_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_link = preg_replace("/\\\/","",$DPopup_link);
if ($DPopup_link=="") {$DPopup_link = "#";} //default
$DPopup_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
if ($DPopup_link_blank!="") {$Popup_link_blank = 'target="_blank"';} else {$Popup_link_blank = 'target="_parent"';}

$DPopup_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_image = preg_replace("/\\\/","",$DPopup_image);
if ($DPopup_image=="") {$DPopup_image = GenerationPlugin_images.'/boxes/book-2.png';} //default
else { $DPopup_image = $DPopup_image;}
$DPopup_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_bgimage = preg_replace("/\\\/","",$DPopup_bgimage);

$DPopup_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_btncolor = preg_replace("/\\\/","",$DPopup_btncolor);
$DPopup_btncolor = explode("|", $DPopup_btncolor);
$DPopup_btncolor = $DPopup_btncolor[3];
if ($DPopup_btncolor=="" || $DPopup_btncolor=="Stripe design") {$DPopup_btncolor = "stripe_red";} //default
if ($DPopup_btncolor=="Simple design") {$DPopup_btncolor = "simple_red";}

$DPopup_backgrounds = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_backgrounds = preg_replace("/\\\/","",$DPopup_backgrounds);
$DPopup_backgrounds = explode("|", $DPopup_backgrounds);
$DPopup_background = $DPopup_backgrounds[0];
$DPopup_screencolor = $DPopup_backgrounds[1];
$DPopup_screenopacity = $DPopup_backgrounds[2];
if ($DPopup_theme=='popup1' || $DPopup_theme=='popup2' || $DPopup_theme=='popup3' || $DPopup_theme=='popup4' || $DPopup_theme=='popup5' || $DPopup_theme=='popup6' || $DPopup_theme=='popup7' || $DPopup_theme=='popup8') {
	$DPopup_bgcolor = '#222';
    if ($DPopup_bgimage!="") {$DPopup_bgimage = $DPopup_bgimage;}
    elseif ($DPopup_background=='bg2') {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DPopup_background=='bg3') {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DPopup_background=='bg4') {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} else {
	$DPopup_bgcolor = '#CCC';
    if ($DPopup_bgimage!="") {$DPopup_bgimage = $DPopup_bgimage;}
    elseif ($DPopup_background=='bg12') {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DPopup_background=='bg13') {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DPopup_background=='bg14') {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DPopup_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
}

$DPopup_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_title_tmp = preg_replace("/\\\/","",$DPopup_title_tmp);
    $DPopup_title = explode("|", $DPopup_title_tmp);
	$DPopup_headclr = $DPopup_title[0];
	if ($DPopup_headclr=="" || $DPopup_headclr=="#") {$DPopup_headclr = "#CC3300";} //default
	$DPopup_headtxt = $DPopup_title[1];
	if ($DPopup_headtxt=="") {$DPopup_headtxt = "Header Title Goes Here!";} //default
	if (strpos($DPopup_headtxt,"(")!==false) {
		$DPopup_headtxt=explode("(",$DPopup_headtxt);
		$DPopup_headtxtF=$DPopup_headtxt[0]; //front
		$DPopup_headtxt=explode(")",$DPopup_headtxt[1]);
		$DPopup_headtxtT=$DPopup_headtxt[0]; //time
		$DPopup_headtxtE=$DPopup_headtxt[1]; //end
		$DPopup_countdown="on";
	}
    function gpcountdown_popup($atts) {    
    	extract(shortcode_atts(array("time" => "10", "front" => "", "end" => "", "type" => "popup"),$atts));
    	return gpcountdownreturn($time,$front,$end,$type);
    }
    add_shortcode("gpcountdown_popup", "gpcountdown_popup");
$DPopup_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_text = preg_replace("/\\\/","",$DPopup_text);
if ($DPopup_text=="") {$DPopup_text = "This is an example of subtitle or description text. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt quasi architecto beatae vitae dicta sunt explicabo.";} //default
$DPopup_formtitle = stripslashes($wpdb->get_var('SELECT Formtitle FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_formtitle = preg_replace("/\\\/","",$DPopup_formtitle);
if ($DPopup_formtitle=="") {$DPopup_formtitle = "Your Details";} //default
$DPopup_formtext = stripslashes($wpdb->get_var('SELECT Formtext FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_formtext = preg_replace("/\\\/","",$DPopup_formtext);
if ($DPopup_formtext=="") {$DPopup_formtext = "This is an example of form text, edit it in admin panel.";} //default

$DPopup_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_form_tmp = preg_replace("/\\\/","",$DPopup_form);
    $DPopup_formx = explode("|", $DPopup_form_tmp);
	$DPopup_form = $DPopup_formx[0];
	$DPopup_formtype = $DPopup_formx[1];
	$DPopup_clink = $DPopup_formx[2];
	$DPopup_cclick1 = $DPopup_formx[3];
	$DPopup_cblank = $DPopup_formx[4];
	if ($DPopup_cblank=="_blank") {$DPopup_cblank="_blank";} else {$DPopup_cblank="_top";}
	$DPopup_cbgimage = $DPopup_formx[5];
	if ($DPopup_cbgimage!='') {$DPopup_cimage = $DPopup_cbgimage;} else {$DPopup_cimage = $DPopup_cclick1;}
	$DPopup_cclick2 = $DPopup_formx[6];
	$DPopup_cwidth = $DPopup_formx[7];
	if ($DPopup_cwidth=="") {$DPopup_cwidth="760";} //default
	$DPopup_cwidth_i = $DPopup_cwidth - 8;
	$DPopup_cheight = $DPopup_formx[8];
	if ($DPopup_cheight=="") {$DPopup_cheight="360";} //default
	$DPopup_cheight_i = $DPopup_cheight - 8;
	$DPopup_cscroll = $DPopup_formx[9];
	if ($DPopup_cscroll=="scroll") {$DPopup_cscroll="scroll";} else {$DPopup_cscroll="hidden";}
	if ($DPopup_form=="") {$DPopup_form="link";} //default
	
$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
	$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
	$gp_d56 = explode("|", $gp_d56_tmp);
	$gp_d5 = $gp_d56[0];
	$gp_d6 = $gp_d56[1];
	if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
	if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default

$DPopup_listpoint_tmp = stripslashes($wpdb->get_var('SELECT Listpoint FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_listpoint_tmp = preg_replace("/\\\/","",$DPopup_listpoint_tmp);
    $DPopup_listpoint = explode("|", $DPopup_listpoint_tmp);
	if ($DPopup_listpoint[0]!="") { $DPopup_point1 = "<li>".$DPopup_listpoint[0]."</li>"; } else { $DPopup_point1=""; }
	if ($DPopup_listpoint[1]!="") { $DPopup_point2 = "<li>".$DPopup_listpoint[1]."</li>"; } else { $DPopup_point2=""; }
	if ($DPopup_listpoint[2]!="") { $DPopup_point3 = "<li>".$DPopup_listpoint[2]."</li>"; } else { $DPopup_point3=""; }
	if ($DPopup_listpoint[3]!="") { $DPopup_point4 = "<li>".$DPopup_listpoint[3]."</li>"; } else { $DPopup_point4=""; }
	if ($DPopup_listpoint[4]!="") { $DPopup_point5 = "<li>".$DPopup_listpoint[4]."</li>"; } else { $DPopup_point5=""; }
	if ($DPopup_listpoint[5]!="") { $DPopup_point6 = "<li>".$DPopup_listpoint[5]."</li>"; } else { $DPopup_point6=""; }
	$DPopup_pointall = $DPopup_listpoint[0].$DPopup_listpoint[1].$DPopup_listpoint[2].$DPopup_listpoint[3].$DPopup_listpoint[4].$DPopup_listpoint[5];
	if (preg_replace("/<li><\/li>/","",$DPopup_pointall)=="") {
    	$DPopup_point1 = "<li>Sample list point number 1 goes here</li>";
    	$DPopup_point2 = "<li>Sample list point number 2 goes here</li>";
    	$DPopup_point3 = "<li>Sample list point number 3 goes here</li>";
    	$DPopup_point4 = "<li>Sample list point number 4 goes here</li>";
    	$DPopup_point5 = "<li>Sample list point number 5 goes here</li>";
    	$DPopup_point6 = "<li>Sample list point number 6 goes here</li>";
	}

if ($DPopup_form=='regular' || $DPopup_form=='') {
	$DPopupf1_view='style="display:block"'; $DPopupf2_view='style="display:none"'; $DPopupf3_view='style="display:none"';
}
elseif ($DPopup_form=='social') {
	$DPopupf1_view='style="display:none"'; $DPopupf2_view='style="display:block"'; $DPopupf3_view='style="display:none"';
}
elseif ($DPopup_form=='both') {
	$DPopupf1_view='style="display:block"'; $DPopupf2_view='style="display:none"'; $DPopupf3_view='style="display:none"';
}
elseif ($DPopup_form=='link') {
	$DPopupf1_view='style="display:none"'; $DPopupf2_view='style="display:none"'; $DPopupf3_view='style="display:block"';
}

$DPopup_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_regular_tmp = preg_replace("/\\\/","",$DPopup_regular_tmp);
    $DPopup_regular = explode("|", $DPopup_regular_tmp);
	$Popup_fname = $DPopup_regular[0];
	if ($Popup_fname=="") {$Popup_fname = "Insert your name";} //default
	$Popup_femail = $DPopup_regular[1];
	if ($Popup_femail=="") {$Popup_femail = "Insert your email";} //default
	$Popup_fbtntxt = $DPopup_regular[2];
	if ($Popup_fbtntxt=="") {$Popup_fbtntxt = "SUBSCRIBE";} //default
	if ($DPopup_regular[4]=="1") {$Popup_name_disabled="style='display:none'"; $Popup_name_padding="style='padding-left:110px!important'";}
	
$DPopup_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_spam = preg_replace("/\\\/","",$DPopup_spam);
if ($DPopup_spam=="") {$DPopup_spam = "We will not share your details with anyone, we promise!";} //default
$DPopup_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_optin = preg_replace("/\\\/","",$DPopup_optin);
	$DPopup_optin = preg_replace("/<br>/","\n",$DPopup_optin);
	$DPopup_optin = preg_replace("/\\\/","",$DPopup_optin);
	$DPopup_optin = explode("|",$DPopup_optin);
	$DPopup_optinsubmit = $DPopup_optin[8];
	
$DPopup_video = stripslashes($wpdb->get_var('SELECT Video FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
	$DPopup_video = preg_replace("/\\\/","",$DPopup_video);
$DPopup_video480 = $DPopup_video;
if ($DPopup_video=="") {$DPopup_video = '<iframe width="640" height="360" src="http://player.vimeo.com/video/50556989" frameborder="0" allowfullscreen></iframe>';} //default
if ($DPopup_video480=="") {$DPopup_video480 = '<iframe width="480" height="360" src="http://player.vimeo.com/video/50556989" frameborder="0" allowfullscreen></iframe>';} //default

$DPopup_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_lightbox.' WHERE id='.$Duniqueid));
    $DPopup_display = explode("|", $DPopup_display);
	$DPopup_dpages = $DPopup_display[0];
	$DPopup_dcats = $DPopup_display[1];
	$DPopup_dposts = $DPopup_display[2];
	$DPopup_showsub = $DPopup_display[3];
	if ($DPopup_showsub=="on") {$DPopup_showsub="checked";}
	$DPopup_ddelay = $DPopup_display[4];
	if ($DPopup_ddelay<0 || $DPopup_ddelay=="0" || $DPopup_ddelay=="") { $DPopup_ddelay="0"; }
	$DPopup_ddays = (strtotime($DPopup_display[5]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	if ($DPopup_ddays<0 || $DPopup_ddays=="0") { $DPopup_ddays="0"; }
?>

<?php
//DISPLAYING

//prepare page list in array
$DPopup_dpages_explode=explode(",",$DPopup_dpages);
foreach ($DPopup_dpages_explode as $DPopup_dpages_explode_element) { $DPopup_dpages_array[]=$DPopup_dpages_explode_element; }
//prepare category list in array
$DPopup_dcats_explode=explode(",",$DPopup_dcats);
foreach ($DPopup_dcats_explode as $DPopup_dcats_explode_element) { $DPopup_dcats_array[]=$DPopup_dcats_explode_element; }
//prepare posts list in array
$DPopup_dposts_explode=explode(",",$DPopup_dposts);
foreach ($DPopup_dposts_explode as $DPopup_dposts_explode_element) { $DPopup_dposts_array[]=$DPopup_dposts_explode_element; }

if (((strpos($DPopup_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DPopup_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DPopup_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DPopup_dpages.',',',author,')!==false) || //author page
	 (is_page($DPopup_dpages_array)))) || //pages and subpages
   ((strpos($DPopup_dcats,'allcats')!==false) &&
	 (is_category($DPopup_dcats_array))) || //category pages
   ((strpos($DPopup_dposts,'allposts')!==false) &&
	 (is_single($DPopup_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>

		<script type="text/javascript">
    	var $jj = jQuery.noConflict();
    	function isValidUserCHECK_popup() {
    		var user_popup = $jj("#gpuserinput_popup").val();
    		var email_popup = $jj("#gpemailinput_popup").val();
    		if(user_popup != 0) {
    			if(isValidUser_popup(user_popup)) {
    				$jj("#gpuserinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				if(isValidEmailAddress_popup(email_popup)) {
    					document.getElementById('verified_popup').type="submit";
    				}
    			} else {
    				$jj("#gpuserinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_popup').type="button";
    			}
    		} else {
    			$jj("#gpuserinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_popup').type="button";
    		}
    	}
    	function isValidEmailCHECK_popup() {
    		var user_popup = $jj("#gpuserinput_popup").val();
    		var email_popup = $jj("#gpemailinput_popup").val();
    		if(email_popup != 0) {
    			if(isValidEmailAddress_popup(email_popup)) {
    				$jj("#gpemailinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				if(isValidUser_popup(user_popup)) {
    					document.getElementById('verified_popup').type="submit";
    				}
    			} else {
    				$jj("#gpemailinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_popup').type="button";
    			}
    		} else {
    			$jj("#gpemailinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_popup').type="button";
    		}
    	}
    	function isValidUser_popup(user_popup) {
     		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
     		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
     		return patternone.test(user_popup);
    	}
    	function isValidEmailAddress_popup(email_popup) {
     		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
     		return pattern.test(email_popup);
    	}
    	</script>
		<?php
		if ($DLivecheck=='on') {
			?>
			<script type="text/javascript">
        	var $jj = jQuery.noConflict();
    		$jj(document).ready(function(){
         		var user_popup = $jj("#gpuserinput_popup").val();
         		var email_popup = $jj("#gpemailinput_popup").val();
        		if(isValidUser_popup(user_popup) && isValidEmailAddress_popup(email_popup)) {
    				$jj("#gpuserinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				$jj("#gpemailinput_popup").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				document.getElementById('verified_popup').type="submit";
    			}
    		});
			</script>
			<?php
        	$gpnameinput_popup='onkeyup="isValidUserCHECK_popup();" onblur="isValidUserCHECK_popup();" onclick="isValidUserCHECK_popup();" onfocus="isValidUserCHECK_popup();"';
        	$gpemailinput_popup='onkeyup="isValidEmailCHECK_popup();" onblur="isValidEmailCHECK_popup();" onclick="isValidEmailCHECK_popup();" onfocus="isValidEmailCHECK_popup();"';
        	$gpformbtn_popup='button';
        } else {
        	$gpnameinput_popup='';
        	$gpemailinput_popup='';
        	$gpformbtn_popup='submit';
        }
		if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
			$gpmydatapopupcookie = explode("|",$_COOKIE['gpmydetails']);
			$Popup_fname = $gpmydatapopupcookie[0];
			$Popup_femail = $gpmydatapopupcookie[1];
		}
		?>
		
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
    	$jj(document).ready(function() {
			//default values in form
			$jj('input[type=text]').each(function(){ $jj(this).data('default', this.value); });
			$jj('input[type=text]').focusin(function(){ if (this.value==$jj(this).data('default')) {this.value='';} });
			$jj('input[type=text]').focusout(function(){ if (this.value=='') {this.value=$jj(this).data('default');} });
			setTimeout(function(){
    			$jj(".GP_show").fancybox({
                    'titleShow' : 'false',
                    'transitionIn' : 'fade',
                    'transitionOut' : 'fade',
					'overlayColor' : '<?php echo $DPopup_screencolor; ?>',
					'overlayOpacity' : '<?php echo $DPopup_screenopacity; ?>',
					'titleShow' : 'true',
                }).trigger('click');
			},<?php echo $DPopup_ddelay;?>*1000);
        });
		//Don't show again checkbox
		$jj(document).ready(function(){ 
        	$jj("#gpds_popup").change(function() {
        		if($jj(this).is(":checked")) { $jj.cookie("gpds_popup", "1", {expires: <?php echo $gp_dsacookie; ?>, path: '/'}); }
				else { $jj.cookie("gpds_popup", "0", {expires: <?php echo $gp_dsacookie; ?>, path: '/'}); }
        	});
        });
		//autoheight for custom content with large image
		$jj(document).ready(function(){
            $gpdochdivh = $jj(window).height();
            $gpdochdivh = ($gpdochdivh/10)*8; //80% of window height
            $jj("#GP_autoheight").css({"max-height": +$gpdochdivh+"px"});
        });
		//Form switch
		$jj(document).ready( function(){ 
        	$jj(".GP_s_en_popup").click(function(){
        		var parent = $jj(this).parents('.GP_s_popup');
        		$jj('.GP_s_di_popup',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Popup_s_show2').fadeOut(500);
        		$jj('#Popup_s_show1').delay(505).fadeIn(500);
        	});
        	$jj(".GP_s_di_popup").click(function(){
        		var parent = $jj(this).parents('.GP_s_popup');
        		$jj('.GP_s_en_popup',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Popup_s_show1').fadeOut(500);
        		$jj('#Popup_s_show2').delay(505).fadeIn(500);
        	});
			var switchwidth1 = $jj('.GP_s_en_popup').width();
			var switchwidth2 = $jj('.GP_s_di_popup').width();
			var switchwidth = switchwidth1+switchwidth2;
			$jj('.GP_s_popup').css({'width': ''+switchwidth+''});
        });
		</script>
		<div style="position:fixed; top:-9999; visibility:hidden" class="GP_s_popup">
            <label class="GP_s_en_popup"><span><?php echo $gp_d5; ?></span></label>
            <label class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
        </div>
						
		<style>
		.Generation_plug.GP_lightbox h2 strong span {
		  color:<?php echo $DPopup_headclr; ?>;
		}
        input[id=gpds_popup] {
          display:none;
        }
        input[id=gpds_popup] + label {
          background: url('<?php echo GenerationPlugin_images."/boxes/unchecked.png"; ?>');
          height: 16px;
          width: 16px;
          display:inline-block;
          padding: 0;
		  margin-bottom: -5px;
        }
        input[id=gpds_popup]:checked + label {
          background: url('<?php echo GenerationPlugin_images."/boxes/checked.png"; ?>');
          height: 16px;
          width: 16px;
          display:inline-block;
          padding: 0;
		  margin-bottom: -5px;
        }
        </style>
		<a style="display:none" class="GP_show" href="#GP_lightbox" title="">&nbsp;</a>

		
		<?php
		if ($DPopup_theme=='popup11' || $DPopup_theme=='popup12' || $DPopup_theme=='popup13' || $DPopup_theme=='popup14' || $DPopup_theme=='popup15' || $DPopup_theme=='popup16' || $DPopup_theme=='popup17' || $DPopup_theme=='popup18') {
			wp_enqueue_style('style user_light-1', GenerationPlugin_style.'/style-light-1.css');
		}
		?>
		
		<?php if ($DPopup_form=='custom') { ?>
			<?php if ($DPopup_formtype=='link' || $DPopup_formtype=='') { ?>
			<div style="display:none">
        	<div class="Generation_plug GP_lightbox" id="GP_lightbox">
				<!-- Don't show again checkbox -->
				<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
					<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
				</div>
        		<div class="GP_box" style="background:#FFF; width:<?php echo $DPopup_cwidth; ?>px!important; 
						height:<?php echo $DPopup_cheight; ?>px!important; overflow:hidden"
				>
                <div class="GP_content" style="overflow:hidden; margin:0!important; margin-top:0!important; 
						margin-right:0!important; margin-bottom:0!important; margin-left:0!important; 
						padding:0!important; padding-top:0!important; padding-right:0!important; 
						padding-bottom:0!important; padding-left:0!important; 
						width:<?php echo $DPopup_cwidth_i; ?>px!important; 
						height:<?php echo $DPopup_cheight_i; ?>px!important;"
				>
					<iframe class="GP_pmzero" src="<?php echo $DPopup_clink; ?>" width="100%" style="height:100%; width:100%; overflow-x:hidden; overflow-y:<?php echo $DPopup_cscroll; ?>" ></iframe>
				</div>
				</div>
			</div>
			</div>
            <?php } elseif ($DPopup_formtype=='image') { ?>
			<div style="display:none">
        	<div class="Generation_plug GP_lightbox" id="GP_lightbox">
				<!-- Don't show again checkbox -->
				<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
					<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
				</div>
        		<div class="GP_box" style="background:#FFF; width:auto!important; height:auto!important; overflow:hidden">
                <div id="GP_autoheight" class="GP_content" style="overflow:hidden; margin:0!important; margin-top:0!important; 
						margin-right:0!important; margin-bottom:0!important; margin-left:0!important; 
						padding:0!important; padding-top:0!important; padding-right:0!important; 
						padding-bottom:0!important; padding-left:0!important; 
						width:auto!important"
				>
					<a href="<?php echo $DPopup_cclick2; ?>" target="<?php echo $DPopup_cblank; ?>">
						<img style="overflow:hidden" src="<?php echo $DPopup_cimage; ?>">
					</a>
				</div>
				</div>
			</div>
			</div>
            <?php } ?>
		<?php } ?>
		<?php if (($DPopup_theme=='popup1' || $DPopup_theme=='popup11') && $DPopup_form!='custom') { ?>
		<!-- popup vertical -->
		<div style="display:none">
        <div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
			<div class="GP_box GP_width715" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <h2 class="GP_a-center"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php if ($DPopup_countdown=="on") {do_shortcode("[gpcountdown_popup time=".$DPopup_headtxtT." front='".$DPopup_headtxtF."' end='".$DPopup_headtxtE."']");} else {echo $DPopup_headtxt;} ?></strong></h2>
                <p class="GP_fs12 GP_a-center"><?php echo $DPopup_text; ?></p>
                <div class="GP_o-hidden">
                    <img src="<?php echo $DPopup_image; ?>" alt="" class="GP_f-right" />
                    <ul class="GP_list">
                        <?php echo $DPopup_point1; ?>
                        <?php echo $DPopup_point2; ?>
                        <?php echo $DPopup_point3; ?>
                        <?php echo $DPopup_point4; ?>
                        <?php echo $DPopup_point5; ?>
                        <?php echo $DPopup_point6; ?>
                    </ul>
                </div>
                <div class="GP_bar-3"></div>
                <div class="GP_form-login-inline">
					
					<?php if ($DPopup_form=='both') { ?>
						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                        	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                        	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                   			<br/>
                        	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                        	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                        </div>
					<?php } ?>
					
					<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                    <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                        <ul class="GP_f-left" <?php echo $Popup_name_padding; ?>>
							<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                            <li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                            <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
							<li><?php echo $DPopup_optin[7]; ?></li>
                            <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                        </ul>
                    </form>
					<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
					<script type="text/javascript">
                    var $jj = jQuery.noConflict();
					if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                        //save user data to cookies
                        $jj("#gpformsubmit_popup").submit(function(){
                            var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                            $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                        });
					}
                    //save user data to cookies
                    $jj("#verified_popup").click(function(){
                        $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                    });
					</script>
					</div>
        			<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
						<a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        	<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        </a>
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
                        //save user data to cookies
                        $jj("#verifiedfb_popup").click(function(){
                        	$jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                        });
                      	</script>
        			</div>
      				<div class="GP_linkv" <?php echo $DPopupf3_view; ?>>
                		<a id="verifiedlink_popup" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                			<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
                			<li style="display:inline"><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                		</a>
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
                        //save user data to cookies
                        $jj("#verifiedlink_popup").click(function(){
                        	$jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                        });
                      	</script>
              		</div>
                </div> 
                <p class="GP_icon GP_padlock GP_w-auto GP_type-2"><?php echo $DPopup_spam; ?></p>            
            </div>
        	</div>
		</div>
		</div>
		<?php } ?>
		<?php if (($DPopup_theme=='popup2' || $DPopup_theme=='popup12') && $DPopup_form!='custom') { ?>
		<!-- popup product plus -->
		<div style="display:none">
        <div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
			<div class="GP_box GP_width903" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
                    <div class="GP_col-left">
                        <div class="GP_bar-4"></div>
                        <h2><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php if ($DPopup_countdown=="on") {do_shortcode("[gpcountdown_popup time=".$DPopup_headtxtT." front='".$DPopup_headtxtF."' end='".$DPopup_headtxtE."']");} else {echo $DPopup_headtxt;} ?></strong></h2>    
                        <p class="GP_fs12"><?php echo $DPopup_text; ?></p>
                        <ul class="GP_list GP_f-right">
                            <?php echo $DPopup_point1; ?>
                            <?php echo $DPopup_point2; ?>
                            <?php echo $DPopup_point3; ?>
                            <?php echo $DPopup_point4; ?>
                            <?php echo $DPopup_point5; ?>
                            <?php echo $DPopup_point6; ?>
                        </ul>
                        <img src="<?php echo $DPopup_image; ?>" alt="" class="GP_f-left" />
                    </div>                        
                    <div class="GP_col-right">
						<h2 class="GP_a-center"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php echo $DPopup_formtitle; ?></strong></h2>       
                        <p class="GP_a-center GP_fs12"><?php echo $DPopup_formtext; ?></p>
                        <div class="GP_form-login-block">
					
        					<?php if ($DPopup_form=='both') { ?>
        						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                                	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                           			<br/>
                                	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
					
							<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                            <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
									<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                                    <li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
									<li><?php echo $DPopup_optin[7]; ?></li>
                                    <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                                </ul>
                            </form>
							<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
							<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
							if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_popup").submit(function(){
                                	var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                                	$jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
							}
                            //save user data to cookies
                            $jj("#verified_popup").click(function(){
                                $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                            });
							</script>
							</div>
        					<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
                                <a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
        					</div>
      						<div <?php echo $DPopupf3_view; ?>>
                				<a id="verifiedlink_popup" class="GP_nodecor" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                				</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
              				</div>
                        </div>  
                        <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DPopup_spam; ?></p>
                    </div>
                    <div class="GP_clear"></div>
                </div>                     
            </div>
        	</div>
		</div>
		</div>
		<?php } ?>
		<?php if (($DPopup_theme=='popup3' || $DPopup_theme=='popup13') && $DPopup_form!='custom') { ?>
		<!-- popup product -->
		<div style="display:none">
        <div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
			<div class="GP_box GP_width903" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
                    <div class="GP_col-left">
                        <div class="GP_bar-5"></div>
                        <h2 class="GP_margin-left" style="margin-bottom:20px"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php if ($DPopup_countdown=="on") {do_shortcode("[gpcountdown_popup time=".$DPopup_headtxtT." front='".$DPopup_headtxtF."' end='".$DPopup_headtxtE."']");} else {echo $DPopup_headtxt;} ?></strong></h2>
                        <ul class="GP_list GP_f-right">
                            <?php echo $DPopup_point1; ?>
                            <?php echo $DPopup_point2; ?>
                            <?php echo $DPopup_point3; ?>
                            <?php echo $DPopup_point4; ?>
                            <?php echo $DPopup_point5; ?>
                            <?php echo $DPopup_point6; ?>
                        </ul>
						<img src="<?php echo $DPopup_image; ?>" alt="" class="GP_f-left GP_margin-top" />
                    </div>
                    <div class="GP_col-right">
                        <h2 class="GP_a-center" style="margin-bottom:30px"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php echo $DPopup_formtitle; ?></strong></h2>                           
                        <div class="GP_form-login-block">
					
        					<?php if ($DPopup_form=='both') { ?>
        						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                                	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                           			<br/>
                                	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
				
							<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                            <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
        							<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                                    <li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DPopup_optin[7]; ?></li>
                                    <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                                </ul>
                            </form>
							<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
        					<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
        					if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_popup").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
        					}
                            //save user data to cookies
                            $jj("#verified_popup").click(function(){
                                $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                            });
        					</script>
							</div>
        					<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
        						<a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
        					</div>
      						<div <?php echo $DPopupf3_view; ?>>
                				<a id="verifiedlink_popup" class="GP_nodecor" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                				</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
              				</div>
                        </div>  
						<p class="GP_icon GP_padlock GP_w-auto"><?php echo $DPopup_spam; ?></p>
                    </div>
                    <div class="GP_clear"></div>
                </div>                     
            </div>
        	</div>
		</div>
		</div>
		<?php } ?>
		<?php if (($DPopup_theme=='popup4' || $DPopup_theme=='popup14') && $DPopup_form!='custom') { ?>
		<!-- popup standard -->
		<div style="display:none">
        <div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
        	<div class="GP_box GP_width680" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
                    <div class="GP_col-left">
                        <div class="GP_bar-4"></div>
                        <h2><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php if ($DPopup_countdown=="on") {do_shortcode("[gpcountdown_popup time=".$DPopup_headtxtT." front='".$DPopup_headtxtF."' end='".$DPopup_headtxtE."']");} else {echo $DPopup_headtxt;} ?></strong></h2>     
                        <p class="GP_fs12"><?php echo $DPopup_text; ?></p>
                        <ul class="GP_list GP_w-auto">
                            <?php echo $DPopup_point1; ?>
                            <?php echo $DPopup_point2; ?>
                            <?php echo $DPopup_point3; ?>
                            <?php echo $DPopup_point4; ?>
                            <?php echo $DPopup_point5; ?>
                            <?php echo $DPopup_point6; ?>
                        </ul>
                    </div>                        
                    <div class="GP_col-right">
                        <h2 class="GP_a-center"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php echo $DPopup_formtitle; ?></strong></h2>          
                        <p class="GP_a-center GP_fs12"><?php echo $DPopup_formtext; ?></p>                         
                        <div class="GP_form-login-block">
					
        					<?php if ($DPopup_form=='both') { ?>
        						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                                	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                           			<br/>
                                	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
				
							<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                            <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
        							<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                                    <li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DPopup_optin[7]; ?></li>
                                    <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                                </ul>
                            </form>
							<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
          					<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
          					if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                            	//save user data to cookies
                                $jj("#gpformsubmit_popup").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
          					}
                            //save user data to cookies
                            $jj("#verified_popup").click(function(){
                                $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                            });
          					</script>
							</div>
        					<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
        						<a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
        					</div>
      						<div <?php echo $DPopupf3_view; ?>>
                				<a id="verifiedlink_popup" class="GP_nodecor" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                				</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
              				</div>
                        </div> 
                        <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DPopup_spam; ?></p>
                    </div>
                    <div class="GP_clear"></div>
                </div>                     
            </div>
        	</div>
		</div>
		</div>
		<?php } ?>
		<?php if (($DPopup_theme=='popup5' || $DPopup_theme=='popup15') && $DPopup_form!='custom') { ?>
		<!-- popup mini -->
		<div style="display:none">
		<div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
        	<div class="GP_box GP_width680" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') 
repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
                    <div class="GP_col-left">
                        <div class="GP_bar-5"></div>
                        <h2 style="margin-bottom:30px"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php if ($DPopup_countdown=="on") {do_shortcode("[gpcountdown_popup time=".$DPopup_headtxtT." front='".$DPopup_headtxtF."' end='".$DPopup_headtxtE."']");} else {echo $DPopup_headtxt;} ?></strong></h2>     
                        <ul class="GP_list GP_w-auto">
                            <?php echo $DPopup_point1; ?>
                            <?php echo $DPopup_point2; ?>
                            <?php echo $DPopup_point3; ?>
                            <?php echo $DPopup_point4; ?>
                            <?php echo $DPopup_point5; ?>
                            <?php echo $DPopup_point6; ?>
                        </ul>
                    </div>                        
                    <div class="GP_col-right">
                        <h2 class="GP_a-center" style="margin-bottom:30px"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php echo $DPopup_formtitle; ?></strong></h2>                            
                        <div class="GP_form-login-block">
					
        					<?php if ($DPopup_form=='both') { ?>
        						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                                	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                           			<br/>
                                	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
				
							<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                            <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                                <ul class="GP_f-left">
        							<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                                    <li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        							<li><?php echo $DPopup_optin[7]; ?></li>
                                    <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                                </ul>
                            </form>
							<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
          					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
          					if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                            	//save user data to cookies
                                $jj("#gpformsubmit_popup").submit(function(){
                                    var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                });
          					}
                            //save user data to cookies
                            $jj("#verified_popup").click(function(){
                                $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                            });
          					</script>
							</div>
        					<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
        						<a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
        					</div>
      						<div <?php echo $DPopupf3_view; ?>>
                				<a id="verifiedlink_popup" class="GP_nodecor" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                				</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
              				</div>
                        </div>  
                        <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DPopup_spam; ?></p>
                    </div>
                    <div class="GP_clear"></div>
                </div>                     
            </div>
        	</div>
		</div>
		</div>
		<?php } ?>
		<?php if (($DPopup_theme=='popup6' || $DPopup_theme=='popup16') && $DPopup_form!='custom') { ?>
		<!-- popup video vertical -->
		<div style="display:none">
        <div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
			<div class="GP_box GP_width715" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <h2 class="GP_a-center"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php if ($DPopup_countdown=="on") {do_shortcode("[gpcountdown_popup time=".$DPopup_headtxtT." front='".$DPopup_headtxtF."' end='".$DPopup_headtxtE."']");} else {echo $DPopup_headtxt;} ?></strong></h2>
                <div class="GP_o-hidden">
                    <div style="text-align:center" class="GP_video640">
                        <?php echo $DPopup_video; ?>
                    </div>
                </div>
                <div class="GP_bar-3"></div>
                <div class="GP_form-login-inline">
					
					<?php if ($DPopup_form=='both') { ?>
						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                        	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                        	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                   			<br/>
                        	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                        	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                        </div>
					<?php } ?>
				
					<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                    <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                    	<ul class="GP_f-left" <?php echo $Popup_name_padding; ?>>
        					<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                        	<li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                            <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        					<li><?php echo $DPopup_optin[7]; ?></li>
                            <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                        </ul>
                    </form>
					<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
          			<script type="text/javascript">
                    var $jj = jQuery.noConflict();
          			if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                        //save user data to cookies
                        $jj("#gpformsubmit_popup").submit(function(){
                        	var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                            $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                    	});
          			}
                    //save user data to cookies
                    $jj("#verified_popup").click(function(){
                    	$jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                    });
          			</script>
					</div>
        			<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
        				<a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        	<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        </a>
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
                        //save user data to cookies
                        $jj("#verifiedfb_popup").click(function(){
                        	$jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                        });
                      	</script>
        			</div>
      				<div class="GP_linkv" <?php echo $DPopupf3_view; ?>>
                		<a id="verifiedlink_popup" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                			<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
                			<li style="display:inline"><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                		</a>
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
                        //save user data to cookies
                        $jj("#verifiedlink_popup").click(function(){
                            $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                        });
                      	</script>
              		</div>
                </div>
				<p class="GP_icon GP_padlock GP_w-auto GP_type-2"><?php echo $DPopup_spam; ?></p>
            </div>
        	</div>
        </div>
    	</div>
		<?php } ?>
		<?php if (($DPopup_theme=='popup7' || $DPopup_theme=='popup17') && $DPopup_form!='custom') { ?>
		<!-- popup video 640 -->
		<div style="display:none">
        <div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
			<div class="GP_box GP_width973" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
                    <div class="GP_col-left">
                        <div class="GP_bar-4"></div>
                        <div class="GP_video">
                            <?php echo $DPopup_video; ?>
                        </div>
						<div style="height:8px"></div>
                    </div>                        
                    <div class="GP_col-right">
                        <h2 class="GP_a-center"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php echo $DPopup_formtitle; ?></strong></h2>       
						<p class="GP_a-center GP_fs12"><?php echo $DPopup_formtext; ?></p>
                        <div class="GP_form-login-block">
					
        					<?php if ($DPopup_form=='both') { ?>
        						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                                	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                           			<br/>
                                	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
						
							<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                            <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                            	<ul class="GP_f-left">
                					<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                                	<li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                					<li><?php echo $DPopup_optin[7]; ?></li>
                                    <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                                </ul>
                            </form>
							<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
                  			<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
                  			if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_popup").submit(function(){
                                	var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            	});
                  			}
                            //save user data to cookies
                            $jj("#verified_popup").click(function(){
                                $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                            });
                  			</script>
							</div>
        					<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
        						<a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
        					</div>
      						<div <?php echo $DPopupf3_view; ?>>
                				<a id="verifiedlink_popup" class="GP_nodecor" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                				</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
              				</div>
                        </div>
                        <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DPopup_spam; ?></p>
                    </div>
                    <div class="GP_clear"></div>
                </div>                     
            </div>
        	</div>
		</div>
		</div>
		<?php } ?>
		<?php if (($DPopup_theme=='popup8' || $DPopup_theme=='popup18') && $DPopup_form!='custom') { ?>
		<!-- popup video 480 -->
		<div style="display:none">
        <div class="Generation_plug GP_lightbox" id="GP_lightbox">
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:7px 14px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_popup" type="checkbox" name="gpds_popup"><label for="gpds_popup"></label>
			</div>
			<div class="GP_box GP_width821" style="background: <?php echo $DPopup_bgcolor; ?> url('<?php echo $DPopup_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
                    <div class="GP_col-left">
                        <div class="GP_bar-4"></div>
                        <div class="GP_video">
                            <?php echo $DPopup_video480; ?>
                        </div>
						<div style="height:8px"></div>
                    </div>                        
                    <div class="GP_col-right">
                        <h2 class="GP_a-center"><strong style="color:<?php echo $DPopup_headclr; ?>;"><?php echo $DPopup_formtitle; ?></strong></h2>       
						<p class="GP_a-center GP_fs12"><?php echo $DPopup_formtext; ?></p>
                        <div class="GP_form-login-block">
					
        					<?php if ($DPopup_form=='both') { ?>
        						<div id="GP_s_popup" class="GP_f_popup GP_s_popup">
                                	<input style="display:none" type="radio" id="GP_s_r1_popup" name="GP_f_popup" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_popup" name="GP_f_popup" />
                           			<br/>
                                	<label for="GP_s_r1_popup" class="GP_s_en_popup selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_popup" class="GP_s_di_popup"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
							
							<div id="Popup_s_show1" <?php echo $DPopupf1_view; ?>>
                            <form id="gpformsubmit_popup" action="<?php echo $DPopup_optin[4]; ?>" method="post">
                            	<ul class="GP_f-left">
                					<li style="display:none"><?php echo $DPopup_optin[5]; ?></li>
                                	<li <?php echo $Popup_name_disabled; ?>><input id="gpuserinput_popup" <?php echo $gpnameinput_popup; ?> name="<?php echo $DPopup_optin[1]; ?>" type="text" value="<?php echo $Popup_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                    <li><input id="gpemailinput_popup" <?php echo $gpemailinput_popup; ?> name="<?php echo $DPopup_optin[2]; ?>" type="text" value="<?php echo $Popup_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                					<li><?php echo $DPopup_optin[7]; ?></li>
                                    <li><input id="verified_popup" name="<?php echo $DPopup_optinsubmit; ?>" type="<?php echo $gpformbtn_popup; ?>" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                                </ul>
                            </form>
							<input type="hidden" id="gpkeepuserdetails_popup" value="<?php echo $DAutoins; ?>">
                  			<script type="text/javascript">
                           	var $jj = jQuery.noConflict();
                  			if ($jj("#gpkeepuserdetails_popup").val()=="on") {
                                //save user data to cookies
                                $jj("#gpformsubmit_popup").submit(function(){
                                	var gpmydetails = $jj("#gpuserinput_popup").val() + '|' + $jj("#gpemailinput_popup").val();
                                    $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            	});
                  			}
                            //save user data to cookies
                            $jj("#verified_popup").click(function(){
                                $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                            });
                  			</script>
							</div>
        					<div id="Popup_s_show2" class="GP_f-left-fb" <?php echo $DPopupf2_view; ?>>
        						<a id="verifiedfb_popup" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
        					</div>
      						<div <?php echo $DPopupf3_view; ?>>
                				<a id="verifiedlink_popup" class="GP_nodecor" href="<?php echo $DPopup_link; ?>" <?php echo $Popup_link_blank; ?>>
                					<img src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Popup_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DPopup_btncolor; ?>" /></li>
                				</a>
    							<script type="text/javascript">
                               	var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_popup").click(function(){
                                    $jj.cookie("gpsubscribed_popup", "subscribed", {expires: <?php echo $gp_dsacookie; ?>, path: '/'});
                                });
                      			</script>
              				</div>
                        </div>
                        <p class="GP_icon GP_padlock GP_w-auto"><?php echo $DPopup_spam; ?></p>
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
} //STOP IF 'DONT SHOW' IS NOT ACTIVE
?>
