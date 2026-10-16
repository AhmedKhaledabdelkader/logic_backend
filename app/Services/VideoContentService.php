<?php

namespace App\Services;

use App\Models\VideoContent;
use App\Repositories\Contracts\VideoContentRepositoryInterface;

class VideoContentService
{
    public function __construct(
        protected VideoContentRepositoryInterface
            $videoContentRepository
    ) {
    }

    public function get(): ?VideoContent
    {
        return $this->videoContentRepository->get();
    }

    public function upsert(
        array $data
    ): VideoContent {

        return $this->videoContentRepository->upsert(
            $data
        );
    }
}