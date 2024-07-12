<?php
global $wpdb;
$table_name_exit = $wpdb->prefix . 'GenerationPlugin_EXIT';


//PREVIEW MODE ON/OFF
$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
$DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
get_currentuserinfo();
global $user_level;
if ($user_level>9 && $DPreview=='on') { $Duniqueid = '9999'; } else { $Duniqueid = '1'; }


$DExit_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_exit.' WHERE id='.$Duniqueid);
if ($DExit_active_tmp=="on") { //START IF ACTIVATED


$DExit_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
$DExit_display = explode("|", $DExit_display);
if ($DExit_display[6]=='' || ($DExit_display[6]!="" && strtotime($DExit_display[6]) <= strtotime(date("Y-m-d")))) {
	$DExit_ddays_1="1";
} else {$DExit_ddays_1="0";}
if ($DExit_display[7]=='' || ($DExit_display[7]!="" && strtotime($DExit_display[7]) > strtotime(date("Y-m-d")))) {
	$DExit_ddays_2="1";
} else {$DExit_ddays_2="0";}
if ($DExit_ddays_1=="1" && $DExit_ddays_2=="1") { //START IF DAYS OK


//display values from database
$gp_dsacookie = $wpdb->get_var('SELECT Cookies FROM '.$table_name_general.' WHERE id=1');
    if ($gp_dsacookie=="") {$gp_dsacookie = "7";} //default
$DExit_redirect = stripslashes($wpdb->get_var('SELECT Redirect FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
$DExit_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
$DExit_stoptext = stripslashes($wpdb->get_var('SELECT Message FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
if ($DExit_redirect=="") {$DExit_redirect = 'http://www.generationplugin.com';} //default
if ($DExit_text=="") {$DExit_text = '**************************** WAIT! ****************************

PLEASE EDIT THIS CONTENT IN YOUR ADMIN PANEL.
E.G. I WILL GIVE YOU $20 OFF THE PRICE!
THIS IS ONE TIME OFFER AND WILL NEVER HAPPEN
AGAIN, CLICK \'STAY ON PAGE\' BUTTON NOW!

***************************************************************';} //default
if ($DExit_stoptext=="") {$DExit_stoptext = 'WAIT!<br>Before You Go, Click<br>"Stay On Page" Or "Cancel"<br>For Something Special!';} //default

$DExit_redirect=urlencode("http://".$DExit_redirect);
$DExit_text=trim(preg_replace("/<br>/","\\n",$DExit_text)); //or addslashes($DExit_text)
$DExit_wrap = stripslashes($wpdb->get_var('SELECT Wrap FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
if ($DExit_wrap=="on") { //smart displaying
	$DExit_text_exp = explode("\\n",$DExit_text);
	$DExit_text_tmp = "\\n".implode('\\n',array_slice($DExit_text_exp, 1, -1))."\\n";
	$DExit_text = $DExit_text_exp[0].wordwrap($DExit_text_tmp,49,'\\n').end($DExit_text_exp);
}
$warningimage = '';
$DExit_stop = stripslashes($wpdb->get_var('SELECT Stop FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
if ($DExit_stop=="on") { //smart displaying
	$warningimage = '<div id="warningimage" style="background:url('.GenerationPlugin_images.'/stop.gif) center center no-repeat; height:180px; text-align:center"><p style="font-weight:bold; line-height:110%; font-size:28px; color:#222; width:490px; text-align:center; margin:0 auto; padding-top:28px; color:#C00">'.$DExit_stoptext.'</p></div>';
}

$DExit_display = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
    $DExit_display = explode("|", $DExit_display);
	$DExit_dpages = $DExit_display[0];
	$DExit_dcats = $DExit_display[1];
	$DExit_dposts = $DExit_display[2];
	$DExit_showsub = $DExit_display[3];
	if ($DExit_showsub=="on") {$DExit_showsub="checked";}
	$DExit_ddelay = $DExit_display[4];
	if ($DExit_ddelay<0 || $DExit_ddelay=="0" || $DExit_ddelay=="") { $DExit_ddelay="0"; }
	$DExit_ddays = (strtotime($DExit_display[5]) - strtotime(date("Y-m-d"))) / (60 * 60 * 24);
	if ($DExit_ddays<0 || $DExit_ddays=="0") { $DExit_ddays="0"; }
?>

<?php
//DISPLAYING

//prepare page list in array
$DExit_dpages_explode=explode(",",$DExit_dpages);
foreach ($DExit_dpages_explode as $DExit_dpages_explode_element) { $DExit_dpages_array[]=$DExit_dpages_explode_element; }
//prepare category list in array
$DExit_dcats_explode=explode(",",$DExit_dcats);
foreach ($DExit_dcats_explode as $DExit_dcats_explode_element) { $DExit_dcats_array[]=$DExit_dcats_explode_element; }
//prepare posts list in array
$DExit_dposts_explode=explode(",",$DExit_dposts);
foreach ($DExit_dposts_explode as $DExit_dposts_explode_element) { $DExit_dposts_array[]=$DExit_dposts_explode_element; }

if (((strpos($DExit_dpages,'allpages')!==false) &&
	 ((is_front_page() && strpos(','.$DExit_dpages.',',',front,')!==false) || //front page
	 (is_search() && strpos(','.$DExit_dpages.',',',search,')!==false) || //search results page
	 (is_author() && strpos(','.$DExit_dpages.',',',author,')!==false) || //author page
	 (is_page($DExit_dpages_array)))) || //pages and subpages
   ((strpos($DExit_dcats,'allcats')!==false) &&
	 (is_category($DExit_dcats_array))) || //category pages
   ((strpos($DExit_dposts,'allposts')!==false) &&
	 (is_single($DExit_dposts_array)))) { //post pages
	 //DO NOT DISPLAY
} else {
?>


	<?php $DExit_redirect = str_replace(".",":DOT:",$DExit_redirect); ?>
	<script type="text/javascript">
	var $jj = jQuery.noConflict();
	var GPmsg = '<?php print($DExit_text); ?>';
	var GPlink = '<?php echo GenerationPlugin_path."redirect.php?url=".$DExit_redirect; ?>';
	var FrameDiv = '<div onmouseover="hidewarningimage()"; style="position:absolute; width:100%; height:100%; left:0; top:0; margin:0 auto; padding:0; background:#fff;"><?php echo $warningimage; ?><iframe width="100%" height="100%" align="middle" frameborder="0" src="'+GPlink+'" ></iframe></div>';
	
	FrameBody = document.body;
	if(!FrameBody){FrameBody=document.getElementsByTagName("body")[0]}
	function hidewarningimage() {
		document.getElementById('warningimage').style.display='none';
	}
	function GPpop(){
		//check for browser first
    	var ua = navigator.userAgent.toLowerCase();
    	var check = function(r) {return r.test(ua);};
        var isIE = !isOpera && check(/msie/);
        var isWebKit = check(/webkit/);
        var isGecko = !isWebKit && check(/gecko/);
        var isOpera = check(/opera/);
        var isChrome = check(/chrome/);
        var isSafari = !isChrome && check(/safari/);
        if(isIE){
        	//nothing
        } else if(isChrome){
        	//nothing
        } else if(isSafari){
        	//nothing
        } else if (isOpera){
        	//???????
        } else if (isGecko){
        	alert(GPmsg);
        } else {
            alert(GPmsg);
        }
		
		window.scrollTo(0,0);
		window.onbeforeunload=GPunpop;
		newdiv=document.createElement("div");
		newdiv.innerHTML=FrameDiv;
		FrameBody.innerHTML="";
		FrameBody.style.overflow="hidden";
		FrameBody.appendChild(newdiv);
		return GPmsg;
	}
	function GPunpop(){}
	$jj('a').click(function(){window.onbeforeunload=GPunpop;});
	$jj('a[href^="#"]').click(function(){window.onbeforeunload=GPpop;});
	$jj('a[target="_blank"]').click(function(){window.onbeforeunload=GPpop;});
    $jj('input[type="submit"]').click(function(){window.onbeforeunload=null;});
    $jj('input[name="submit"]').click(function(){window.onbeforeunload=null;});
    $jj('input[type="button"]').click(function(){window.onbeforeunload=null;});
	$jj(document).ready(function(){window.onbeforeunload=GPpop;});
	</script>


<?php
} //displaying settings
} //STOP IF DAYS OK
} //STOP IF ACTIVATED
?>