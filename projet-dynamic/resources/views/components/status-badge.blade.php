@props(['status', 'type' => 'payment'])
@php
$labels = [
    'paye'     => 'Payé',
    'attente'  => 'En attente',
    'retard'   => 'En retard',
    'actif'    => 'Actif',
    'expire'   => 'Expiré',
    'archive'  => 'Archivé',
    'occupee'  => 'Occupée',
    'vacante'  => 'Vacante',
    'a_faire'  => 'À faire',
    'en_cours' => 'En cours',
    'termine'  => 'Terminé',
    'haute'    => 'Haute',
    'moyenne'  => 'Moyenne',
    'basse'    => 'Basse',
];
$label = $labels[$status] ?? $status;
@endphp
<span class="badge rounded-pill badge-{{ $status }} px-3 py-2">{{ $label }}</span>
