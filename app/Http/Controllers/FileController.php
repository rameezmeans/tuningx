<?php

namespace App\Http\Controllers;

use App\Models\File;
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
        return view('files.index', ['masterTools' => $masterTools, 'slaveTools' => $slaveTools]);
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
    public function showFile($id)
    {
        $file = File::findOrFail($id);
        return view('files.file', [ 'file' => $file ]);
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
        return view('files.file', [ 'file' => $file ]);
    }
}
