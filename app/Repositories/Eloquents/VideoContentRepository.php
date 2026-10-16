<?php

namespace App\Repositories\Eloquents;

use App\Models\VideoContent;
use App\Repositories\Contracts\VideoContentRepositoryInterface;

class VideoContentRepository
    implements VideoContentRepositoryInterface
{
    private const CONTENT_ID = 1;

    public function get(): ?VideoContent
    {
        return VideoContent::find(
            self::CONTENT_ID
        );
    }

    public function upsert(array $data): VideoContent
    {
        return VideoContent::updateOrCreate(
            [
                'id' => self::CONTENT_ID,
            ],
            [
                'title' => $data['title'],
                'subtitle' => $data['subtitle'],
                'youtube_url' => $data['youtube_url'],
            ]
        );
    }
}