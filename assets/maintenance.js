(() => {
  const page = document.querySelector('.rm-page'), section = document.getElementById('coming-soon');
  if (!page || !section || matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  const one = s => page.querySelector(s), all = s => page.querySelectorAll(s);
  const set = (el, transform, opacity) => { if (!el) return; el.style.transform = transform; if (opacity !== undefined) el.style.opacity = opacity; };
  const dots = all('.rm-dots-hero i'), dots2 = all('.rm-dots-second i');
  let y = window.scrollY, vy = 0, p = 0, vp = 0, raf;
  const loop = () => {
    const target = window.scrollY;
    vy = (vy + (target - y) * .09) * .8; y += vy;
    if (Math.abs(target-y)<.05 && Math.abs(vy)<.05) { y=target; vy=0; }
    const progress = Math.min(1, Math.max(0, (innerHeight-section.getBoundingClientRect().top)/innerHeight));
    vp = (vp + (progress-p)*.09)*.8; p+=vp;
    if (Math.abs(progress-p)<.001 && Math.abs(vp)<.001) { p=progress; vp=0; }
    const shift=Math.min(1,innerWidth/1280), offset=Math.min(220,innerWidth*.4);
    set(one('.rm-decoration'),`translateY(${y*.6}px)`);
    set(one('.rm-content'),`translateY(${-y*.08}px)`);
    set(dots[0],`translate(${y*.09}px,${-y*.04}px)`); set(dots[1],`translate(${-y*.06}px,${y*.03}px)`); set(dots[2],`translateY(${-y*.12}px)`);
    set(one('.rm-brand-left'),`translateX(${-y*.18*shift}px)`); set(one('.rm-brand-right'),`translateX(${y*.18*shift}px)`);
    set(one('.rm-tagline'),`translateY(${-y*.14}px)`);
    set(one('.rm-professions'),`translateY(${-y*.2}px)`,Math.max(0,1-y/260));
    set(one('.rm-wa'),`translateX(${-y*.25*shift}px)`,Math.max(0,1-y/220));
    set(one('.rm-email'),`translateX(${y*.25*shift}px)`,Math.max(0,1-y/220));
    set(one('.rm-line-1'),`translateX(${(1-p)*-offset}px)`); set(one('.rm-line-2'),`translateX(${(1-p)*offset}px)`);
    set(one('.rm-launch'),`translateY(${(1-p)*36}px)`,p); set(one('.rm-instagram'),`translateY(${(1-p)*36}px)`,p);
    set(dots2[0],`translate(${y*.05}px,${-y*.03}px)`); set(dots2[1],`translate(${-y*.07}px,${y*.02}px)`);
    raf = Math.abs(target-y)>.05 || Math.abs(vy)>.05 || Math.abs(progress-p)>.001 || Math.abs(vp)>.001 ? requestAnimationFrame(loop) : null;
  };
  const schedule = () => { if (!raf) raf=requestAnimationFrame(loop); };
  window.addEventListener('scroll',schedule,{passive:true}); window.addEventListener('resize',schedule,{passive:true});
  raf=requestAnimationFrame(loop); window.addEventListener('pagehide',()=>cancelAnimationFrame(raf),{once:true});
})();
