<?php

namespace App\Repositories\Eloquents;

use App\Models\AboutPage;
use App\Repositories\Contracts\AboutPageRepositoryInterface;

class AboutPageRepository implements AboutPageRepositoryInterface
{
    /**
     * There is only ever one About page row. Auto-create it with
     * empty defaults the first time it's requested, so the admin
     * form always has something to load and PATCH against.
     */
    public function find(): AboutPage
    {
        return AboutPage::first() ?? AboutPage::create([
            'hero_title' => '',
            'hero_subtitle' => '',
            'story_title' => '',
            'story_paragraph' => '',
            'story_image' => null,
            'presence' => [],
            'values' => [],
        ]);
    }

    public function update(array $data): AboutPage
    {
        $page = $this->find();

        $page->update($data);

        return $page->fresh();
    }
}