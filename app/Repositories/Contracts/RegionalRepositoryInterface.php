<?php

namespace App\Repositories\Contracts;

use App\Models\Regional;

interface RegionalRepositoryInterface
{
    public function get(): ?Regional;

    public function findById(int $id): Regional;

    public function upsert(array $data): Regional;

    public function delete(Regional $regional): bool;
}