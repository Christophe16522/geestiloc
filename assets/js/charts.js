/* =============================================================
   GestiLoc — Graphiques du tableau de bord  (charts.js)
   Nécessite Chart.js chargé avant ce script.
   ============================================================= */
(function () {
    'use strict';

    /* Revenus mensuels — courbe */
    var revenuesEl = document.getElementById('revenuesChart');
    if (revenuesEl) {
        new Chart(revenuesEl.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre', 'Janvier'],
                datasets: [{
                    label: 'Revenus (€)',
                    data: [22000, 23500, 21800, 24000, 23200, 24500],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#06b6d4',
                    pointBorderColor: '#3b82f6',
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    /* Répartition par type — anneau */
    var typesEl = document.getElementById('typesChart');
    if (typesEl) {
        new Chart(typesEl.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Appartements', 'Maisons', 'Studios'],
                datasets: [{
                    data: [7, 3, 2],
                    backgroundColor: ['#3b82f6', '#06b6d4', '#f59e0b']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }
}());
