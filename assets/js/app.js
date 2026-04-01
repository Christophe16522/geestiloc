/* =============================================================
   GestiLoc — Logique applicative partagée  (app.js)
   ============================================================= */
(function () {
    'use strict';

    /* ── Toast notification ───────────────────────────────────── */
    var s = document.createElement('style');
    s.textContent = '@keyframes fadeInToast{from{opacity:0;transform:translate(-50%,-10px)}to{opacity:1;transform:translate(-50%,0)}}';
    document.head.appendChild(s);

    function showToast(msg, type) {
        var t = document.createElement('div');
        t.textContent = msg;
        t.style.cssText = 'position:fixed;top:80px;left:50%;transform:translateX(-50%);background:' +
            (type === 'success' ? '#10b981' : '#1e3a8a') +
            ';color:white;padding:.75rem 1.5rem;border-radius:50px;font-size:.88rem;font-weight:600;' +
            'box-shadow:0 4px 20px rgba(0,0,0,.2);z-index:9999;pointer-events:none;' +
            'animation:fadeInToast .3s ease;';
        document.body.appendChild(t);
        setTimeout(function() { t.remove(); }, 2500);
    }

    /* ── Scroll progress bar ──────────────────────────────────── */
    var bar = document.createElement('div');
    bar.id = 'scroll-progress';
    document.body.prepend(bar);

    window.addEventListener('scroll', function () {
        var max = document.body.scrollHeight - window.innerHeight;
        var pct = max > 0 ? (window.scrollY / max) * 100 : 0;
        bar.style.width = pct + '%';
    }, { passive: true });

    /* ── Navbar scroll glass effect ───────────────────────────── */
    var navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function () {
            navbar.style.boxShadow = window.scrollY > 30
                ? '0 4px 40px rgba(0,0,0,0.28)'
                : '0 2px 30px rgba(0,0,0,0.2)';
        }, { passive: true });
    }

    /* ── Scroll reveal (ajoute .reveal aux cartes et sections) ── */
    function initReveal() {
        // On révèle les sections qui ont déjà la classe .reveal via CSS
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(function (el) {
            observer.observe(el);
        });
    }
    initReveal();

    /* ── Lien actif dans la navbar ──────────────────────────── */
    var currentPage = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav-link').forEach(function (link) {
        if (link.getAttribute('href') === currentPage) link.classList.add('active');
    });

    /* ── Gestionnaire générique de soumission de formulaire ──── */
    document.querySelectorAll('form[data-redirect]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var msg = this.dataset.successMsg || 'Enregistrement réussi !';
            showToast(msg, 'success');
            setTimeout(function() { window.location.href = this.dataset.redirect; }.bind(this), 1200);
        });
    });
}());

/* =============================================================
   Filtre de tableau générique — appeler initFilter(config)
   =============================================================
   config = {
     tableId        : 'myTable',
     searchId       : 'mySearch',               // optionnel
     counterId      : 'result-count',            // optionnel
     counterLabel   : ['item', 'items'],         // singulier, pluriel
     dropdowns      : [                          // optionnel
         { id: 'cityFilter', dataAttr: 'city' },
     ],
     searchCells    : [0, 1],                   // index de cellules
     toggleSelector : '.filter-status',         // défaut
     toggleDataAttr : 'status',                 // clé dataset des lignes
   }
   ============================================================= */
function initFilter(config) {
    var activeToggle   = 'all';
    var toggleSelector = config.toggleSelector || '.filter-status';
    var toggleDataAttr = config.toggleDataAttr || 'status';

    var table = document.getElementById(config.tableId);
    if (!table) return;

    var rows       = table.querySelectorAll('tbody tr');
    var searchEl   = config.searchId   ? document.getElementById(config.searchId)   : null;
    var counterEl  = config.counterId  ? document.getElementById(config.counterId)  : null;
    var noResultEl = document.getElementById('no-results');

    function applyFilter() {
        var q = searchEl ? searchEl.value.toLowerCase() : '';
        var visible = 0;

        rows.forEach(function (row) {
            var text = (config.searchCells || [0]).map(function (i) {
                return row.cells[i] ? row.cells[i].textContent.toLowerCase() : '';
            }).join(' ');

            var ok = !q || text.includes(q);

            (config.dropdowns || []).forEach(function (d) {
                var el = document.getElementById(d.id);
                if (el && el.value) ok = ok && row.dataset[d.dataAttr] === el.value;
            });

            ok = ok && (activeToggle === 'all' || row.dataset[toggleDataAttr] === activeToggle);
            row.style.display = ok ? '' : 'none';
            if (ok) visible++;
        });

        if (counterEl) {
            var labels = config.counterLabel || ['résultat', 'résultats'];
            counterEl.textContent = visible + ' ' + (visible > 1 ? labels[1] : labels[0]);
        }
        if (noResultEl) noResultEl.style.display = visible === 0 ? 'block' : 'none';
    }

    document.querySelectorAll(toggleSelector).forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll(toggleSelector).forEach(function (l) { l.classList.remove('active'); });
            this.classList.add('active');
            activeToggle = this.dataset.value;
            applyFilter();
        });
    });

    if (searchEl) searchEl.addEventListener('input', applyFilter);
    (config.dropdowns || []).forEach(function (d) {
        var el = document.getElementById(d.id);
        if (el) el.addEventListener('change', applyFilter);
    });
}
