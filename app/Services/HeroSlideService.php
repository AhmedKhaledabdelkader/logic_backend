<?php

namespace App\Services;

use App\Models\HeroSlide;
use App\Repositories\Contracts\HeroSlideRepositoryInterface;
use App\Traits\HandlesFileUpload;
use Illuminate\Database\Eloquent\Collection;

class HeroSlideService
{
    use HandlesFileUpload;

    public function __construct(
        protected HeroSlideRepositoryInterface $heroSlideRepository
    ) {
        //
    }

    /**
     * Create or update one hero slide.
     */
    public function upsert(array $data): HeroSlide
    {
        $existing = null;

        /*
         * Find the existing slide when an ID is provided.
         */
        if (!empty($data['id'])) {

            $existing = $this->heroSlideRepository->findById(
                (int) $data['id']
            );
        }

        /*
         * Check if a NEW image was actually uploaded.
         */
        if (
            isset($data['image']) &&
            $data['image']
        ) {

            /*
             * Keep the old image path before replacing it.
             */
            $oldImage = $existing?->image;

            /*
             * Store the new image.
             */
            $data['image'] = $this->storeFile(
                $data['image'],
                'hero-slides',
                'private'
            );

            /*
             * Delete the old image only after
             * the new image has been stored.
             */
            if ($oldImage) {

                $this->deleteFile(
                    $oldImage,
                    'private'
                );
            }

        } elseif ($existing) {

            /*
             * No new image was uploaded.
             *
             * IMPORTANT:
             * Keep the existing image.
             */
            $data['image'] = $existing->image;
        }

        /*
         * Send the final data to the repository.
         */
        return $this->heroSlideRepository->upsert(
            $data
        );
    }

    /**
     * Create or update multiple hero slides.
     *
     * @param array $slides
     * @return Collection
     */
    public function upsertMany(array $slides): Collection
    {
        $savedSlides = [];

        foreach ($slides as $slide) {

            $savedSlides[] = $this->upsert(
                $slide
            );
        }

        return new Collection(
            $savedSlides
        );
    }

    /**
     * Get all hero slides.
     */
    public function getAll(): Collection
    {
        return $this->heroSlideRepository->getAll();
    }

    /**
     * Get one hero slide.
     */
    public function getById(int $id): HeroSlide
    {
        return $this->heroSlideRepository->findById(
            $id
        );
    }

    /**
     * Delete hero slide.
     */
    public function delete(int $id): bool
    {
        $heroSlide = $this->heroSlideRepository->findById(
            $id
        );

        /*
         * Delete the stored image.
         */
        if ($heroSlide->image) {

            $this->deleteFile(
                $heroSlide->image,
                'private'
            );
        }

        /*
         * Delete the database record.
         */
        return $this->heroSlideRepository->delete(
            $heroSlide
        );
    }
}
