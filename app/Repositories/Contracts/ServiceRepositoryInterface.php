<?php

namespace App\Repositories\Contracts;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    public function getAll(bool $onlyActive = false): Collection;

    /** Find by numeric id or by slug. */
    public function find(string|int $idOrSlug): ?Service;

    public function create(array $data): Service;

    public function update(Service $service, array $data): Service;

    public function delete(Service $service): bool;

    /** @param int[] $ids Service ids in their new display order. */
    public function reorder(array $ids): void;
}
