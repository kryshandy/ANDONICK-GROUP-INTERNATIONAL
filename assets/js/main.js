/**
 * ANDONICK Group International — Interactions premium.
 * Menu mobile, scrollspy, reveal au scroll, compteurs animés,
 * barre de progression, bouton retour en haut, formulaire AJAX.
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {

		/* ============ Menu mobile + overlay ============ */
		var toggle = document.getElementById('navToggle');
		var nav = document.getElementById('mainNav');
		var overlay = document.getElementById('navOverlay');

		function closeNav() {
			nav.classList.remove('open');
			toggle.classList.remove('open');
			toggle.setAttribute('aria-expanded', 'false');
			overlay.classList.remove('open');
			document.body.style.overflow = '';
		}

		function openNav() {
			nav.classList.add('open');
			toggle.classList.add('open');
			toggle.setAttribute('aria-expanded', 'true');
			overlay.classList.add('open');
			document.body.style.overflow = 'hidden';
		}

		if (toggle && nav && overlay) {
			toggle.addEventListener('click', function () {
				nav.classList.contains('open') ? closeNav() : openNav();
			});
			overlay.addEventListener('click', closeNav);
			nav.querySelectorAll('a').forEach(function (link) {
				link.addEventListener('click', closeNav);
			});
			document.addEventListener('keydown', function (e) {
				if (e.key === 'Escape') { closeNav(); }
			});
		}

		/* ============ Header scrolled state ============ */
		var header = document.getElementById('siteHeader');
		function onScrollHeader() {
			if (window.scrollY > 10) {
				header.classList.add('scrolled');
			} else {
				header.classList.remove('scrolled');
			}
		}
		onScrollHeader();

		/* ============ Onglets formulaire ============ */
		var tabs = document.querySelectorAll('.form-tab');
		var panels = {
			devis: document.getElementById('panel-devis'),
			rappel: document.getElementById('panel-rappel'),
		};
		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				tabs.forEach(function (t) { t.classList.remove('active'); });
				tab.classList.add('active');
				Object.keys(panels).forEach(function (key) {
					if (panels[key]) {
						panels[key].hidden = (key !== tab.dataset.tab);
					}
				});
			});
		});

		/* ============ Toast ============ */
		function showToast(message) {
			var toast = document.getElementById('toast');
			if (!toast) { return; }
			toast.textContent = message;
			toast.classList.add('show');
			setTimeout(function () {
				toast.classList.remove('show');
			}, 5000);
		}

		/* ============ Soumission AJAX des formulaires ============ */
		document.querySelectorAll('.andonick-form').forEach(function (form) {
			form.addEventListener('submit', function (e) {
				if (typeof window.AndonickData === 'undefined') { return; }
				e.preventDefault();
				var submitBtn = form.querySelector('button[type="submit"]');
				var original = submitBtn ? submitBtn.textContent : '';
				if (submitBtn) { submitBtn.textContent = '…'; submitBtn.disabled = true; }
				var data = new FormData(form);
				fetch(window.AndonickData.ajaxUrl, {
					method: 'POST',
					credentials: 'same-origin',
					body: data,
				}).then(function () {
					form.reset();
					showToast(window.AndonickData.toast);
				}).catch(function () {
					showToast(window.AndonickData.toast);
				}).finally(function () {
					if (submitBtn) { submitBtn.textContent = original; submitBtn.disabled = false; }
				});
			});
		});

		/* ============ Scroll : progress bar + back-top ============ */
		var progress = document.getElementById('progressBar');
		var backTop = document.getElementById('backTop');
		var ticking = false;

		function onScroll() {
			var y = window.scrollY;
			var height = document.documentElement.scrollHeight - window.innerHeight;
			if (progress) {
				progress.style.width = (height > 0 ? (y / height) * 100 : 0) + '%';
			}
			if (backTop) {
				backTop.classList.toggle('show', y > 600);
			}
			onScrollHeader();
			ticking = false;
		}

		window.addEventListener('scroll', function () {
			if (!ticking) {
				window.requestAnimationFrame(onScroll);
				ticking = true;
			}
		}, { passive: true });

		if (backTop) {
			backTop.addEventListener('click', function () {
				window.scrollTo({ top: 0, behavior: 'smooth' });
			});
		}

		/* ============ Scrollspy : lien actif dans la nav ============ */
		var sections = document.querySelectorAll('main section[id]');
		var navLinks = document.querySelectorAll('.main-nav a[href^="#"]:not(.btn)');

		function spy() {
			var pos = window.scrollY + 140;
			var current = '';
			sections.forEach(function (section) {
				if (pos >= section.offsetTop) {
					current = section.id;
				}
			});
			navLinks.forEach(function (link) {
				var target = link.getAttribute('href').slice(1);
				link.classList.toggle('active', target === current);
			});
		}

		window.addEventListener('scroll', spy, { passive: true });
		spy();

		/* ============ Reveal au scroll ============ */
		var revealEls = document.querySelectorAll('.reveal');
		if ('IntersectionObserver' in window) {
			var revealObserver = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('visible');
						revealObserver.unobserve(entry.target);
					}
				});
			}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
			revealEls.forEach(function (el) { revealObserver.observe(el); });
		} else {
			revealEls.forEach(function (el) { el.classList.add('visible'); });
		}

		/* ============ Compteurs animés ============ */
		var counters = document.querySelectorAll('[data-count]');
		var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		function animateCount(el) {
			var target = parseInt(el.dataset.count, 10);
			var suffix = el.dataset.suffix || '';
			if (prefersReduced) {
				el.textContent = target + suffix;
				return;
			}
			var duration = 1600;
			var start = null;
			function step(ts) {
				if (!start) { start = ts; }
				var progress = Math.min((ts - start) / duration, 1);
				var eased = 1 - Math.pow(1 - progress, 3);
				el.textContent = Math.round(eased * target) + suffix;
				if (progress < 1) {
					window.requestAnimationFrame(step);
				}
			}
			window.requestAnimationFrame(step);
		}

		if ('IntersectionObserver' in window && counters.length) {
			var countObserver = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						animateCount(entry.target);
						countObserver.unobserve(entry.target);
					}
				});
			}, { threshold: 0.4 });
			counters.forEach(function (el) { countObserver.observe(el); });
		} else {
			counters.forEach(function (el) {
				el.textContent = el.dataset.count + (el.dataset.suffix || '');
			});
		}
	});
})();