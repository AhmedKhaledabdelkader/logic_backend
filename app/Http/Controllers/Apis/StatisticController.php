<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\StatisticResource;
use App\Services\StatisticService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function __construct(
        protected StatisticService $statisticService
    ) {
    }

    /**
     * Get all statistics.
     */
    public function index()
    {
        $statistics = $this->statisticService->getAll();

        return response()->json([
            'status' => 'success',
            'message' => 'Statistics retrieved successfully.',
            'data' => StatisticResource::collection(
                $statistics
            ),
        ]);
    }

    /**
     * Get one statistic.
     */
    public function show(int $id)
    {
        $statistic = $this->statisticService->getById(
            $id
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Statistic retrieved successfully.',
            'data' => new StatisticResource(
                $statistic
            ),
        ]);
    }

    /**
     * Create or update multiple statistics.
     *
     * Expected request:
     *
     * statistics[0][id]
     * statistics[0][number]
     * statistics[0][title]
     *
     * statistics[1][id]
     * statistics[1][number]
     * statistics[1][title]
     */
   public function upsert(Request $request)
{
    $statistics = $request->input(
        'statistics',
        []
    );

    $savedStatistics =
        $this->statisticService->sync(
            $statistics
        );

    return response()->json([
        'status' => 'success',
        'message' =>
            'Statistics synchronized successfully.',
        'data' =>
            StatisticResource::collection(
                $savedStatistics
            ),
    ]);
}

    /**
     * Delete one statistic.
     */
    public function destroy(int $id): JsonResponse
    {
        $this->statisticService->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Statistic deleted successfully.',
        ]);
    }
}