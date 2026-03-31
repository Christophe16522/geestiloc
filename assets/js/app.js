/* =============================================================
   GestiLoc — Logique applicative partagée  (app.js)
   ============================================================= */
(function () {
    'use strict';

    /* -- Lien actif dans la navbar -------------------------------- */
    var currentPage = window.location.pathname.split('/').pop() || 'index.html';
    document.querySelectorAll('.nav-link').forEach(function (link) {
        if (link.getAttribute('href') === currentPage) link.classList.add('active');
    });

    /* -- Gestionnaire générique de soumission de formulaire -------
       Ajouter data-redirect="page.html" (et optionnellement
       data-success-msg="...") sur la balise <form> pour l'activer.
    --------------------------------------------------------------- */
    document.querySelectorAll('form[data-redirect]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var msg = this.dataset.successMsg || 'Enregistrement réussi !';
            alert(msg);
            window.location.href = this.dataset.redirect;
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
