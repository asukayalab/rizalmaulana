(() => {
 'use strict';
 const motion = matchMedia('(prefers-reduced-motion: reduce)');
 const desktop = matchMedia('(min-width: 1000px)');
 const header = document.querySelector('[data-menu]');
 if (header) {
  const toggle = header.querySelector('.menu-toggle'), panel = header.querySelector('nav');
  panel.querySelectorAll('li').forEach((li, i) => li.style.setProperty('--menu-index', i));
  const open = state => {
   toggle.setAttribute('aria-expanded', String(state)); toggle.setAttribute('aria-label', state ? 'Tutup menu' : 'Buka menu');
   header.classList.toggle('is-open', state); panel.inert = !state;
  };
  header.classList.add('menu-ready'); open(false);
  toggle.addEventListener('click', () => open(toggle.getAttribute('aria-expanded') !== 'true'));
  document.addEventListener('keydown', e => { if (e.key === 'Escape' && header.classList.contains('is-open')) { open(false); toggle.focus(); } });
  document.addEventListener('click', e => { if (!header.contains(e.target)) open(false); });
  header.addEventListener('focusout', () => requestAnimationFrame(() => { if (!header.contains(document.activeElement)) open(false); }));
  panel.addEventListener('click', e => { if (e.target.closest('a')) open(false); });
 }
 const revealElements = [...document.querySelectorAll('[data-reveal]')];
 if ('IntersectionObserver' in window && !motion.matches) {
  const observer = new IntersectionObserver(entries => entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); } }), { rootMargin: '0px 0px -30px 0px', threshold: .05 });
  document.documentElement.classList.add('js', 'reveal-ready'); revealElements.forEach(el => observer.observe(el));
  // Never leave content invisible if initialization or the observer fails later.
  window.addEventListener('beforeprint', () => revealElements.forEach(el => el.classList.add('is-visible')));
 }
 document.querySelectorAll('[data-count]').forEach(el => {
  if (motion.matches || !('IntersectionObserver' in window)) return;
  const target = Number(el.dataset.count);
  const observer = new IntersectionObserver(entries => { if (!entries[0].isIntersecting) return; observer.disconnect(); let start;
   const count = now => { start ??= now; const p = Math.min(1, (now - start) / 1200); el.textContent = String(Math.round(target * (1 - Math.pow(1 - p, 3)))); if (p < 1 && !motion.matches) requestAnimationFrame(count); else el.textContent = String(target); };
   requestAnimationFrame(count);
  }, { threshold: .5 }); observer.observe(el);
 });
 const slider = document.querySelector('[data-project-slider]');
 if (slider) {
  const slides = [...slider.querySelectorAll('.project-slide')], controls = slider.querySelector('.slider-controls');
  let index = 0, busy = false;
  const show = next => {
   if (busy || slides.length < 2) return;
   const old = index; index = (next + slides.length) % slides.length;
   if (old === index) return;
   if (slides[old].contains(document.activeElement)) slider.querySelector('[data-project-next]').focus({ preventScroll: true });
   busy = true;
   slides.forEach((el, i) => { el.inert = i !== index; el.setAttribute('aria-hidden', String(i !== index)); });
   slides[index].classList.add('is-entering'); slides[index].style.visibility = 'visible';
   slider.querySelector('[data-project-status]').textContent = `${String(index + 1).padStart(2, '0')} / ${String(slides.length).padStart(2, '0')}`;
   setTimeout(() => { slides.forEach((el, i) => { el.classList.toggle('is-active', i === index); el.classList.remove('is-entering'); el.style.visibility = i === index ? 'visible' : 'hidden'; }); busy = false; }, motion.matches ? 0 : 1000);
  };
  slides.forEach((el, i) => { el.classList.toggle('is-active', i === 0); el.inert = i !== 0; el.setAttribute('aria-hidden', String(i !== 0)); el.style.visibility = i === 0 ? 'visible' : 'hidden'; });
  slider.classList.add('slider-ready');
  if (slides.length > 1) {
   controls.hidden = false;
   slider.querySelector('[data-project-prev]').addEventListener('click', () => show(index - 1));
   slider.querySelector('[data-project-next]').addEventListener('click', () => show(index + 1));
   slider.addEventListener('keydown', e => { if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') { e.preventDefault(); show(index + (e.key === 'ArrowRight' ? 1 : -1)); } });
   let x, y;
   slider.addEventListener('touchstart', e => { x = e.changedTouches[0].clientX; y = e.changedTouches[0].clientY; }, { passive: true });
   slider.addEventListener('touchend', e => { const dx = e.changedTouches[0].clientX - x, dy = e.changedTouches[0].clientY - y; if (Math.abs(dx) > 60 && Math.abs(dx) > Math.abs(dy) * 1.5) show(index + (dx < 0 ? 1 : -1)); }, { passive: true });
  }
 }
 const approach = document.querySelector('[data-approach]');
 let selected = -1, stepButtons = [], items = [];
 const setStep = next => {
  if (!approach || next === selected) return; selected = next;
  items.forEach((item, i) => { item.classList.toggle('is-active', i === next); item.inert = i !== next; item.setAttribute('aria-hidden', String(i !== next)); });
  stepButtons.forEach((button, i) => button.setAttribute('aria-pressed', String(i === next)));
 };
 if (approach) {
  items = [...approach.querySelectorAll('.approach-item')]; stepButtons = [...approach.querySelectorAll('[data-step]')];
  approach.querySelector('.approach-pagination').hidden = false; setStep(0); approach.classList.add('approach-ready');
  stepButtons.forEach((button, i) => button.addEventListener('click', () => {
   if (desktop.matches && innerHeight > 650 && !motion.matches) {
    const track = approach.offsetHeight - innerHeight;
    window.scrollTo({ top: scrollY + approach.getBoundingClientRect().top + (i + .25) / items.length * track, behavior: 'instant' });
   }
   setStep(i);
  }));
  let x, y;
  approach.addEventListener('touchstart', e => { x = e.changedTouches[0].clientX; y = e.changedTouches[0].clientY; }, { passive: true });
  approach.addEventListener('touchend', e => { const dx = e.changedTouches[0].clientX - x, dy = e.changedTouches[0].clientY - y; if (!desktop.matches && Math.abs(dx) > 60 && Math.abs(dx) > Math.abs(dy) * 1.5) setStep(Math.min(items.length - 1, Math.max(0, selected + (dx < 0 ? 1 : -1)))); }, { passive: true });
 }
 const hero = document.querySelector('.hero-content'); let pending = false;
 const update = () => {
  pending = false;
  if (hero) { const p = Math.min(1, Math.max(0, scrollY / (innerHeight * .7))); hero.style.opacity = motion.matches || innerWidth <= 760 ? '' : String(1 - p); }
  if (approach && desktop.matches && innerHeight > 650 && !motion.matches) {
   const distance = Math.max(1, approach.offsetHeight - innerHeight);
   const p = Math.max(0, Math.min(.999, -approach.getBoundingClientRect().top / distance));
   setStep(Math.floor(p * items.length));
  }
 };
 const schedule = () => { if (!pending) { pending = true; requestAnimationFrame(update); } };
 window.addEventListener('scroll', schedule, { passive: true }); window.addEventListener('resize', schedule, { passive: true });
 motion.addEventListener('change', () => { revealElements.forEach(el => el.classList.add('is-visible')); schedule(); }); desktop.addEventListener('change', schedule); update();
})();
