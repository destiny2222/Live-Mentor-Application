<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EnrollmentDataController extends Controller
{
    public function getEnrollmentData(Request $request)
    {

        try {
            $user_id = $request->user()->id;
            $end_date = now();
            $start_date = $end_date->copy()->subDays(30);

            $enrollments = Proposal::query()
                ->where('user_id', $user_id)
                ->where('status', '4')
                ->whereBetween('created_at', [$start_date, $end_date])
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            $daily = $this->fillMissingDates($enrollments, $start_date, $end_date, 'Y-m-d');
            $weekly = $this->aggregateToWeekly($daily);
            $monthly = $this->aggregateToMonthly($daily);

            return response()->json([
                'daily' => $daily,
                'weekly' => $weekly,
                'monthly' => $monthly,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    private function fillMissingDates($data, $start, $end, $format)
    {
        $result = collect();
        $current = $start->copy();

        while ($current <= $end) {
            $date = $current->format($format);
            $count = $data->firstWhere('date', $date)?->count ?? 0;
            $result[$date] = $count;
            $current->addDay();
        }

        return $result;
    }

    private function aggregateToWeekly($daily)
    {
        return $daily->groupBy(function ($value, $key) {
            return Carbon::parse($key)->format('Y-W');
        })->map->sum();
    }

    private function aggregateToMonthly($daily)
    {
        return $daily->groupBy(function ($value, $key) {
            return Carbon::parse($key)->format('Y-m');
        })->map->sum();
    }
}