<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
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
    public function createLanguage(Request $request)
    {
        $language = $request->all();
        unset($language['_token']);
        Language::create($language);

        return redirect()->route('account',['success'=>'Language successfully Added!']);  
        
    }

    /**
     * Edit the language.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editLanguage(Request $request)
    {
        $language = Language::findOrFail($request->id);
        return view('edit-language', ['language' => $language]);
        // return redirect()->route('languages',['success', 'Language successfully Edited!']);    
    }

    /**
     * Update the language.
     *
     * @return route redirect
     */
    public function updateLanguage(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $language->mastery = $request->mastery;
        $language->save();
        
        return redirect()->route('account',['success'=>'Language successfully Edited!']);    
    }

    /**
     * delete the language.
     *
     * @return route redirect
     */
    public function deleteLanguage(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $language->delete();   
    }
}
