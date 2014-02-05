jQuery(function($) {
	$.urlParam = function(name){
	    var results = new RegExp('[\\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
	    return results[1] || 0;
	}
	var marchex = $.urlParam('utm_source');
	$.cookie('marchex', marchex, { expires: 30, path: '/' });
});