<div id="tab8" class="tab_content" style="display:none; padding:0!important">

<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post" id="GenerationPlugin_displayingform_exit" enctype="multipart/form-data" name="myexitform">


<?php
if (isset($_POST['displayingformsent_exit'])=='Save Changes') {
	
	$Exit_startdate = $_POST['Exit_dstart'];
	if ($_POST['Exit_ddays']=="") { $Exit_days = ""; }
	elseif ($Exit_startdate!="") { $Exit_days = date("Y-m-d", strtotime($Exit_startdate." + ".$_POST['Exit_ddays']." days")); }
	else { $Exit_days = date("Y-m-d", strtotime(" + ".$_POST['Exit_ddays']." days")); }
	$Exit_display = implode(',',$_POST['Exit_pagelist']).'|'.implode(',',$_POST['Exit_catlist']).'|'.implode(',',$_POST['Exit_postlist']).'|'.$_POST['Exit_showsub'].'|'.$_POST['Exit_ddelay'].'|'.$Exit_days.'|'.$_POST['Exit_dstart'].'|'.$_POST['Exit_dstop'];
  
	//replace \n with html br before save to database
    $Exit_text=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Exit_text']);
    $Exit_stoptext=str_replace(array("\r\n", "\r", "\n"), '<br>', $_POST['Exit_stoptext']);
	
	//save to database
	if (isset($_POST['Savepreview_exit'])) {
    $wpdb->update($table_name_exit,
    	array('Redirect'=>mysql_real_escape_string(trim($_POST['Exit_redirect'])),
    		  'Text'=>mysql_real_escape_string(trim($Exit_text)),
    		  'Wrap'=>mysql_real_escape_string(trim($_POST['Exit_wrap'])),
    		  'Message'=>mysql_real_escape_string(trim($Exit_stoptext)),
    		  'Stop'=>mysql_real_escape_string(trim($_POST['Exit_stop'])),
			  'Active'=>mysql_real_escape_string(trim($_POST['Exit_active'])),
			  'Display'=>mysql_real_escape_string(trim($Exit_display))
    	),
    	array('id'=>'1')
    );
	}
    $wpdb->update($table_name_exit,
    	array('Redirect'=>mysql_real_escape_string(trim($_POST['Exit_redirect'])),
    		  'Text'=>mysql_real_escape_string(trim($Exit_text)),
    		  'Wrap'=>mysql_real_escape_string(trim($_POST['Exit_wrap'])),
    		  'Message'=>mysql_real_escape_string(trim($Exit_stoptext)),
    		  'Stop'=>mysql_real_escape_string(trim($_POST['Exit_stop'])),
			  'Active'=>mysql_real_escape_string(trim($_POST['Exit_active'])),
			  'Display'=>mysql_real_escape_string(trim($Exit_display))
    	),
    	array('id'=>'9999')
    );
}

//display values from database
$DExit_redirect = stripslashes($wpdb->get_var('SELECT Redirect FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
	$DExit_redirect = preg_replace("/\\\/","",$DExit_redirect);
$DExit_text = stripslashes($wpdb->get_var('SELECT Text FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
	$DExit_text = preg_replace("/\\\/","",$DExit_text);
$DExit_stoptext = stripslashes($wpdb->get_var('SELECT Message FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
	$DExit_stoptext = preg_replace("/\\\/","",$DExit_stoptext);
$DExit_active_tmp = $wpdb->get_var('SELECT Active FROM '.$table_name_exit.' WHERE id='.$Duniqueid);
	if ($DExit_active_tmp=="on") {$DExit_active="checked"; $DExit_activated='style="width:301px!important"';} 
	else {$DExit_activated='style="background-color:#FCC; width:301px!important"';}
$DExit_wrap = $wpdb->get_var('SELECT Wrap FROM '.$table_name_exit.' WHERE id='.$Duniqueid);
	if ($DExit_wrap=="on") {$DExit_wrapcheck="checked";}
$DExit_stop = $wpdb->get_var('SELECT Stop FROM '.$table_name_exit.' WHERE id='.$Duniqueid);
	if ($DExit_stop=="on") {$DExit_stopcheck="checked";}

    //replace html br with \n before display in text field
	$DExit_text = preg_replace("/<br>/","\n",$DExit_text);
	$DExit_text = preg_replace("/\\\/","",$DExit_text);

    //replace html br with \n before display in text field
	$DExit_stoptext = preg_replace("/<br>/","\n",$DExit_stoptext);
	$DExit_stoptext = preg_replace("/\\\/","",$DExit_stoptext);

$DExit_displays = stripslashes($wpdb->get_var('SELECT Display FROM '.$table_name_exit.' WHERE id='.$Duniqueid));
	$DExit_displays = preg_replace("/\\\/","",$DExit_displays);
    $DExit_display = explode("|", $DExit_displays);
	$DExit_dpages = $DExit_display[0];
	$DExit_dcats = $DExit_display[1];
	$DExit_dposts = $DExit_display[2];
	if (strpos($DExit_dpages,'allpages')!==false) {$DExit_dpagesall="checked";}
	if (strpos($DExit_dcats,'allcats')!==false) {$DExit_dcatsall="checked";}
	if (strpos($DExit_dposts,'allposts')!==false) {$DExit_dpostsall="checked";}
	//if ($DExit_dpagesall=="" && $DExit_dcatsall=="" && $DExit_dpostsall=="") {$DExit_dcheckall="";}
	$DExit_showsub = $DExit_display[3];
	if ($DExit_showsub=="on") {$DExit_showsub="checked";}
	$DExit_ddelay = $DExit_display[4];
	$DExit_ddays = $DExit_display[5];
	$DExit_dstart = $DExit_display[6];
	$DExit_dstop = $DExit_display[7];
?>


	<script language="javascript" type="text/javascript">
    function addwaitsl() {
    	var waitstarsline = "**************************** WAIT! ****************************\n\n";
    	document.myexitform.Exit_text.value += waitstarsline;
    }
    function addregsl() {
    	var waitstarsline = "****************************************************************\n\n";
    	document.myexitform.Exit_text.value += waitstarsline;
    }
    function addbottomsl() {
    	var starsline = "\n\n****************************************************************";
    	document.myexitform.Exit_text.value += starsline;
    }
    function resettxt() {
    	var resetit = "";
    	document.myexitform.Exit_text.value = resetit;
    }
	</script>


        <div class="left_section">
        	<h4>Customize</h4>
			<div class="activate" <?php echo $DExit_activated; ?>>
				<input name="Exit_active" type="checkbox" <?php echo $DExit_active; ?>> Activate Exit Popup
			</div>
			<input style="width:40px; margin-right:1px; display:inline;" type="text" value="http://" disabled>
			<input style="width:286px!important; margin-left:0; display:inline;" name="Exit_redirect" type="text" value="<?php echo $DExit_redirect; ?>"> Destin. page
			<br/>
			<textarea style="width:330px!important; height:180px;" class="m1px" name="Exit_text"><?php echo $DExit_text; ?></textarea> Text
            <br/>
			<input style="width:163px!important; margin:8px 1px 0 0" type="button" value="add top line (wait)" onClick="addwaitsl();">
			<input style="width:163px!important; margin:8px 0 0 0" type="button" value="add top line (regular)" onClick="addregsl();">
			<br/>
			<input style="width:330px!important; margin:4px 0 0 0" type="button" value="add bottom line" onClick="addbottomsl();">
			<br/>
			<input style="width:330px!important; margin:4px 0 0 0" type="button" value="clear text field" onClick="resettxt();">
			<div style="margin:3px 0 0 1px">
    			<input type="checkbox" name="Exit_wrap" value="on" <?php echo $DExit_wrapcheck; ?>>
    			<img id="helpbtn_exit3" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
    			<span class="exitchhelp" id="helptip_exit3">Recommended for better displaying.</span>
    			Smart text wrapping
			</div>			
			<div style="margin:3px 0 0 1px">
    			<input type="checkbox" name="Exit_stop" value="on" <?php echo $DExit_stopcheck; ?>>
    			Show 'STOP' image and message on top of the page
			</div>
			<textarea style="width:330px!important" name="Exit_stoptext"><?php echo $DExit_stoptext; ?></textarea> 'STOP' text
		</div>
            
        <div class="right_section" id="exit_checkboxes">
			<h4 class="hiddens">
				Displaying settings&nbsp;&nbsp;&nbsp;<img id="helpbtn_exit1" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_exit1">Click here to show options.</span>
			</h4>
            <div class="toggle">
				<input style="display:inline-block;" type="checkbox" name="Exit_pagelist[]" value="allpages" <?php echo $DExit_dpagesall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on page and subpages</div>
				<div class="toggle">
        		<?php
        		//list all pages and subpages
				$DExit_dpages_front="front";
				if (strpos(','.$DExit_dpages.',',',front,')!==false || $DExit_displays=="") {$DExit_dpagesch[$DExit_dpages_front]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Exit_pagelist[]" value="front" '.$DExit_dpagesch[$DExit_dpages_front].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Front page</span><br>';
				
				//do not show on search results page
				$DExit_dpages_search="search";
				if (strpos(','.$DExit_dpages.',',',search,')!==false || $DExit_displays=="") {$DExit_dpagesch[$DExit_dpages_search]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Exit_pagelist[]" value="search" '.$DExit_dpagesch[$DExit_dpages_search].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Search results page</span><br>';
				
				//do not show on author page
				$DExit_dpages_author="author";
				if (strpos(','.$DExit_dpages.',',',author,')!==false || $DExit_displays=="") {$DExit_dpagesch[$DExit_dpages_author]='checked';}
        		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        		echo '<input type="checkbox" name="Exit_pagelist[]" value="author" '.$DExit_dpagesch[$DExit_dpages_author].'>';
				echo '&nbsp;<span style="border-bottom:1px dotted #666">Author page</span><br>';
				
        		$allpages = get_pages('parent=0&sort_column=menu_order'); 
        		foreach ($allpages as $page) {
					//pages
        			$title = $page->post_title;
        			$pageID = $page->ID;
        			$theslug = $page->post_name;
 					if (strpos(','.$DExit_dpages.',',','.trim($pageID).',')!==false || $DExit_displays=="") {$DExit_dpagesch[$pageID]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Exit_pagelist[]" value="'.$pageID.'" '.$DExit_dpagesch[$pageID].'>';
					echo '&nbsp;'.$title.'<br>';
					
					//subpages
					if ($page->post_parent)	{
        				$ancestors=get_post_ancestors($page->ID);
        				$root=count($ancestors)-1;
        				$pageparent = $ancestors[$root];
        			} else {
        				$pageparent = $page->ID;
        			}
        			$children = get_pages("child_of=$pageparent&sort_column=menu_order" );
        			if ($children) {
        				foreach ($children as $child) {
        					$childtitle = $child->post_title;
        					$childID = $child->ID;
        					$childDepth = count(get_ancestors($childID, 'page'));
 							if (strpos(','.$DExit_dpages.',',','.trim($childID).',')!==false || $DExit_displays=="") {$DExit_dsubpagesch[$childID]='checked';}
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        					echo '<input type="checkbox" name="Exit_pagelist[]" value="'.$childID.'" '.$DExit_dsubpagesch[$childID].'>';
							echo '&nbsp;'.$childtitle;
        					echo '<br>';
        				}
        			}
        		}
				?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Exit_catlist[]" value="allcats" <?php echo $DExit_dcatsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on category pages</div>
				<div class="toggle">
             	<?php
        		//list all categories
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id = $cat->term_id;
 					if (strpos(','.$DExit_dcats.',',','.trim($cat_id).',')!==false || $DExit_displays=="") {$DExit_dcatsch[$cat_id]='checked';}
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<input type="checkbox" name="Exit_catlist[]" value="'.$cat_id.'" '.$DExit_dcatsch[$cat_id].'>';
					echo '&nbsp;'.$cat->name.'<br>';
        		} ?>
				</div><br>
				
				<input style="display:inline-block;" type="checkbox" name="Exit_postlist[]" value="allposts" <?php echo $DExit_dpostsall; ?>>
				<div style="display:inline; color:#069" class="hiddens">&nbsp;Do NOT show on posts</div>
				<div class="toggle">
             	<?php
        		//list all posts by category
                $cats = get_categories();
                foreach ($cats as $cat) {
                	$cat_id= $cat->term_id;
        			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        			echo '<span style="color:#CCC">'.$cat->name.'</span><br>';
                    query_posts("cat=$cat_id&post_per_page=1000");
                    if (have_posts()) { 
						while (have_posts()) {
							the_post();
                            global $id; //the page id
        					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							if (strpos(','.$DExit_dposts.',',','.trim($id).',')!==false || $DExit_displays=="") {$DExit_dpostsch[$id]='checked';}
        					echo '<input type="checkbox" name="Exit_postlist[]" value="'.$id.'" '.$DExit_dpostsch[$id].'>&nbsp;';
							echo '&nbsp;'.the_title().'<br>';
                		}
					}
        		} ?>
				</div><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				<input type="checkbox" id="exit_checkboxes_switch" <?php echo $DExit_dcheckall; ?>>
					&nbsp;<span style="color:#069; font-size:11px">Check / uncheck all</span><br>
				Start campaign on <input style="width:85px!important" class="showdelay" name="Exit_dstart" type="text" value="<?php echo $DExit_dstart; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-02-30</span><br>
				Finish campaign on <input style="width:85px!important" class="showdelay" name="Exit_dstop" type="text" value="<?php echo $DExit_dstop; ?>"> <span style="color:#AAA">year-month-day, e.g.: 2014-03-15</span>
				<!-- OR
				Show for next <input class="showdelay" name="Exit_ddays" type="text" value="<?php echo $DExit_ddays; ?>"> days<br>
				-->
				
            </div>
			
        	<h4>
				Preview&nbsp;&nbsp;&nbsp;<img id="helpbtn_exit2" src="<?php echo GenerationPlugin_images.'/info.png'; ?>">
				<span id="helptip_exit2">To preview your customized theme: point 'Preview mode...' button and then click 'Preview in new tab'.</span>
			</h4>
			<div id="exitpop1" class="preview5"><img src="<?php echo GenerationPlugin_preview; ?>/exitD1.gif"></div>
        </div>
		
		
		<div style="position:absolute; margin-top:-55px; left:893px; height:56px; z-index:999" class="saveasonhover">
    		<input name="displayingformsent_exit" type="hidden" value="Save Changes">
    		<input id="Savepreview_exit" name="Savepreview_exit" type="hidden" value="Savepreview_exit">
    		<?php if ($user_level>9 && $DPreview=='on') { ?>
				<input onClick="javascript:document.getElementById('Savepreview_exit').disabled=true;" style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		<div style="position:absolute; display:none; z-index:99" class="saveasshow">
            		<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges_preview.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
        		</div>
    		<?php } else { ?>
				<input style="background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
			<?php } ?>
		</div>


</form>
</div> 