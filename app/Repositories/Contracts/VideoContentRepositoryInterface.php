<?php

namespace App\Repositories\Contracts;

use App\Models\VideoContent;

interface VideoContentRepositoryInterface
{
    public function get(): ?VideoContent;

    public function upsert(array $data): VideoContent;
}