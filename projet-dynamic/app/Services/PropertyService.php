<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class PropertyService
{
    public function store(array $data): Property
    {
        return Property::create(array_merge($data, ['user_id' => Auth::id()]));
    }

    public function update(Property $property, array $data): bool
    {
        return $property->update($data);
    }

    public function destroy(Property $property): bool
    {
        return $property->delete();
    }

    public function getFiltered(Request $request): LengthAwarePaginator
    {
        $query = Property::where('user_id', Auth::id())
            ->with('tenants');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        if ($city = $request->get('city')) {
            $query->where('city', $city);
        }

        return $query->latest()->paginate(12)->withQueryString();
    }

    public function updateStatus(Property $property, string $status): void
    {
        $property->update(['status' => $status]);
    }
}
