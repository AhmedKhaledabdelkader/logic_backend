<?php

namespace App\Repositories\Eloquents;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getAll(bool $onlyActive = false): Collection
    {
        return Service::query()
            ->with('items')
            ->when($onlyActive, fn ($q) => $q->where('is_active', true))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    }

    public function find(string|int $idOrSlug): ?Service
    {
        $query = Service::with('items');

        return ctype_digit((string) $idOrSlug)
            ? $query->find((int) $idOrSlug)
            : $query->where('slug', $idOrSlug)->first();
    }

    public function create(array $data): Service
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'] ?? [];
            unset($data['items']);

            $data['sort_order'] ??= ((int) Service::max('sort_order')) + 1;

            $service = Service::create($data);
            $this->syncItems($service, $items);

            return $service->load('items');
        });
    }

    public function update(Service $service, array $data): Service
    {
        return DB::transaction(function () use ($service, $data) {
            $items = $data['items'] ?? null;
            unset($data['items']);

            $service->update($data);

            // Only touch the bullets when the client actually sent them.
            if ($items !== null) {
                $this->syncItems($service, $items);
            }

            return $service->load('items');
        });
    }

    public function delete(Service $service): bool
    {
        return (bool) $service->delete(); // items cascade
    }

    public function reorder(array $ids): void
    {
        DB::transaction(function () use ($ids) {
            foreach (array_values($ids) as $position => $id) {
                Service::whereKey($id)->update(['sort_order' => $position + 1]);
            }
        });
    }

    /**
     * Make the service's items match the given list: update rows that carry
     * a known id, create the rest, delete anything that was left out.
     * Array position becomes sort_order.
     */
    private function syncItems(Service $service, array $items): void
    {
        $existing = $service->items()->get()->keyBy('id');
        $keep = [];

        foreach (array_values($items) as $position => $item) {
            $payload = [
                'title' => $item['title'],
                'group_title' => $item['group_title'] ?? null,
                'sort_order' => $position + 1,
            ];

            $id = $item['id'] ?? null;

            if ($id && $existing->has($id)) {
                $existing[$id]->update($payload);
                $keep[] = (int) $id;
            } else {
                $keep[] = $service->items()->create($payload)->id;
            }
        }

        $service->items()->whereNotIn('id', $keep)->delete();
    }
}
