<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TakipController extends Controller
{
    
    public function takip(){
        $proje_yoentici = User::where('unvan','proje-yurutucusu')->get();
        $proje_ogrencisi = User::where('unvan','proje-ogrencisi')->get();
        $teacher = count($proje_yoentici);
        $counter = 0;
        
        foreach($proje_ogrencisi as $ogr){
            if ($teacher>0 && isset($proje_yoentici[$counter])) {
                $ogr->danisman = ($proje_yoentici[$counter])->id;
                $ogr->save();
                $counter +=1;
            }
             else {
                $counter=0;
                $ogr->danisman = ($proje_yoentici[$counter])->id;
                $ogr->save();
                $counter +=1;
            }
        }
    }
}
