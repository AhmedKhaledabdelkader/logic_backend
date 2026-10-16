<?php

namespace App\Services;

use App\Models\Insight;
use App\Repositories\Contracts\InsightRepositoryInterface;
use App\Traits\HandlesFileUpload;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class InsightService
{
    use HandlesFileUpload;

    public function __construct(
        protected InsightRepositoryInterface $insightRepository
    ) {
    }

    public function getAll(): Collection
    {
        return $this->insightRepository->getAll();
    }

    public function getFeatured(): Collection
    {
        return $this->insightRepository->getFeatured();
    }

    public function find(int $id): Insight
    {
        return $this->insightRepository->find($id);
    }

    /**
     * Create a new insight.
     */
    public function create(array $data): Insight
    {
        if ($data['image'] instanceof UploadedFile) {
            $data['image'] = $this->storeFile($data['image'], 'insights', 'private');
        } else {
            $data['image'] = null;
        }

        return $this->insightRepository->create($data);
    }

    /**
     * Update an existing insight.
     */
    public function update(int $id, array $data): Insight
    {
        $existing = $this->insightRepository->find($id);

        if ($data['image'] instanceof UploadedFile) {
            $oldImage = $existing->image;

            $data['image'] = $this->storeFile($data['image'], 'insights', 'private');

            if ($oldImage) {
                $this->deleteFile($oldImage, 'private');
            }
        } else {
            // No new file was uploaded (or it never arrived because of the
            // PUT/multipart issue) — keep whatever image already exists.
            $data['image'] = $existing->image;
        }

        $data['title'] = $data['title'] ?? $existing->title;
        $data['is_featured'] = $data['is_featured'] ?? $existing->is_featured;

        return $this->insightRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $insight = $this->insightRepository->find($id);

        if ($insight->image) {
            $this->deleteFile($insight->image, 'private');
        }

        return $this->insightRepository->delete($id);
    }
}