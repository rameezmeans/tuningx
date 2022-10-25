<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $todaysFilesCount = File::where('created_at', '>=', Carbon::today())->count();
        $yesterdaysFilesCount = File::whereDate('created_at', Carbon::yesterday())->count();
        $previousYearsFilesCount = File::whereYear('created_at', now()->subYear()->year)->count();
        $twoYearsAgoFilesCount = File::whereYear('created_at', now()->subYears(2)->year)->count();
          
        $startWeek = Carbon::now()->subWeek()->startOfWeek(); 
        $endWeek   = Carbon::now()->subWeek()->endOfWeek();  

        $previousWeeksFilesCount    = File::query()->whereBetween('created_at',[ $startWeek,$endWeek ])->count();

        $previousMonthsFilesCount = File::whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->count();

        $thisWeeksFilesCount = File::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $thisMonthsFilesCount = File::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->count();
        
        $thisWeeksCreditsCount = - (Credit::whereMonth('created_at',Carbon::now()->month)
        ->WhereNotNull('file_id')
        ->sum('credits'));

        $thisYearsFilesCount = File::whereYear('created_at', Carbon::now()->year)->count();
        $thisYearsCreditsCount = -(Credit::whereYear('created_at', Carbon::now()->year)
        ->WhereNotNull('file_id')->sum('credits'));

        $twoFiles = File::orderBy('created_at', 'desc')->take(2)->get();

        $items = File::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $count = [];
        $countArr = [];
        
        foreach ($items as $key => $value) {
            $count[(int)$key] = count($value);
        }
        
        for($i = 1; $i <= 12; $i++){
            if(!empty($count[$i])){
                $countArr[$i] = $count[$i];    
            }else{
                $countArr[$i] = 0;    
            }
        }

        return view('home', [ 
            'todaysFilesCount' => $todaysFilesCount, 
            'yesterdaysFilesCount'  => $yesterdaysFilesCount, 
            'previousYearsFilesCount'  => $previousYearsFilesCount, 
            'previousWeeksFilesCount'  => $previousWeeksFilesCount,
            'previousMonthsFilesCount'  => $previousMonthsFilesCount,
            'thisWeeksFilesCount'  => $thisWeeksFilesCount,
            'thisMonthsFilesCount'  => $thisMonthsFilesCount,
            'twoYearsAgoFilesCount'  => $twoYearsAgoFilesCount,
            'thisWeeksCreditsCount'  => $thisWeeksCreditsCount,
            'thisYearsCreditsCount'  => $thisYearsCreditsCount,
            'thisYearsFilesCount'  => $thisYearsFilesCount,
            'twoFiles'  => $twoFiles,
            'countArr'  => json_encode($countArr,JSON_NUMERIC_CHECK),
        ]);
    }
}
