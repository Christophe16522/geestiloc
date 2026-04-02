<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Payment $model): bool { return $user->id === $model->user_id; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Payment $model): bool { return $user->id === $model->user_id; }
    public function delete(User $user, Payment $model): bool { return $user->id === $model->user_id; }
}
