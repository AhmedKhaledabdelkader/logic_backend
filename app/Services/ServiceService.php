<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ServiceService
{
    public function __construct(
        protected ServiceRepositoryInterface $serviceRepository
    ) {
    }

    public function getAll(bool $onlyActive = false): Collection
    {
        return $this->serviceRepository->getAll($onlyActive);
    }

    public function find(string|int $idOrSlug): ?Service
    {
        return $this->serviceRepository->find($idOrSlug);
    }

    public function create(array $data): Service
    {
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);

        return $this->serviceRepository->create($data);
    }

    public function update(Service $service, array $data): Service
    {
        if (!empty($data['slug'])) {
            $data['slug'] = $this->uniqueSlug($data['slug'], $service->id);
        } else {
            unset($data['slug']);
        }

        return $this->serviceRepository->update($service, $data);
    }

    public function delete(Service $service): bool
    {
        return $this->serviceRepository->delete($service);
    }

    public function reorder(array $ids): void
    {
        $this->serviceRepository->reorder($ids);
    }

    private function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source) ?: 'service';
        $slug = $base;
        $i = 2;

        while (
            Service::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
