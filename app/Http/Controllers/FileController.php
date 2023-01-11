<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Credit;
use App\Models\EmailTemplate;
use App\Models\EngineerFileNote;
use App\Models\File;
use App\Models\FileFeedback;
use App\Models\FileInternalEvent;
use App\Models\FileUrl;
use App\Models\Price;
use App\Models\RequestFile;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Laravel\Ui\Presets\React;
use Carbon\Carbon;
use Twilio\Rest\Client;

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

    public function download($file_name) {
        
        $file_path = public_path('/uploads/'.$file_name);
        return response()->download($file_path);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $masterTools = [];
        $slaveTools = [];

        if(Auth::user()->master_tools && Auth::user()->master_tools !== ''){
            $masterTools = explode(',',Auth::user()->master_tools);
        }
        if(Auth::user()->slave_tools && Auth::user()->master_tools !== ''){
            $slaveTools = explode(',',Auth::user()->slave_tools);
        }
        
        $brandsObjects = Vehicle::select('make')->distinct()->get();

        $brands = [];
        foreach($brandsObjects as $b){
            if($b->make != '')
            $brands []= $b->make;
        }

        return view('files.submit_file', ['brands' => $brands,'masterTools' => $masterTools, 'slaveTools' => $slaveTools]);
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
            'engine' => 'required|max:255',
            'ecu' => 'max:255',
            'user_id' => 'required',
            'gear_box' => 'max:255',
        ]);

        $file['tools'] = "tools value";//this is not required at all -- update it
        $file['credits'] = 0;
        $file['checked_by'] = 'customer';

        $newFile = File::create($file);

        if($newFile){
            return redirect()->route('stages', ['file_id' => $newFile->id]);
        }

        return redirect()->back()->withInput();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function postStages(Request $request)
    {   
        if($request->tuning == 'Stage 0'){

            $request->validate([
                'total_credits_to_submit' => 'required',
                'tuning' => 'required',
                'option' => 'required'
            ]);
        }
        else{

            $request->validate([
                'total_credits_to_submit' => 'required',
                'tuning' => 'required'
            ]);
        }

        $credits = $request->total_credits_to_submit;
        $file = File::findOrFail($request->file_id); 

        $file->stages = $request->tuning;

        if( $request->option && sizeof($request->option) > 0 ){
         $file->options = implode(',', $request->option );
        }

        $price = Price::where('label', 'credit_price')->first();

        $customer = Auth::user();

        $factor = 0;
        $tax = 0;

        if($customer->group->tax > 0){
            $tax = (float) $customer->group->tax;
        }

        if($customer->group->raise > 0){
            $factor = (float)  ($customer->group->raise / 100) * $price->value;
        }

        if($customer->group->discount > 0){
            $factor =  -1* (float) ($customer->group->discount / 100) * $price->value;
        }

        $file->save();

        return view( 'files.pay_credits', [ 
        'file' => $file, 
        'credits' => $credits, 
        'price' => $price,
        'factor' => $factor,
        'tax' => $tax,
        'group' =>  $customer->group
        ] );
    }

    public function sendMessage($receiver, $message)
    {
        try {
            $accountSid = env("TWILIO_SID");
            $authToken = env("TWILIO_AUTH_TOKEN");
            $twilioNumber = env("TWILIO_NUMBER"); 
            $client = new Client($accountSid, $authToken);

            $message = $client->messages
                  ->create($receiver, 
                           ["body" => $message, "from" => "ecutech"]
            );

            \Log::info('message sent to:'.$receiver);

        } catch (\Exception $e) {
            \Log::info($e->getMessage());
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addCredits(Request $request)
    {

        $credits = $request->credits;

        $creditsInAccount = Auth::user()->credits->sum('credits');

        if($creditsInAccount >= $request->credits){

            $credit = new Credit();
            $credit->file_id = $request->file_id;
            $credit->credits = -$credits;
            $credit->price_payed = 0;
            $credit->invoice_id = 'INV-'.mt_rand(1000,9999);
            
            $credit->user_id = Auth::user()->id;
            $credit->save();

            $file = File::findOrFail($request->file_id); 

            $file->credits = $credits;
            $file->is_credited = true;
            $file->assignment_time = Carbon::now();

            $file->save();

        // $admin = User::where('email', 'xrkalix@gmail.com')->first();
        $admin = User::where('is_admin', 1)->first();

        $template = EmailTemplate::where('name', 'File Uploaded')->first();

        $html = $template->html;

        $uploader = User::findOrFail($file->user_id);

        $html = str_replace("#brand_logo", get_image_from_brand($file->brand) ,$html);
        $html = str_replace("#customer_name", $uploader->name ,$html);
        $html = str_replace("#vehicle_name", $file->brand." ".$file->engine." ".$file->vehicle()->TORQUE_standard ,$html);
        
        $tunningType = '<img alt=".'.$file->stages.'" width="33" height="33" src="'.url('icons').'/'.\App\Models\Service::where('name', $file->stages)->first()->icon .'">';
        $tunningType .= '<span class="text-black" style="top: 2px; position:relative;">'.$file->stages.'</span>';
            
        foreach($file->options() as $option) {
            $tunningType .= '<div class="p-l-20"><img alt="'.$option.'" width="40" height="40" src="'.url('icons').'/'.\App\Models\Service::where('name', $option)->first()->icon.'">';
            $tunningType .=  $option;  
            $tunningType .= '</div>';
        }

        $html = str_replace("#tuning_type", $tunningType, $html);
        $html = str_replace("#file_url", env('BACKEND_URL').'file/'.$file->id, $html);

        $optionsMessage = "";
        if($file->options){
            foreach($file->options() as $option) {
                $optionsMessage .= ",".$option." ";
            }
        }

        $message = "Hi, New File is being uploaded by Client: ".$uploader->name."";
        

        $subject = "ECU Tech: File Uploaded!";

            \Mail::to($admin->email)->send(new \App\Mail\AllMails(['html' => $html, 'subject' => $subject]));
            $this->sendMessage($admin->phone, $message);
        }
        
        return redirect()->route('file-history',['success' => 'File successfully Added!']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stages(Request $request)
    {
        $file = File::findOrFail($request->file_id);
        $responseStages = Http::get('http://backend.ecutech.gr/api/get_stages');
        $stages = json_decode($responseStages->body(), true)['stages'];
        $responseOptions = Http::get('http://backend.ecutech.gr/api/get_options');
        $options = json_decode($responseOptions->body(), true)['options'];
        
        return view( 'files.set_stages', ['file' => $file, 'stages' => $stages, 'options' => $options] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fileHistory()
    {
        $files = File::orderBy('created_at','desc')
        ->where('is_credited', '=', 1)
        ->whereNull('original_file_id')
        ->where('user_id', Auth::user()->id)
        ->get();
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
            'request_file' => 'required',
            'file_type' => 'required|max:255',
            'master_tools' => 'required|max:255',
            'request_type' => 'required|max:255',
        ]);
        
        $file = $request->file('request_file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'),$fileName);

        $pos = strpos($requestFile['master_tools'], '.');
        $second_str = substr($requestFile['master_tools'], $pos);
        $first_str = substr($requestFile['master_tools'],0, $pos);
        $second_str = substr($second_str, 1);
        
        if($first_str != '')
            $ecusArray []= $first_str;  
        if($second_str != '')              
            $ecusArray []= $second_str; 

        $requestFile['master_tools'] = $first_str;
        $requestFile['tool_type'] = $second_str;

        $file = File::findOrFail($requestFile['file_id'])->toArray();

        $newFile = $file;
        $newFile['credits'] = 0;
        $newFile['file_attached'] =  $fileName;
        $newFile['request_type'] =   $requestFile['request_type'];
        $newFile['original_file_id'] =   $requestFile['file_id'];
        $newFile['file_type'] =   $requestFile['file_type'];
        $newFile['tool'] =   $requestFile['master_tools'];
        $newFile['tool_type'] =   $requestFile['tool_type'];
        $newFile['checked_by'] =  'customer';
        unset($newFile['id']);
        
        $old = File::findOrFail($requestFile['file_id']);
        $old->checked_by = 'customer';
        $old->save();

        $newFileCreated = File::create($newFile);

        $admin = User::where('is_admin', 1)->first();

        $template = EmailTemplate::where('name', 'Request File Uploaded')->first();

        $html = $template->html;

        $uploader = User::findOrFail($newFileCreated ->user_id);

        $html = str_replace("#brand_logo", get_image_from_brand($newFileCreated->brand) ,$html);
        $html = str_replace("#customer_name", $uploader->name ,$html);
        $html = str_replace("#vehicle_name", $newFileCreated->brand." ".$newFileCreated->engine." ".$newFileCreated->vehicle()->TORQUE_standard ,$html);
        
        $tunningType = '<img alt=".'.$newFileCreated->stages.'" width="33" height="33" src="'.url('icons').'/'.\App\Models\Service::where('name', $newFileCreated->stages)->first()->icon .'">';
        $tunningType .= '<span class="text-black" style="top: 2px; position:relative;">'.$newFileCreated->stages.'</span>';
        
        if($newFileCreated->options){
            foreach($newFileCreated->options() as $option) {
                $tunningType .= '<div class="p-l-20"><img alt="'.$option.'" width="40" height="40" src="'.url('icons').'/'.\App\Models\Service::where('name', $option)->first()->icon.'">';
                $tunningType .=  $option;  
                $tunningType .= '</div>';
            }
        }

        $html = str_replace("#tuning_type", $tunningType,$html);
        $html = str_replace("#file_url", route('file', $newFileCreated->id),$html);

        $optionsMessage = "";

        if($newFileCreated->options){
            foreach($newFileCreated->options() as $option) {
                $optionsMessage .= ",".$option." ";
            }
        }

        $message = "Hi, New File is being uploaded by a Client. 
        Customer: ".$uploader->name." 
        ". 
        "Vehicle: ".$newFileCreated->brand." ".$newFileCreated->engine." ".$newFileCreated->vehicle()->TORQUE_standard." 
        ". 
        "Tuning Type: ".$newFileCreated->stages." ".$optionsMessage." 
        ";

        $subject = "ECU Tech: New Request File Uploaded!";

            \Mail::to($admin->email)->send(new \App\Mail\AllMails(['html' => $html, 'subject' => $subject]));
            
            if($newFileCreated->assigned_to){
                $engineer = User::FindOrFail($newFileCreated->assigned_to);
                \Mail::to($engineer->email)->send(new \App\Mail\AllMails(['html' => $html, 'subject' => $subject]));
                $this->sendMessage($engineer->phone, $message);
            }

            $this->sendMessage($admin->phone, $message);
        

        if($newFileCreated){

            return redirect()->route('stages', ['file_id' => $newFileCreated ->id]);
        }

    }

    public function getComments(Request $request){

        $commentObj = Comment::where('engine', $request->engine);

        if($request->make){
            $commentObj->where('make',$request->make);
        }

        if($request->model){
            $commentObj->where('model', $request->model);
        }

        if($request->ecu){
            $commentObj->where('ecu',$request->ecu);
        }

        if($request->generation){
            $commentObj->where('generation', $request->generation);
        }

        $comments = $commentObj->get();
        
        $optionsArray = explode(',',$request->options);

        $optionComment = '';

        if(!$comments->isEmpty()){

            $optionComment .= '<ul class="bullets">';

            foreach($comments as $comment){
                if(in_array($comment->option,$optionsArray)){
                    $optionComment  .= '<li>'.$comment->comments.'</li>';
                }
            }

            $optionComment .= '</ul>';
        }

        return response()->json(['comments'=> $optionComment]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showFile($id)
    {
        $file = File::where('id',$id)
        ->where('user_id', Auth::user()->id)
        ->whereNull('original_file_id')
        ->first();

        if(!$file){
            abort(404);
        }

        $vehicle = Vehicle::where('Make', $file->brand)
        ->where('Model', $file->model)
        ->where('Generation', $file->version)
        ->where('Engine', $file->engine)
        ->first();
        
         if($file->checked_by == 'engineer'){
            $file->checked_by = 'seen';
            $file->save();
        }

        $slaveTools = [];
        $masterTools = [];

        if(Auth::user()->masterTools != ''){
            $masterTools = explode(',',  Auth::user()->master_tools );
        }
        if(Auth::user()->slave_tools != ''){
            $slaveTools = explode(',',  Auth::user()->slave_tools );
        }
        
        return view('files.show_file', [ 'file' => $file, 'masterTools' => $masterTools,  'slaveTools' => $slaveTools, 'vehicle' => $vehicle ]);
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
        $reply = new EngineerFileNote();
        $reply->egnineers_internal_notes = $request->egnineers_internal_notes;

        if($request->file('engineers_attachement')){
            $attachment = $request->file('engineers_attachement');
            $fileName = $attachment->getClientOriginalName();
            $attachment->move(public_path('uploads'),$fileName);
            $reply->engineers_attachement = $fileName;
        }

        $reply->file_id = $request->file_id;
        $reply->save();

        $file = File::findOrFail($request->file_id);

        // $admin = User::where('is_admin', 1)->first();
        $admin = User::where('email', 'xrkalix@gmail.com')->first();

        $template = EmailTemplate::where('name', 'Message To Engineer')->first();

        $html = $template->html;

        $uploader = User::findOrFail($file ->user_id);

        $html = str_replace("#brand_logo", get_image_from_brand($file->brand) ,$html);
        $html = str_replace("#customer_name", $uploader->name ,$html);
        $html = str_replace("#vehicle_name", $file->brand." ".$file->engine." ".$file->vehicle()->TORQUE_standard ,$html);
        
        $tunningType = '<img alt=".'.$file->stages.'" width="33" height="33" src="'.url('icons').'/'.\App\Models\Service::where('name', $newFileCreated->stages)->first()->icon .'">';
        $tunningType .= '<span class="text-black" style="top: 2px; position:relative;">'.$file->stages.'</span>';
            
        if($file->options){
            foreach($file->options() as $option) {
                $tunningType .= '<div class="p-l-20"><img alt="'.$option.'" width="40" height="40" src="'.url('icons').'/'.\App\Models\Service::where('name', $option)->first()->icon.'">';
                $tunningType .=  $option;  
                $tunningType .= '</div>';
            }
        }

        $html = str_replace("#tuning_type", $tunningType,$html);
        $html = str_replace("#file_url", route('file', $file->id),$html);

        $optionsMessage = "";
        
        if($file->options){
            foreach($file->options() as $option) {
                $optionsMessage .= ",".$option." ";
            }
        }

        $message = "Hi, a support message is sent by: ".$uploader->name;

        $subject = "ECU Tech: Client support message!";

            \Mail::to($admin->email)->send(new \App\Mail\AllMails(['html' => $html, 'subject' => $subject]));
            
            if($file->assigned_to){
                $engineer = User::FindOrFail($file->assigned_to);
                \Mail::to($engineer->email)->send(new \App\Mail\AllMails(['html' => $html, 'subject' => $subject]));
                $this->sendMessage($engineer->phone, $message);
            }
            
            $this->sendMessage($admin->phone, $message);
        
        $old = File::findOrFail($request->file_id);
        $old->checked_by = 'customer';
        $old->save();
        
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fileFeedback(Request $request)
    {
        FileFeedback::where('request_file_id','=', $request->request_file_id)->delete();

        $requestFile = new FileFeedback();
        $requestFile->file_id = $request->file_id;
        $requestFile->request_file_id = $request->request_file_id;
        $requestFile->type = $request->type;
        $requestFile->save();

        return response()->json($request->all());
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getModels(Request $request)
    {
        $brand = $request->brand;
        $models = Vehicle::select('model')->distinct()->where('make', '=', $brand)->get();
        return response()->json( [ 'models' => $models ] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getVersions(Request $request)
    {
        $model = $request->model;
        $brand = $request->brand;

        $versions = Vehicle::select('generation')->distinct()
        ->where('Make', '=', $brand)
        ->where('Model', '=', $model)
        ->get();

        return response()->json( [ 'versions' => $versions ] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getEngines(Request $request)
    {
        $model = $request->model;
        $brand = $request->brand;
        $version = $request->version;

        $engines = Vehicle::select('engine')->distinct()
        ->where('Make', '=', $brand)
        ->where('Model', '=', $model)
        ->where('Generation', '=', $version)
        ->get();

        return response()->json( [ 'engines' => $engines ] );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getECUs(Request $request)
    {
        $model = $request->model;
        $brand = $request->brand;
        $version = $request->version;
        $engine = $request->engine;
       
        $ecus = Vehicle::select('Engine_ECU')->distinct()
        ->where('Make', '=', $brand)
        ->where('Model', '=', $model)
        ->where('Generation', '=', $version)
        ->where('Engine', '=', $engine)
        ->get();

        $ecusArray = [];

        foreach($ecus as $e){
            if(str_contains($e->Engine_ECU, ' / ')){
                
                $pos = strpos($e->Engine_ECU, ' / ');
                $second_str = substr($e->Engine_ECU, $pos);
                $first_str = substr($e->Engine_ECU,0, $pos);
                $second_str = substr($second_str, 3);

                if($first_str != '')
                    $ecusArray []= $first_str;  
                if($second_str != '')              
                    $ecusArray []= $second_str;                
                
            }
            else{
                if($e->Engine_ECU != '')    
                    $ecusArray []= $e->Engine_ECU;
            }
        }

        $ecusArray = array_values(array_unique($ecusArray));
        
        return response()->json( [ 'ecus' => $ecusArray ]);
    }

}
