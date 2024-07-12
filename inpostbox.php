<?php
/********** FUNCTION START **********/
function gpinpostreturn() {



global $wpdb;
$table_name_insider = $wpdb->prefix . 'GenerationPlugin_INSIDER';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }


$DInside_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
$DInside_display = explode("|", $DInside_displays);
$DInside_showsub = $DInside_display[3];
if ($DInside_showsub=="on" && $_COOKIE["gpsubscribed_inside"]=="subscribed") { /* STOP HERE */ } 
else { //START IF 'SUBSCRIBED' IS NOT ACTIVE


$DInside_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_insider.' WHERE id='.$Duniqueid);
if ($DInside_active_tmp=="on") { //START IF ACTIVATED


$DInside_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
$DInside_display = explode("|", $DInside_display);
if ($DInside_display[6]=='' || ($DInside_display[6]!="" && strtotime($DInside_display[6]) <= strtotime(date("Y-m-d")))) {
	$DInside_ddays_1="1";
} else {$DInside_ddays_1="0";}
if ($DInside_display[7]=='' || ($DInside_display[7]!="" && strtotime($DInside_display[7]) > strtotime(date("Y-m-d")))) {
	$DInside_ddays_2="1";
} else {$DInside_ddays_2="0";}
if ($DInside_ddays_1=="1" && $DInside_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$DInside_theme = stripslashes($wpdb->get_var('SELECT Theme FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_theme = preg_replace("/\\\/","",$DInside_theme);
if ($DInside_theme=="") {$DInside_theme = "inside1";} //default
$DInside_link = stripslashes($wpdb->get_var('SELECT Link FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_link = preg_replace("/\\\/","",$DInside_link);
if ($DInside_link=="") {$DInside_link = "#";} //default
$DInside_link_blank = stripslashes($wpdb->get_var('SELECT Link_blank FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
if ($DInside_link_blank!="") {$Inside_link_blank = 'target="_blank"';} else {$Inside_link_blank = 'target="_parent"';}

$DInside_bgimage = stripslashes($wpdb->get_var('SELECT Bgimage FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_bgimage = preg_replace("/\\\/","",$DInside_bgimage);

$DInside_btncolor = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_btncolor = preg_replace("/\\\/","",$DInside_btncolor);
$DInside_btncolor = explode("|", $DInside_btncolor);
$DInside_btncolor = $DInside_btncolor[3];

if ($DInside_btncolor=="" || $DInside_btncolor=="Stripe design") {$DInside_btncolor = "stripe_red";} //default
if ($DInside_btncolor=="Simple design") {$DInside_btncolor = "simple_red";} //default

$DInside_background = stripslashes($wpdb->get_var('SELECT Background FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_background = preg_replace("/\\\/","",$DInside_background);
if ($DInside_theme=='inside1' || $DInside_theme=='inside2') {
	$DInside_bgcolor = '#222';
    if ($DInside_bgimage!="") {$DInside_bgimage = $DInside_bgimage;}
    elseif ($DInside_background=='bg2') {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
    elseif ($DInside_background=='bg3') {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/d_carbonfiber.jpg';}
    elseif ($DInside_background=='bg4') {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/d_wood.jpg';}
    else {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/d_noise.jpg';}
} else {
	$DInside_bgcolor = '#CCC';
    if ($DInside_bgimage!="") {$DInside_bgimage = $DInside_bgimage;}
    elseif ($DInside_background=='bg12') {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
    elseif ($DInside_background=='bg13') {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/l_sparkles.jpg';}
    elseif ($DInside_background=='bg14') {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/l_blur.jpg';}
    else {$DInside_bgimage = GenerationPlugin_images.'/backgrounds/l_noise.jpg';}
}

$DInside_title_tmp = stripslashes($wpdb->get_var('SELECT Title FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_title_tmp = preg_replace("/\\\/","",$DInside_title_tmp);
    $DInside_title = explode("|", $DInside_title_tmp);
	$DInside_headclr = $DInside_title[0];
	if ($DInside_headclr=="") {$DInside_headclr="#CC3300";} //default
	$DInside_headtxt = $DInside_title[1];
	if ($DInside_headtxt=="") {$DInside_headtxt="Header Title Goes Here! Lorem Ipsum.";} //default
	if (strpos($DInside_headtxt,"(")!==false) {
		$DInside_headtxt=explode("(",$DInside_headtxt);
		$DInside_headtxtF=$DInside_headtxt[0]; //front
		$DInside_headtxt=explode(")",$DInside_headtxt[1]);
		$DInside_headtxtT=$DInside_headtxt[0]; //time
		$DInside_headtxtE=$DInside_headtxt[1]; //end
		$DInside_countdown="on";
	}
    function gpcountdown_inside($atts) {
    	extract(shortcode_atts(array("time" => "10", "front" => "", "end" => "", "type" => "inside"),$atts));
    	return gpcountdownreturn($time,$front,$end,$type);
    }
    add_shortcode("gpcountdown_inside", "gpcountdown_inside");

$DInside_form = stripslashes($wpdb->get_var('SELECT Form FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_form_tmp = preg_replace("/\\\/","",$DInside_form);
    $DInside_formx = explode("|", $DInside_form_tmp);
	$DInside_form = $DInside_formx[0];
	$DInside_formtype = $DInside_formx[1];
	$DInside_clink = $DInside_formx[2];
	$DInside_cclick1 = $DInside_formx[3];
	$DInside_cblank = $DInside_formx[4];
	if ($DInside_cblank=="_blank") {$DInside_cblank="_blank";} else {$DInside_cblank="_top";}
	$DInside_cbgimage = $DInside_formx[5];
	if ($DInside_cbgimage!='') {$DInside_cimage = $DInside_cbgimage;} else {$DInside_cimage = $DInside_cclick1;}
	$DInside_cclick2 = $DInside_formx[6];
	$DInside_cwidth = $DInside_formx[7];
	if ($DInside_cwidth=="") {$DInside_cwidth="760";} //default
	$DInside_cwidth_i = $DInside_cwidth - 8;
	$DInside_cheight = $DInside_formx[8];
	if ($DInside_cheight=="") {$DInside_cheight="360";} //default
	$DInside_cheight_i = $DInside_cheight - 8;
	$DInside_cscroll = $DInside_formx[9];
	if ($DInside_cscroll=="scroll") {$DInside_cscroll="scroll";} else {$DInside_cscroll="hidden";}
	if ($DInside_form=="") {$DInside_form="link";} //default
	
$gp_d56 = $wpdb->get_var('SELECT Switch FROM '.$table_name_general.' WHERE id=1');
	$gp_d56_tmp = preg_replace("/\\\/","",$gp_d56);
	$gp_d56 = explode("|", $gp_d56_tmp);
	$gp_d5 = $gp_d56[0];
	$gp_d6 = $gp_d56[1];
	if ($gp_d56[0]=="") {$gp_d5 = "Regular";} //default
	if ($gp_d56[1]=="") {$gp_d6 = "Facebook";} //default

if ($DInside_form=='regular' || $DInside_form=='') {
	$DInsidef1_view='style="display:block"'; $DInsidef2_view='style="display:none"'; $DInsidef3_view='style="display:none"'; $DInside_wider='';
}
elseif ($DInside_form=='social') {
	$DInsidef1_view='style="display:none"'; $DInsidef2_view='style="display:block"'; $DInsidef3_view='style="display:none"'; $DInside_wider='style="width:1125px; min-width:1125px; max-width:1125px"';
}
elseif ($DInside_form=='both') {
	$DInsidef1_view='style="display:block"'; $DInsidef2_view='style="display:none"'; $DInsidef3_view='style="display:none"'; $DInside_wider='';
}
elseif ($DInside_form=='link') {
	$DInsidef1_view='style="display:none"'; $DInsidef2_view='style="display:none"'; $DInsidef3_view='style="display:block"'; $DInside_wider='style="width:1125px; min-width:1125px; max-width:1125px"';
}

$DInside_regular_tmp = stripslashes($wpdb->get_var('SELECT Regular FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_regular_tmp = preg_replace("/\\\/","",$DInside_regular_tmp);
    $DInside_regular = explode("|", $DInside_regular_tmp);
	$Inside_fname = $DInside_regular[0];
	if ($Inside_fname=="") {$Inside_fname="Insert your name";} //default
	$Inside_femail = $DInside_regular[1];
	if ($Inside_femail=="") {$Inside_femail="Insert your email";} //default
	$Inside_fbtntxt = $DInside_regular[2];
	if ($Inside_fbtntxt=="") {$Inside_fbtntxt="Subscribe";} //default
	$Inside_fbtnclr = $DInside_regular[3];
	if ($Inside_fbtnclr=="") {$Inside_fbtnclr="stripe_red";} //default
	if ($DInside_regular[4]=="1") {$Inside_name_disabled="style='display:none'"; $Inside_name_padding="style='padding-left:90px!important'";}
	
$DInside_spam = stripslashes($wpdb->get_var('SELECT Spam FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_spam = preg_replace("/\\\/","",$DInside_spam);
if ($DInside_spam=="") {$DInside_spam="We will not share your personal details with any third parties, we promise!";} //default
$DInside_optin = stripslashes($wpdb->get_var('SELECT Optincode FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
	$DInside_optin = preg_replace("/<br>/","\n",$DInside_optin);
	$DInside_optin = preg_replace("/\\\/","",$DInside_optin);
	$DInside_optin = explode("|",$DInside_optin);
	$DInside_optinsubmit = $DInside_optin[8];

$DInside_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_insider.' WHERE id='.$Duniqueid));
    $DInside_display = explode("|", $DInside_display);
	$DInside_dpages = $DInside_display[0];
	$DInside_dcats = $DInside_display[1];
	$DInside_dposts = $DInside_display[2];
	$DInside_showsub = $DInside_display[3];
	if ($DInside_showsub=="on") {$DInside_showsub="checked";}
	$DInside_ddelay = $DInside_display[4];
	if ($DInside_ddelay<0 || $DInside_ddelay=="0" || $DInside_ddelay=="") { $DInside_ddelay="0"; }
	$DInside_ddays = (strtotime($DInside_display[5]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	if ($DInside_ddays<0 || $DInside_ddays=="0") { $DInside_ddays="0"; }
?>

<?php
//DISPLAYING

//prepare page list in array
$DInside_dpages_explode=explode(",",$DInside_dpages);
foreach ($DInside_dpages_explode as $DInside_dpages_explode_element) { $DInside_dpages_array[]=$DInside_dpages_explode_element; }
//prepare category list in array
$DInside_dcats_explode=explode(",",$DInside_dcats);
foreach ($DInside_dcats_explode as $DInside_dcats_explode_element) { $DInside_dcats_array[]=$DInside_dcats_explode_element; }
//prepare posts list in array
$DInside_dposts_explode=explode(",",$DInside_dposts);
foreach ($DInside_dposts_explode as $DInside_dposts_explode_element) { $DInside_dposts_array[]=$DInside_dposts_explode_element; }

if (((strpos($DInside_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DInside_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DInside_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DInside_dpages.',',',author,')!==false) || //author page
	 (is_page($DInside_dpages_array)))) || //pages and subpages
   ((strpos($DInside_dcats,'allcats')!==false) &&
	 (is_category($DInside_dcats_array))) || //category pages
   ((strpos($DInside_dposts,'allposts')!==false) &&
	 (is_single($DInside_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>

		<script type="text/javascript">
     	var $jj = jQuery.noConflict();
     	function isValidUserCHECK_inside() {
     		var user_inside = $jj("#gpuserinput_inside").val();
     		var email_inside = $jj("#gpemailinput_inside").val();
     		if(user_inside != 0) {
     			if(isValidUser_inside(user_inside)) {
     				$jj("#gpuserinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
     				if(isValidEmailAddress_inside(email_inside)) {
     					document.getElementById('verified_inside').type="submit";
     				}
     			} else {
     				$jj("#gpuserinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroruser.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('verified_inside').type="button";
     			}
     		} else {
     			$jj("#gpuserinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/user.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('verified_inside').type="button";
     		}
     	}
     	function isValidEmailCHECK_inside() {
     		var user_inside = $jj("#gpuserinput_inside").val();
     		var email_inside = $jj("#gpemailinput_inside").val();
     		if(email_inside != 0) {
     			if(isValidEmailAddress_inside(email_inside)) {
     				$jj("#gpemailinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
     				if(isValidUser_inside(user_inside)) {
     					document.getElementById('verified_inside').type="submit";
     				}
     			} else {
     				$jj("#gpemailinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/erroremail.png'; ?>')", "background-color": "#FDD" });
     				document.getElementById('verified_inside').type="button";
     			}
     		} else {
     			$jj("#gpemailinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/email.png'; ?>')", "background-color": "#FFF" });
     			document.getElementById('verified_inside').type="button";
     		}
     	}
     	function isValidUser_inside(user_inside) {
      		//var patternone = new RegExp(/^\w{2,20}$/i); //one word letters, numbers and underscore only
      		var patternone = new RegExp(/^[A-Z]{2,20}$/i); //one word letters and underscore only
      		return patternone.test(user_inside);
     	}
     	function isValidEmailAddress_inside(email_inside) {
      		var pattern = new RegExp(/^([A-Z0-9._%+-]+@[A-Z0-9.-]+\.(?:AC|AD|AE|AERO|AF|AG|AI|AL|AM|AN|AO|AQ|AR|ARPA|AS|ASIA|AT|AU|AW|AX|AZ|BA|BB|BD|BE|BF|BG|BH|BI|BIZ|BJ|BM|BN|BO|BR|BS|BT|BV|BW|BY|BZ|CA|CAT|CC|CD|CF|CG|CH|CI|CK|CL|CM|CN|CO|COM|COOP|CR|CU|CV|CW|CX|CY|CZ|DE|DJ|DK|DM|DO|DZ|EC|EDU|EE|EG|ER|ES|ET|EU|FI|FJ|FK|FM|FO|FR|GA|GB|GD|GE|GF|GG|GH|GI|GL|GM|GN|GOV|GP|GQ|GR|GS|GT|GU|GW|GY|HK|HM|HN|HR|HT|HU|ID|IE|IL|IM|IN|INFO|INT|IO|IQ|IR|IS|IT|JE|JM|JO|JOBS|JP|KE|KG|KH|KI|KM|KN|KP|KR|KW|KY|KZ|LA|LB|LC|LI|LK|LR|LS|LT|LU|LV|LY|MA|MC|MD|ME|MG|MH|MIL|MK|ML|MM|MN|MO|MOBI|MP|MQ|MR|MS|MT|MU|MUSEUM|MV|MW|MX|MY|MZ|NA|NAME|NC|NE|NET|NF|NG|NI|NL|NO|NP|NR|NU|NZ|OM|ORG|PA|PE|PF|PG|PH|PK|PL|PM|PN|PR|PRO|PS|PT|PW|PY|QA|RE|RO|RS|RU|RW|SA|SB|SC|SD|SE|SG|SH|SI|SJ|SK|SL|SM|SN|SO|SR|ST|SU|SV|SX|SY|SZ|TC|TD|TEL|TF|TG|TH|TJ|TK|TL|TM|TN|TO|TP|TR|TRAVEL|TT|TV|TW|TZ|UA|UG|UK|US|UY|UZ|VA|VC|VE|VG|VI|VN|VU|WF|WS|XN--0ZWM56D|XN--11B5BS3A9AJ6G|XN--3E0B707E|XN--45BRJ9C|XN--80AKHBYKNJ4F|XN--80AO21A|XN--90A3AC|XN--9T4B11YI5A|XN--CLCHC0EA0B2G2A9GCD|XN--DEBA0AD|XN--FIQS8S|XN--FIQZ9S|XN--FPCRJ9C3D|XN--FZC2C9E2C|XN--G6W251D|XN--GECRJ9C|XN--H2BRJ9C|XN--HGBK6AJ7F53BBA|XN--HLCJ6AYA9ESC7A|XN--J6W193G|XN--JXALPDLP|XN--KGBECHTV|XN--KPRW13D|XN--KPRY57D|XN--LGBBAT1AD8J|XN--MGBAAM7A8H|XN--MGBAYH7GPA|XN--MGBBH1A71E|XN--MGBC0A9AZCG|XN--MGBERP4A5D4AR|XN--O3CW4H|XN--OGBPF8FL|XN--P1AI|XN--PGBS0DH|XN--S9BRJ9C|XN--WGBH1C|XN--WGBL6A|XN--XKC2AL3HYE2A|XN--XKC2DL3A5EE0H|XN--YFRO4I67O|XN--YGBI2AMMX|XN--ZCKZAH|XXX|YE|YT|ZA|ZM|ZW)$)/i);
      		return pattern.test(email_inside);
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
         		var user_inside = $jj("#gpuserinput_inside").val();
         		var email_inside = $jj("#gpemailinput_inside").val();
        		if(isValidUser_inside(user_inside) && isValidEmailAddress_inside(email_inside)) {
    				$jj("#gpuserinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validuser.png'; ?>')", "background-color": "#DFD" });
    				$jj("#gpemailinput_inside").css({ "background-image": "url('<?php echo GenerationPlugin_images.'/validemail.png'; ?>')", "background-color": "#DFD" });
    				document.getElementById('verified_inside').type="submit";
    			}
    		});
			</script>
			<?php
        	$gpnameinput_inside='onkeyup="isValidUserCHECK_inside();" onblur="isValidUserCHECK_inside();" onclick="isValidUserCHECK_inside();" onfocus="isValidUserCHECK_inside();"';
        	$gpemailinput_inside='onkeyup="isValidEmailCHECK_inside();" onblur="isValidEmailCHECK_inside();" onclick="isValidEmailCHECK_inside();" onfocus="isValidEmailCHECK_inside();"';
        	$gpformbtn_inside='button';
        } else {
        	$gpnameinput_inside='';
        	$gpemailinput_inside='';
        	$gpformbtn_inside='submit';
        }
		if ($DAutoins=='on' && isset($_COOKIE['gpmydetails'])) {
			$gpmydatapopupcookie = explode("|",$_COOKIE['gpmydetails']);
			$Inside_fname = $gpmydatapopupcookie[0];
			$Inside_femail = $gpmydatapopupcookie[1];
		}
		?>
		
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
    	$jj(document).ready(function() {
			//default values in form
			$jj('input[type=text]').each(function(){ $jj(this).data('default', this.value); });
			$jj('input[type=text]').focusin(function(){ if (this.value==$jj(this).data('default')) {this.value='';} });
			$jj('input[type=text]').focusout(function(){ if (this.value=='') {this.value=$jj(this).data('default');} });
		});
		//Form switch
		$jj(document).ready( function(){ 
        	$jj(".GP_s_en_inside").click(function(){
        		var parent = $jj(this).parents('.GP_s_inside');
        		$jj('.GP_s_di_inside',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Inside_s_show2').fadeOut(500);
        		$jj('#Inside_s_show1').delay(505).fadeIn(500);
        	});
        	$jj(".GP_s_di_inside").click(function(){
        		var parent = $jj(this).parents('.GP_s_inside');
        		$jj('.GP_s_en_inside',parent).removeClass('selected');
        		$jj(this).addClass('selected');
				
        		$jj('#Inside_s_show1').fadeOut(500);
        		$jj('#Inside_s_show2').delay(505).fadeIn(500);
        	});
			var switchwidth1 = $jj('.GP_s_en_inside').width();
			var switchwidth2 = $jj('.GP_s_di_inside').width();
			var switchwidth = switchwidth1+switchwidth2;
			$jj('.GP_s_inside').css({'width': ''+switchwidth+''});
        });
		</script>
		<div style="position:fixed; top:-9999; visibility:hidden" class="GP_s_inside">
            <label class="GP_s_en_inside"><span><?php echo $gp_d5; ?></span></label>
            <label class="GP_s_di_inside"><span><?php echo $gp_d6; ?></span></label>
        </div>
		
		<style>
		.Generation_plug.GP_incontent h2 strong span {
		  color:<?php echo $DInside_headclr; ?>;
		}
		</style>
		
		<?php
		if ($DInside_theme=='inside11' || $DInside_theme=='inside12') {
			wp_enqueue_style('style user_light-6', GenerationPlugin_style.'/style-light-6.css');
		}
		if ($DInside_form=='custom') {
            $insidereturnnow = ''; //start
			$insidereturnnow .= '<div class="Generation_plug GP_incontent">';
                if ($DInside_formtype=='link' || $DInside_formtype=='') {
					$insidereturnnow .= '<div class="GP_box" style="background:#FFF; width:'.$DInside_cwidth.'px!important;'; 
                	$insidereturnnow .= 'height:'.$DInside_cheight.'px!important; overflow:hidden">';
                    $insidereturnnow .= '<div class="GP_content" style="overflow:hidden; margin:0!important; margin-top:0!important;';
                    $insidereturnnow .= 'padding:0!important; padding-top:0!important; padding-right:0!important;';
                    $insidereturnnow .= 'padding-bottom:0!important; padding-left:0!important';
                    $insidereturnnow .= 'width:'.$DInside_cwidth_i.'px!important; height:'.$DInside_cheight_i.'px!important">';
        				$insidereturnnow .= '<iframe class="GP_pmzero" src="'.$DInside_clink.'" width="100%" style="';
                		$insidereturnnow .= 'min-height:'.$DInside_cheight.'px!important; overflow:hidden';
                		$insidereturnnow .= 'min-width:'.$DInside_cwidth.'px!important; overflow:hidden">';
        				$insidereturnnow .= 'overflow-x:hidden; overflow-y:hidden" ></iframe>'; 
					$insidereturnnow .= '</div>';
					$insidereturnnow .= '</div>';
				} elseif ($DInside_formtype=='image') {
					$insidereturnnow .= '<div class="GP_box" style="background:#FFF; width:auto!important;'; 
                	$insidereturnnow .= 'height:auto!important; overflow:hidden">';
                    $insidereturnnow .= '<div class="GP_content" style="overflow:hidden; margin:0!important; margin-top:0!important;';
                    $insidereturnnow .= 'padding:0!important; padding-top:0!important; padding-right:0!important;';
                    $insidereturnnow .= 'padding-bottom:0!important; padding-left:0!important';
                    $insidereturnnow .= 'width:auto!important; height:auto!important; text-align:center">';
    					$insidereturnnow .= '<a href="'.$DInside_cclick2.'" target="'.$DInside_cblank.'">';
    						$insidereturnnow .= '<img style="overflow:hidden"; src="'.$DInside_cimage.'">';
    					$insidereturnnow .= '</a>';
                	$insidereturnnow .= '</div>';
            		$insidereturnnow .= '</div>';
				}
    		$insidereturnnow .= '</div>';
		} elseif ($DInside_theme=='inside1' || $DInside_theme=='inside11') {
            $insidereturnnow = ''; //start
			$insidereturnnow .= '<div class="Generation_plug GP_incontent">';
            	$insidereturnnow .= '<div class="GP_box GP_width700" style="background:';
				$insidereturnnow .= $DInside_bgcolor;
				$insidereturnnow .= ' url(\'';
				$insidereturnnow .= $DInside_bgimage;
				$insidereturnnow .= '\') repeat center center;">';
                $insidereturnnow .= '<div class="GP_content">';
                    $insidereturnnow .= '<h2 class="GP_a-center"><strong style="color:';
					$insidereturnnow .= $DInside_headclr;
					$insidereturnnow .= '">';
					if ($DInside_countdown=="on") {
						$insidereturnnow .= '<script type="text/javascript">';
                            $insidereturnnow .= '$jj(document).ready(function(){';
                            	$insidereturnnow .= 'var timeLeft=(';
								$insidereturnnow .= $DInside_headtxtT;
								$insidereturnnow .= ')*60*1000;';
                            	$insidereturnnow .= 'var timer=new Timer($jj(\'#GP_countdown_inside\'), timeLeft, "inside");';
                            $insidereturnnow .= '});';
                            $insidereturnnow .= '</script>';
                            $insidereturnnow .= '<span id="GP_countdown_inside">';
                            	$insidereturnnow .= '<span>';
								$insidereturnnow .= $DInside_headtxtF;
								$insidereturnnow .= '</span>';
                            	$insidereturnnow .= '<span class="m">00 minutes</span> ';
                            	$insidereturnnow .= '<span class="s">00 seconds</span>';
                            	$insidereturnnow .= '<span>';
								$insidereturnnow .= $DInside_headtxtE;
								$insidereturnnow .= '</span>';
                            $insidereturnnow .= '</span>';
					} else {
						$insidereturnnow .= $DInside_headtxt;
					}
					$insidereturnnow .= '</strong></h2>';
                    $insidereturnnow .= '<div class="GP_form-login-inline">';
					
    					if ($DInside_form=='both') {
    						$insidereturnnow .= '<div id="GP_s_inside" class="GP_f_inside GP_s_inside">';
                            	$insidereturnnow .= '<input style="display:none" type="radio" id="GP_s_r1_inside"';
								$insidereturnnow .= ' name="GP_f_inside" checked />';
                            	$insidereturnnow .= '<input style="display:none" type="radio" id="GP_s_r2_inside"';
								$insidereturnnow .= ' name="GP_f_inside" />';
                       			$insidereturnnow .= '<br/>';
                            	$insidereturnnow .= '<label for="GP_s_r1_inside" class="GP_s_en_inside selected">';
									$insidereturnnow .= '<span>'.$gp_d5.'</span>';
								$insidereturnnow .= '</label>';
                            	$insidereturnnow .= '<label for="GP_s_r2_inside" class="GP_s_di_inside">';
									$insidereturnnow .= '<span>'.$gp_d6.'</span>';
								$insidereturnnow .= '</label>';
                            $insidereturnnow .= '</div>';
    					}
					
						$insidereturnnow .= '<div id="Inside_s_show1" ';
						$insidereturnnow .= $DInsidef1_view;;
						$insidereturnnow .= '>';
                        $insidereturnnow .= '<form id="gpformsubmit_inside" action="';
						$insidereturnnow .= $DInside_optin[4];
						$insidereturnnow .= '" method="post">';
                            $insidereturnnow .= '<ul class="GP_f-left" '.$Inside_name_padding.'>';
    							$insidereturnnow .= '<li style="display:none">';
								$insidereturnnow .= $DInside_optin[5];
								$insidereturnnow .= '</li>';
                                $insidereturnnow .= '<li '.$Inside_name_disabled.'><input id="gpuserinput_inside" ';
								$insidereturnnow .= $gpnameinput_inside;
								$insidereturnnow .= ' name="';
								$insidereturnnow .= $DInside_optin[1];
								$insidereturnnow .= '" type="text" value="';
								$insidereturnnow .= $Inside_fname;
								$insidereturnnow .= '" class="GP_input-user" style="background-image:url(\'';
								$insidereturnnow .= GenerationPlugin_images;
								$insidereturnnow .= '/user.png\')!important; width:173px!important; min-width:173px!important; max-width:173px!important" /></li>';
                                $insidereturnnow .= '<li><input id="gpemailinput_inside" ';
								$insidereturnnow .= $gpemailinput_inside;
								$insidereturnnow .= ' name="';
								$insidereturnnow .= $DInside_optin[2];
								$insidereturnnow .= '" type="text" value="';
								$insidereturnnow .= $Inside_femail;
								$insidereturnnow .= '" class="GP_input-user" style="background-image:url(\'';
								$insidereturnnow .= GenerationPlugin_images;
								$insidereturnnow .= '/email.png\')!important; width:173px!important; min-width:173px!important; max-width:173px!important" /></li>';
    							$insidereturnnow .= '<li>';
								$insidereturnnow .= $DInside_optin[7];
								$insidereturnnow .= '</li>';
                                $insidereturnnow .= '<li><input id="verified_inside" name="';
								$insidereturnnow .= $DInside_optinsubmit;
								$insidereturnnow .= '" type="';
								$insidereturnnow .= $gpformbtn_inside;
								$insidereturnnow .= '" value="';
								$insidereturnnow .= $Inside_fbtntxt;
								$insidereturnnow .= '" class="GP_button GP_';
								$insidereturnnow .= $DInside_btncolor;
								$insidereturnnow .= '" /></li>';
                            $insidereturnnow .= '</ul>';
                        $insidereturnnow .= '</form>';
    					$insidereturnnow .= '<input type="hidden" id="gpkeepuserdetails_inside" value="';
						$insidereturnnow .= $DAutoins;
						$insidereturnnow .= '">';
						?>
						<?php
						$insidereturnnow .= '<script type="text/javascript">';
                        $insidereturnnow .= 'var $jj = jQuery.noConflict();';
    					$insidereturnnow .= 'if ($jj("#gpkeepuserdetails_inside").val()=="on") {';
                            //save user data to cookies
                            $insidereturnnow .= '$jj("#gpformsubmit_inside").submit(function(){';
                                $insidereturnnow .= 'var gpmydetails = $jj("#gpuserinput_inside").val() + \'|\' + $jj("#gpemailinput_inside").val();';
                                $insidereturnnow .= '$jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});';
                            $insidereturnnow .= '});';
    					$insidereturnnow .= '}';
    					$insidereturnnow .= '$jj("#verified_inside").click(function(){';
    						$insidereturnnow .= '$jj.cookie("gpsubscribed_inside", "subscribed", {expires: '.$gp_dsacookie.', path: "/"});';
    					$insidereturnnow .= '});';
    					$insidereturnnow .= '</script>';
    					$insidereturnnow .= '</div>';
						?>
						<?php
            			$insidereturnnow .= '<div id="Inside_s_show2" class="GP_f-left-fb" ';
						$insidereturnnow .= $DInsidef2_view;
						$insidereturnnow .= '>';
							$insidereturnnow .= '<a id="verifiedfb_inside" href="'.GenerationPlugin_path.'facebook.php" target="_blank">';
                            	$insidereturnnow .= '<img style="margin:0 auto" src="'.GenerationPlugin_images.'/btn/facebook.gif">';
                            $insidereturnnow .= '</a>';
							$insidereturnnow .= '<script type="text/javascript">';
							$insidereturnnow .= 'var $jj = jQuery.noConflict();';
							$insidereturnnow .= '$jj("#verifiedfb_inside").click(function(){';
								$insidereturnnow .= '$jj.cookie("gpsubscribed_inside", "subscribed", {expires: '.$gp_dsacookie.', path: "/"});';
							$insidereturnnow .= '});';
							$insidereturnnow .= '</script>';
            			$insidereturnnow .= '</div>';
          				$insidereturnnow .= '<div class="GP_linkv" ';
						$insidereturnnow .= $DInsidef3_view;
						$insidereturnnow .= '>';
                    		$insidereturnnow .= '<a id="verifiedlink_inside" href="';
							$insidereturnnow .= $DInside_link;
							$insidereturnnow .= '" ';
							$insidereturnnow .= $Inside_link_blank;
							$insidereturnnow .= '>';
                    			$insidereturnnow .= '<img style="display:inline" src="';
								$insidereturnnow .= GenerationPlugin_images;
								$insidereturnnow .= '/btn/animarrows.gif">';
                    			$insidereturnnow .= '<li style="display:inline"><input type="button" value="';
								$insidereturnnow .= $Inside_fbtntxt;
								$insidereturnnow .= '" class="GP_button GP_';
								$insidereturnnow .= $DInside_btncolor;
								$insidereturnnow .= '" /></li>';
                    		$insidereturnnow .= '</a>';
							$insidereturnnow .= '<script type="text/javascript">';
							$insidereturnnow .= 'var $jj = jQuery.noConflict();';
							$insidereturnnow .= '$jj("#verifiedlink_inside").click(function(){';
								$insidereturnnow .= '$jj.cookie("gpsubscribed_inside", "subscribed", {expires: '.$gp_dsacookie.', path: "/"});';
							$insidereturnnow .= '});';
							$insidereturnnow .= '</script>';
                  		$insidereturnnow .= '</div>';
                    $insidereturnnow .= '</div>';
					$insidereturnnow .= '<p style="margin-left:0px!important; margin-bottom:0px!important" class="GP_icon GP_padlock GP_w-auto GP_type-2 GP_nomarginbottom">';
					$insidereturnnow .= $DInside_spam;
					$insidereturnnow .= '</p>';
                $insidereturnnow .= '</div>';
            	$insidereturnnow .= '</div>';
    		$insidereturnnow .= '</div>';
		} elseif ($DInside_theme=='inside2' || $DInside_theme=='inside12') {
            $insidereturnnow = ''; //start
    		$insidereturnnow .= '<div class="Generation_plug GP_incontent">';
            	$insidereturnnow .= '<div class="GP_box GP_width700" style="background:';
				$insidereturnnow .= $DInside_bgcolor;
				$insidereturnnow .= ' url(\'';
				$insidereturnnow .= $DInside_bgimage;
				$insidereturnnow .= '\') repeat center center">';
                $insidereturnnow .= '<div class="GP_content GP_insider">';
                    $insidereturnnow .= '<div class="GP_form-login-inline">';

    					if ($DInside_form=='both') {
    						$insidereturnnow .= '<div id="GP_s_inside" class="GP_f_inside GP_s_inside">';
                            	$insidereturnnow .= '<input style="display:none" type="radio" id="GP_s_r1_inside"';
								$insidereturnnow .= ' name="GP_f_inside" checked />';
                            	$insidereturnnow .= '<input style="display:none" type="radio" id="GP_s_r2_inside"';
								$insidereturnnow .= ' name="GP_f_inside" />';
                       			$insidereturnnow .= '<br/>';
                            	$insidereturnnow .= '<label for="GP_s_r1_inside" class="GP_s_en_inside selected">';
									$insidereturnnow .= '<span>'.$gp_d5.'</span>';
								$insidereturnnow .= '</label>';
                            	$insidereturnnow .= '<label for="GP_s_r2_inside" class="GP_s_di_inside">';
									$insidereturnnow .= '<span>'.$gp_d6.'</span>';
								$insidereturnnow .= '</label>';
                            $insidereturnnow .= '</div>';
    					}
						
						$insidereturnnow .= '<div id="Inside_s_show1" ';
						$insidereturnnow .= $DInsidef1_view;
						$insidereturnnow .= '>';
                        $insidereturnnow .= '<form id="gpformsubmit_inside" action="';
						$insidereturnnow .= $DInside_optin[4];
						$insidereturnnow .= '" method="post">';
                            $insidereturnnow .= '<ul class="GP_f-left" '.$Inside_name_padding.'>';
    							$insidereturnnow .= '<li style="display:none">';
								$insidereturnnow .= $DInside_optin[5];
								$insidereturnnow .= '</li>';
                                $insidereturnnow .= '<li '.$Inside_name_disabled.'><input id="gpuserinput_inside" ';
								$insidereturnnow .= $gpnameinput_inside;
								$insidereturnnow .= ' name="';
								$insidereturnnow .= $DInside_optin[1];
								$insidereturnnow .= '" type="text" value="';
								$insidereturnnow .= $Inside_fname;
								$insidereturnnow .= '" class="GP_input-user" style="background-image:url(\'';
								$insidereturnnow .= GenerationPlugin_images;
								$insidereturnnow .= '/user.png\')!important; width:173px!important; min-width:173px!important; max-width:173px!important" /></li>';
                                $insidereturnnow .= '<li><input id="gpemailinput_inside" ';
								$insidereturnnow .= $gpemailinput_inside;
								$insidereturnnow .= ' name="';
								$insidereturnnow .= $DInside_optin[2];
								$insidereturnnow .= '" type="text" value="';
								$insidereturnnow .= $Inside_femail;
								$insidereturnnow .= '" class="GP_input-user" style="background-image:url(\'';
								$insidereturnnow .= GenerationPlugin_images;
								$insidereturnnow .= '/email.png\')!important; width:173px!important; min-width:173px!important; max-width:173px!important" /></li>';
    							$insidereturnnow .= '<li>';
								$insidereturnnow .= $DInside_optin[7];
								$insidereturnnow .= '</li>';
                                $insidereturnnow .= '<li><input id="verified_inside" name="';
								$insidereturnnow .= $DInside_optinsubmit;
								$insidereturnnow .= '>" type="';
								$insidereturnnow .= $gpformbtn_inside;
								$insidereturnnow .= '" value="';
								$insidereturnnow .= $Inside_fbtntxt;
								$insidereturnnow .= '" class="GP_button GP_';
								$insidereturnnow .= $DInside_btncolor;
								$insidereturnnow .= '" /></li>';
                            $insidereturnnow .= '</ul>';
                        $insidereturnnow .= '</form>';
    					$insidereturnnow .= '<input type="hidden" id="gpkeepuserdetails_inside" value="';
						$insidereturnnow .= $DAutoins;
						$insidereturnnow .= '">';
						?>
    					<?php
						$insidereturnnow .= '<script type="text/javascript">';
                        $insidereturnnow .= 'var $jj = jQuery.noConflict();';
    					$insidereturnnow .= 'if ($jj("#gpkeepuserdetails_inside").val()=="on") {';
                            //save user data to cookies
                            $insidereturnnow .= '$jj("#gpformsubmit_inside").submit(function(){';
                                $insidereturnnow .= 'var gpmydetails = $jj("#gpuserinput_inside").val() + \'|\' + $jj("#gpemailinput_inside").val();';
                                $insidereturnnow .= '$jj.cookie("gpmydetails", gpmydetails, {expires: 365*10, path: '/'});';
                            $insidereturnnow .= '});';
    					$insidereturnnow .= '}';
    					$insidereturnnow .= '$jj("#verified_inside").click(function(){';
    						$insidereturnnow .= '$jj.cookie("gpsubscribed_inside", "subscribed", {expires: '.$gp_dsacookie.', path: "/"});';
    					$insidereturnnow .= '});';
    					$insidereturnnow .= '</script>';
    					$insidereturnnow .= '</div>';
						?>
						<?php
            			$insidereturnnow .= '<div id="Inside_s_show2" class="GP_f-left-fb" ';
						$insidereturnnow .= $DInsidef2_view;
						$insidereturnnow .= '>';
            				$insidereturnnow .= '<a id="verifiedfb_inside" href="'.GenerationPlugin_path.'facebook.php" target="_blank">';
                            	$insidereturnnow .= '<img style="margin:0 auto" src="'.GenerationPlugin_images.'/btn/facebook.gif">';
                            $insidereturnnow .= '</a>';
							$insidereturnnow .= '<script type="text/javascript">';
							$insidereturnnow .= 'var $jj = jQuery.noConflict();';
							$insidereturnnow .= '$jj("#verifiedfb_inside").click(function(){';
								$insidereturnnow .= '$jj.cookie("gpsubscribed_inside", "subscribed", {expires: '.$gp_dsacookie.', path: "/"});';
							$insidereturnnow .= '});';
							$insidereturnnow .= '</script>';
            			$insidereturnnow .= '</div>';
          				$insidereturnnow .= '<div class="GP_linkv" ';
						$insidereturnnow .= $DInsidef3_view;
						$insidereturnnow .= '>';
                    		$insidereturnnow .= '<a id="verifiedlink_inside" href="';
							$insidereturnnow .= $DInside_link;
							$insidereturnnow .= '" ';
							$insidereturnnow .= $Inside_link_blank;
							$insidereturnnow .= '>';
                    			$insidereturnnow .= '<img style="display:inline" src="';
								$insidereturnnow .= GenerationPlugin_images;
								$insidereturnnow .= '/btn/animarrows.gif">';
                    			$insidereturnnow .= '<li style="display:inline"><input type="button" value="';
								$insidereturnnow .= $Inside_fbtntxt;
								$insidereturnnow .= '" class="GP_button GP_';
								$insidereturnnow .= $DInside_btncolor;
								$insidereturnnow .= '" /></li>';
                    		$insidereturnnow .= '</a>';
							$insidereturnnow .= '<script type="text/javascript">';
							$insidereturnnow .= 'var $jj = jQuery.noConflict();';
							$insidereturnnow .= '$jj("#verifiedlink_inside").click(function(){';
								$insidereturnnow .= '$jj.cookie("gpsubscribed_inside", "subscribed", {expires: '.$gp_dsacookie.', path: "/"});';
							$insidereturnnow .= '});';
							$insidereturnnow .= '</script>';
                  		$insidereturnnow .= '</div>';
                    $insidereturnnow .= '</div>';
                $insidereturnnow .= '</div>';
            	$insidereturnnow .= '</div>';
    		$insidereturnnow .= '</div>';
		}
		
		//return whole inside box
		return $insidereturnnow;


} //displaying settings
} //STOP IF DAYS OK
} //STOP IF ACTIVATED 	
} //START IF 'SUBSCRIBED' IS NOT ACTIVE


/********** FUNCTION STOP **********/
}

//shortcode
function gpinpost() {
	return gpinpostreturn();
}
add_shortcode("gpinpost", "gpinpost");
?>
