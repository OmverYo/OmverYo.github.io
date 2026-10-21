'use strict';
(() => {
  const languageButtons = [...document.querySelectorAll('[data-language]')];
  const filterButtons = [...document.querySelectorAll('[data-filter]')];
  const projects = [...document.querySelectorAll('.project[data-category]')];
  let language = 'ko';
  function setLanguage(value) {
    language = value === 'en' ? 'en' : 'ko';
    document.documentElement.lang = language;
    document.querySelectorAll('[data-ko][data-en]').forEach(element => {
      element.textContent = element.dataset[language];
    });
    document.querySelectorAll('[data-alt-ko][data-alt-en]').forEach(element => {
      element.alt = language === 'en' ? element.dataset.altEn : element.dataset.altKo;
    });
    languageButtons.forEach(button => button.setAttribute('aria-pressed', String(button.dataset.language === language)));
    document.title = language === 'en' ? 'Dongjun Lee | AI Vision & Robot Software Developer' : '이동준 | AI 비전 · 로봇 소프트웨어 개발자';
    const url = new URL(window.location.href);
    if (language === 'en') url.searchParams.set('lang', 'en');
    else url.searchParams.delete('lang');
    try { history.replaceState(null, '', url); } catch (_) { /* Content remains usable without history access. */ }
    const status = document.getElementById('copy-status');
    if (status) status.textContent = '';
  }
  languageButtons.forEach(button => button.addEventListener('click', () => setLanguage(button.dataset.language)));
  if (new URLSearchParams(location.search).get('lang') === 'en') setLanguage('en');
  filterButtons.forEach(button => button.addEventListener('click', () => {
    const filter = button.dataset.filter;
    filterButtons.forEach(item => item.setAttribute('aria-pressed', String(item === button)));
    projects.forEach(project => { project.hidden = filter !== 'all' && project.dataset.category !== filter; });
    const count = projects.filter(project => !project.hidden).length;
    document.getElementById('project-count').textContent = `${count} ${count === 1 ? 'PROJECT' : 'PROJECTS'}`;
  }));
  document.getElementById('copy-email')?.addEventListener('click', async () => {
    const status = document.getElementById('copy-status');
    try {
      if (!navigator.clipboard?.writeText) throw new Error('Clipboard unavailable');
      await navigator.clipboard.writeText('omver5669@gmail.com');
      status.textContent = language === 'ko' ? '이메일을 복사했습니다.' : 'Email copied.';
    } catch (_) {
      status.textContent = language === 'ko' ? 'omver5669@gmail.com을 직접 복사해 주세요.' : 'Please copy omver5669@gmail.com directly.';
    }
  });
})();
