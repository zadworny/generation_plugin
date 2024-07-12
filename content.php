<?php
//MOBILE DETECTION
include 'mobiledetection.php';
$detect = new Mobile_Detect;
//if ($detect->isMobile()) { /*STOP*/ } else { //don't display in mobile phones
//if ($detect->isTablet()) { /*STOP*/ } else { //don't display in tablets
if ($detect->isMobile() || $detect->isTablet()) { /*STOP*/ } else { //don't display in mobile phones AND tablets



//LOAD JQUERY IN HEAD
function GPloadjqueryinhead() {
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'GPloadjqueryinhead');



//REGISTRATION
function GPaddcontentto_header() { ?>

	<style type="text/css">
    .Generation_plug,
    .Generation_plug div,
    .Generation_plug p,
    .Generation_plug dt,
    .Generation_plug dd,
    .Generation_plug ul,
    .Generation_plug li,
    .Generation_plug fieldset,
    .Generation_plug td,
    .Generation_plug th,
    .Generation_plug input,
    .Generation_plug textarea,
    .Generation_plug h2,
    .Generation_plug strong {
      font-family: Arial, Helvetica, sans-serif;
    }
	/* form switch */
	label[class^=GP_s_en_],
	label[class^=GP_s_di_],
	label[class^=GP_s_en_] span,
	label[class^=GP_s_di_] span {
      background: url(<?php echo GenerationPlugin_images."/boxes/switch.gif"; ?>) repeat-x;
      display: block;
      float: left;
      border-top-left-radius: 5px!important;
      border-top-right-radius: 5px!important;
      border-bottom-left-radius: 5px!important;
      border-bottom-right-radius: 5px!important;
    }
	</style>
	
	<?php
	wp_enqueue_style('style user_main', GenerationPlugin_style.'/style.css');

    add_filter("widget_text", "shortcode_unautop");
    add_filter("widget_text", "do_shortcode");
    
    wp_deregister_script('jquery.fancybox');
    wp_deregister_script('fancybox');
    wp_deregister_script('jquery-fancybox');
	
    wp_enqueue_style('style user_fancyboxcss', GenerationPlugin_lightbox.'/1.3.4.css');
    wp_enqueue_script('script user_fancyboxjs', GenerationPlugin_lightbox.'/1.3.4.js', array("jquery"), "1.8.2", true);
	
	global $wpdb;
	$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
	$gp_d3 = $wpdb->get_var('SELECT Minutes FROM '.$table_name_general.' WHERE id=1');
		$gp_d3 = preg_replace("/\\\/","",$gp_d3);
		if ($gp_d3=="") {$gp_d3 = "Minutes";} //default
	$gp_d4 = $wpdb->get_var('SELECT Seconds FROM '.$table_name_general.' WHERE id=1');
		$gp_d4 = preg_replace("/\\\/","",$gp_d4);
		if ($gp_d4=="") {$gp_d4 = "Seconds";} //default
	
    wp_enqueue_script('script_user_scripts', GenerationPlugin_scripts.'/script.js', array("jquery"), "1.8.2", true);
    //wp_enqueue_script('script_user_lightboxpack', GenerationPlugin_lightbox.'/1.3.4.pack.js', array("jquery"), "1.8.2", true);
    wp_enqueue_script('script_user_jquerycookie', GenerationPlugin_scripts.'/jquery.cookie.js', array("jquery"), "1.8.2", true);
	?>

    <script type="text/javascript">
	function Timer(container, timeLeft, ctype) {
      var minsContainer  = $jj(container).find('.m');
      var secsContainer  = $jj(container).find('.s');
    
      var currentTimeLeft = timeLeft;
      var cctype = 'timer_'+ctype;
      var ctype = '#GP_countdown_'+ctype;
      //use value from cookie if cookie is set
      if ($jj.cookie(cctype)) { currentTimeLeft = $jj.cookie(cctype); }
      var secondsForTimer = 1000;
      var timerInterval;
    
      if (currentTimeLeft < 0) { $jj(ctype).css({"text-decoration":"blink"}); return; } 
      else { timerInterval = setInterval(countdown, secondsForTimer); }
    
      function countdown() {
        currentTimeLeft = parseInt(currentTimeLeft - secondsForTimer);
    	$jj.cookie(cctype, currentTimeLeft, {expires: 7});
        if (currentTimeLeft < 0) {
           clearInterval(timerInterval);
    	   $jj(ctype).css({"text-decoration":"blink"});
           return;
        } else {
           //calculate hours left
           var wholeSeconds = parseInt(currentTimeLeft / 1000,10);
           var wholeMinutes = parseInt(currentTimeLeft / 60000,10);
           //calculate minutes left
           var minutes = parseInt(wholeMinutes % 90,10);
           //calculate seconds left
           var seconds = parseInt(wholeSeconds % 60,10);
           //prefix 0 min and second counter
           $jj(minsContainer).text((minutes < 10 ? "0" : "") + minutes  + (minutes ==1 ? " <?php echo $gp_d3; ?>" : " <?php echo $gp_d3; ?>"));
           $jj(secsContainer).text((seconds < 10 ? "0" : "") + seconds  + (seconds ==1 ? " <?php echo $gp_d4; ?>" : " <?php echo $gp_d4; ?>"));
        }
      }
    }
	</script>

    <?php
	//PREVIEW MODE ON/OFF
    global $wpdb;
    $table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
    $DPreview = $wpdb->get_var('SELECT Preview FROM '.$table_name_general.' WHERE id=1');
    get_currentuserinfo() ;
    global $user_level;
    if ($user_level>9 && $DPreview=='on') { ?>
		<style type="text/css"> html { margin-top:28px!important; } </style>
		<div style="position:fixed; z-index:99998; top:0; width:100%; height:28px; background:#444">&nbsp;</div>
		<div style="position:fixed; z-index:100000; top:4px; width:400px; left:50%; margin-left:-200px; text-align:center; color:#CCC; text-decoration:blink; font-size:13px; font-family:Arial">'Generation Plugin' preview mode. Visible for admin only.</div>
		<?php
    } elseif ($user_level>9) { ?>
		<style type="text/css"> html { margin-top:28px!important; } </style>
		<div style="position:fixed; z-index:99998; top:0; width:100%; height:28px; background:#444">&nbsp;</div>
		<div style="position:fixed; z-index:99998; top:4px; width:400px; left:50%; margin-left:-200px; text-align:center; color:#666; text-decoration:none; font-size:13px">Wordpress admin bar replacement. Visible for admin only.</div>
		<?php
    }
	
}
add_action('wp_head','GPaddcontentto_header');



//PROMOTE LINK FOR AFFILIATES
//lightbox, footer standard, register, sidebar, inpost
function GPpromotelink() {
		global $wpdb;
		$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
		$poweredby = $wpdb->get_var('SELECT Poweredby FROM '.$table_name_general.' WHERE id=1');
			$poweredby = preg_replace("/\\\/","",$poweredby);
			if ($poweredby=="") {$poweredby = "This Website Is Proudly Powered By Generation Plugin";} //default
        $DAffi = $wpdb->get_var('SELECT Affiliate FROM '.$table_name_general.' WHERE id=1'); $DAffi = explode('|',$DAffi);
        if ($DAffi[0]=='on') {
			if ($DAffi[1]!='Insert Your Affiliate Link' && $DAffi[1]!='') { $DAffiliate = $DAffi[1]; }
        ?>
		<script type="text/javascript">
		var $jj = jQuery.noConflict();
   	 	$jj(document).ready(function(){

			var $pbblockheight = null;
            $pbblockheight_start = $jj("#GP_poweredbyhover").height()+30;
            $pbblockheight = $jj("#GP_poweredbyhover").height()-30;
            $jj("#GP_poweredbyshow").css({"display": "block"});
            $jj("#GP_poweredbyhover").css({"display": "block", "bottom": "-"+$pbblockheight_start+"px"});
            $jj("#GP_poweredbyhover").delay(1000).animate({"bottom": "+=113px"}, 500);

    		$jj('#GP_poweredbyshow').hide();
    		$jj('#GP_poweredbyhover').hover(
				function(){$jj('#GP_poweredbyshow').fadeIn(300);},
				function(){$jj('#GP_poweredbyshow').fadeOut(300);}
			);
		});
		</script>
        <a href="http://<?php echo $DAffiliate; ?>" target="_blank" style="border:none">
			<img style="display:none" id="GP_poweredbyhover" src="<?php echo GenerationPlugin_images.'/poweredbyicon.png'; ?>">
			<p style="display:none; color:#ca2424" id="GP_poweredbyshow" class="GP_promote_icon">
				<?php echo $poweredby; ?><br/>
				<img style="margin-top:5px; margin-right:-20px" src="<?php echo GenerationPlugin_images.'/poweredbyicon_arrow.png'; ?>">
			</p>
		</a>
<?php } }
add_action('wp_footer','GPpromotelink');



//COUNTDOWN TIMER SHORTCODE
function gpcountdownreturn($time,$front,$end,$type) { 
		global $wpdb;
    	$table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
    	$jqueryfix = $wpdb->get_var('SELECT Jqueryfix FROM '.$table_name_general.' WHERE id=1');
    	$gp_d3 = $wpdb->get_var('SELECT Minutes FROM '.$table_name_general.' WHERE id=1');
    		$gp_d3 = preg_replace("/\\\/","",$gp_d3);
    		if ($gp_d3=="") {$gp_d3 = "Minutes";} //default
    	$gp_d4 = $wpdb->get_var('SELECT Seconds FROM '.$table_name_general.' WHERE id=1');
    		$gp_d4 = preg_replace("/\\\/","",$gp_d4);
    		if ($gp_d4=="") {$gp_d4 = "Seconds";} //default
		?>
        <script type="text/javascript">
        $jj(document).ready(function(){
        	var timeLeft=(<?php echo $time; ?>)*60*1000;
        	var timer=new Timer($jj('#GP_countdown_<?php echo $type; ?>'), timeLeft, "<?php echo $type; ?>");
        });
        </script>
        <span id="GP_countdown_<?php echo $type; ?>">
        	<span><?php echo $front; ?> </span>
        	<span class="m">00 <?php echo $gp_d3; ?></span>
        	<span class="s">00 <?php echo $gp_d4; ?></span>
        	<span> <?php echo $end; ?></span>
        </span>
<?php }



/********** REGULAR SIGNUP **********/
include "sidebarbox.php";

/********** INPOST SIGNUP **********/
include "inpostbox.php";

/********** REGISTRATION **********/
include "specialpopup.php";
	
	
	
function GPaddcontentto_footer() {

    global $wpdb;
    $table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
	$DAutoins = $wpdb->get_var('SELECT Autoins FROM '.$table_name_general.' WHERE id=1');
    $DLivecheck = $wpdb->get_var('SELECT Livecheck FROM '.$table_name_general.' WHERE id=1');

	/********** LIGHTBOX POPUP **********/
	include "lightboxpopup.php";
	
	/********** HEADER PANEL **********/
	include "headerpanel.php";

	/********** FOOTER PANEL **********/
	include "footerpanel.php";

	/********** SLIDE PANEL **********/
	include "slidepanel.php";

	/********** EXIT POPUP **********/
	include "exitpopup.php";
	
}
add_action('wp_footer','GPaddcontentto_footer');



}
?>
