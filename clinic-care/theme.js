/* Clinic Care: mobile navigation. */
(function () {
	'use strict';
	document.documentElement.classList.add('cp-js');

	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('primary-nav');
	if (!toggle || !nav) { return; }

	function setOpen(open) {
		nav.classList.toggle('is-open', open);
		toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
	}

	toggle.addEventListener('click', function () {
		setOpen(toggle.getAttribute('aria-expanded') !== 'true');
	});

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && nav.classList.contains('is-open')) {
			setOpen(false);
			toggle.focus();
		}
	});

	nav.addEventListener('click', function (e) {
		if (e.target.closest('a')) { setOpen(false); }
	});

	document.addEventListener('click', function (e) {
		if (nav.classList.contains('is-open') && !nav.contains(e.target) && !toggle.contains(e.target)) { setOpen(false); }
	});

	window.matchMedia('(min-width: 1000px)').addEventListener('change', function (m) {
		if (m.matches) { setOpen(false); }
	});
})();
