var $jj = jQuery.noConflict();


<!-- FIX VIDEO OVERLAY FOR FANCYBOX -->
<!-- TEMPORARY DISABLED - PROBLEM WITH WOOCOMMERCE 'ADD TO BASKET' BUTTONS -->
$dd(document).ready(function() { //change $dd to $jj to enable
    $dd("iframe").each(function(){ //change $dd to $jj to enable
        var ifr_source = $jj(this).attr('src');
        var wmode = "wmode=transparent";
        if(ifr_source.indexOf('?') != -1) {
            var getQString = ifr_source.split('?');
            var oldString = getQString[1];
            var newString = getQString[0];
            $jj(this).attr('src',newString+'?'+wmode+'&'+oldString);
        }
        else $jj(this).attr('src',ifr_source+'?'+wmode);
    });
});


<!-- DISPLAY BOX AND CONTENT IN CENTER -->
var script = {
        boxMiddle: function() {
            if( $jj('.GP_box.GP_middle').length > 0) {
                height = $jj(window).height();
                width = $jj(window).width();
                box_top = (height - $jj('.GP_box.GP_middle').height()) / 2;
                box_left = (width - $jj('.GP_box.GP_middle').width()) / 2;
                $jj('.GP_box.GP_middle').css({
                    'top': box_top,
                    'left': box_left
                });
            } 
        },
        boxVertical: function() {
            if( $jj('.GP_box.GP_vertical').length > 0) {
                height = $jj(window).height();
                width = $jj(window).width();
                $jj('.GP_box.GP_vertical .GP_container').css({
                    'height': height
                });
                $jj('.GP_box.GP_slide_box.GP_vertical .GP_container').css({
                    'paddingTop': 0,
                    'paddingBottom': 0
                });
                height_inside_vertical_inside = $jj('.GP_box.GP_slide_box.GP_vertical .GP_container .GP_inside').height();
                height_inside_vertical = $jj('.GP_box.GP_slide_box.GP_vertical .GP_container').height();
                box_vertical_top = (height_inside_vertical_inside - height_inside_vertical) /2;
                if( box_vertical_top < 0)
                {
                    box_vertical_top =  box_vertical_top * (-1);
                }
                $jj('.GP_box.GP_slide_box.GP_vertical .GP_container .GP_inside').css({
                    'top': box_vertical_top
                });
            }
        }
};

$jj(window).resize(function() {
	script.boxVertical();
	if( $jj('.GP_box.GP_middle').length > 0) {
        height = $jj(window).height();
        width = $jj(window).width();
        box_top = (height - $jj('.GP_box.GP_middle').height()) / 2;
        box_left = (width - $jj('.GP_box.GP_middle').width()) / 2;
		$jj('.GP_box.GP_middle').css({
			'top': box_top,
			'left': box_left
		});
	}
});


//Display popups always in center
//$jj(document).ready(function(){			   
	//$jj(window).resize(function(){
    	//$jj('#fancyboxwrap').css({
        	//position:'fixed',
            //left: ($jj(window).width() - $jj('#fancyboxwrap').outerWidth())/2,
            //top: ($jj(window).height() - $jj('#fancyboxwrap').outerHeight())/2
        //});
    //});
	//$jj(window).resize();
//});