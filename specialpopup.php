<?php
/********** WIDGET **********/
/********** FUNCTION START **********/
function gpregisterreturn_widget() {


global $wpdb;
$table_name_register = $wpdb->prefix . 'GenerationPlugin_REGISTER';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }


$DReg_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_register.' WHERE id='.$Duniqueid));
$DReg_display = explode("|", $DReg_displays);
$DReg_showsub = $DReg_display[3];
if ($DReg_showsub=="on" && $_COOKIE["gpsubscribed_reg"]=="subscribed") { /* STOP HERE */ } 
else { //START IF 'SUBSCRIBED' IS NOT ACTIVE

$DReg_ddelay = $DReg_display[4];
if ($DReg_ddelay<0 || $DReg_ddelay=="0" || $DReg_ddelay=="") { $DReg_ddelay="0"; }


$DReg_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_register.' WHERE id='.$Duniqueid);
if ($DReg_active_tmp=="on") { //START IF ACTIVATED


$DReg_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_Reg.' WHERE id='.$Duniqueid));
$DReg_display = explode("|", $DReg_display);
if ($DReg_display[6]=='' || ($DReg_display[6]!="" && strtotime($DReg_display[6]) <= strtotime(date("Y-m-d")))) {
	$DReg_ddays_1="1";
} else {$DReg_ddays_1="0";}
if ($DReg_display[7]=='' || ($DReg_display[7]!="" && strtotime($DReg_display[7]) > strtotime(date("Y-m-d")))) {
	$DReg_ddays_2="1";
} else {$DReg_ddays_2="0";}
if ($DReg_ddays_1=="1" && $DReg_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$DReg_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_theme = preg_replace("/\\\/","",$DReg_theme);
if ($DReg_theme=="") {$DReg_theme = "header1";} //default
$DReg_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_link = preg_replace("/\\\/","",$DReg_link);
if ($DReg_link=="") {$DReg_link = "#";}
$DReg_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_image = preg_replace("/\\\/","",$DReg_image);
if ($DReg_image=="") {$DReg_image = GenerationPlugin_images.'/boxes/register-padlock.png';}
else { $DReg_image = $DReg_image;}
$DReg_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_bgimage = preg_replace("/\\\/","",$DReg_bgimage);

$DReg_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_btncolor = preg_replace("/\\\/","",$DReg_btncolor);
$DReg_btncolor = explode("|", $DReg_btncolor);
$DReg_btncolor = $DReg_btncolor[3];
if ($DReg_btncolor=="" || $DReg_btncolor=="Stripe design") {$DReg_btncolor = "stripe_red";}
if ($DReg_btncolor=="Simple design") {$DReg_btncolor = "simple_red";}

$DReg_backgrounds = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_backgrounds = preg_replace("/\\\/","",$DReg_backgrounds);
$DReg_backgrounds = explode("|", $DReg_backgrounds);
$DReg_background = $DReg_backgrounds[0];
$DReg_screencolor = $DReg_backgrounds[1];
$DReg_screenopacity = $DReg_backgrounds[2];
if ($DReg_theme=='reg1' || $DReg_theme=='reg2') {
	$DReg_bgcolor = '#222';
    if ($DReg_bgimage!="") {$DReg_bgimage = $DReg_bgimage;}
    elseif ($DReg_background=='bg2') {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DReg_background=='bg3') {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DReg_background=='bg4') {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} else {
	$DReg_bgcolor = '#CCC';
    if ($DReg_bgimage!="") {$DReg_bgimage = $DReg_bgimage;}
    elseif ($DReg_background=='bg12') {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DReg_background=='bg13') {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DReg_background=='bg14') {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DReg_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
}

$DReg_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_title_tmp = preg_replace("/\\\/","",$DReg_title_tmp);
    $DReg_title = explode("|", $DReg_title_tmp);
	$DReg_headclr = $DReg_title[0];
	if ($DReg_headclr=="") {$DReg_headclr="#CC0000";} //default
	$DReg_headtxt = $DReg_title[1];
	if ($DReg_headtxt=="") {$DReg_headtxt="Header Title Goes Here!";} //default
	if (strpos($DReg_headtxt,"(")!==false) {
		$DReg_headtxt=explode("(",$DReg_headtxt);
		$DReg_headtxtF=$DReg_headtxt[0]; //front
		$DReg_headtxt=explode(")",$DReg_headtxt[1]);
		$DReg_headtxtT=$DReg_headtxt[0]; //time
		$DReg_headtxtE=$DReg_headtxt[1]; //end
		$DReg_countdown="on";
	}
    function gpcountdown_reg($atts) {    
    	extract(shortcode_atts(array("time" => "10", "front" => "", "end" => "", "type" => "reg"),$atts));
    	return gpcountdownreturn($time,$front,$end,$type);
    }
    add_shortcode("gpcountdown_reg", "gpcountdown_reg");
$DReg_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_text = preg_replace("/\\\/","",$DReg_text);
if ($DReg_text=="") {$DReg_text="This is an example of subtitle or description text. Lorem ipsum dolor amet.";} //default

$DReg_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_form_tmp = preg_replace("/\\\/","",$DReg_form);
    $DReg_formx = explode("|", $DReg_form_tmp);
	$DReg_form = $DReg_formx[0];
	$DReg_formtype = $DReg_formx[1];
	$DReg_clink = $DReg_formx[2];
	$DReg_cclick1 = $DReg_formx[3];
	$DReg_cblank = $DReg_formx[4];
	if ($DReg_cblank=="_blank") {$DReg_cblank="_blank";} else {$DReg_cblank="_top";}
	$DReg_cbgimage = $DReg_formx[5];
	if ($DReg_cbgimage!='') {$DReg_cimage = $DReg_cbgimage;} else {$DReg_cimage = $DReg_cclick1;}
	$DReg_cclick2 = $DReg_formx[6];
	$DReg_cwidth = $DReg_formx[7];
	if ($DReg_cwidth=="") {$DReg_cwidth="760";} //default
	$DReg_cwidth_i = $DReg_cwidth - 8;
	$DReg_cheight = $DReg_formx[8];
	if ($DReg_cheight=="") {$DReg_cheight="360";} //default
	$DReg_cheight_i = $DReg_cheight - 8;
	$DReg_cscroll = $DReg_formx[9];
	if ($DReg_cscroll=="scroll") {$DReg_cscroll="scroll";} else {$DReg_cscroll="hidden";}
	if ($DReg_form=="") {$DReg_form="link";} //default
	$DReg_surname = $DReg_formx[10];
	$DReg_phone = $DReg_formx[11];
	$DReg_subject = $DReg_formx[12];
	$DReg_message = $DReg_formx[13];
	if ($DReg_message=="") {$DReg_message = "Your message";} //default
	$DReg_recipient = $DReg_formx[14];
	$DReg_not1 = $DReg_formx[15];
	$DReg_not2 = $DReg_formx[16];
	$DReg_not3 = $DReg_formx[17];
	if ($DReg_surname=="") {$DReg_dsurname="none";} else {$DReg_dsurname="block";}
	if ($DReg_phone=="") {$DReg_dphone="none";} else {$DReg_dphone="block";}
	if ($DReg_subject=="") {$DReg_dsubject="none";} else {$DReg_dsubject="block";}
	
$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
	$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
	$gp_d56 = explode("|", $gp_d56_tmp);
	$gp_d5 = $gp_d56[0];
	$gp_d6 = $gp_d56[1];
	if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
	if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default

if ($DReg_form=='regular' || $DReg_form=='') {
	$DRegf1_view='style="display:block"'; $DRegf2_view='style="display:none"'; $DRegf3_view='style="display:none"';
}
elseif ($DReg_form=='social') {
	$DRegf1_view='style="display:none"'; $DRegf2_view='style="display:block"'; $DRegf3_view='style="display:none"';
}
elseif ($DReg_form=='both') {
	$DRegf1_view='style="display:block"'; $DRegf2_view='style="display:none"'; $DRegf3_view='style="display:none"';
}
elseif ($DReg_form=='link') {
	$DRegf1_view='style="display:none"'; $DRegf2_view='style="display:none"'; $DRegf3_view='style="display:block"';
}

$DReg_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_regular_tmp = preg_replace("/\\\/","",$DReg_regular_tmp);
    $DReg_regular = explode("|", $DReg_regular_tmp);
	$Reg_fname = $DReg_regular[0];
	if ($Reg_fname=="") {$Reg_fname="Insert your name";} //default
	$Reg_femail = $DReg_regular[1];
	if ($Reg_femail=="") {$Reg_femail="Insert your email";} //default
	$Reg_fbtntxt = $DReg_regular[2];
	if ($Reg_fbtntxt=="") {$Reg_fbtntxt="Register";} //default
	$Reg_fbtnclr = $DReg_regular[3];
	if ($Reg_fbtnclr=="") {$Reg_fbtnclr="stripe_red";} //default
	
$DReg_social_tmp = stripslashes($wpdb->get_var('SELECT Social FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_social_tmp = preg_replace("/\\\/","",$DReg_social_tmp);
	$DReg_social = explode("|", $DReg_social_tmp);
	$Reg_fb1 = $DReg_social[0];
	$Reg_fb2 = $DReg_social[1];
	$Reg_fb3 = $DReg_social[2];
	$Reg_fb4 = $DReg_social[3];
	
$DReg_sky_tmp = stripslashes($wpdb->get_var('SELECT Sky FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_sky_tmp = preg_replace("/\\\/","",$DReg_sky_tmp);
	$DReg_sky = explode("|", $DReg_sky_tmp);
	$Reg_skytitle = $DReg_sky[0];
	$Reg_skyheader = $DReg_sky[1];
	$Reg_skydescription = $DReg_sky[2];
	$Reg_skylink = $DReg_sky[3];
	$Reg_skytarget = $DReg_sky[4];
	if ($Reg_skytarget=="on") {$Reg_skytarget="_blank";} else {$Reg_skytarget="_self";}
	if ($Reg_skytitle=="") {$Reg_skytitle="Free!";} //default
	if ($Reg_skyheader=="") {$Reg_skyheader="Bestselling Ebook";} //default
	if ($Reg_skydescription=="") {$Reg_skydescription="Click here for instant download";} //default
	if ($Reg_skylink=="") {$Reg_skylink="#";} //default
	if ($Reg_skytarget=="") {$Reg_skytarget="_self";} //default

$DReg_openlink = stripslashes($wpdb->get_var('SELECT Openlink FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_openlink = preg_replace("/\\\/","",$DReg_openlink);
if ($DReg_openlink=="") {$DReg_openlink="Register";} //default
//$DReg_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	//$DReg_spam = preg_replace("/\\\/","",$DReg_spam);
if ($DReg_spam=="") {$DReg_spam="We will not share your details with anyone, we promise!";} //default
$DReg_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_register.' WHERE id='.$Duniqueid));
	$DReg_optin = preg_replace("/\\\/","",$DReg_optin);
	
$DReg_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_register.' WHERE id='.$Duniqueid));
    $DReg_display = explode("|", $DReg_display);
	$DReg_dpages = $DReg_display[0];
	$DReg_dcats = $DReg_display[1];
	$DReg_dposts = $DReg_display[2];
?>

<?php
//DISPLAYING

//prepare page list in array
$DReg_dpages_explode=explode(",",$DReg_dpages);
foreach ($DReg_dpages_explode as $DReg_dpages_explode_element) { $DReg_dpages_array[]=$DReg_dpages_explode_element; }
//prepare category list in array
$DReg_dcats_explode=explode(",",$DReg_dcats);
foreach ($DReg_dcats_explode as $DReg_dcats_explode_element) { $DReg_dcats_array[]=$DReg_dcats_explode_element; }
//prepare posts list in array
$DReg_dposts_explode=explode(",",$DReg_dposts);
foreach ($DReg_dposts_explode as $DReg_dposts_explode_element) { $DReg_dposts_array[]=$DReg_dposts_explode_element; }

if (((strpos($DReg_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DReg_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DReg_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DReg_dpages.',',',author,')!==false) || //author page
	 (is_page($DReg_dpages_array)))) || //pages and subpages
   ((strpos($DReg_dcats,'allcats')!==false) &&
	 (is_category($DReg_dcats_array))) || //category pages
   ((strpos($DReg_dposts,'allposts')!==false) &&
	 (is_single($DReg_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>
		
		<script type="text/javascript">
     	var $jj = jQuery.noConflict();
     	function isValidUserCHECK_reg() {
     		var user_reg = $jj("#gpuserinput_reg").val();
     		var email_reg = $jj("#gpemailinput_reg").val();
     		if(user_reg != 0) {
     			if(isValidUser_reg(user_reg)) {
     				$jj("#gpuserinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
     				if(isValidEmailAddress_reg(email_reg)) {
     					document.getElementById('register').type="submit";
     				}
     			} else {
     				$jj("#gpuserinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('register').type="button";
     			}
     		} else {
     			$jj("#gpuserinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('register').type="button";
     		}
     	}
		//contact form surname - start
     	function isValidUserCHECK_sur_reg() {
     		var user_sur_reg = $jj("#gpuserinput_sur_reg").val();
     		var email_sur_reg = $jj("#gpemailinput_sur_reg").val();
     		if(user_sur_reg != 0) {
     			if(isValidUser_sur_reg(user_sur_reg)) {
     				$jj("#gpuserinput_sur_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
     				if(isValidEmailAddress_sur_reg(email_sur_reg)) {
     					//document.getElementById('register').type="submit";
     				}
     			} else {
     				$jj("#gpuserinput_sur_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
     				//document.getElementById('register').type="button";
     			}
     		} else {
     			$jj("#gpuserinput_sur_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
     			//document.getElementById('register').type="button";
     		}
     	}
		//contact form surname - stop
     	function isValidEmailCHECK_reg() {
     		var user_reg = $jj("#gpuserinput_reg").val();
     		var email_reg = $jj("#gpemailinput_reg").val();
     		if(email_reg != 0) {
     			if(isValidEmailAddress_reg(email_reg)) {
     				$jj("#gpemailinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
     				if(isValidUser_reg(user_reg)) {
     					document.getElementById('register').type="submit";
     				}
     			} else {
     				$jj("#gpemailinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('register').type="button";
     			}
     		} else {
     			$jj("#gpemailinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('register').type="button";
     		}
     	}
     	function isValidUser_reg(user_reg) {
      		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
      		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
      		return patternone.test(user_reg);
     	}
     	function isValidUser_sur_reg(user_sur_reg) {
      		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
      		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
      		return patternone.test(user_sur_reg);
     	}
     	function isValidEmailAddress_reg(email_reg) {
      		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
      		return pattern.test(email_reg);
     	}
     	</script>
		<?php
        global $wpdb;
        $table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
        $DAutoins = $wpdb->get_var('SELECT Autoins FROM '.$table_name_general.' WHERE id=1');
        $DLivecheck = $wpdb->get_var('SELECT Livecheck FROM '.$table_name_general.' WHERE id=1');

		if ($DLivecheck=='on') {
			?>
			<script type="text/javascript">
         	var $jj = jQuery.noConflict();
    		$jj(document).ready(function(){
         		var user_reg = $jj("#gpuserinput_reg").val();
         		var user_sur_reg = $jj("#gpuserinput_sur_reg").val();
         		var email_reg = $jj("#gpemailinput_reg").val();
        		if(isValidUser_reg(user_reg) && isValidEmailAddress_reg(user_sur_reg) && isValidEmailAddress_reg(email_reg)) {
    				$jj("#gpuserinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
					$jj("#gpuserinput_sur_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				$jj("#gpemailinput_reg").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				document.getElementById('register').type="submit";
    			}
    		});
			</script>
			<?php
        	$gpnameinput_reg='onkeyup="isValidUserCHECK_reg();" onblur="isValidUserCHECK_reg();" onclick="isValidUserCHECK_reg();" onfocus="isValidUserCHECK_reg();"';
        	$gpnameinput_sur_reg='onkeyup="isValidUserCHECK_sur_reg();" onblur="isValidUserCHECK_sur_reg();" onclick="isValidUserCHECK_sur_reg();" onfocus="isValidUserCHECK_sur_reg();"';
        	$gpemailinput_reg='onkeyup="isValidEmailCHECK_reg();" onblur="isValidEmailCHECK_reg();" onclick="isValidEmailCHECK_reg();" onfocus="isValidEmailCHECK_reg();"';
        	$gpformbtn_reg='button';
        } else {
        	$gpnameinput_reg='';
        	$gpemailinput_reg='';
        	$gpemailinput_sur_reg='';
        	$gpformbtn_reg='submit';
        }
		if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
			$gpmydatapopupcookie = explode("|",$_COOKIE['gpmydetails']);
			$Reg_fname = $gpmydatapopupcookie[0];
			$Reg_femail = $gpmydatapopupcookie[1];
		}
		?>
		
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
    	$jj(document).ready(function() {
			//default values in form
			$jj('input[type=text]').each(function(){ $jj(this).data('default', this.value); });
			$jj('input[type=text]').focusin(function(){ if (this.value==$jj(this).data('default')) {this.value='';} });
			$jj('input[type=text]').focusout(function(){ if (this.value=='') {this.value=$jj(this).data('default');} });
            $jj(".GP_showregister").fancybox({
                'titleShow' : 'false',
                'transitionIn' : 'fade',
                'transitionOut' : 'fade',
				'titleShow' : 'true',
				'overlayColor' : '<?php echo $DReg_screencolor; ?>',
				'overlayOpacity' : '<?php echo $DReg_screenopacity; ?>',
            });
        });
		//slide skybox on load
		$jj(document).ready(function(){
			setTimeout(function(){
    			$jj(".GP_skydiv_img").css({"display": "block"}).delay(500).animate({"marginBottom": 0}, 3000);
    			$jj(".GP_skydiv").css({"display": "block"}).delay(500).animate({"marginBottom": 0}, 3000);
			},<?php echo $DReg_ddelay;?>*1000);
			$jj(".GP_skydiv").mouseover(function() {
    			$jj(".GP_skydiv_close").fadeIn(0);
    		});
    		$jj(".GP_skydiv").mouseout(function() {
    			$jj(".GP_skydiv_close").fadeOut(0);
    		});
			$jj(".GP_skydiv_close").click(function() {
				$jj(".GP_skydiv_img").animate({"marginBottom": -100}, 3000);
				$jj(".GP_skydiv").animate({"marginBottom": -100}, 3000);
			});
        });
		//autoheight for custom content with large image
		$jj(document).ready(function(){
            $gpdochdivh_reg = $jj(window).height();
            $gpdochdivh_reg = ($gpdochdivh_reg/10)*8; //80% of window height
            $jj("#GP_autoheight_reg").css({"max-height": +$gpdochdivh_reg+"px"});
        });
		//Form switch
		$jj(document).ready(function(){ 
        	$jj(".GP_s_en_reg").click(function(){
        		var parent = $jj(this).parents('.GP_s_reg');
        		$jj('.GP_s_di_reg',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Reg_s_show2').fadeOut(500);
        		$jj('#Reg_s_show1').delay(505).fadeIn(500);
        	});
        	$jj(".GP_s_di_reg").click(function(){
        		var parent = $jj(this).parents('.GP_s_reg');
        		$jj('.GP_s_en_reg',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Reg_s_show1').fadeOut(500);
        		$jj('#Reg_s_show2').delay(505).fadeIn(500);
        	});
			var switchwidth1 = $jj('.GP_s_en_reg').width();
			var switchwidth2 = $jj('.GP_s_di_reg').width();
			var switchwidth = switchwidth1+switchwidth2;
			$jj('.GP_s_reg').css({'width': ''+switchwidth+''});
        });
        </script>
		<script type="text/javascript">
        var $jj = jQuery.noConflict();
        $jj(document).ready(function(){
        	$jj('#gp_contactform').submit(function(){
            	var action = $jj(this).attr('action');
            		$jj.post(action, {
              		name: $jj('#gpuserinput_reg').val(),
                    surname: $jj('#gpuserinput_sur_reg').val(),
                    email: $jj('#gpemailinput_reg').val(),
                    phone: $jj('#gpphoneinput_reg').val(),
                    subject: $jj('#gpsubjectinput_reg').val(),
                    message: $jj('#gpmessageinput_reg').val(),
                    recipient: $jj('#gprecipientinput_reg').val(),
                    not1: $jj('#gpnot1_reg').val(),
                    not2: $jj('#gpnot2_reg').val(),
                    not3: $jj('#gpnot3_reg').val(),
					//defaults
                    defname: $jj('#gpnamedefault_reg').val(),
                    defsurname: $jj('#gpsurnamedefault_reg').val(),
                    defemail: $jj('#gpemaildefault_reg').val(),
                    defphone: $jj('#gpphonedefault_reg').val(),
                    defsubject: $jj('#gpsubjectdefault_reg').val(),
                    defmessage: $jj('#gpmessagedefault_reg').val()	
           		},
         		function(data){
                    $jj('#gp_contactform #submit').attr('disabled','');
                    $jj('#gp_contactform').before('<div class="gpresponse">'+data+'</div>');
                    $jj('.gpresponse').slideDown();
                    if (document.getElementById("gpsuccesssent") != null) {
						$jj('.gpwarning').hide();
						$jj('#gp_contactform').slideUp();
					}
                    $jj('.gpwarning').delay(5000).fadeOut(500);
       			});
      			return false;
        	});
        });
		</script>
		<div style="position:fixed; top:-9999; visibility:hidden" class="GP_s_reg">
            <label class="GP_s_en_reg"><span><?php echo $gp_d5; ?></span></label>
            <label class="GP_s_di_reg"><span><?php echo $gp_d6; ?></span></label>
        </div>
		
		<style>
		.Generation_plug.GP_registerform h2 strong span {
		  color:<?php echo $DReg_headclr; ?>;
		}
		</style>
		
		<?php
		if ($DReg_theme=='reg11' || $DReg_theme=='reg12' || $DReg_theme=='reg13') {
			wp_enqueue_style('style user_light-7', GenerationPlugin_style.'/style-light-7.css');
		}
		?>
		
		<?php if ($DReg_form=='custom') { ?>
			<?php if ($DReg_formtype=='link' || $DReg_formtype=='') { ?>
			<div style="display:none">
        	<div class="Generation_plug GP_registerform" id="GP_registerform">
        		<div class="GP_box" style="background:#FFF; width:<?php echo $DReg_cwidth; ?>px!important; 
						height:<?php echo $DReg_cheight; ?>px!important; overflow:hidden"
				>
                <div class="GP_content" style="overflow:hidden; margin:0!important; margin-top:0!important; 
						margin-right:0!important; margin-bottom:0!important; margin-left:0!important; 
						padding:0!important; padding-top:0!important; padding-right:0!important; 
						padding-bottom:0!important; padding-left:0!important; 
						width:<?php echo $DReg_cwidth_i; ?>px!important; 
						height:<?php echo $DReg_cheight_i; ?>px!important;"
				>
					<iframe class="GP_pmzero" src="<?php echo $DReg_clink; ?>" width="100%" style="height:100%; width:100%; overflow-x:hidden; overflow-y:<?php echo $DReg_cscroll; ?>" ></iframe>
				</div>
				</div>
			</div>
			</div>
            <?php } elseif ($DReg_formtype=='image') { ?>
			<div style="display:none">
        	<div class="Generation_plug GP_registerform" id="GP_registerform">
        		<div class="GP_box" style="background:#FFF; width:auto!important; height:auto!important; overflow:hidden">
                <div id="GP_autoheight_reg" class="GP_content" style="overflow:hidden; margin:0!important; margin-top:0!important; 
						margin-right:0!important; margin-bottom:0!important; margin-left:0!important; 
						padding:0!important; padding-top:0!important; padding-right:0!important; 
						padding-bottom:0!important; padding-left:0!important; 
						width:auto!important"
				>
					<a href="<?php echo $DReg_cclick2; ?>" target="<?php echo $DReg_cblank; ?>">
						<img style="overflow:hidden"; src="<?php echo $DReg_cimage; ?>">
					</a>
				</div>
				</div>
			</div>
			</div>
            <?php } ?>

    		<div class="Generation_plug" style="text-align:center!important">
    			<a style="border:0!important" class="GP_showregister gpregister" href="#GP_registerform">
    				<input type="button" value="<?php echo $DReg_openlink; ?>" class="GP_button <?php echo 'GP_'.$DReg_btncolor; ?>" />
    				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png'; ?>">
    			</a>
    		</div>
		<?php } elseif ($DReg_theme=='reg1' || $DReg_theme=='reg11') { ?>
		<!-- registration box -->
		<div style="display:none">
        <div class="Generation_plug GP_registerform" id="GP_registerform">
        <div class="GP_box GP_width530" style="background: <?php echo $DReg_bgcolor; ?> url('<?php echo $DReg_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
					<h2 style="margin-bottom:5px"><strong style="color:<?php echo $DReg_headclr; ?>;"><?php if ($DReg_countdown=="on") {do_shortcode("[gpcountdown_reg time=".$DReg_headtxtT." front='".$DReg_headtxtF."' end='".$DReg_headtxtE."']");} else {echo $DReg_headtxt;} ?></strong></h2>
                    <p class="GP_fs12 GP_a-center GP_nomargintop">&nbsp;<?php echo $DReg_text; ?></p>
                    <div class="GP_col-left">
                        <div class="GP_bar-6 GP_nomargintop"></div>                     
                        <div class="GP_a-center"><img style="margin-left:-18px" src="<?php echo $DReg_image; ?>" alt="" /></div>
                    </div>                        
                    <div class="GP_col-right">  
                        <div class="GP_form-login-block">
					
        					<?php if ($DReg_form=='both') { ?>
        						<div id="GP_s_reg" class="GP_f_reg GP_s_reg">
                                	<input style="display:none" type="radio" id="GP_s_r1_reg" name="GP_f_reg" checked />
                                	<input style="display:none" type="radio" id="GP_s_r2_reg" name="GP_f_reg" />
                           			<br/>
                                	<label for="GP_s_r1_reg" class="GP_s_en_reg selected"><span><?php echo $gp_d5; ?></span></label>
                                	<label for="GP_s_r2_reg" class="GP_s_di_reg"><span><?php echo $gp_d6; ?></span></label>
                                </div>
        					<?php } ?>
					
							<div id="Reg_s_show1" <?php echo $DRegf1_view; ?>>
                                <form id="gpformsubmit_reg" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
        							<ul class="GP_f-left">
                                        <li><input <?php echo $gpnameinput_reg; ?> type="text" value="<?php echo $Reg_fname; ?>" class="GP_input-user" name="user_login" id="gpuserinput_reg" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                        <li><input <?php echo $gpemailinput_reg; ?> type="text" value="<?php echo $Reg_femail; ?>" class="GP_input-user" name="user_email" id="gpemailinput_reg" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
        								<?php do_action('register_form'); ?>
                                        <li><input type="submit" value="<?php echo $Reg_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DReg_btncolor; ?>" id="register" /></li>
                                    </ul>
                                </form>
            					<input type="hidden" id="gpkeepuserdetails_reg" value="<?php echo $DAutoins; ?>">
    							<script type="text/javascript">
                                var $jj = jQuery.noConflict();
            					if ($jj("#gpkeepuserdetails_reg").val()=="on") {
                                    //save user data to cookies
                                    $jj("#gpformsubmit_reg").submit(function(){
                                        var gpmydetails = $jj("#gpuserinput_reg").val() + '|' + $jj("#gpemailinput_reg").val();
                                        $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                                    });
            					}
                                //save user data to cookies
                                $jj("#register").click(function(){
                                    $jj.cookie("gpsubscribed_reg", "subscribed", {expires: 7, path: '/'});
                                });
            					</script>
							</div>
        					<div id="Reg_s_show2" <?php echo $DRegf2_view; ?>>
        						<a id="verifiedfb_reg" href="<?php echo GenerationPlugin_path.'/facebook.php?t=r'; ?>" target="_blank">
                        			<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebookv.gif">
                        		</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedfb_reg").click(function(){
                                    $jj.cookie("gpsubscribed_reg", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
        					</div>
      						<div <?php echo $DRegf3_view; ?>>
                				<a id="verifiedlink_reg" class="GP_nodecor" href="<?php echo $DReg_link; ?>" target="_parent">
                					<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrowsv.gif'; ?>">
                					<li><input type="button" value="<?php echo $Reg_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DReg_btncolor; ?>" /></li>
                				</a>
            					<script type="text/javascript">
                                var $jj = jQuery.noConflict();
                                //save user data to cookies
                                $jj("#verifiedlink_reg").click(function(){
                                    $jj.cookie("gpsubscribed_reg", "subscribed", {expires: 7, path: '/'});
                                });
                              	</script>
              				</div>
                        </div>
                    </div>
                    <div class="GP_clear"></div>
                </div>
            </div>
        </div>
        </div>
        </div>

		<div class="Generation_plug" style="text-align:center!important">
			<a style="border:0!important" class="GP_showregister gpregister" href="#GP_registerform">
				<input type="button" value="<?php echo $DReg_openlink; ?>" class="GP_button <?php echo 'GP_'.$DReg_btncolor; ?>" />
				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png'; ?>">
			</a>
		</div>
		<?php } ?>
		<?php if ($DReg_theme=='reg2' || $DReg_theme=='reg12') { ?>
		<!-- login box -->
		<div style="display:none">
        <div class="Generation_plug GP_registerform" id="GP_registerform">
        <div class="GP_box GP_width530" style="background: <?php echo $DReg_bgcolor; ?> url('<?php echo $DReg_bgimage; ?>') repeat center center;">
            <div class="GP_content">
                <div class="GP_two-columns">
					<h2 style="margin-bottom:5px"><strong style="color:<?php echo $DReg_headclr; ?>;"><?php if ($DReg_countdown=="on") {do_shortcode("[gpcountdown_reg time=".$DReg_headtxtT." front='".$DReg_headtxtF."' end='".$DReg_headtxtE."']");} else {echo $DReg_headtxt;} ?></strong></h2>
                    <p class="GP_fs12 GP_a-center GP_nomargintop">&nbsp;<?php echo $DReg_text; ?></p>
						<div class="GP_form-login-block" style="margin-bottom:-15px!important">
						<form id="gp_contactform" action="<?php echo GenerationPlugin_path; ?>contact.php" method="post">
							<input type="hidden" id="gprecipientinput_reg" value="<?php echo $DReg_recipient; ?>">
							<input type="hidden" id="gpnamedefault_reg" value="<?php echo $Reg_fname; ?>">
							<input type="hidden" id="gpsurnamedefault_reg" value="<?php echo $DReg_surname; ?>">
							<input type="hidden" id="gpemaildefault_reg" value="<?php echo $Reg_femail; ?>">
							<input type="hidden" id="gpphonedefault_reg" value="<?php echo $DReg_phone; ?>">
							<input type="hidden" id="gpsubjectdefault_reg" value="<?php echo $DReg_subject; ?>">
							<input type="hidden" id="gpmessagedefault_reg" value="<?php echo $DReg_message; ?>">
							<input type="hidden" id="gpnot1_reg" value="<?php echo $DReg_not1; ?>">
							<input type="hidden" id="gpnot2_reg" value="<?php echo $DReg_not2; ?>">
							<input type="hidden" id="gpnot3_reg" value="<?php echo $DReg_not3; ?>">
        					<ul class="GP_f-left" style="min-width:462px!important">
                            	<li>
									<input <?php echo $gpnameinput_reg; ?> type="text" value="<?php echo $Reg_fname; ?>" class="GP_input-user" id="gpuserinput_reg" style="min-width:462px!important; background-position:98% 50%!important; background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important;" />
								</li>
                            	<li style="display:<?php echo $DReg_dsurname; ?>">
									<input <?php echo $gpnameinput_sur_reg; ?> type="text" value="<?php echo $DReg_surname; ?>" class="GP_input-user" id="gpuserinput_sur_reg" style="min-width:462px!important; background-position:98% 50%!important; background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important;" />
								</li>
                                <li>
									<input <?php echo $gpemailinput_reg; ?> type="text" value="<?php echo $Reg_femail; ?>" class="GP_input-user" id="gpemailinput_reg" style="min-width:462px!important; background-position:98% 50%!important; background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; margin-bottom:20px!important" />
								</li>
                                <li style="display:<?php echo $DReg_dphone; ?>">
									<input type="text" value="<?php echo $DReg_phone; ?>" class="GP_input-user" id="gpphoneinput_reg" style="min-width:462px!important" />
								</li>
                                <li style="display:<?php echo $DReg_dsubject; ?>">
									<input type="text" value="<?php echo $DReg_subject; ?>" class="GP_input-user" id="gpsubjectinput_reg" style="min-width:462px!important" />
								</li>
                                <li>
									<textarea value="<?php echo $DReg_message; ?>"
									onfocus="(this.value == '<?php echo $DReg_message; ?>') && (this.value = '')"
       								onblur="(this.value == '') && (this.value = '<?php echo $DReg_message; ?>')" 
									style="color:#999; width:462px!important; height:82px!important; padding:10px; 
									resize:none; box-sizing: border-box!important" 
									id="gpmessageinput_reg" /><?php echo $DReg_message; ?></textarea>
								</li>
                                <li>
									<input id="gp_contactcookie" type="image" value="<?php echo $Reg_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DReg_btncolor; ?>" style="float:right; margin-right:0!important; box-shadow:none" />
								</li>
                        	</ul>
						</form>
						
            			<input type="hidden" id="gpkeepuserdetails_reg" value="<?php echo $DAutoins; ?>">
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
            			if ($jj("#gpkeepuserdetails_reg").val()=="on") {
                        	//save user data to cookies
                            $jj("#gpformsubmit_reg").submit(function(){
                            	var gpmydetails = $jj("#gpuserinput_reg").val() + '|' + $jj("#gpemailinput_reg").val();
                                $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            });
            			}
            			</script>
					</div>
                </div>
            </div>
        </div>
        </div>
        </div>

		<div class="Generation_plug" style="text-align:center!important">
			<a style="border:0!important" class="GP_showregister gpregister" href="#GP_registerform">
				<input type="button" value="<?php echo $DReg_openlink; ?>" class="GP_button <?php echo 'GP_'.$DReg_btncolor; ?>" />
				<img src="<?php echo GenerationPlugin_images.'/boxes/regular_shadow.png'; ?>">
			</a>
		</div>
		<?php } ?>
		<?php if ($DReg_theme=='reg3') { ?>
		<!-- skybox -->
		<div class="Generation_plug GP_skydivbox">
            <img style="display:none" class="GP_skydiv_img" src="<?php echo GenerationPlugin_images.'/boxes/sky_d_icon.png'; ?>" />
            <div style="display:none" class="GP_skydiv">
            	<img style="display:none" class="GP_skydiv_close" src="<?php echo GenerationPlugin_images.'/boxes/xsky.png'; ?>" />
            	<a href="<?php echo $Reg_skylink; ?>" target="<?php echo $Reg_skytarget; ?>">
            	<p>
            		<?php echo $Reg_skyheader; ?><br/>
                	<span><?php echo $Reg_skydescription; ?></span>
            	</p>
            	</a>
            </div>
		</div>
		<?php } elseif ($DReg_theme=='reg13') { ?>
		<!-- skybox -->
		<div class="Generation_plug GP_skydivbox">
            <img style="display:none" class="GP_skydiv_img" src="<?php echo GenerationPlugin_images.'/boxes/sky_l_icon.png'; ?>" />
    		<div style="display:none" class="GP_skydiv">
            	<img style="display:none" class="GP_skydiv_close" src="<?php echo GenerationPlugin_images.'/boxes/xsky.png'; ?>" />
            	<h1><?php echo $Reg_skytitle; ?></h1>
            	<a href="<?php echo $Reg_skylink; ?>" target="<?php echo $Reg_skytarget; ?>">
            	<p>
            		<?php echo $Reg_skyheader; ?><br/>
                	<span><?php echo $Reg_skydescription; ?></span>
            	</p>
            	</a>
            </div>
        </div>
		<?php } ?>

<?php 
} //displaying settings
} //STOP IF DAYS OK
} //STOP IF ACTIVATED
} //STOP IF 'SUBSCRIBED' IS NOT ACTIVE


/********** FUNCTION STOP **********/
}



global $wpdb;
$table_name_register = $wpdb->prefix . 'GenerationPlugin_REGISTER';
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }
$DReg_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_register.' WHERE id='.$Duniqueid));
$DReg_theme = preg_replace("/\\\/","",$DReg_theme);

if ($DReg_theme=='reg3' || $DReg_theme=='reg13') {
	add_action('wp_footer','gpregisterreturn_widget');
} else {
	//widget
    wp_register_sidebar_widget(
        'GenerationPluginID2',
        'Generation Plugin - Registration Link',
        'gpregisterreturn_widget',
        array(
            'description' => 'Displays "Generation Plugin" link to popup registration form'
        )
    );
}
?>
