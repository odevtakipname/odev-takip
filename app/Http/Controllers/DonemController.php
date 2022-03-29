<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donem;
use Illuminate\Support\Facades\Log;

class DonemController extends Controller
{
    public function index()
    {
        return view('client.donem.donem');
    }
    public function data()
    {
        $donem = Donem::orderBy('created_at', 'DESC')->get();
        return $donem;
    }

    public function store(Request $request)
    {
        if ($request->id) {
            $donem  = Donem::find($request->id);
        } else {
           $donem = new Donem();
        }
        //Log::info($request->post());
        $donem->name = $request->name;
        $donem->yil = $request->yil;
        $donem->save();
    }
    public function delete($id){
        $donem = Donem::find($id);
        $donem->delete();
    }
    public function active($id){
        $donem = Donem::find($id);
        if($donem->opened == 1){
            return "Dönem daha önce aktif edilmiştir.";
        }else{
            Log::info('else');
            $donemler = Donem::where('opened',1)->get();
            if (count($donemler)==0) {
                $donem->opened =1;
                Log::info('dobnemnler 0');

            } else {
                foreach ($donemler as $dd) {
                   $dd->opened = 0;
                   $dd->save();
                }
                Log::info('dobnemnler 0 değil');

                $donem->opened = 1;
            }
            $donem->save();
        }

    }
}
