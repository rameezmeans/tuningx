<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $yesterdaysFilesCount = File::where('created_at', '>=', Carbon::yesterday())->count();
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
        ]);
    }
}
