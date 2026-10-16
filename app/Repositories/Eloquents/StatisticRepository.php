<?php

namespace App\Repositories\Eloquents;

use App\Models\Statistic;
use App\Repositories\Contracts\StatisticRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StatisticRepository implements StatisticRepositoryInterface
{
    public function getAll(): Collection
    {
        return Statistic::orderBy('id')->get();
    }

    public function findById(int $id): Statistic
    {
        return Statistic::findOrFail($id);
    }

    public function upsert(array $data): Statistic
    {
        if (!empty($data['id'])) {

            $statistic = Statistic::findOrFail(
                $data['id']
            );

            $statistic->update([
                'number' => $data['number'],
                'title' => $data['title'],
            ]);

            return $statistic->fresh();
        }

        return Statistic::create([
            'number' => $data['number'],
            'title' => $data['title'],
        ]);
    }

    /**
     * Synchronize the database with the submitted statistics.
     *
     * Existing IDs are updated.
     * Missing IDs are created.
     * IDs not submitted anymore are deleted.
     */
    public function sync(array $statistics): Collection
    {
        $keptIds = [];

        foreach ($statistics as $data) {

            $statistic = $this->upsert($data);

            $keptIds[] = $statistic->id;
        }

        /*
         * Delete every statistic that was NOT
         * included in the submitted list.
         */
        if (empty($keptIds)) {

            Statistic::query()->delete();

        } else {

            Statistic::whereNotIn(
                'id',
                $keptIds
            )->delete();
        }

        return Statistic::orderBy('id')->get();
    }

    public function delete(
        Statistic $statistic
    ): bool {
        return $statistic->delete();
    }
}