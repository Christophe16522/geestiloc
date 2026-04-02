/* ============================================================
   GestiLoc Docs — Script partagé
   ============================================================ */

/* --- Structure de navigation (source unique de vérité) ---- */
const NAV = [
  { type: 'link', labelKey: 'home', path: 'index.html' },
  {
    type: 'section', labelKey: 'user_guide',
    items: [
      { type: 'link', labelKey: 'ug_start',       path: 'utilisateur/demarrage.html' },
      { type: 'link', labelKey: 'ug_dashboard',   path: 'utilisateur/tableau-de-bord.html' },
      { type: 'link', labelKey: 'ug_properties',  path: 'utilisateur/proprietes.html' },
      { type: 'link', labelKey: 'ug_tenants',     path: 'utilisateur/locataires.html' },
      { type: 'link', labelKey: 'ug_contracts',   path: 'utilisateur/contrats.html' },
      { type: 'link', labelKey: 'ug_payments',    path: 'utilisateur/paiements.html' },
      { type: 'link', labelKey: 'ug_documents',   path: 'utilisateur/documents.html' },
      { type: 'link', labelKey: 'ug_maintenance', path: 'utilisateur/maintenance.html' },
    ]
  },
  {
    type: 'section', labelKey: 'functional',
    items: [
      { type: 'link', labelKey: 'fn_overview',     path: 'fonctionnel/apercu.html' },
      { type: 'link', labelKey: 'fn_user_stories', path: 'fonctionnel/user-stories.html' },
      {
        type: 'group', labelKey: 'fn_modules',
        items: [
          { type: 'link', labelKey: 'fn_properties', path: 'fonctionnel/modules/proprietes.html' },
          { type: 'link', labelKey: 'fn_tenants',    path: 'fonctionnel/modules/locataires.html' },
          { type: 'link', labelKey: 'fn_contracts',  path: 'fonctionnel/modules/contrats.html' },
          { type: 'link', labelKey: 'fn_payments',   path: 'fonctionnel/modules/paiements.html' },
          { type: 'link', labelKey: 'fn_documents',  path: 'fonctionnel/modules/documents.html' },
          { type: 'link', labelKey: 'fn_maintenance',path: 'fonctionnel/modules/maintenance.html' },
        ]
      }
    ]
  },
  {
    type: 'section', labelKey: 'technical',
    items: [
      { type: 'link', labelKey: 'tc_architecture', path: 'technique/architecture.html' },
      { type: 'link', labelKey: 'tc_database',     path: 'technique/base-de-donnees.html' },
      { type: 'link', labelKey: 'tc_installation', path: 'technique/installation.html' },
      { type: 'link', labelKey: 'tc_blade',        path: 'technique/composants-blade.html' },
      { type: 'link', labelKey: 'tc_poc',          path: 'technique/poc-vs-dynamic.html' },
    ]
  }
];

/* ---------------------------------------------------------- */
(function () {
  const body        = document.body;
  const root        = body.dataset.root || '.';
  const currentPage = body.dataset.page || '';

  /* --- Données de traduction (chargées via i18n.js) ------- */
  const I18N = window.I18N || null;

  /* --- Helpers i18n --------------------------------------- */
  function getLang()  { return localStorage.getItem('docs_lang') || 'fr'; }
  function setLang(l) { localStorage.setItem('docs_lang', l); }

  function navLabel(labelKey, lang) {
    if (!I18N) return labelKey;
    const dict = ((I18N[lang] || I18N['fr'] || {}).nav) || {};
    return dict[labelKey] || labelKey;
  }

  /* --- Utilitaires ---------------------------------------- */

  /** Vérifie si un nœud ou ses enfants contient la page active */
  function hasActive(items) {
    return items.some(function (item) {
      if (item.type === 'link') return item.path === currentPage;
      if (item.items)           return hasActive(item.items);
      return false;
    });
  }

  /** Construit récursivement le DOM de navigation */
  function buildNav(items, depth, lang) {
    depth = depth || 0;
    const container = document.createElement('div');

    items.forEach(function (item, idx) {

      if (item.type === 'link') {
        const a      = document.createElement('a');
        a.href        = root + '/' + item.path;
        a.textContent = navLabel(item.labelKey, lang);
        a.className   = 'nav-link' + (item.path === currentPage ? ' active' : '');
        if (depth > 0) a.style.paddingLeft = (0.75 + depth * 0.5) + 'rem';
        container.appendChild(a);

      } else if (item.type === 'section') {
        if (idx > 0) {
          const hr = document.createElement('hr');
          hr.className = 'nav-divider';
          container.appendChild(hr);
        }
        const label       = document.createElement('span');
        label.className   = 'nav-section-label';
        label.textContent = navLabel(item.labelKey, lang);
        container.appendChild(label);

        const children     = buildNav(item.items, depth, lang);
        children.className = 'nav-section-children';
        container.appendChild(children);

      } else if (item.type === 'group') {
        const isOpen = hasActive(item.items);

        const groupLabel       = document.createElement('div');
        groupLabel.className   = 'nav-group-label' + (isOpen ? ' open' : '');
        groupLabel.style.paddingLeft = (0.75 + depth * 0.5) + 'rem';

        const labelSpan       = document.createElement('span');
        labelSpan.textContent = navLabel(item.labelKey, lang);
        const chevron         = document.createElement('span');
        chevron.className     = 'chevron';
        chevron.textContent   = '\u25BA';
        groupLabel.appendChild(labelSpan);
        groupLabel.appendChild(chevron);
        container.appendChild(groupLabel);

        const groupChildren       = buildNav(item.items, depth + 1, lang);
        groupChildren.className   = 'nav-group-children';
        groupChildren.style.maxHeight = isOpen ? '600px' : '0';
        container.appendChild(groupChildren);

        groupLabel.addEventListener('click', function () {
          const open = groupLabel.classList.toggle('open');
          groupChildren.style.maxHeight = open ? '600px' : '0';
        });
      }
    });

    return container;
  }

  /* --- Génération du fil d'Ariane ------------------------- */

  /** Retourne le chemin dans NAV menant à la page cible */
  function findPath(items, target) {
    for (const item of items) {
      if (item.type === 'link' && item.path === target) return [item];
      if (item.items) {
        const sub = findPath(item.items, target);
        if (sub) return [item, ...sub];
      }
    }
    return null;
  }

  function buildBreadcrumb(navEl, lang) {
    const path = findPath(NAV, currentPage);
    if (!path || currentPage === 'index.html') return;

    const uiDict = I18N ? ((I18N[lang] || I18N['fr'] || {}).ui || {}) : {};

    const home  = document.createElement('a');
    home.href   = root + '/index.html';
    home.textContent = uiDict.breadcrumb_docs || 'Docs';
    navEl.appendChild(home);

    path.forEach(function (item, i) {
      const sep       = document.createElement('span');
      sep.className   = 'sep';
      sep.textContent = '/';
      navEl.appendChild(sep);

      const isLast = i === path.length - 1;
      const label  = navLabel(item.labelKey, lang);

      if (!isLast && item.path) {
        const a    = document.createElement('a');
        a.href     = root + '/' + item.path;
        a.textContent = label;
        navEl.appendChild(a);
      } else {
        const el      = document.createElement('span');
        el.className  = isLast ? 'current' : '';
        el.textContent = label;
        navEl.appendChild(el);
      }
    });
  }

  /* --- Application des traductions au contenu ------------- */

  function applyTranslations(lang) {
    if (!I18N) return;

    // Dériver la clé de page : "utilisateur/tableau-de-bord.html" → "utilisateur_tableau_de_bord"
    const pageKey = currentPage.replace('.html', '').replace(/[\/-]/g, '_');
    const data    = (I18N[lang] || {})[pageKey];
    if (!data) return; // page non traduite : conserver le contenu HTML existant

    const article  = document.querySelector('article');
    if (!article) return;

    const $  = function (s) { return article.querySelector(s); };
    const $$ = function (s) { return Array.from(article.querySelectorAll(s)); };

    // Titre et sous-titre
    if (data.h1)       { const el = $('h1');             if (el) el.textContent = data.h1; }
    if (data.subtitle) { const el = $('.page-subtitle'); if (el) el.innerHTML   = data.subtitle; }

    // Titres de section
    if (data.h2) { const els = $$('h2'); data.h2.forEach(function (t, i) { if (els[i]) els[i].textContent = t; }); }
    if (data.h3) { const els = $$('h3'); data.h3.forEach(function (t, i) { if (els[i]) els[i].textContent = t; }); }

    // Paragraphes (hors sous-titre)
    if (data.p) {
      const els = $$('p').filter(function (el) { return !el.classList.contains('page-subtitle'); });
      data.p.forEach(function (t, i) { if (els[i]) els[i].innerHTML = t; });
    }

    // Listes ordonnées et non ordonnées (innerHTML pour conserver le balisage <li>)
    if (data.ol) { const els = $$('ol'); data.ol.forEach(function (h, i) { if (els[i]) els[i].innerHTML = h; }); }
    if (data.ul) { const els = $$('ul'); data.ul.forEach(function (h, i) { if (els[i]) els[i].innerHTML = h; }); }

    // Callouts (.note / .tip / .warning)
    if (data.callout) {
      const els = $$('.note, .tip, .warning');
      data.callout.forEach(function (h, i) { if (els[i]) els[i].innerHTML = h; });
    }

    // Cellules de tableau
    if (data.th) { const els = $$('th'); data.th.forEach(function (t, i) { if (els[i]) els[i].innerHTML = t; }); }
    if (data.td) { const els = $$('td'); data.td.forEach(function (t, i) { if (els[i]) els[i].innerHTML = t; }); }

    // Cartes de la page d'accueil (index uniquement)
    if (data.card_label) {
      const els = Array.from(document.querySelectorAll('.card .card-label'));
      data.card_label.forEach(function (t, i) { if (els[i]) els[i].textContent = t; });
    }
    if (data.card_title) {
      const els = Array.from(document.querySelectorAll('.card h3'));
      data.card_title.forEach(function (t, i) { if (els[i]) els[i].textContent = t; });
    }
    if (data.card_desc) {
      const els = Array.from(document.querySelectorAll('.card p'));
      data.card_desc.forEach(function (t, i) { if (els[i]) els[i].textContent = t; });
    }
  }

  /* --- Initialisation ------------------------------------- */
  const lang = getLang();

  // Sidebar nav (avec labels traduits)
  const sidebarNavEl = document.getElementById('sidebarNav');
  if (sidebarNavEl) sidebarNavEl.appendChild(buildNav(NAV, 0, lang));

  // Fil d'Ariane
  const breadcrumbEl = document.getElementById('breadcrumb');
  if (breadcrumbEl) buildBreadcrumb(breadcrumbEl, lang);

  // Sélecteur de langue dans le header (toujours visible)
  const headerEl = document.querySelector('.sidebar-header');
  if (headerEl) {
    const picker = document.createElement('div');
    picker.className = 'lang-picker';

    var flags = {
      fr: 'https://flagcdn.com/20x15/fr.png',
      en: 'https://flagcdn.com/20x15/gb.png'
    };
    var labels = { fr: 'Français', en: 'English' };

    ['fr', 'en'].forEach(function (l) {
      const btn = document.createElement('button');
      btn.className = 'lang-btn' + (l === lang ? ' active' : '');
      btn.innerHTML = '<img src="' + flags[l] + '" width="20" height="15" alt="' + l + '"> <span>' + l.toUpperCase() + '</span>';
      btn.title = labels[l];
      btn.addEventListener('click', function () {
        if (l !== lang) { setLang(l); location.reload(); }
      });
      picker.appendChild(btn);
    });

    headerEl.appendChild(picker);
  }

  // Crédit développeur en bas de la sidebar
  const sidebarEl = document.getElementById('sidebar');
  if (sidebarEl) {
    const credit = document.createElement('div');
    credit.className = 'sidebar-credit';
    credit.innerHTML = 'Developed by <strong>Christophe LAI</strong>';
    sidebarEl.appendChild(credit);
  }

  // Traductions du contenu de la page
  applyTranslations(lang);

  // Wrapper tables pour scroll horizontal
  document.querySelectorAll('article table').forEach(function (table) {
    if (table.parentElement.classList.contains('table-wrap')) return;
    const wrap = document.createElement('div');
    wrap.className = 'table-wrap';
    table.parentNode.insertBefore(wrap, table);
    wrap.appendChild(table);
  });

  // Mobile sidebar toggle
  const toggle  = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');

  function openSidebar()  { sidebar.classList.add('open');    toggle.classList.add('open');    overlay.classList.add('open'); }
  function closeSidebar() { sidebar.classList.remove('open'); toggle.classList.remove('open'); overlay.classList.remove('open'); }

  if (toggle && sidebar && overlay) {
    toggle.addEventListener('click', function () {
      sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });
    overlay.addEventListener('click', closeSidebar);
  }

})();
