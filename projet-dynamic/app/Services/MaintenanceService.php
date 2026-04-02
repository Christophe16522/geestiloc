<?php

namespace App\Services;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class MaintenanceService
{
    public function store(array $data): Maintenance
    {
        return Maintenance::create(array_merge($data, ['user_id' => Auth::id()]));
    }

    public function update(Maintenance $maintenance, array $data): bool
    {
        return $maintenance->update($data);
    }

    public function updateProgress(Maintenance $maintenance, int $percentage): void
    {
        $status = $maintenance->status;
        if ($percentage > 0 && $status === 'a_faire') {
            $status = 'en_cours';
        }
        if ($percentage >= 100) {
            $status = 'termine';
        }

        $maintenance->update([
            'progress_percentage' => $percentage,
            'status'              => $status,
            'started_at'          => $maintenance->started_at ?? now(),
        ]);
    }

    public function close(Maintenance $maintenance): void
    {
        $maintenance->update([
            'status'              => 'termine',
            'progress_percentage' => 100,
            'completed_at'        => now(),
        ]);
    }

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $query = Maintenance::where('user_id', Auth::id())->with('property');

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($priority = $request->get('priority')) {
            $query->byPriority($priority);
        }

        if ($search = $request->get('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        return $query->latest()->paginate(15)->withQueryString();
    }
}
