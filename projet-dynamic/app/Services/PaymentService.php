<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    public function store(array $data): Payment
    {
        return Payment::create(array_merge($data, ['user_id' => Auth::id()]));
    }

    public function update(Payment $payment, array $data): bool
    {
        return $payment->update($data);
    }

    public function markAsPaid(Payment $payment): void
    {
        $payment->update([
            'status'       => 'paye',
            'payment_date' => now(),
        ]);

        $tenant = Tenant::find($payment->tenant_id);
        if ($tenant) {
            app(TenantService::class)->syncPaymentStatus($tenant);
        }
    }

    public function getMonthlyStats(int $month, int $year): array
    {
        $userId = Auth::id();
        return [
            'total'   => Payment::where('user_id', $userId)->byMonth($month)->byYear($year)->sum('amount'),
            'paid'    => Payment::where('user_id', $userId)->paye()->byMonth($month)->byYear($year)->sum('amount'),
            'pending' => Payment::where('user_id', $userId)->attente()->byMonth($month)->byYear($year)->sum('amount'),
            'late'    => Payment::where('user_id', $userId)->retard()->byMonth($month)->byYear($year)->sum('amount'),
        ];
    }

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $query = Payment::where('user_id', Auth::id())->with(['tenant', 'property']);

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($month = $request->get('month')) {
            $query->byMonth((int) $month);
        }

        if ($year = $request->get('year')) {
            $query->byYear((int) $year);
        }

        return $query->latest()->paginate(20)->withQueryString();
    }
}
