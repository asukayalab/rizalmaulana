// QA only; pass an installed puppeteer-core directory through RIZAL_QA_MODULE.
const { createRequire } = require('node:module');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const req = createRequire((process.env.RIZAL_QA_MODULE || '/tmp/rizal-qa') + '/package.json');
const puppeteer = req('puppeteer-core');
(async () => {
 const browser = await puppeteer.launch({ executablePath: process.env.CHROME_PATH || '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome', headless: true });
 const errors = [], results = [];
 const wait = ms => new Promise(r => setTimeout(r, ms));
 const page = await browser.newPage(); page.on('pageerror', error => errors.push(error.message));
 try {
  for (const width of [320,375,760,1024,1280,1440,1920]) {
   await page.setViewport({ width, height: 900 }); const response = await page.goto('http://localhost:8096', { waitUntil: 'networkidle0' }); assert.equal(response.status(),200);
   await wait(1900);
   const geometry = await page.evaluate(() => ({ width: innerWidth, scrollWidth: document.documentElement.scrollWidth, hero: document.querySelector('h1').innerText, images: [...document.images].filter(i => i.complete && !i.naturalWidth).length }));
   assert(geometry.scrollWidth <= width, 'horizontal overflow at ' + width); assert.match(geometry.hero,/Kepastian/); assert.equal(geometry.images,0); results.push('Layout ' + width + 'px');
  }
  await page.setViewport({ width: 1440, height: 900 }); await page.goto('http://localhost:8096',{waitUntil:'networkidle0'}); await wait(1900);
  const toggle = page.locator('.menu-toggle'); await toggle.click(); await wait(800);
  assert.equal(await page.$eval('.menu-toggle',e=>e.getAttribute('aria-expanded')),'true');
  assert.equal(await page.$$eval('.menu-panel a',es=>es.length),6); await page.keyboard.press('Escape'); assert.equal(await page.$eval('.menu-toggle',e=>e.getAttribute('aria-expanded')),'false');
  assert.equal(await page.$eval('.menu-panel',e=>e.inert),true); results.push('Menu open / close / Escape / inert');
  await page.locator('[data-project-next]').click(); await wait(1100);
  assert.match(await page.$eval('[data-project-status]',e=>e.textContent),/02/);
  const active = await page.$$eval('.project-slide',es=>es.filter(e=>!e.inert).length); assert.equal(active,1);
  await page.keyboard.press('ArrowRight'); await wait(1100); assert.match(await page.$eval('[data-project-status]',e=>e.textContent),/03/); results.push('Project wipe / keyboard / inactive slide isolation');
  await page.evaluate(()=>{const e=document.querySelector('[data-approach]');scrollTo({top:scrollY+e.getBoundingClientRect().top+(e.offsetHeight-innerHeight)*.6,behavior:'instant'});}); await wait(500);
  assert.equal(await page.$eval('[data-step="2"]',e=>e.getAttribute('aria-pressed')),'true');
  await page.locator('[data-step="3"]').click(); await wait(500); assert.equal(await page.$eval('[data-step="3"]',e=>e.getAttribute('aria-pressed')),'true'); results.push('Spirit scroll / pagination');
  await page.emulateMediaFeatures([{name:'prefers-reduced-motion',value:'reduce'}]); await page.reload({waitUntil:'networkidle0'});
  assert.equal(await page.$eval('.hero',e=>getComputedStyle(e).position),'relative'); assert.equal(await page.$eval('.profile-photo',e=>getComputedStyle(e).position),'relative');
  assert.equal(await page.$eval('.hero h1',e=>getComputedStyle(e).animationName),'none'); results.push('Reduced motion static hero / no sticky / no entrance');
  await page.goto('http://localhost:8096/?page_id=10',{waitUntil:'networkidle0'}); assert(await page.$('.rm-page')); assert.match(await page.$eval('meta[name="robots"]',e=>e.content),/noindex/); results.push('Maintenance template / noindex');
  const nojs = await browser.newPage(); await nojs.setJavaScriptEnabled(false); await nojs.goto('http://localhost:8096',{waitUntil:'networkidle0'});
  assert.equal(await nojs.$$eval('.project-slide',es=>es.filter(e=>getComputedStyle(e).visibility!=='hidden').length),5);
  assert.equal(await nojs.$$eval('.approach-item',es=>es.filter(e=>getComputedStyle(e).visibility!=='hidden').length),4);
  assert.equal(await nojs.$$eval('.menu-panel a',es=>es.length),6); await nojs.close(); results.push('No JavaScript: all projects / Spirit content / navigation accessible');
  assert.deepEqual(errors,[]); results.push('No browser JavaScript errors');
  const report={checkedAt:new Date().toISOString(),environment:'Dedicated local WordPress :8096',results,errors};
  if(process.env.RIZAL_QA_REPORT) fs.writeFileSync(process.env.RIZAL_QA_REPORT,JSON.stringify(report,null,2)+'\n');
  console.log(JSON.stringify(report,null,2));
 } finally { await browser.close(); }
})().catch(error=>{console.error(error);process.exitCode=1;});
