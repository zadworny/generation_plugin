<?php
global $wpdb;
$table_name_header = $wpdb->prefix . 'GenerationPlugin_HEADER';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }

if (is_user_logged_in()) {
	//if user is logged in
	?>
	<style type="text/css">
	.Generation_plug #GP_header-container, .Generation_plug #GP_header_heybar, .Generation_plug #GP_heybar_trigger_open {
		top:28px!important;
	}
	</style>
	<?php
}


if ($_COOKIE["gpds_header"]!="1") { //START IF 'DONT SHOW' IS NOT ACTIVE


$DHeader_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_header.' WHERE id='.$Duniqueid));
$DHeader_display = explode("|", $DHeader_displays);
$DHeader_showsub = $DHeader_display[3];
if ($DHeader_showsub=="on" && $_COOKIE["gpsubscribed_header"]=="subscribed") { /* STOP HERE */ } 
else { //START IF 'SUBSCRIBED' IS NOT ACTIVE

	
$DHeader_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_header.' WHERE id='.$Duniqueid);
if ($DHeader_active_tmp=="on") { //START IF ACTIVATED


$DHeader_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_header.' WHERE id='.$Duniqueid));
$DHeader_display = explode("|", $DHeader_display);
if ($DHeader_display[6]=='' || ($DHeader_display[6]!="" && strtotime($DHeader_display[6]) <= strtotime(date("Y-m-d")))) {
	$DHeader_ddays_1="1";
} else {$DHeader_ddays_1="0";}
if ($DHeader_display[7]=='' || ($DHeader_display[7]!="" && strtotime($DHeader_display[7]) > strtotime(date("Y-m-d")))) {
	$DHeader_ddays_2="1";
} else {$DHeader_ddays_2="0";}
if ($DHeader_ddays_1=="1" && $DHeader_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$dontshowagain = $wpdb->get_var('SELECT Dontshowagain FROM '.$table_name_general.' WHERE id=1');
	$dontshowagain = preg_replace("/\\\/","",$dontshowagain);
	if ($dontshowagain=="") {$dontshowagain = "Don't show again";} //default
$DHeader_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_theme = preg_replace("/\\\/","",$DHeader_theme);
if ($DHeader_theme=="") {$DHeader_theme = "header1";} //default
$DHeader_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_link = preg_replace("/\\\/","",$DHeader_link);
if ($DHeader_link=="") {$DHeader_link = "#";} //default
$DHeader_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_header.' WHERE id='.$Duniqueid));
if ($DHeader_link_blank!="") {$Header_link_blank = 'target="_blank"';} else {$Header_link_blank = 'target="_parent"';}

$DHeader_image = stripslashes($wpdb->get_var('SELECT Image FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_image = preg_replace("/\\\/","",$DHeader_image);
if ($DHeader_image=="") {$DHeader_image = GenerationPlugin_images.'/boxes/book-1.png';} //default
else { $DHeader_image = $DHeader_image;}
$DHeader_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_bgimage = preg_replace("/\\\/","",$DHeader_bgimage);

$DHeader_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_btncolor = preg_replace("/\\\/","",$DHeader_btncolor);
$DHeader_btncolor = explode("|", $DHeader_btncolor);
$DHeader_btncolor = $DHeader_btncolor[3];

if ($DHeader_btncolor=="" || $DHeader_btncolor=="Stripe design") {$DHeader_btncolor = "stripe_red";} //default
if ($DHeader_btncolor=="Simple design") {$DHeader_btncolor = "simple_red";} //default

$DHeader_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_form_tmp = preg_replace("/\\\/","",$DHeader_form);
    $DHeader_formx = explode("|", $DHeader_form_tmp);
	$DHeader_form = $DHeader_formx[0];
	$DHeader_bookmarkclr = $DHeader_formx[11];
	
$DHeader_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_background = preg_replace("/\\\/","",$DHeader_background);
if (($DHeader_form!='custom') && ($DHeader_theme=='header1' || $DHeader_theme=='header2')) {
	$DHeader_bgcolor = '#222';
    if ($DHeader_bgimage!="") {$DHeader_bgimage = $DHeader_bgimage;}
    elseif ($DHeader_background=='bg2') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DHeader_background=='bg3') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DHeader_background=='bg4') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} elseif ($DHeader_form=='custom' && $DHeader_bookmarkclr=='dark') {
	$DHeader_bgcolor = '#222';
    if ($DHeader_background=='bg2') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DHeader_background=='bg3') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DHeader_background=='bg4') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} elseif ($DHeader_form=='custom' && $DHeader_bookmarkclr=='light') {
	$DHeader_bgcolor = '#CCC';
    if ($DHeader_background=='bg12') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DHeader_background=='bg13') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DHeader_background=='bg14') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
} else {
	$DHeader_bgcolor = '#CCC';
    if ($DHeader_bgimage!="") {$DHeader_bgimage = $DHeader_bgimage;}
    elseif ($DHeader_background=='bg12') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DHeader_background=='bg13') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DHeader_background=='bg14') {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DHeader_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
}

$DHeader_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_title_tmp = preg_replace("/\\\/","",$DHeader_title_tmp);
    $DHeader_title = explode("|", $DHeader_title_tmp);
	$DHeader_headclr = $DHeader_title[0];
	if ($DHeader_headclr=="") {$DHeader_headclr="#CC3300";} //default
	$DHeader_headtxt = $DHeader_title[1];
	if ($DHeader_headtxt=="") {$DHeader_headtxt="Header Title Goes Here!";} //default
	if (strpos($DHeader_headtxt,"(")!==false) {
		$DHeader_headtxt=explode("(",$DHeader_headtxt);
		$DHeader_headtxtF=$DHeader_headtxt[0]; //front
		$DHeader_headtxt=explode(")",$DHeader_headtxt[1]);
		$DHeader_headtxtT=$DHeader_headtxt[0]; //time
		$DHeader_headtxtE=$DHeader_headtxt[1]; //end
		$DHeader_countdown="on";
	}
    function gpcountdown_header($atts) {    
    	extract(shortcode_atts(array("time" => "10", "front" => "", "end" => "", "type" => "header"),$atts));
    	return gpcountdownreturn($time,$front,$end,$type);
    }
    add_shortcode("gpcountdown_header", "gpcountdown_header");
$DHeader_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_text = preg_replace("/\\\/","",$DHeader_text);
if ($DHeader_text=="") {$DHeader_text="This is an example of subtitle or description text. Lorem ipsum.";} //default

$DHeader_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_form_tmp = preg_replace("/\\\/","",$DHeader_form);
    $DHeader_formx = explode("|", $DHeader_form_tmp);
	$DHeader_form = $DHeader_formx[0];
	$DHeader_formtype = $DHeader_formx[1];
	$DHeader_clink = $DHeader_formx[2];
	$DHeader_cclick1 = $DHeader_formx[3];
	$DHeader_cblank = $DHeader_formx[4];
	if ($DHeader_cblank=="_blank") {$DHeader_cblank="_blank";} else {$DHeader_cblank="_top";}
	$DHeader_cbgimage = $DHeader_formx[5];
	if ($DHeader_cbgimage!='') {$DHeader_cimage = $DHeader_cbgimage;} else {$DHeader_cimage = $DHeader_cclick1;}
	$DHeader_cclick2 = $DHeader_formx[6];
	$DHeader_cwidth = $DHeader_formx[7];
	if ($DHeader_cwidth=="") {$DHeader_cwidth="760";} //default
	$DHeader_cwidth_i = $DHeader_cwidth - 8;
	$DHeader_cheight = $DHeader_formx[8];
	if ($DHeader_cheight=="") {$DHeader_cheight="360";} //default
	$DHeader_cheight_i = $DHeader_cheight - 8;
	$DHeader_cscroll = $DHeader_formx[9];
	if ($DHeader_cscroll=="scroll") {$DHeader_cscroll="scroll";} else {$DHeader_cscroll="hidden";}
	if ($DHeader_form=="") {$DHeader_form="link";} //default
	$DHeader_cfullw = $DHeader_formx[10];
	$DHeader_bookmarkclr = $DHeader_formx[11];
	
$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
	$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
	$gp_d56 = explode("|", $gp_d56_tmp);
	$gp_d5 = $gp_d56[0];
	$gp_d6 = $gp_d56[1];
	if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
	if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default

if ($DHeader_form=='regular' || $DHeader_form=='') {
	$Dheaderf1_view='style="display:inline"'; $Dheaderf2_view='style="display:none"'; $Dheaderf3_view='style="display:none"'; $DHeader_wider=''; $Dheader_h2header='style="min-width:400px; width:400px"';
}
elseif ($DHeader_form=='social') {
	$Dheaderf1_view='style="display:none"'; $Dheaderf2_view='style="display:inline; margin-right:20px!important"'; $Dheaderf3_view='style="display:none"'; $DHeader_wider='style="width:1125px; min-width:1125px; max-width:1125px"'; $Dheader_h2header='style="min-width:400px; width:400px"';
}
elseif ($DHeader_form=='both') {
	$Dheaderf1_view='style="display:inline"'; $Dheaderf2_view='style="display:none; margin-right:20px!important"'; $Dheaderf3_view='style="display:none"'; $DHeader_wider=''; $Dheader_h2header='style="display:none"';
}
elseif ($DHeader_form=='link') {
	$Dheaderf1_view='style="display:none"'; $Dheaderf2_view='style="display:none"'; $Dheaderf3_view='style="display:inline"'; $DHeader_wider='style="width:1125px; min-width:1125px; max-width:1125px"'; $Dheader_h2header='style="min-width:400px; width:400px"';
}

$DHeader_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_regular_tmp = preg_replace("/\\\/","",$DHeader_regular_tmp);
    $DHeader_regular = explode("|", $DHeader_regular_tmp);
	$Header_fname = $DHeader_regular[0];
	if ($Header_fname=="") {$Header_fname="Insert your name";} //default
	$Header_femail = $DHeader_regular[1];
	if ($Header_femail=="") {$Header_femail="Insert your email";} //default
	$Header_fbtntxt = $DHeader_regular[2];
	if ($Header_fbtntxt=="") {$Header_fbtntxt="Subscribe";} //default
	$Header_fbtnclr = $DHeader_regular[3];
	if ($Header_fbtnclr=="") {$Header_fbtnclr="stripe_red";} //default
	if ($DHeader_regular[4]=="1") {$Header_name_disabled="style='display:none'";}

$DHeader_hey_tmp = stripslashes($wpdb->get_var('SELECT Hey FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_hey_tmp = preg_replace("/\\\/","",$DHeader_hey_tmp);
	$DHeader_hey = explode("|", $DHeader_hey_tmp);
	$Header_heytext = $DHeader_hey[0];
	$Header_heybutton = $DHeader_hey[1];
	$Header_heylink = $DHeader_hey[2];
	$Header_heytarget = $DHeader_hey[3];
	if ($Header_heytarget=="on") {$Header_heytarget="checked";}
	$Header_heycolor = $DHeader_hey[4];
	if ($Header_heytext=="") {$Header_heytext="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed blandit sapien at lorem dolor ipsum cinterestum elit blankis derum";} //default
	if ($Header_heybutton=="") {$Header_heybutton="DOWNLOAD";} //default
	if ($Header_heylink=="") {$Header_heylink="#";} //default
	if ($Header_heytarget=="") {$Header_heytarget="_self";} //default
	if ($Header_heycolor=="") {$Header_heycolor="#EB593C";} //default
	
$DHeader_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_spam = preg_replace("/\\\/","",$DHeader_spam);
if ($DHeader_spam=="") {$DHeader_spam="We will not share your details with anyone, we promise!";} //default
$DHeader_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_header.' WHERE id='.$Duniqueid));
	$DHeader_optin = preg_replace("/<br>/","\n",$DHeader_optin);
	$DHeader_optin = preg_replace("/\\\/","",$DHeader_optin);
	$DHeader_optin = explode("|",$DHeader_optin);
	$DHeader_optinsubmit = $DHeader_optin[8];

$DHeader_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_header.' WHERE id='.$Duniqueid));
    $DHeader_display = explode("|", $DHeader_display);
	$DHeader_dpages = $DHeader_display[0];
	$DHeader_dcats = $DHeader_display[1];
	$DHeader_dposts = $DHeader_display[2];
	$DHeader_showsub = $DHeader_display[3];
	if ($DHeader_showsub=="on") {$DHeader_showsub="checked";}
	$DHeader_ddelay = $DHeader_display[4];
	if ($DHeader_ddelay<0 || $DHeader_ddelay=="0" || $DHeader_ddelay=="") { $DHeader_ddelay="0"; }
	$DHeader_ddays = (strtotime($DHeader_display[5]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	if ($DHeader_ddays<0 || $DHeader_ddays=="0") { $DHeader_ddays="0"; }
?>

<?php
//DISPLAYING

//prepare page list in array
$DHeader_dpages_explode=explode(",",$DHeader_dpages);
foreach ($DHeader_dpages_explode as $DHeader_dpages_explode_element) { $DHeader_dpages_array[]=$DHeader_dpages_explode_element; }
//prepare category list in array
$DHeader_dcats_explode=explode(",",$DHeader_dcats);
foreach ($DHeader_dcats_explode as $DHeader_dcats_explode_element) { $DHeader_dcats_array[]=$DHeader_dcats_explode_element; }
//prepare posts list in array
$DHeader_dposts_explode=explode(",",$DHeader_dposts);
foreach ($DHeader_dposts_explode as $DHeader_dposts_explode_element) { $DHeader_dposts_array[]=$DHeader_dposts_explode_element; }

if (((strpos($DHeader_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DHeader_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DHeader_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DHeader_dpages.',',',author,')!==false) || //author page
	 (is_page($DHeader_dpages_array)))) || //pages and subpages
   ((strpos($DHeader_dcats,'allcats')!==false) &&
	 (is_category($DHeader_dcats_array))) || //category pages
   ((strpos($DHeader_dposts,'allposts')!==false) &&
	 (is_single($DHeader_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>

		<script type="text/javascript">
    	var $jj = jQuery.noConflict();
    	function isValidUserCHECK_header() {
    		var user_header = $jj("#gpuserinput_header").val();
    		var email_header = $jj("#gpemailinput_header").val();
    		if(user_header != 0) {
    			if(isValidUser_header(user_header)) {
    				$jj("#gpuserinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				if(isValidEmailAddress_header(email_header)) {
    					document.getElementById('verified_header').type="submit";
    				}
    			} else {
    				$jj("#gpuserinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_header').type="button";
    			}
    		} else {
    			$jj("#gpuserinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_header').type="button";
    		}
    	}
    	function isValidEmailCHECK_header() {
    		var user_header = $jj("#gpuserinput_header").val();
    		var email_header = $jj("#gpemailinput_header").val();
    		if(email_header != 0) {
    			if(isValidEmailAddress_header(email_header)) {
    				$jj("#gpemailinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				if(isValidUser_header(user_header)) {
    					document.getElementById('verified_header').type="submit";
    				}
    			} else {
    				$jj("#gpemailinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
    				document.getElementById('verified_header').type="button";
    			}
    		} else {
    			$jj("#gpemailinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
    			document.getElementById('verified_header').type="button";
    		}
    	}
    	function isValidUser_header(user_header) {
     		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
     		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
     		return patternone.test(user_header);
    	}
    	function isValidEmailAddress_header(email_header) {
     		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
     		return pattern.test(email_header);
    	}
    	</script>
		<?php
		if ($DLivecheck=='on') {
			?>
			<script type="text/javascript">
         	var $jj = jQuery.noConflict();
    		$jj(document).ready(function(){
         		var user_header = $jj("#gpuserinput_header").val();
         		var email_header = $jj("#gpemailinput_header").val();
        		if(isValidUser_header(user_header) && isValidEmailAddress_header(email_header)) {
    				$jj("#gpuserinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				$jj("#gpemailinput_header").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				document.getElementById('verified_header').type="submit";
    			}
    		});
			</script>
			<?php
        	$gpnameinput_header='onkeyup="isValidUserCHECK_header();" onblur="isValidUserCHECK_header();" onclick="isValidUserCHECK_header();" onfocus="isValidUserCHECK_header();"';
        	$gpemailinput_header='onkeyup="isValidEmailCHECK_header();" onblur="isValidEmailCHECK_header();" onclick="isValidEmailCHECK_header();" onfocus="isValidEmailCHECK_header();"';
        	$gpformbtn_header='button';
        } else {
        	$gpnameinput_header='';
        	$gpemailinput_header='';
        	$gpformbtn_header='submit';
        }
		if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
			$gpmydatapopupcookie = explode("|",$_COOKIE['gpmydetails']);
			$Header_fname = $gpmydatapopupcookie[0];
			$Header_femail = $gpmydatapopupcookie[1];
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
				<?php if ($DHeader_theme!='header3' && $DHeader_theme!='header13') { ?>
            	var $headerheight = null;
                $headerheight = $jj("#GP_header-container").height();
            	$jj("#GP_header_delay").css({ 'position': 'fixed', 'z-index': '99999' }).fadeIn(800);
            	$jj("body").delay(800).animate({"marginTop": $headerheight+4}, 500);
            
            	$jj("#GP_header-container .GP_close").click(function(){
            		$jj("body").animate({"marginTop": 0}, 500);
            		$jj(this).parents("#GP_header-container").delay(800).animate({ opacity: 'hide' }, 800);
            	});
				<?php } elseif ($DHeader_theme=='header3' || $DHeader_theme=='header13') { ?>
            	var $headerheight_hey = null;
                $headerheight_hey = $jj("#GP_header_heybar").height();
				$jj("#GP_header_heybar").css({'display': 'block'}).animate({"marginTop": 0}, 250);
            	$jj("body").animate({"marginTop": $headerheight_hey+3}, 250);
            
            	$jj("#GP_heybar_trigger_close").click(function(){
            		$jj("body").animate({"marginTop": 0}, 250);
            		$jj(this).parents("#GP_header_heybar").animate({"marginTop": -40 /*-36*/}, 250);
            		$jj(".GP_heybar_trigger").css({'marginTop': -36, 'display': 'block'}).delay(250).animate({"marginTop": 0}, 250);
            	});
            	$jj("#GP_heybar_trigger_open").click(function(){
            		$jj(".GP_heybar_trigger").animate({"marginTop": -36}, 250);
					$jj("#GP_header_heybar").delay(250).animate({"marginTop": 0}, 250);
            		$jj("body").delay(250).animate({"marginTop": $headerheight_hey+3}, 250);
            	});
				<?php } ?>
			},<?php echo $DHeader_ddelay;?>*1000);
        });
		//Don't show again checkbox
		$jj(document).ready(function(){ 
        	$jj("#gpds_header").change(function() {
        		if($jj(this).is(":checked")) { $jj.cookie("gpds_header", "1", {expires: 7, path: '/'}); }
				else { $jj.cookie("gpds_header", "0", {expires: 7, path: '/'}); }
        	});
        });
		//Form switch
		$jj(document).ready( function(){ 
        	$jj(".GP_s_en_header").click(function(){
        		var parent = $jj(this).parents('.GP_s_header');
        		$jj('.GP_s_di_header',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Header_s_show2').fadeOut(500);
        		$jj('#Header_s_show1').delay(505).fadeIn(500);
        	});
        	$jj(".GP_s_di_header").click(function(){
        		var parent = $jj(this).parents('.GP_s_header');
        		$jj('.GP_s_en_header',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Header_s_show1').fadeOut(500);
        		$jj('#Header_s_show2').delay(505).fadeIn(500);
        	});
			var switchwidth1 = $jj('.GP_s_en_header').width();
			var switchwidth2 = $jj('.GP_s_di_header').width();
			var switchwidth = switchwidth1+switchwidth2;
			$jj('.GP_s_header').css({'width': ''+switchwidth+''});
        });
        </script>
		<div style="position:fixed; top:-9999; visibility:hidden" class="GP_s_header">
            <label class="GP_s_en_header"><span><?php echo $gp_d5; ?></span></label>
            <label class="GP_s_di_header"><span><?php echo $gp_d6; ?></span></label>
        </div>
		
		<style>
		.Generation_plug.GP_header h2 strong span {
		  color:<?php echo $DHeader_headclr; ?>;
		}
        input[id=gpds_header] {
          display:none;
        }
        input[id=gpds_header] + label {
          background: url('<?php echo GenerationPlugin_images."/boxes/unchecked.png"; ?>');
          height: 16px;
          width: 16px;
          display:inline-block;
          padding: 0;
		  margin-bottom: -5px;
        }
        input[id=gpds_header]:checked + label {
          background: url('<?php echo GenerationPlugin_images."/boxes/checked.png"; ?>');
          height: 16px;
          width: 16px;
          display:inline-block;
          padding: 0;
		  margin-bottom: -5px;
        }
        </style>


		<?php
		if ($DHeader_theme=='header11' || $DHeader_theme=='header12' || $DHeader_theme=='header13') {
			wp_enqueue_style('style user_light-3', GenerationPlugin_style.'/style-light-3.css');
		}
		?>
		
		<?php if ($DHeader_form=='custom') {
			  if ($DHeader_cfullw=="fullw") {$DHeader_cwidth = '100%';} 
			  else {$DHeader_cwidth = $DHeader_cwidth.'px';} ?>
		<div class="Generation_plug GP_header" id="GP_header_delay" style="display:none">
        	<div id="GP_header-container" style="background: <?php echo $DHeader_bgcolor; ?> url('<?php echo $DHeader_bgimage; ?>') repeat center center; width:100%!important; 
				height:<?php echo $DHeader_cheight; ?>px!important"
			>
			<?php if ($DHeader_formtype=='link' || $DHeader_formtype=='') { ?>
                <div class="GP_header" style="overflow:hidden; margin:0 auto!important; margin-top:0!important; 
					margin-bottom:0!important;
					padding:0!important; padding-top:0!important; padding-right:0!important; 
					padding-bottom:0!important; padding-left:0!important; 
					height:<?php echo $DHeader_cheight; ?>px!important;
					width:<?php echo $DHeader_cwidth; ?>!important"
				>
					<iframe class="GP_pmzero" src="<?php echo $DHeader_clink; ?>" width="100%" style="height:100%; width:100%; overflow-x:hidden; overflow-y:hidden" ></iframe>
				</div>
            <?php } elseif ($DHeader_formtype=='image') { ?>
				<div class="GP_header" style="overflow:hidden; margin:0 auto!important; margin-top:0!important; 
					margin-bottom:0!important;
					padding:0!important; padding-top:0!important; padding-right:0!important; 
					padding-bottom:0!important; padding-left:0!important; 
					height:<?php echo $DHeader_cheight; ?>px!important;
					width:<?php echo $DHeader_cwidth; ?>!important"
				>
					<a href="<?php echo $DHeader_cclick2; ?>" target="<?php echo $DHeader_cblank; ?>">
						<img style="overflow:hidden"; src="<?php echo $DHeader_cimage; ?>">
					</a>
				</div>
            <?php } ?>
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:-16px 45px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_header" type="checkbox" name="gpds_header"><label for="gpds_header"></label>
			</div>
            <a href="#" title="Close" class="GP_icon GP_close GP_right-bottom">Close</a>
        	</div>
		</div>
		<?php } ?>
		<?php if (($DHeader_theme=='header1' || $DHeader_theme=='header11') && $DHeader_form!='custom') { ?>
		<div class="Generation_plug GP_header" id="GP_header_delay" style="display:none">
        	<div id="GP_header-container" style="background: <?php echo $DHeader_bgcolor; ?> url('<?php echo $DHeader_bgimage; ?>') repeat center center;">
            <div id="GP_header">
				<img src="<?php echo $DHeader_image; ?>" alt="" class="GP_book" />
                <div class="GP_col-left">
                    <div class="GP_o-hidden">
						
    					<?php if ($DHeader_form=='both') { 
							$DHeader_switchmargin = '&nbsp;&nbsp;&nbsp;'; 
							$Dheaderf2_view = 'style="display:none!important; margin-right:20px!important"';
							$Dheaderh2_switchdisplay = 'style="display:none!important"'; ?>
    						<div style="display:inline" id="GP_s_header" class="GP_f_header GP_s_header">
                            	<input style="display:none" type="radio" id="GP_s_r1_header" name="GP_f_header" checked />
                            	<input style="display:none" type="radio" id="GP_s_r2_header" name="GP_f_header" />
                       			<br/>
                            	<label for="GP_s_r1_header" class="GP_s_en_header selected"><span><?php echo $gp_d5; ?></span></label>
                            	<label for="GP_s_r2_header" class="GP_s_di_header"><span><?php echo $gp_d6; ?></span></label>
                            </div>
    					<?php } else {$Dheaderh2_switchdisplay = 'style="display:inline!important"';} ?>
						
                        <h2 <?php echo $Dheaderh2_switchdisplay; ?>><strong style="color:<?php echo $DHeader_headclr; ?>"><?php if ($DHeader_countdown=="on") {do_shortcode("[gpcountdown_header time=".$DHeader_headtxtT." front='".$DHeader_headtxtF."' end='".$DHeader_headtxtE."']");} else {echo $DHeader_headtxt;} ?></strong></h2>
                        <p class="GP_desc"><?php echo $DHeader_switchmargin; ?>&nbsp;<?php echo $DHeader_text; ?></p>
                    </div>
                    <div class="GP_form-login-inline">
						<div id="Header_s_show1" <?php echo $Dheaderf1_view; ?>>
                        <form id="gpformsubmit_header" action="<?php echo $DHeader_optin[4]; ?>" method="post">
                            <ul class="GP_f-left">
    							<li style="display:none"><?php echo $DHeader_optin[5]; ?></li>
                                <li <?php echo $Header_name_disabled; ?>><input id="gpuserinput_header" <?php echo $gpnameinput_header; ?> name="<?php echo $DHeader_optin[1]; ?>" type="text" value="<?php echo $Header_fname; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                <li><input id="gpemailinput_header" <?php echo $gpemailinput_header; ?> name="<?php echo $DHeader_optin[2]; ?>" type="text" value="<?php echo $Header_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
    							<li><?php echo $DHeader_optin[7]; ?></li>
                                <li><input id="verified_header" name="<?php echo $DHeader_optinsubmit; ?>" type="<?php echo $gpformbtn_header; ?>" value="<?php echo $Header_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DHeader_btncolor; ?>" /></li>
                            </ul>
                        </form>
    					<input type="hidden" id="gpkeepuserdetails_header" value="<?php echo $DAutoins; ?>">
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
    					if ($jj("#gpkeepuserdetails_header").val()=="on") {
                            //save user data to cookies
                            $jj("#gpformsubmit_header").submit(function(){
                                var gpmydetails = $jj("#gpuserinput_header").val() + '|' + $jj("#gpemailinput_header").val();
                                $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            });
    					}
                        //save user data to cookies
                        $jj("#verified_header").click(function(){
                            $jj.cookie("gpsubscribed_header", "subscribed", {expires: 7, path: '/'});
                        });
    					</script>
						</div>
    					<div id="Header_s_show2" class="GP_f-left-fb" <?php echo $Dheaderf2_view; ?>>
    						<a id="verifiedfb_header" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        		<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        	</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedfb_header").click(function(){
                                $jj.cookie("gpsubscribed_header", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
    					</div>
  						<div class="GP_linkv" <?php echo $Dheaderf3_view; ?>>
            				<a id="verifiedlink_header" href="<?php echo $DHeader_link; ?>" <?php echo $Header_link_blank; ?>>
            					<li style="display:inline"><input type="button" value="<?php echo $Header_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DHeader_btncolor; ?>" /></li>
            					<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
            				</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedlink_header").click(function(){
                                $jj.cookie("gpsubscribed_header", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
          				</div>
                        <p style="display:inline" class="GP_icon GP_padlock"><?php echo $DHeader_spam; ?></p>
                    </div>
                </div>
            </div>
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:-16px 45px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px"><?php echo $dontshowagain; ?></p> <input id="gpds_header" type="checkbox" name="gpds_header"><label for="gpds_header"></label>
			</div>
            <a href="#" title="Close" class="GP_icon GP_close GP_right-bottom">Close</a>
        	</div>
		</div>
		<?php } ?>
		<?php if (($DHeader_theme=='header2' || $DHeader_theme=='header12') && $DHeader_form!='custom') { ?>
		<div class="Generation_plug GP_header" id="GP_header_delay" style="display:none">
        	<div id="GP_header-container" class="GP_header-mini" style="background: <?php echo $DHeader_bgcolor; ?> url('<?php echo $DHeader_bgimage; ?>') repeat center center;">
            <div id="GP_header" <?php echo $DHeader_wider; ?>>
                <div class="GP_col-left">
                    <div class="GP_o-hidden GP_f-left">

						<?php if ($DHeader_form=='both') { ?>
    						<div style="margin:0 -20px 35px auto!important" id="GP_s_header" class="GP_f_header GP_s_header">
                            	<input style="display:none" type="radio" id="GP_s_r1_header" name="GP_f_header" checked />
                            	<input style="display:none" type="radio" id="GP_s_r2_header" name="GP_f_header" />
                       			<br/>
                            	<label for="GP_s_r1_header" class="GP_s_en_header selected"><span><?php echo $gp_d5; ?></span></label>
                            	<label for="GP_s_r2_header" class="GP_s_di_header"><span><?php echo $gp_d6; ?></span></label>
                            </div>
    					<?php } ?>
						
						<h2 <?php echo $Dheader_h2header; ?>><strong style="color:<?php echo $DHeader_headclr; ?>"><?php if ($DHeader_countdown=="on") {do_shortcode("[gpcountdown_header time=".$DHeader_headtxtT." front='".$DHeader_headtxtF."' end='".$DHeader_headtxtE."']");} else {echo $DHeader_headtxt;} ?></strong></h2>
						
                        <p class="GP_desc" style="float:right!important">&nbsp;<?php echo $DHeader_text; ?></p>
                    </div>
                    <div class="GP_form-login-inline">
						<div id="Header_s_show1" <?php echo $Dheaderf1_view; ?>>
                        <form id="gpformsubmit_header" action="<?php echo $DHeader_optin[4]; ?>" method="post">
                            <ul class="GP_f-left">
    							<li style="display:none"><?php echo $DHeader_optin[5]; ?></li>
                                <li style="display:none"><input id="gpuserinput_header" <?php echo $gpnameinput_header; ?> name="<?php echo $DHeader_optin[1]; ?>" type="text" value="<?php echo 'Subscriber'; /*$Header_fname;*/ ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/user.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
                                <li><input id="gpemailinput_header" <?php echo $gpemailinput_header; ?> name="<?php echo $DHeader_optin[2]; ?>" type="text" value="<?php echo $Header_femail; ?>" class="GP_input-user" style="background-image:url('<?php echo GenerationPlugin_images.'/email.png'; ?>')!important; width:211px!important; min-width:211px!important; max-width:211px!important" /></li>
    							<li><?php echo $DHeader_optin[7]; ?></li>
                                <li><input id="verified_header" name="<?php echo $DHeader_optinsubmit; ?>" type="<?php echo $gpformbtn_header; ?>" value="<?php echo $Header_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DHeader_btncolor; ?>" /></li>
                            </ul>
                        </form>
    					<input type="hidden" id="gpkeepuserdetails_header" value="<?php echo $DAutoins; ?>">
    					<script type="text/javascript">
                        var $jj = jQuery.noConflict();
    					if ($jj("#gpkeepuserdetails_header").val()=="on") {
                            //save user data to cookies
                            $jj("#gpformsubmit_header").submit(function(){
                                var gpmydetails = $jj("#gpuserinput_header").val() + '|' + $jj("#gpemailinput_header").val();
                                $jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});
                            });
    					}
                        //save user data to cookies
                        $jj("#verified_header").click(function(){
                            $jj.cookie("gpsubscribed_header", "subscribed", {expires: 7, path: '/'});
                        });
    					</script>
						</div>
    					<div id="Header_s_show2" class="GP_f-left-fb" <?php echo $Dheaderf2_view; ?>>
							<a id="verifiedfb_header" href="<?php echo GenerationPlugin_path.'facebook.php'; ?>" target="_blank">
                        		<img style="margin:0 auto" src="<?php echo GenerationPlugin_images; ?>/btn/facebook.gif">
                        	</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedfb_header").click(function(){
                                $jj.cookie("gpsubscribed_header", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
    					</div>
  						<div class="GP_linkv" <?php echo $Dheaderf3_view; ?>>
            				<a id="verifiedlink_header" href="<?php echo $DHeader_link; ?>" <?php echo $Header_link_blank; ?>>
            					<li style="display:inline"><input type="button" value="<?php echo $Header_fbtntxt; ?>" class="GP_button <?php echo 'GP_'.$DHeader_btncolor; ?>" /></li>
            					<img style="display:inline" src="<?php echo GenerationPlugin_images.'/btn/animarrows.gif'; ?>">
            				</a>
        					<script type="text/javascript">
                            var $jj = jQuery.noConflict();
                            //save user data to cookies
                            $jj("#verifiedlink_header").click(function(){
                                $jj.cookie("gpsubscribed_header", "subscribed", {expires: 7, path: '/'});
                            });
                          	</script>
          				</div>
                        <p style="display:inline" class="GP_icon GP_padlock"><?php echo $DHeader_spam; ?></p>
                    </div>
                </div>
            </div>
			<!-- Don't show again checkbox -->
			<div style="position:absolute; z-index:99998; right:0; margin:-19px 45px 0 0; color:#393; font-size:9px;">
				<p style="display:inline; font-size:9px; margin-top:-2px"><?php echo $dontshowagain; ?></p> <input id="gpds_header" type="checkbox" name="gpds_header"><label for="gpds_header"></label>
			</div>
            <a href="#" title="Close" class="GP_icon GP_close GP_right-bottom">Close</a>
        	</div>
		</div>
		<?php } ?>
		<?php if ($DHeader_theme=='header3' || $DHeader_theme=='header13') { ?>
		<div class="Generation_plug">
    		<div style="background-color:<?php echo $Header_heycolor; ?>" class="GP_heybar_trigger" id="GP_heybar_trigger_open">
            	<img src="<?php echo GenerationPlugin_images.'/boxes/bararrow2.png'; ?>">
            </div>
            <div style="background-color:<?php echo $Header_heycolor; ?>" class="GP_heybar" id="GP_header_heybar">
            	<img src="<?php echo GenerationPlugin_images.'/boxes/bararrow.png'; ?>" id="GP_heybar_trigger_close">
            	<p style="padding-left:58px">
            		<?php echo $Header_heytext; ?>
            		<a href="<?php echo $Header_heylink; ?>" target="<?php echo $Header_heytarget; ?>">
						<?php echo $Header_heybutton; ?>
					</a>
            	</p>
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
