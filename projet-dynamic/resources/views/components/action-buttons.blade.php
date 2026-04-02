@props(['showRoute'=>null,'editRoute'=>null,'deleteRoute'=>null,'downloadRoute'=>null,'confirmMessage'=>'Confirmer la suppression ?','model'=>null])
<div class="action-btn-group">
  @if($showRoute)
  <a href="{{ $showRoute }}" class="action-btn action-btn--view" title="Voir"><i class="fa-solid fa-eye"></i></a>
  @endif
  @if($editRoute)
  <a href="{{ $editRoute }}" class="action-btn action-btn--edit" title="Modifier"><i class="fa-solid fa-pencil"></i></a>
  @endif
  @if($downloadRoute)
  <a href="{{ $downloadRoute }}" class="action-btn action-btn--download" title="Télécharger"><i class="fa-solid fa-download"></i></a>
  @endif
  @if($deleteRoute)
  <form method="POST" action="{{ $deleteRoute }}" class="d-inline" onsubmit="return confirm('{{ $confirmMessage }}')">
    @csrf @method('DELETE')
    <button type="submit" class="action-btn action-btn--delete" title="Supprimer"><i class="fa-solid fa-trash"></i></button>
  </form>
  @endif
</div>
