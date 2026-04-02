@props(['status','type'=>'payment'])
@php
$map = [
  'paye'     => ['paye',     __('common.status_paye')],
  'attente'  => ['attente',  __('common.status_attente')],
  'retard'   => ['retard',   __('common.status_retard')],
  'actif'    => ['actif',    __('common.status_actif')],
  'expire'   => ['expire',   __('common.status_expire')],
  'archive'  => ['archive',  __('common.status_archive')],
  'a_faire'  => ['a_faire',  __('common.status_a_faire')],
  'en_cours' => ['en_cours', __('common.status_en_cours')],
  'termine'  => ['termine',  __('common.status_termine')],
  'vacant'   => ['vacant',   __('common.status_vacant')],
  'occupee'  => ['occupee',  __('common.status_occupee')],
  'haute'    => ['retard',   __('common.priority_haute')],
  'moyenne'  => ['attente',  __('common.priority_moyenne')],
  'basse'    => ['termine',  __('common.priority_basse')],
];
[$cls, $lbl] = $map[$status] ?? ['attente', $status];
@endphp
<span class="status-badge status-badge--{{ $cls }}">{{ $lbl }}</span>
