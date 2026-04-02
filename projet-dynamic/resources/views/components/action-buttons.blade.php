@props(['showRoute' => null, 'editRoute' => null, 'deleteRoute' => null, 'confirmMessage' => 'Supprimer cet élément ?', 'small' => true])
<div class="d-flex gap-1 align-items-center">
    @if($showRoute)
    <a href="{{ $showRoute }}" class="btn btn-sm btn-outline-primary" title="Voir">
        <i class="fas fa-eye"></i>
    </a>
    @endif
    @if($editRoute)
    <a href="{{ $editRoute }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
        <i class="fas fa-edit"></i>
    </a>
    @endif
    @if($deleteRoute)
    <form method="POST" action="{{ $deleteRoute }}" onsubmit="return confirm('{{ $confirmMessage }}')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
            <i class="fas fa-trash"></i>
        </button>
    </form>
    @endif
</div>
