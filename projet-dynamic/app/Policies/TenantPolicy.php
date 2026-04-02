<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;

class TenantPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Tenant $model): bool { return $user->id === $model->user_id; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Tenant $model): bool { return $user->id === $model->user_id; }
    public function delete(User $user, Tenant $model): bool { return $user->id === $model->user_id; }
}
