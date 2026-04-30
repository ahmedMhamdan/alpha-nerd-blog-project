document.addEventListener('DOMContentLoaded', function () {
  const root = document.documentElement;
  const toggle = document.getElementById('adminThemeToggle');

  if (!toggle) return;

  toggle.addEventListener('click', function () {
    const current = root.getAttribute('data-admin-theme') || 'dark';
    const next = current === 'dark' ? 'light' : 'dark';

    root.setAttribute('data-admin-theme', next);
    localStorage.setItem('alpha_admin_theme', next);
  });
});
