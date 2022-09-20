<?php

namespace App\Http\Controllers;

use App\Models\EngineerFileNote;
use App\Models\File;
use App\Models\FileInternalEvent;
use App\Models\FileUrl;
use App\Models\RequestFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
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
       
        $masterTools = explode(',',Auth::user()->master_tools);
        $slaveTools = explode(',',Auth::user()->slave_tools);
        return view('files.submit_file', ['masterTools' => $masterTools, 'slaveTools' => $slaveTools]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'),$fileName);
     
        return response()->json(['success'=>$fileName]);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postFile(Request $request)
    {

        $file = $request->validate([
            'tool' => 'required|max:255',
            'tool_type' => 'required|max:255',
            'file_attached' => 'required|max:255',
            'file_type' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:255',
            'model_year' => 'required|max:255',
            'license_plate' => 'required|max:255',
            'vin_number' => 'required|max:255',
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'version' => 'required|max:255',
            'model' => 'required|max:255',
            'tools' => 'required|max:255',
            'gear_box' => 'required|max:255',
        ]);

        $flag = File::create($file);

        if($flag){
            return redirect()->route('file-history',['success', 'File successfully Added!'])->withInput();;
        }

        return redirect()->back()->withInput();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fileHistory()
    {
        $files = File::all();
        return view('files.file_history', [ 'files' => $files ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function requestFile(Request $request)
    {

        $requestFile = $request->validate([
            'file_id' => 'required',
            'request_file' => 'required|max:255',
            'file_type' => 'required|max:255',
            'master_tools' => 'required|max:255',
            'ecu_file_select' => '',
            'gearbox_file_select' => ''
        ]);

        $file = $request->file('request_file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'),$fileName);

        $requestFile['request_file'] = $fileName;
        $requestFile['master_tools'] = implode(',', $requestFile['master_tools'] );
        
        $requestFile = RequestFile::create($requestFile);

        return redirect()->back()->with('success', 'File successfully Added!');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showFile($id)
    {
        $file = File::findOrFail($id);
        $user = Auth::user();
        $masterTools = explode(',',  Auth::user()->master_tools );
        $slaveTools = explode(',',  Auth::user()->slave_tools );
        $unsortedTimelineObjects = $file->files->toArray();

        $createdTimes = [];

        foreach($file->files->toArray() as $t) {
            $createdTimes []= $t['created_at'];
        } 
    
        foreach($file->engineer_file_notes->toArray() as $a) {
            $unsortedTimelineObjects []= $a;
            $createdTimes []= $a['created_at'];
        }   

        foreach($file->file_internel_events->toArray() as $b) {
            $unsortedTimelineObjects []= $b;
            $createdTimes []= $b['created_at'];
        } 

        foreach($file->file_urls->toArray() as $b) {
            $unsortedTimelineObjects []= $b;
            $createdTimes []= $b['created_at'];
        } 

        array_multisort($createdTimes, SORT_DESC, $unsortedTimelineObjects);
        
        return view('files.show_file', [ 'attachedFiles' => $unsortedTimelineObjects,'file' => $file, 'masterTools' => $masterTools,  'slaveTools' => $slaveTools ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function EditMilage(Request $request)
    {
        
        $file = File::findOrFail($request->id);
        $file->license_plate = $request->license_plate;
        $file->first_registration = $request->first_registration;
        $file->kilometrage = $request->kilometrage;
        $file->vehicle_internal_notes = $request->vehicle_internal_notes;
        $file->save();
        return redirect()->back()->with('success', 'File successfully Edited!');

    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addCustomerNote(Request $request)
    {
        $file = File::findOrFail($request->id);
        $file->name = $request->name;
        $file->phone = $request->phone;
        $file->email = $request->email;
        $file->customer_internal_notes = $request->customer_internal_notes;
        $file->save();
        return redirect()->back()->with('success', 'File successfully Edited!');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fileEngineersNotes(Request $request)
    {
        $file = new EngineerFileNote();
        $file->egnineers_internal_notes = $request->egnineers_internal_notes;

        if($request->file('engineers_attachement')){
            $attachment = $request->file('engineers_attachement');
            $fileName = $attachment->getClientOriginalName();
            $attachment->move(public_path('uploads'),$fileName);
            $file->engineers_attachement = $fileName;
        }

        $file->file_id = $request->file_id;
        $file->save();
        return redirect()->back()->with('success', 'Engineer note successfully Added!');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fileEventsNotes(Request $request)
    {
        $file = new FileInternalEvent();
        $file->events_internal_notes = $request->events_internal_notes;
       
        if($request->file('events_attachement')){
            $attachment = $request->file('events_attachement');
            $fileName = $attachment->getClientOriginalName();
            $attachment->move(public_path('uploads'),$fileName);
            $file->events_attachement = $fileName;
        }

        $file->file_id = $request->file_id;
        $file->save();
        return redirect()->back()->with('success', 'Events note successfully Added!');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fileURL(Request $request)
    {
        $file = new FileUrl();
        $file->file_url = $request->file_url;
       
        if($request->file('file_url_attachment')){
            $attachment = $request->file('file_url_attachment');
            $fileName = $attachment->getClientOriginalName();
            $attachment->move(public_path('uploads'),$fileName);
            $file->file_url_attachment = $fileName;
        }

        $file->file_id = $request->file_id;
        $file->save();
        return redirect()->back()->with('success', 'URL successfully Added!');
    }
}
