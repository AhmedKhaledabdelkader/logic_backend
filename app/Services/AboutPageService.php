<?php

namespace App\Services;

use App\Models\AboutPage;
use App\Repositories\Contracts\AboutPageRepositoryInterface;
use App\Traits\HandlesFileUpload;
use Illuminate\Http\UploadedFile;

class AboutPageService
{
    use HandlesFileUpload;

    public function __construct(
        protected AboutPageRepositoryInterface $aboutPageRepository
    ) {
    }

    public function find(): AboutPage
    {
        return $this->aboutPageRepository->find();
    }

    public function update(array $data): AboutPage
    {
        $existing = $this->aboutPageRepository->find();

        if ($data['story_image'] instanceof UploadedFile) {
            $oldImage = $existing->story_image;

            $data['story_image'] = $this->storeFile($data['story_image'], 'about', 'private');

            if ($oldImage) {
                $this->deleteFile($oldImage, 'private');
            }
        } else {
            // No new file uploaded — keep whatever image already exists.
            $data['story_image'] = $existing->story_image;
        }

        return $this->aboutPageRepository->update($data);
    }
}