jQuery(function($) {
	$.urlParam = function(name){
	    var results = new RegExp('[\\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
	    return results[1] || 0;
	}
	var marchex = $.urlParam('s_cid');
	$.cookie('marchexcid', marchex, { expires: 7, path: '/' });
});