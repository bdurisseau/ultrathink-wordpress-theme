/**
 * Lots of Help — Main JavaScript
 *
 * Enhancement, not requirement.
 * Progressive, not aggressive.
 * Graceful, never jarring.
 *
 * @package LotsOfHelp
 * @since 1.0.0
 */

(function() {
	'use strict';

	/**
	 * Smooth Scroll for Anchor Links
	 *
	 * When clicking internal anchors, scroll smoothly.
	 * Feels more intentional, less mechanical.
	 */
	function initSmoothScroll() {
		const links = document.querySelectorAll('a[href^="#"]');

		links.forEach(link => {
			link.addEventListener('click', function(e) {
				const href = this.getAttribute('href');

				// Skip if it's just "#"
				if (href === '#') return;

				const target = document.querySelector(href);

				if (target) {
					e.preventDefault();
					target.scrollIntoView({
						behavior: 'smooth',
						block: 'start'
					});

					// Update URL without jumping
					history.pushState(null, null, href);
				}
			});
		});
	}

	/**
	 * Enhanced Focus States
	 *
	 * Show focus outlines only for keyboard navigation.
	 * Accessibility without visual clutter.
	 */
	function initFocusStates() {
		let isUsingKeyboard = false;

		// Detect keyboard usage
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Tab') {
				isUsingKeyboard = true;
				document.body.classList.add('using-keyboard');
			}
		});

		// Detect mouse usage
		document.addEventListener('mousedown', function() {
			isUsingKeyboard = false;
			document.body.classList.remove('using-keyboard');
		});
	}

	/**
	 * Reading Progress Indicator
	 *
	 * On single posts, show how far through the story readers are.
	 * Subtle encouragement to continue.
	 */
	function initReadingProgress() {
		// Only on single posts
		if (!document.body.classList.contains('single-post')) return;

		// Create progress bar
		const progressBar = document.createElement('div');
		progressBar.className = 'reading-progress';
		progressBar.innerHTML = '<div class="reading-progress-bar"></div>';
		document.body.prepend(progressBar);

		const bar = progressBar.querySelector('.reading-progress-bar');

		// Update on scroll
		function updateProgress() {
			const windowHeight = window.innerHeight;
			const documentHeight = document.documentElement.scrollHeight;
			const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

			const progress = (scrollTop / (documentHeight - windowHeight)) * 100;
			bar.style.width = Math.min(progress, 100) + '%';
		}

		window.addEventListener('scroll', updateProgress, { passive: true });
		updateProgress(); // Initial call
	}

	/**
	 * External Links — Open in New Tab
	 *
	 * External links open in new tabs.
	 * Keep readers connected to the site.
	 */
	function initExternalLinks() {
		const domain = window.location.hostname;
		const links = document.querySelectorAll('a[href^="http"]');

		links.forEach(link => {
			if (!link.href.includes(domain)) {
				link.setAttribute('target', '_blank');
				link.setAttribute('rel', 'noopener noreferrer');
			}
		});
	}

	/**
	 * Initialize All Enhancements
	 *
	 * Wait for DOM to be ready, then enhance.
	 */
	function init() {
		initSmoothScroll();
		initFocusStates();
		initReadingProgress();
		initExternalLinks();
	}

	// Run when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}

})();
