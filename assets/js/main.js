/**
 * ANDONICK Group International — Interactions premium.
 * Menu mobile, scrollspy, reveal au scroll, compteurs animés,
 * barre de progression, bouton retour en haut, formulaire AJAX.
 */
(function () {
	'use strict';

	/* Le contenu reste visible sans JavaScript. Cette classe n'est ajoutée que
	 * lorsque le script a effectivement démarré, avant le premier rendu utile. */
	document.documentElement.classList.add('reveal-ready');

	document.addEventListener('DOMContentLoaded', function () {
		var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		/* Cible fiable du lien d'évitement sur les gabarits intérieurs. */
		var primaryMain = document.querySelector('main');
		if (primaryMain && !primaryMain.id) {
			primaryMain.id = 'main-content';
		}
		var skipLink = document.querySelector('.skip-link');
		if (skipLink) {
			skipLink.addEventListener('click', function () {
				var target = document.querySelector(skipLink.getAttribute('href'));
				if (target) {
					target.setAttribute('tabindex', '-1');
					target.focus({ preventScroll: true });
				}
			});
		}

		/* Les tableaux larges deviennent une région atteignable au clavier. */
		document.querySelectorAll('.refs-table-wrap').forEach(function (wrap) {
			wrap.setAttribute('tabindex', '0');
			wrap.setAttribute('role', 'region');
			wrap.setAttribute('aria-label', (typeof window.AndonickData !== 'undefined' && window.AndonickData.lang === 'en') ? 'Scrollable references table' : 'Tableau des références défilant');
		});

		/* ============ Menu mobile + overlay ============ */
		var toggle = document.getElementById('navToggle');
		var nav = document.getElementById('mainNav');
		var navClose = document.getElementById('navClose');
		var overlay = document.getElementById('navOverlay');
		var drawerQuery = window.matchMedia('(max-width: 1040px)');
		var navReturnFocus = null;

		function navFocusable() {
			if (!nav) { return []; }
			return Array.prototype.slice.call(nav.querySelectorAll('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])'));
		}

		function closeNav(restoreFocus) {
			if (!nav || !toggle || !overlay) { return; }
			nav.classList.remove('open');
			toggle.classList.remove('open');
			toggle.setAttribute('aria-expanded', 'false');
			toggle.setAttribute('aria-label', toggle.dataset.openLabel || 'Menu');
			overlay.classList.remove('open');
			overlay.setAttribute('aria-hidden', 'true');
			document.body.classList.remove('nav-open');
			if (drawerQuery.matches) {
				nav.setAttribute('aria-hidden', 'true');
			} else {
				nav.removeAttribute('aria-hidden');
			}
			if (restoreFocus && navReturnFocus && typeof navReturnFocus.focus === 'function') {
				navReturnFocus.focus();
			}
		}

		function openNav() {
			if (!nav || !toggle || !overlay) { return; }
			navReturnFocus = document.activeElement;
			nav.classList.add('open');
			toggle.classList.add('open');
			toggle.setAttribute('aria-expanded', 'true');
			toggle.setAttribute('aria-label', toggle.dataset.closeLabel || 'Menu');
			nav.setAttribute('aria-hidden', 'false');
			overlay.classList.add('open');
			overlay.setAttribute('aria-hidden', 'false');
			document.body.classList.add('nav-open');
			window.setTimeout(function () {
				var focusable = navFocusable();
				if (focusable.length) { focusable[0].focus(); }
			}, 30);
		}

		function syncNavMode() {
			if (!nav || !toggle) { return; }
			if (drawerQuery.matches) {
				if (!nav.classList.contains('open')) { nav.setAttribute('aria-hidden', 'true'); }
			} else {
				closeNav(false);
				nav.removeAttribute('aria-hidden');
			}
		}

		if (toggle && nav && overlay) {
			syncNavMode();
			toggle.addEventListener('click', function () {
				nav.classList.contains('open') ? closeNav(true) : openNav();
			});
			overlay.addEventListener('click', function () { closeNav(true); });
			if (navClose) { navClose.addEventListener('click', function () { closeNav(true); }); }
			nav.querySelectorAll('a').forEach(function (link) {
				link.addEventListener('click', function () { closeNav(true); });
			});
			document.addEventListener('keydown', function (e) {
				if (!nav.classList.contains('open')) { return; }
				if (e.key === 'Escape') {
					e.preventDefault();
					closeNav(true);
				} else if (e.key === 'Tab') {
					var focusable = navFocusable();
					if (!focusable.length) { return; }
					var first = focusable[0];
					var last = focusable[focusable.length - 1];
					if (e.shiftKey && document.activeElement === first) {
						e.preventDefault();
						last.focus();
					} else if (!e.shiftKey && document.activeElement === last) {
						e.preventDefault();
						first.focus();
					}
				}
			});
			if (drawerQuery.addEventListener) { drawerQuery.addEventListener('change', syncNavMode); }
			else { drawerQuery.addListener(syncNavMode); }
		}

		/* ============ Header scrolled state ============ */
		var header = document.getElementById('siteHeader');
		function onScrollHeader() {
			if (!header) { return; }
			if (window.scrollY > 10) {
				header.classList.add('scrolled');
			} else {
				header.classList.remove('scrolled');
			}
		}
		onScrollHeader();

		/* ============ Onglets formulaire ============ */
		var tabs = Array.prototype.slice.call(document.querySelectorAll('.form-tab'));
		var panels = {
			devis: document.getElementById('panel-devis'),
			rappel: document.getElementById('panel-rappel'),
		};
		function activateTab(tab, moveFocus) {
			if (!tab) { return; }
				tabs.forEach(function (t) {
					t.classList.remove('active');
					t.setAttribute('aria-selected', 'false');
					t.setAttribute('tabindex', '-1');
				});
				tab.classList.add('active');
				tab.setAttribute('aria-selected', 'true');
				tab.setAttribute('tabindex', '0');
				Object.keys(panels).forEach(function (key) {
					if (panels[key]) {
						panels[key].hidden = (key !== tab.dataset.tab);
					}
				});
				if (moveFocus) { tab.focus(); }
		}
		tabs.forEach(function (tab) {
			tab.setAttribute('tabindex', tab.getAttribute('aria-selected') === 'true' ? '0' : '-1');
			tab.addEventListener('click', function () {
				activateTab(tab, false);
			});
			tab.addEventListener('keydown', function (e) {
				var index = tabs.indexOf(tab);
				var next = null;
				if (e.key === 'ArrowRight' || e.key === 'ArrowDown') { next = tabs[(index + 1) % tabs.length]; }
				else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') { next = tabs[(index - 1 + tabs.length) % tabs.length]; }
				else if (e.key === 'Home') { next = tabs[0]; }
				else if (e.key === 'End') { next = tabs[tabs.length - 1]; }
				if (next) {
					e.preventDefault();
					activateTab(next, true);
				}
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

		/* Retour après soumission classique : le serveur a validé, enregistré
		 * la demande puis redirigé vers le formulaire. */
		if (typeof window.AndonickData !== 'undefined' && window.AndonickData.formFeedback) {
			showToast(window.AndonickData.formFeedback);
			if (window.history && window.history.replaceState) {
				var cleanUrl = new URL(window.location.href);
				cleanUrl.searchParams.delete('andonick_form');
				window.history.replaceState({}, document.title, cleanUrl.toString());
			}
		}

		/* ============ Ancres internes : si la section n'existe pas sur cette page (ex. article de blog), on va sur l'accueil avec l'ancre — comme la référence ============ */
		document.addEventListener('click', function (e) {
			var a = e.target && e.target.closest ? e.target.closest('a[href^="#"]') : null;
			if (!a) { return; }
			var id = a.getAttribute('href').slice(1);
			if (!id) { return; }
			if (document.getElementById(id)) { return; }
			e.preventDefault();
			var base = (typeof window.AndonickData !== 'undefined' && window.AndonickData.frontUrl) ? window.AndonickData.frontUrl : '/';
			var lang = (typeof window.AndonickData !== 'undefined') ? window.AndonickData.lang : '';
			window.location.href = base + (lang === 'en' ? '?lang=en' : '') + '#' + id;
		});

		/* ============ Sélecteur de langue : on reste sur la section en cours ============ */
		document.querySelectorAll('.lang-switch a').forEach(function (link) {
			link.addEventListener('click', function (e) {
				var hash = window.location.hash || '';
				var href = link.getAttribute('href');
				if (href && href.indexOf('#') === -1) {
					e.preventDefault();
					window.location.href = href + hash;
				}
			});
		});

		/* ============ Soumission des formulaires ============
		 * Le navigateur effectue une soumission WordPress classique. Cela évite
		 * d'annoncer un succès lorsque le serveur ou le SMTP a échoué. */
		document.querySelectorAll('.andonick-form').forEach(function (form) {
			form.addEventListener('submit', function () {
				var submitBtn = form.querySelector('button[type="submit"]');
				if (submitBtn) {
					submitBtn.disabled = true;
					submitBtn.setAttribute('aria-busy', 'true');
				}
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
				window.scrollTo({ top: 0, behavior: prefersReduced ? 'auto' : 'smooth' });
			});
		}

		/* ============ Scrollspy : lien actif dans la nav ============ */
		var sections = document.querySelectorAll('main section[id]');
		var navLinks = document.querySelectorAll('.main-nav a:not(.btn)');

		function navHash(link) {
			try {
				var url = new URL(link.href, window.location.href);
				return (url.origin === window.location.origin && url.pathname === window.location.pathname) ? url.hash.slice(1) : '';
			} catch (err) {
				return '';
			}
		}

		function spy() {
			var pos = window.scrollY + 140;
			var current = '';
			sections.forEach(function (section) {
				if (pos >= section.offsetTop) {
					current = section.id;
				}
			});
			navLinks.forEach(function (link) {
				var target = navHash(link);
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

		function animateCount(el) {
			var target = parseInt(el.dataset.count, 10);
			var suffix = el.dataset.suffix || '';
			if (prefersReduced) {
				el.textContent = target + suffix;
				return;
			}
			var duration = (typeof window.AndonickData !== 'undefined' && window.AndonickData.counterDuration)
				? parseInt(window.AndonickData.counterDuration, 10)
				: 1600;
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

		/* ============ Bandeau cookies (RGPD) ============ */
		var cookieBanner = document.getElementById('cookieBanner');
		if (cookieBanner) {
			var cookieChoice = null;
			try {
				cookieChoice = window.localStorage.getItem('andonick_cookies');
			} catch (e) { /* stockage indisponible : bandeau affiché à chaque visite */ }
			if (cookieChoice) {
				cookieBanner.remove();
			} else {
				window.setTimeout(function () { cookieBanner.classList.add('open'); }, 600);
				cookieBanner.querySelectorAll('button[data-cookie]').forEach(function (btn) {
					btn.addEventListener('click', function () {
						try {
							window.localStorage.setItem('andonick_cookies', btn.dataset.cookie);
						} catch (e) { /* ignore */ }
						cookieBanner.classList.remove('open');
						window.setTimeout(function () { cookieBanner.remove(); }, 450);
					});
				});
			}
		}

		/* ============ Lightbox galerie ============ */
		var galleryLinks = Array.prototype.slice.call(document.querySelectorAll('.gallery-link'));
		if (galleryLinks.length) {
			var lb = null;
			var lbState = { items: galleryLinks, index: 0 };
			var lbTrigger = null;
			var isEnglish = typeof window.AndonickData !== 'undefined' && window.AndonickData.lang === 'en';

			function lbBuild() {
				lb = document.createElement('div');
				lb.className = 'lightbox';
				lb.setAttribute('role', 'dialog');
				lb.setAttribute('aria-modal', 'true');
				lb.setAttribute('aria-label', isEnglish ? 'Project image viewer' : 'Visionneuse des réalisations');
				lb.innerHTML =
					'<button type="button" class="lightbox-close" aria-label="' + (isEnglish ? 'Close' : 'Fermer') + '">&times;</button>' +
					'<button type="button" class="lightbox-prev" aria-label="' + (isEnglish ? 'Previous' : 'Précédente') + '">&lsaquo;</button>' +
					'<button type="button" class="lightbox-next" aria-label="' + (isEnglish ? 'Next' : 'Suivante') + '">&rsaquo;</button>' +
					'<div class="lightbox-count"></div>' +
					'<img alt="" decoding="async">' +
					'<div class="lightbox-caption"></div>';
				document.body.appendChild(lb);
				if (lbState.items.length < 2) {
					lb.querySelector('.lightbox-prev').hidden = true;
					lb.querySelector('.lightbox-next').hidden = true;
				}
				lb.querySelector('.lightbox-close').addEventListener('click', lbClose);
				lb.querySelector('.lightbox-prev').addEventListener('click', function () { lbShow(lbState.index - 1); });
				lb.querySelector('.lightbox-next').addEventListener('click', function () { lbShow(lbState.index + 1); });
				lb.addEventListener('click', function (e) {
					if (e.target === lb) { lbClose(); }
				});
				document.addEventListener('keydown', lbKey);
			}

			function lbShow(index) {
				if (!lb) { lbBuild(); }
				var total = lbState.items.length;
				lbState.index = (index + total) % total;
				var link = lbState.items[lbState.index];
				var img = link.querySelector('img');
				lb.querySelector('img').src = link.getAttribute('href');
				lb.querySelector('img').alt = img ? img.alt : '';
				lb.querySelector('.lightbox-caption').textContent = img ? img.alt : '';
				lb.querySelector('.lightbox-count').textContent = (lbState.index + 1) + ' / ' + total;
				lb.classList.add('open');
				document.body.classList.add('lightbox-open');
				lb.querySelector('.lightbox-close').focus();
			}

			function lbClose() {
				if (!lb) { return; }
				lb.classList.remove('open');
				document.body.classList.remove('lightbox-open');
				document.removeEventListener('keydown', lbKey);
				if (lbTrigger) { lbTrigger.focus(); }
				window.setTimeout(function () {
					if (lb) { lb.remove(); lb = null; }
				}, 300);
			}

			function lbKey(e) {
				if (!lb || !lb.classList.contains('open')) { return; }
				if (e.key === 'Escape') { lbClose(); }
				else if (e.key === 'ArrowLeft') { lbShow(lbState.index - 1); }
				else if (e.key === 'ArrowRight') { lbShow(lbState.index + 1); }
				else if (e.key === 'Tab') {
					var controls = Array.prototype.slice.call(lb.querySelectorAll('button:not([hidden])'));
					var first = controls[0];
					var last = controls[controls.length - 1];
					if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
					else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
				}
			}

			galleryLinks.forEach(function (link, index) {
				var baseLabel = link.getAttribute('aria-label') || (isEnglish ? 'Enlarge image' : 'Agrandir l’image');
				link.setAttribute('aria-label', baseLabel + ' ' + (index + 1) + ' / ' + galleryLinks.length);
				link.addEventListener('click', function (e) {
					e.preventDefault();
					lbTrigger = link;
					lbShow(index);
				});
			});
		}
	});
})();
