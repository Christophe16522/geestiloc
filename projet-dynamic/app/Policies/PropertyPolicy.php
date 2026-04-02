<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Property $model): bool { return $user->id === $model->user_id; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Property $model): bool { return $user->id === $model->user_id; }
    public function delete(User $user, Property $model): bool { return $user->id === $model->user_id; }
}
