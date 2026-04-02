<?php

namespace App\Services;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ContractService
{
    public function store(array $data): Contract
    {
        return Contract::create(array_merge($data, ['user_id' => Auth::id()]));
    }

    public function update(Contract $contract, array $data): bool
    {
        return $contract->update($data);
    }

    public function archive(Contract $contract): void
    {
        $contract->update(['status' => 'archive']);
    }

    public function getExpiring(int $days = 30): Collection
    {
        return Contract::where('user_id', Auth::id())->expirant($days)->with(['tenant', 'property'])->get();
    }

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $query = Contract::where('user_id', Auth::id())->with(['tenant', 'property']);

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        return $query->latest()->paginate(15)->withQueryString();
    }
}
