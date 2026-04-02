<?php

namespace App\Policies;

use App\Models\Maintenance;
use App\Models\User;

class MaintenancePolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Maintenance $model): bool { return $user->id === $model->user_id; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Maintenance $model): bool { return $user->id === $model->user_id; }
    public function delete(User $user, Maintenance $model): bool { return $user->id === $model->user_id; }
}
