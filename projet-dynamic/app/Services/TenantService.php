<?php

namespace App\Services;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class TenantService
{
    public function store(array $data): Tenant
    {
        return Tenant::create(array_merge($data, ['user_id' => Auth::id()]));
    }

    public function update(Tenant $tenant, array $data): bool
    {
        return $tenant->update($data);
    }

    public function destroy(Tenant $tenant): bool
    {
        return $tenant->delete();
    }

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $query = Tenant::where('user_id', Auth::id())->with('property');

        if ($search = $request->get('search')) {
            $query->search($search);
        }

        if ($status = $request->get('payment_status')) {
            $query->where('payment_status', $status);
        }

        return $query->latest()->paginate(15)->withQueryString();
    }

    public function syncPaymentStatus(Tenant $tenant): void
    {
        $latestPayment = $tenant->payments()
            ->byMonth(now()->month)
            ->byYear(now()->year)
            ->first();

        if ($latestPayment) {
            $tenant->update(['payment_status' => $latestPayment->status]);
        }
    }
}
