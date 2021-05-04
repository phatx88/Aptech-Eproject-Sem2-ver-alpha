function checkAll(check_all) {
	$(check_all).change(function () {
		var checkboxes = $(this).closest('table').find(':checkbox');
		checkboxes.prop('checked', $(this).is(':checked'));
	});
}

// Add slideup & fadein animation to dropdown
$('.dropdown').on('show.bs.dropdown', function (e) {
	var $dropdown = $(this).find('.dropdown-menu');
	var orig_margin_top = parseInt($dropdown.css('margin-top'));
	$dropdown.css({ 'margin-top': (orig_margin_top + 10) + 'px', opacity: 0 }).animate({ 'margin-top': orig_margin_top + 'px', opacity: 1 }, 100, function () {
		$(this).css({ 'margin-top': '' });
	});
});
// Add slidedown & fadeout animation to dropdown
$('.dropdown').on('hide.bs.dropdown', function (e) {
	var $dropdown = $(this).find('.dropdown-menu');
	var orig_margin_top = parseInt($dropdown.css('margin-top'));
	$dropdown.css({ 'margin-top': orig_margin_top + 'px', opacity: 1, display: 'block' }).animate({ 'margin-top': (orig_margin_top + 10) + 'px', opacity: 0 }, 100, function () {
		$(this).css({ 'margin-top': '', display: '' });
	});
});

/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
//Fire Function only when user start scrolling
let didScroll

$(window).scroll(function (event) {
	didScroll = true
});

//Wait for Document to load before scrolling
setInterval(function () {
	if (didScroll) {
		let prevScrollpos = window.pageYOffset
		window.onscroll = function () {
			const currentScrollPos = window.pageYOffset
			if (prevScrollpos > currentScrollPos) {
				document.getElementById('navbar').style.top = '0'
			} else {
				document.getElementById('navbar').style.top = '-57px'
			}
			prevScrollpos = currentScrollPos
		}
		didScroll = false
	}
}, 500);
