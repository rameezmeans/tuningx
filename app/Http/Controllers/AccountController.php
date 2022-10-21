<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class AccountController extends Controller
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
        $languages = Language::where('user_id', Auth::user()->id)->get();
        $credits = Credit::orderBy('created_at', 'asc')->get();
        $masterTools = explode(',', Auth::user()->master_tools);
        $slaveTools = explode(',', Auth::user()->slave_tools);
        return view('account', [ 'languages' => $languages, 'credits' => $credits, 'masterTools' =>  $masterTools,'slaveTools' => $slaveTools ]);
    }

    /**
     * get Bosch ECU page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function boschECU()
    {
        return view('bosch_ecu');
    }

    /**
     * get Price List page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function priceList()
    {
        return view('price_list');
    }



    /**
     * Update Tools.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateTools(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->master_tools = implode(',', $request->master_tools);
        $user->slave_tools =  implode(',', $request->slave_tools);
        $user->save();

        return redirect()->route('account',['success' => 'Tools edited, successfully!']);
        
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword(Request $request)
    {

        $customValidationMessages = [
            'password.required' => 'We thought you wanted to change your password. Please provide a new password.',
            'password.min' => 'Please provide a password at least 8 characters long. Your account will be safer this way!',
            'password.confirm' => 'Nope! You did not confirm you want to use that password. Please confirm your password.'
        ];

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required',
          ], $customValidationMessages);
  
          $user = \Auth::user();

          if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->route('account',['error' => 'Password does not match!']);
          }
  
          $user->password = \Hash::make($request->new_password);
  
          $user->save();
  
          return redirect()->route('account',['success' => 'Password udpated, successfully!']);
    }


}
