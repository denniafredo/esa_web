<?php

namespace App\Http\Controllers;

use App\Models\Employment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch employments
        $employments = Employment::whereDate('date_start_of_work', '>=', now()->subWeek())->get();
        $totalEmployments = Employment::count();

        // Fetch public holidays for the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $url = "https://api-harilibur.vercel.app/api?year={$currentYear}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        }
        curl_close($ch);

        $publicHolidays = json_decode($response, true);
        for ($i = 0; $i < sizeof($publicHolidays); $i++) {
            $date = Carbon::createFromFormat('Y-m-d', $publicHolidays[$i]['holiday_date']);
            $publicHolidays[$i]['day_of_week'] = $date->format('D');
        }
        $currentDate = now();
        $filteredHolidays = [];
        usort($publicHolidays, function ($a, $b) {
            $dateA = Carbon::createFromFormat('Y-m-d', $a['holiday_date']);
            $dateB = Carbon::createFromFormat('Y-m-d', $b['holiday_date']);
            return $dateA <=> $dateB;
        });
        for ($i = 0; $i < sizeof($publicHolidays); $i++) {
            $date = Carbon::createFromFormat('Y-m-d', $publicHolidays[$i]['holiday_date']);

            if ($date->gte($currentDate)) {
                $publicHolidays[$i]['day_of_week'] = $date->format('D');
                $filteredHolidays[] = $publicHolidays[$i];
            }

            // Limit to 6 events
            if (count($filteredHolidays) >= 6) {
                break;
            }
        }
        $publicHolidays = $filteredHolidays;

        return view('dashboard', compact('employments', 'totalEmployments', 'publicHolidays'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function show($id)
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit()
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

}
