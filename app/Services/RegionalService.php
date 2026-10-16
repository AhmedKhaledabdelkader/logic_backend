<?php

namespace App\Services;

use App\Models\Regional;
use App\Repositories\Contracts\RegionalRepositoryInterface;
use App\Traits\HandlesFileUpload;

class RegionalService
{
    use HandlesFileUpload;

    private const REGIONAL_ID = 1;

    public function __construct(
        protected RegionalRepositoryInterface $regionalRepository
    ) {
    }

    /**
     * Get Regional ID = 1.
     */
    public function get(): ?Regional
    {
        return $this->regionalRepository->get();
    }

    /**
     * Create or update Regional ID = 1.
     */
    public function upsert(array $data): Regional
    {
        /*
         * Always work with Regional ID = 1.
         */
        $existing = Regional::find(
            self::REGIONAL_ID
        );

        /*
         * Check if a new image was uploaded.
         */
        if (
            isset($data['image']) &&
            $data['image']
        ) {

            /*
             * Keep old image path.
             */
            $oldImage = $existing?->image;

            /*
             * Store new image.
             */
            $data['image'] = $this->storeFile(
                $data['image'],
                'regionals',
                'private'
            );

            /*
             * Delete old image.
             */
            if ($oldImage) {

                $this->deleteFile(
                    $oldImage,
                    'private'
                );
            }

        } elseif ($existing) {

            /*
             * No new image.
             *
             * Keep current image.
             */
            $data['image'] = $existing->image;
        }

        /*
         * Force ID = 1.
         */
        $data['id'] = self::REGIONAL_ID;

        return $this->regionalRepository->upsert(
            $data
        );
    }

    /**
     * Delete Regional ID = 1.
     */
    public function delete(): bool
    {
        $regional = $this->regionalRepository->findById(
            self::REGIONAL_ID
        );

        /*
         * Delete image.
         */
        if ($regional->image) {

            $this->deleteFile(
                $regional->image,
                'private'
            );
        }

        /*
         * Delete database record.
         */
        return $this->regionalRepository->delete(
            $regional
        );
    }
}