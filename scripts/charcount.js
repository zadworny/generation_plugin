(function($jj) {

	$jj.fn.charCount = function(options){
		// default configuration properties
		var defaults = {	
			allowed: 140,		
			warning: 25,
			css: 'counter',
			counterElement: 'span',
			cssWarning: 'warning',
			cssExceeded: 'exceeded',
			counterText: ''
		}; 
		var options = $jj.extend(defaults, options); 

		function calculate(obj){
			var count = $jj(obj).val().length;
			var available = options.allowed - count;
			if(available <= options.warning && available >= 0){
				$jj(obj).next().addClass(options.cssWarning);
			} else {
				$jj(obj).next().removeClass(options.cssWarning);
			}
			if(available < 0){
				$jj(obj).next().addClass(options.cssExceeded);
			} else {
				$jj(obj).next().removeClass(options.cssExceeded);
			}
			$jj(obj).next().html(options.counterText + available);
		};

		this.each(function() {  			
			$jj(this).after('&nbsp;<'+ options.counterElement +' class="' + options.css + '">'+ options.counterText +'</'+ options.counterElement +'>&nbsp;');
			calculate(this);
			$jj(this).keyup(function(){calculate(this)});
			$jj(this).change(function(){calculate(this)});
		});
	};

})(jQuery);