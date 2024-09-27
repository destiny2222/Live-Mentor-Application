<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BookSession;
use App\Models\Proposal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function getAnalyticsData(Request $request): JsonResponse
    {
        try {
            $user_id = $request->user()->id;
            $end_date = now();
            $start_date = $end_date->copy()->subDays(30);

            $enrollments = $this->getEnrollmentData($user_id, $start_date, $end_date);
            $sessions = $this->getSessionData($user_id, $start_date, $end_date);

            return response()->json([
                'enrollments' => $enrollments,
                'sessions' => $sessions,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getEnrollmentData($user_id, $start_date, $end_date)
    {
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

        return [
            'daily' => $daily,
            'weekly' => $weekly,
            'monthly' => $monthly,
        ];
    }

    private function getSessionData($user_id, $start_date, $end_date)
    {
        $sessions = BookSession::query()
            ->where('user_id', $user_id)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(CASE WHEN status IS NULL THEN 1 ELSE 0 END) as pending'),
                DB::raw('SUM(CASE WHEN status = "0" THEN 1 ELSE 0 END) as reviewing'),
                DB::raw('SUM(CASE WHEN status = "1" THEN 1 ELSE 0 END) as accepted')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $daily = $this->fillMissingDates($sessions, $start_date, $end_date, 'Y-m-d', ['pending', 'reviewing', 'accepted']);
        $weekly = $this->aggregateToWeekly($daily);
        $monthly = $this->aggregateToMonthly($daily);

        return [
            'daily' => $daily,
            'weekly' => $weekly,
            'monthly' => $monthly,
        ];
    }

    private function fillMissingDates($data, $start, $end, $format, $fields = ['count'])
    {
        $result = collect();
        $current = $start->copy();

        while ($current <= $end) {
            $date = $current->format($format);
            $entry = $data->firstWhere('date', $date);
            $result[$date] = array_fill_keys($fields, 0);
            
            if ($entry) {
                foreach ($fields as $field) {
                    $result[$date][$field] = $entry->{$field} ?? 0;
                }
            }
            
            $current->addDay();
        }

        return $result;
    }

    private function aggregateToWeekly($daily)
    {
        return $daily->groupBy(function ($value, $key) {
            return Carbon::parse($key)->format('Y-W');
        })->map(function ($week) {
            return $week->reduce(function ($carry, $day) {
                foreach ($day as $key => $value) {
                    $carry[$key] = ($carry[$key] ?? 0) + $value;
                }
                return $carry;
            }, []);
        });
    }

    private function aggregateToMonthly($daily)
    {
        return $daily->groupBy(function ($value, $key) {
            return Carbon::parse($key)->format('Y-m');
        })->map(function ($month) {
            return $month->reduce(function ($carry, $day) {
                foreach ($day as $key => $value) {
                    $carry[$key] = ($carry[$key] ?? 0) + $value;
                }
                return $carry;
            }, []);
        });
    }
}
