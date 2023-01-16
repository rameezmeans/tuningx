<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\File;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function clearFeed(Request $request) {
        Session::forget('feed');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $todaysFilesCount = File::where('created_at', '>=', Carbon::today())->where('user_id', $user->id)->count();
        $yesterdaysFilesCount = File::whereDate('created_at', Carbon::yesterday())->where('user_id', $user->id)->count();
        $previousYearsFilesCount = File::whereYear('created_at', now()->subYear()->year)->where('user_id', $user->id)->count();
        $twoYearsAgoFilesCount = File::whereYear('created_at', now()->subYears(2)->year)->where('user_id', $user->id)->count();
          
        $startPrevWeek = Carbon::now()->subWeek()->startOfWeek(); 
        $endPrevWeek   = Carbon::now()->subWeek()->endOfWeek();  

        $previousWeeksFilesCount    = File::query()->whereBetween('created_at',[ $startPrevWeek,$endPrevWeek ])->where('user_id', $user->id)->count();

        $previousMonthsFilesCount = File::whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->where('user_id', $user->id)->count();

        $thisWeeksFilesCount = File::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('user_id', $user->id)->count();
        $thisMonthsFilesCount = File::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at',Carbon::now()->month)->where('user_id', $user->id)->count();
        
        $thisWeeksCreditsCount = - (Credit::whereMonth('created_at',Carbon::now()->month)
        ->WhereNotNull('file_id')->where('user_id', $user->id)
        ->sum('credits'));

        $thisYearsFilesCount = File::whereYear('created_at', Carbon::now()->year)->where('user_id', $user->id)->count();
        $thisYearsCreditsCount = -(Credit::whereYear('created_at', Carbon::now()->year)->where('user_id', $user->id)
        ->WhereNotNull('file_id')->sum('credits'));

        $twoFiles = File::orderBy('created_at', 'desc')->where('user_id', $user->id)->take(2)->get();

        $items = File::select('id', 'created_at')->where('user_id', $user->id)
        ->get()
        ->groupBy(function($date) {

            if(Carbon::parse($date->created_at)->format('Y') == date('Y')){
                //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
                return Carbon::parse($date->created_at)->format('m'); // grouping by months
            }
        });

        $count = [];
        $countYear = [];
        
        foreach ($items as $key => $value) {
            $count[(int)$key] = count($value);
        }
        
        for($i = 1; $i <= 12; $i++){
            if(!empty($count[$i])){
                $countYear[$i] = $count[$i];    
            }else{
                $countYear[$i] = 0;    
            }
        }

        $datesMonth = [];
        $datesMonthCount = [];

        for($i = 1; $i <=  date('t'); $i++){
            // add the date to the dates array
            $datesMonth[] =  str_pad($i, 2, '0', STR_PAD_LEFT).'-'. date('M');
            $datesMonthCount []= File::whereMonth('created_at',date('m'))->whereDay('created_at',$i)->where('user_id', $user->id)->count();
        }

        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek();

        $weekRange = $this->createDateRangeArray($thisWeekStart, $thisWeekEnd);

        $weekCount = [];
        foreach($weekRange as $r) {
            $date = DateTime::createFromFormat('d/m/Y', $r);
            $day = $date->format('d');
            $month = $date->format('m');
            $weekCount []= File::whereMonth('created_at',$month)->whereDay('created_at',$day)->where('user_id', $user->id)->count();
        }

        // dd($countYear);
        
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
            'countYear'  => json_encode($countYear,JSON_NUMERIC_CHECK),
            'datesMonth'  => json_encode($datesMonth,JSON_NUMERIC_CHECK),
            'datesMonthCount'  => json_encode($datesMonthCount,JSON_NUMERIC_CHECK),
            'weekRange'  => json_encode($weekRange,JSON_NUMERIC_CHECK),
            'weekCount'  => json_encode($weekCount,JSON_NUMERIC_CHECK),
        ]);
    }

    function createDateRangeArray($strDateFrom,$strDateTo){
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.
    
        // could test validity of dates here but I'm already doing
        // that in the main script
    
        $aryRange = [];
    
        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));
    
        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('d/m/y', $iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('d/m/y', $iDateFrom));
            }
        }
        return $aryRange;
    }
}
