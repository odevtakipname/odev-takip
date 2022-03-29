<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HocaController extends Controller
{
    public function index(){
        return view('client.hoca.ogrenciler');
    }
    public function data(){
        //->where('danisman', auth()->user()->id)
        $users = User::with('get_projects')->orderBy('created_at','DESC')->get();
        return $users;
    }
}
