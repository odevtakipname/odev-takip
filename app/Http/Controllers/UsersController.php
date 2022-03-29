<?php

namespace App\Http\Controllers;

use App\Models\Proje;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index()
    {
        return view('client.kullanicilar.kullanicilar');
    }
    public function data()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return $users;
    }
    public function online_user()
    {
        $user = User::find(auth()->user()->id);
        if ($user->unvan == "proje-ogrencisi") {
           $project = Proje::where('ogrenci_id',auth()->user()->id)->orderBy('created_at','DESC')->get()->first();
           $danisman = isset($user->danisman) &&  User::find($user->danisman) ? User::find($user->danisman) : [];
        } else {
            $project = [];
            $danisman = [];
        }
        
        return ['user'=>$user,'project'=>$project,'danisman'=>$danisman];
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $user  = User::find($request->id);
        } else {
            $user = new User();
        }
        //Log::info($request->post());
        $user->ad = $request->ad;
        $user->soyad = $request->soyad;
        $user->eposta = $request->eposta;
        $user->unvan = $request->unvan;
        $user->password = bcrypt($request->eposta);
        $user->danisman = null;
        $user->person  = [
            "bolum" => $request->bolum,
            "cep" => $request->cep,
            "fakulte" => $request->fakulte,
            "ogrenciNo" => $request->ogrenciNo,
            "sinif" => $request->sinif
        ];

        if ($request->file('image')) {
            $name = date('YmdHi') . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
            $user->image = $name;
        }
        $user->save();
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
    public function newAdmin()
    {
        $user = new User();
        //Log::info($request->post());
        $user->ad = "Sistem ";
        $user->soyad = "Yöneticisi";
        $user->eposta = "yonetici1@yonetici.com";
        $user->unvan = "sistem-yoneticisi";
        $user->password = bcrypt(123);
        $user->danisman = null;
        $user->person  = [
            "bolum" => "",
            "cep" => "",
            "fakulte" => "",
            "ogrenciNo" => "",
            "sinif" => ""
        ];
        $user->save();
        return $user;
    }
}
