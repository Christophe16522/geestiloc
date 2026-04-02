<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Tenant;
use App\Services\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $service) {}

    public function index(Request $request): View
    {
        return view('payments.index', [
            'payments'     => $this->service->getFiltered($request),
            'monthlyStats' => $this->service->getMonthlyStats(now()->month, now()->year),
        ]);
    }

    public function create(): View
    {
        $tenants    = Tenant::where('user_id', auth()->id())->get();
        $properties = Property::where('user_id', auth()->id())->get();

        return view('payments.create', compact('tenants', 'properties'));
    }

    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());

        return redirect()->route('payments.index')->with('success', 'Paiement enregistré avec succès.');
    }

    public function show(Payment $payment): View
    {
        $this->authorize('view', $payment);
        $payment->load(['tenant', 'property']);

        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment): View
    {
        $this->authorize('update', $payment);
        $tenants    = Tenant::where('user_id', auth()->id())->get();
        $properties = Property::where('user_id', auth()->id())->get();

        return view('payments.edit', compact('payment', 'tenants', 'properties'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment): RedirectResponse
    {
        $this->authorize('update', $payment);
        $this->service->update($payment, $request->validated());

        return redirect()->route('payments.show', $payment)->with('success', 'Paiement mis à jour.');
    }

    public function destroy(Payment $payment): RedirectResponse
    {
        $this->authorize('delete', $payment);
        $this->service->destroy($payment);

        return redirect()->route('payments.index')->with('success', 'Paiement supprimé.');
    }

    public function markAsPaid(Payment $payment): RedirectResponse
    {
        $this->authorize('update', $payment);
        $this->service->markAsPaid($payment);

        return redirect()->back()->with('success', 'Paiement marqué comme réglé.');
    }
}
