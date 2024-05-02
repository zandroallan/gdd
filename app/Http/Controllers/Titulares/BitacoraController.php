<?php
/**************************************************
Name: BorradorController.php
Creation date: Jue 21 de Noviembre de 2019
Description: Controlador principal, Borradores Direccion
***************************************************/
namespace App\Http\Controllers\Titulares;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Classes\clsTools;
use App\Http\Requests\Modulos\Direccion\BitacoraRequest;
use App\Http\Models\DocumentoBitacora;
use App\Http\Models\Catalogos\C_Area;
use App\Http\Models\Catalogos\C_Dependencia;
use App\Http\Models\Catalogos\C_Tipo_Documento;
use Entrust;
use Auth;
use DB;

class BitacoraController extends Controller
{
    private $vnameRoute='ttl.bitacoras';
    public function __construct()
    {
        // Fecha: Mié 04 de Dic 2019
        // Descripción: Constructor de la clase BitacoraController

        $this->middleware('auth');
        view()->share('titulo', 'Bitacoras');
        view()->share('current_route', $this->vnameRoute);
    }

	public function search(Request $vrequest)
	{
        // Fecha: Mié 04 de Dic 2019
        // Descripción: Muestra todos los folios enviados fisicamente.

		$vstatus=200;
        $vrespuesta=array();
        try {
			$vfiltro=array();
			$vaccion=$vrequest->input('method');		
            switch($vaccion){
                case 'show': 
                    $vflFisicaDireccion=DocumentoBitacora::findOrFail($vrequest->input('id'));
                    $vdatosDependencia=Dependencia::findOrFail($vflFisicaDireccion->id_dependencia);
                    $vflFisicaDireccion['id_tipo_organismo']=$vdatosDependencia->id_tipo_organismo;
                  break;
                case 'get':
                    $vfiltro['id_area']=Auth::User()->id_area;
                    $vflFisicaDireccion=DocumentoBitacora::busquedas($vfiltro)->get();
                  break;
            }
            if(count($vflFisicaDireccion)>0)
                $vrespuesta=['codigo'=>1, 'respuesta'=>$vflFisicaDireccion];
            else 
                $vrespuesta=['codigo'=>0, 'respuesta'=>'No Existen datos registrados.'];
            unset($vflFisicaDireccion);
        }
        catch(Exception $vexception ){
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un problema al mostrar los datos. </ br> Verifiquelo con el administrador del sistema.';
            $vrespuesta['mensaje']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
	}

	public function destroy($vid) 
	{ 
		$vstatus=200;
        $vrespuesta=array();
        DB::beginTransaction();
		try {
            $vdlDocumentoBitacora=DocumentoBitacora::findOrFail($vid);
            $vdlDocumentoBitacora->delete();

			$vrespuesta['codigo']=1;
            $vrespuesta['mensaje']='El documento fue eliminado satisfactoriamente';
			DB::commit();
            unset($vdlDocumentoBitacora);
        }
        catch(Exception $vexception ){			
			DB::rollback();
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
	}
	
    public function index()
    {
        // Fecha: Mié 25 de Sep 09:33
        // Descripción: Retorna la vista create.blade.php de la carpeta VIEW

        return view('modulos.titulares.bitacoras.index');
    }

    public function create() 
    {
        // Fecha: Mié 26 de Sep 13:00
        // Descripción: Retorna la vista de VIEW/modulos/titulares/bitacoras

        return view('modulos.titulares.bitacoras.create', [
                'id_dependencia'=>C_Dependencia::lists(),
                'id_tipos_documentos'=>C_Tipo_Documento::lists(['id_clasificacion'=>2])
            ]);
    }

    public function edit($vid) 
    {
        // Fecha: Mié 04 de Dic 2019
        // Descripción: Retorna la vista de VIEW/modulos/titulares/bitacoras

        $vflDocumentacionBitacora=DocumentoBitacora::findOrFail($vid);

        return view('modulos.titulares.bitacoras.edit', [
            'respuesta'=>$vflDocumentacionBitacora,
            'id_dependencia'=>C_Dependencia::lists(),
            'id_tipos_documentos'=>C_Tipo_Documento::lists(['id_clasificacion'=>2])
        ]);
    }

    public function store(Request $vrequest) 
    {
        // Fecha: Mié 27 de Sep 09:54
        // Descripción: Registra la informacion.

        $vstatus=200;
        $vrespuesta=array();
        DB::beginTransaction();
		try {

            $vflDocumentacionBitacora=$vrequest->all();
             if((isset($vflDocumentacionBitacora['id'])) && ($vflDocumentacionBitacora['id'] > 0)) 
                $vdlDocumentacionBitacora=DocumentoBitacora::findOrFail($vflDocumentacionBitacora['id']);
            else
                $vdlDocumentacionBitacora=new DocumentoBitacora;

            $vflDocumentacionBitacora['id_status']=1;
            $vflDocumentacionBitacora['id_area']=Auth::User()->id_area;
            $vflDocumentacionBitacora['id_usuario']=Auth::User()->id;
            $vflDocumentacionBitacora['fecha_documento']=clsTools::getYYYYMMDD($vflDocumentacionBitacora['fecha_documento']);
            $vdlDocumentacionBitacora->fill($vflDocumentacionBitacora)->save();

            $vrespuesta['codigo']=1;
            $vrespuesta['id_documento_bitacora']=$vdlDocumentacionBitacora->id;
			$vrespuesta['respuesta']='Registrado Exitosamente';
			$vrespuesta['sended_at']=true;
            $vrespuesta['url']=route('ttl.bitacoras.index');
            
            DB::commit();
            unset($vflDocumentacionBitacora, $vdlDocumentacionBitacora);
        }
        catch(Exception $vexception ){
			$vstatus=500;
			DB::rollback();
            $vrespuesta['respuesta']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

	public function download($id) { }
    
    public function anexo(Request $vrequest)
    {
        // Fecha: Mar 21 de Ene 2020
        // Descripción: Se guarda el anexo del documento fisico y cambia el status a concluido.

        $vstatus=201;
        $vrespuesta=array();
        try {
            $vfiltro=array();
            if($vrequest->hasFile('files')) {
                $id=$vrequest->input('id_documento_bitacora');
                $vflDocumentacionBitacora=DocumentoBitacora::find($id);
                $vflDocumentacionBitacora->codigo_clasificacion=$vrequest->input('codigo_clasificacion');
                $vflDocumentacionBitacora->id_status=3;
                $vflDocumentacionBitacora->save();
                $vflArea=C_Area::find(Auth::User()->id_area);
                $tipo_documento= \App\Http\Models\Catalogos\C_Tipo_Documento::find($vflDocumentacionBitacora->id_tipo_documento);
                $ruta_de_archivos='';
                unset($vflDocumentacionBitacora);
                
                $path=storage_path().'/bitacoras/'.\App\Http\Classes\clsHerramientas::NormalizaURL($vflArea->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;
                   
                $ruta_de_archivos='bitacoras/'.\App\Http\Classes\clsHerramientas::NormalizaURL($vflArea->area).'/'.date('Y').'/'.\App\Http\Classes\clsHerramientas::NormalizaURL($tipo_documento->nombre).'/'.$id;
               
                $i=1;
                $files=$vrequest->file('files');
                foreach($files as $file){
                    $vrespuesta['file']=true;
                    $fileName="Anexo-".$file->getClientOriginalName();
                    $tipo_archivo=$file->getClientOriginalExtension();
                    $size=$file->getClientSize();
                    $file->move($path, $fileName);
                    $i++;
                }
            }
            $vrespuesta=['codigo'=>1, 'respuesta'=>'Anexo guardado exitosamente.'];
        }
        catch(Exception $vexception ){
            $vstatus=500;
            $vrespuesta['codigo']=-1;
            $vrespuesta['respuesta']='Ocurrio un problema al mostrar los datos. </ br> Verifiquelo con el administrador del sistema.';
            $vrespuesta['mensaje']=$vexception->getMessage();
        }
        return response()->json($vrespuesta, $vstatus);
    }

    public function update(Request $request, $id) { }
}
