function checkAll(check_all) {
	$(check_all).change(function() {
	    var checkboxes = $(this).closest('table').find(':checkbox');
	    checkboxes.prop('checked', $(this).is(':checked'));
	});
}

// Add slideup & fadein animation to dropdown
$('.dropdown').on('show.bs.dropdown', function(e){
	var $dropdown = $(this).find('.dropdown-menu');
	var orig_margin_top = parseInt($dropdown.css('margin-top'));
	$dropdown.css({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}).animate({'margin-top': orig_margin_top + 'px', opacity: 1}, 100, function(){
	   $(this).css({'margin-top':''});
	});
 });
 // Add slidedown & fadeout animation to dropdown
 $('.dropdown').on('hide.bs.dropdown', function(e){
	var $dropdown = $(this).find('.dropdown-menu');
	var orig_margin_top = parseInt($dropdown.css('margin-top'));
	$dropdown.css({'margin-top': orig_margin_top + 'px', opacity: 1, display: 'block'}).animate({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}, 100, function(){
	   $(this).css({'margin-top':'', display:''});
	});
 });