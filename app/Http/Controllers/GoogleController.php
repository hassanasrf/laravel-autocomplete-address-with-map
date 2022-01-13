<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Session;

class GoogleController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
        Session::put('name', $request->get('autocomplete'));
        Session::put('lat', $request->get('latitude'));
        Session::put('lang', $request->get('longitude'));
        return view('googleAutocomplete');
    }
}