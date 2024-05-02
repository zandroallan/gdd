<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;
use DB;
class AnexosController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function descargar($id)
    {
        $datos = \App\Http\Models\Anexo::find($id);
        $destinationPath= storage_path().'/'.$datos->path.'/'.$datos->nombre;
        if(File::exists($destinationPath)){
            return response()->download($destinationPath);
        }
        else{
            return redirect()->back();
        }  
    }

    public function destroy($id)
    {
        $datos= \App\Http\Models\Anexo::find($id);
        DB::beginTransaction();
        try {
            $datos->delete();
            DB::commit();
        }catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            $message= ['errors'=>$error];
            return response()->json($message, 401);
        }        
        $message=['success'=>'Documento <b>eliminado</b>.'];
        return response()->json($message, 201);            
    }    
}
