<?php
if (isset($_POST['createbackup'])) {
	 global $wpdb;
	 $table_name = $wpdb->prefix . 'GenerationPlugin_';
     
     //get all of the tables
	 $sql = "SHOW TABLES LIKE '%".$table_name."%'";
     $results = $wpdb->get_results($sql);
     foreach ($results as $index => $value) {
         foreach ($value as $tableName) {
             $tables[] = $tableName;
         }
     }
     //cycle through
     foreach ($tables as $table) {
         $result = $wpdb->get_results("SELECT * FROM ".$table, ARRAY_N); //ARRAY_A for keys and values
         $num_fields = count($wpdb->last_result);
         $return.= 'DROP TABLE '.$table.';;;';

		 $table1 = strpos($table,"GENERAL");
		 $table2 = strpos($table,"LIGHTBOX");
		 $table3 = strpos($table,"SLIDER");
		 $table4 = strpos($table,"HEADER");
		 $table5 = strpos($table,"FOOTER");
		 $table6 = strpos($table,"REGULAR");
		 $table7 = strpos($table,"INSIDER");
		 $table8 = strpos($table,"REGISTER");
		 $table9 = strpos($table,"EXIT");
		 
		 if ($table1!==false) {$create=gp_create1;}
		 elseif ($table2!==false) {$create=gp_create2;}
		 elseif ($table3!==false) {$create=gp_create3;}
		 elseif ($table4!==false) {$create=gp_create4;}
		 elseif ($table5!==false) {$create=gp_create5;}
		 elseif ($table6!==false) {$create=gp_create6;}
		 elseif ($table7!==false) {$create=gp_create7;}
		 elseif ($table8!==false) {$create=gp_create8;}
		 elseif ($table9!==false) {$create=gp_create9;}
		 
         $return.= "\n\n".$create.";;\n\n";
         foreach ($result as $newrow) {
             $return.= 'INSERT INTO '.$table.' VALUES(';
			 $record = array();
             foreach ($newrow as $row) {
                 $row = addslashes($row);
                 $row = ereg_replace("\n","\\n",$row);
                 if ($row!=NULL) { $record[] = '"'.$row.'"'; } else { $record[] = '""'; }
             }
             $records = implode(',',$record);
			 $return.= $records;
             $return.= ");;;\n";
         }
         $return.="\n\n\n";
     }
	 
     //save file
	 $version = '_'.GenerationPlugin_version.'_';
     $date = date('d.M.Y_');
     $time = date('H.i.s');
	 $filename = GenerationPlugin_uploads.'generationpluginbackup'.$version.$date.$time.'.sql';
     $handle = fopen($filename,'w');
     fwrite($handle,$return);
     fclose($handle);
}
if (isset($_POST['deletebackup'])) { //delete this file
	$file = $_POST['deletebackup'];
	$start = strpos($file,"generationpluginbackup");
	$file = substr($file,$start);
	$file = GenerationPlugin_uploads.$file;
	unlink($file);
}
if (isset($_POST['restorebackup'])) {
	$file = $_POST['restorebackup'];
	$start = strpos($file,"generationpluginbackup");
	$file = substr($file,$start);
	$file = GenerationPlugin_uploads.$file;

    /* Read the file */
    $lines = file($file);
    $scriptfile = false;
    
    /* Get rid of the comments and form one jumbo line */
    foreach ($lines as $line) {
        $line = trim($line);
        if (!preg_match('/^--/', $line)) {
        	$scriptfile.=" ".$line;
        }
    }
    
    /* Split the jumbo line into smaller lines */
    $queries = explode(';;;', $scriptfile);
    
    /* Run each line as a query */
    foreach ($queries as $query) {
		$query = trim($query);
        if ($query=="") { continue; }
		$query = trim($query).";";
		$wpdb->get_results($query);
    }
}
if (isset($_POST['restorebackupfromfile'])) {
    $addtorestorelist = $_POST['addtorestorelist'];
    $restorefile = $_FILES['restorefile']['name'];
    $restorepath = GenerationPlugin_uploads.basename($restorefile);
	$file = $restorepath;
	
	/* check if file already exists */
    $dir=opendir(GenerationPlugin_uploads);
	$findfile = basename($restorefile);
    while (false!==($filename=readdir($dir))) {$files[]=$filename;} 
	$restorefiles = implode(';',$files);
	$searchforfile = strpos($restorefiles,$findfile);
	
    move_uploaded_file($_FILES['restorefile']['tmp_name'], $restorepath);
	
	/* Read the file */
    $lines = file($file);
    $scriptfile = false;
    
    /* Get rid of the comments and form one jumbo line */
    foreach ($lines as $line) {
        $line = trim($line);
        if (!preg_match('/^--/', $line)) {
        	$scriptfile.=" ".$line;
        }
    }
    
    /* Split the jumbo line into smaller lines */
    $queries = explode(';;;', $scriptfile);
    
    /* Run each line as a query */
    foreach ($queries as $query) {
		$query = trim($query);
        if ($query=="") { continue; }
		$query = trim($query).";";
		$wpdb->get_results($query);
    }
	if ($addtorestorelist!='on' && $searchforfile===false) {unlink($file);}
}
if (isset($_POST['defaultreset']) && $_POST['confirmreset']=='on') {
	 global $wpdb;
	 $table_name = $wpdb->prefix . 'GenerationPlugin_';
	 $table_name_general = $wpdb->prefix . 'GenerationPlugin_GENERAL';
	 $myemail = $wpdb->get_var('SELECT Myemail FROM '.$table_name_general.' WHERE id=1');
     
     //get all of the tables
	 $sql = "SHOW TABLES LIKE '%".$table_name."%'";
     $results = $wpdb->get_results($sql);
     foreach ($results as $index => $value) {
         foreach ($value as $tableName) {
             $tables[] = $tableName;
         }
     }
     //cycle through
     foreach ($tables as $table) {
         $results1 = $wpdb->get_results("TRUNCATE TABLE ".$table);
         $results2 = $wpdb->get_results("ALTER TABLE ".$table." AUTO_INCREMENT=1");
   		 $wpdb->insert($table, array('id'=>'1'), array('%d'));
   		 $wpdb->insert($table, array('id'=>'9999'), array('%d'));
     }
	 $wpdb->update($table_name_general, array('Myemail'=>trim($myemail)),array('id'=>'1'));
     $wpdb->get_results("DELETE FROM ".$table_name_general." WHERE id='9999'"); 
}
?>

<script type="text/javascript">
function checkedornot(){
    if (document.getElementById('confirmreset').checked){
        document.getElementById('defaultreset').type="submit";
    }else{
    	document.getElementById('defaultreset').type="button";
    }
}
</script>
		
		
		
		
		
		<div id="tab12" class="tab_content" style="display:none; padding:0!important">
		
		<form action="<?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" method="post"  enctype="multipart/form-data">
		
    	<input type="hidden" name="License" value="Multisite">
    	<input type="hidden" name="done" value="processed">
		<input type="hidden" id="gpkeepuserdetails_test" value="<?php echo $DAutoins; ?>">
		<input type="hidden" name="generalformsent">
		
		<div style="display:table-row">
		<div style="width:472px; background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center; width:442px!important">
				Create and restore backups
			</div>
			<span class="gendesc">
				'Create backup' button creates a backup (adds it to the list below).<br>
				'Browse' and 'Restore' buttons upload and restores a backup from file.<br>
				Your uploaded custom backgrounds and product images will NOT be included in your backups! You can copy these files manually from 'wp-content > uploads' on your ftp server.<br>
			</span>
			<br>
			<div style="text-align:center; margin-top:0px">
				<img style="margin:0 10px -11px 0" src="<?php echo GenerationPlugin_images.'/backup.png'; ?>">
        		<input style="width:352px; height:35px" type="submit" name="createbackup" value="Create Backup">
				<br>
    			<img style="margin:0 10px -11px 0" src="<?php echo GenerationPlugin_images.'/restore.png'; ?>">
    			<input style="height:35px; margin-right:0" type="file" name="restorefile">
    			<input style="width:150px; height:35px; margin-left:-30px" type="submit" name="restorebackupfromfile" value="Restore Backup">
			</div>
			<input style="margin-left:82px" type="checkbox" name="addtorestorelist"> Add this file to my backup list
		</div>
		<div style="width:472px; background-color:white; height:auto!important" class="generalbox">
			<div class="gactivate" style="text-align:center; width:442px!important">
				List of all backups
			</div>
			<?php
                $dir = substr(GenerationPlugin_uploads,0,-1);
                $files = array();
                clearstatcache();
                $dh = opendir($dir);
                while (($file = readdir($dh)) !== false) {
                    if ($file!="." && $file!=".." && $file!="..." && substr($file,0,22)=='generationpluginbackup') {
                    	$ts = filemtime(getcwd() . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $file);
                    	$files['K' . $ts] = $file;
					}
                }
                closedir($dh);
                krsort($files);
				
                $files = array_slice($files, 0, 100);
                foreach ($files as $date => $file)
                {
					$p = explode('_',$file);
					$path = GenerationPlugin_uploads.$file;
					$size = filesize($path)/1024;
					$size = round($size,2)." KB";
					$time = str_replace('.',':',$p[3]);
					$date = str_replace('.',' ',$p[2]).' '.substr($time,0,-4);
					$new = '<div style="float:left; width:175px">'.$date.'</div>';
					$new.= '<div style="float:left; width:120px">Version '.$p[1].'</div>';
					$new.= '<div style="float:left; width:90px">'.$size.'</div>';
					$new.= '<div style="float:left; text-align:right; width:85px; margin-top:0px">';
						$new.= '<input title="Restore" ';
						$new.= 'value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$file.'" ';
						$new.= 'type="submit" name="restorebackup" style="cursor:pointer; height:16px; width:18px; ';
						$new.= 'background:transparent no-repeat; text-decoration:underline; ';
						$new.= 'background-image:url('.GenerationPlugin_images.'/tm_restore.png); color:#069; border:none">';
						$new.= '<a style="background:transparent no-repeat; height:16px; width:16px; text-decoration:none ';
						$new.= '" title="Download" href="'.$path.'">';
							$new.= '<img style="margin:0 3px 0 6px" src="'.GenerationPlugin_images.'/tm_download.png">';
						$new.= '</a>&nbsp;&nbsp;';
						$new.= '<input title="Delete" ';
						$new.= 'value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$file.'" ';
						$new.= 'type="submit" name="deletebackup" style="cursor:pointer; height:16px; width:16px; ';
						$new.= 'background:transparent no-repeat; text-decoration:underline; ';
						$new.= 'background-image:url(\''.GenerationPlugin_images.'/tm_delete.png\'); color:#069; border:none">';
					$new.= '</div>';
					echo $new.'<br>';
                }
            ?>
		</div>
		</div>
		
		<div style="display:table-row">
		<div style="width:472px; background-color:white" class="generalbox">
			<div class="gactivate" style="text-align:center; width:442px!important; background-color:#F66; color:#FFF">
				Reset all settings to default
			</div>
			<span style="color:red">Warning!</span>&nbsp;&nbsp;
			<span class="gendesc">
				Use this function carefully! It will erase all your settings except backups.
				We highly recommend to create a backup before use this function.
			</span>
			<div style="text-align:left; margin-top:25px">
    			<div style="display:inline-block; float:left; background-color:#FCC; width:33px; height:33px; text-align:center; border:none; margin-right:10px">
    				<input style="margin-top:9px" type="checkbox" name="confirmreset" id="confirmreset" onClick="checkedornot()">
    			</div>
				<span style="color:red">Yes, I am sure I want to reset all my 'Generation Plugin' settings to default and I understand I can NOT undo this step. I have created a backup.</span>
			</div>
			<div style="text-align:center">
    			<input style="height:35px; width:352px; margin-top:45px" type="button" name="defaultreset" id="defaultreset" value="Reset All The Settings To Default">
			</div>
		</div>
		</div>
		
		<div style="position:absolute; margin-top:-105px; left:320px; height:56px; z-index:999" class="saveasonhover">
    		<input name="generalformsent_timemachine" type="hidden" value="Save Changes">
    		<input style="display:none; background-image:url('<?php echo GenerationPlugin_images; ?>/savechanges.png'); min-height:50px; border-top:0" class="menu_tabs_dark" value="" type="submit">
		</div>
				
		</form>
		</div>