<?php
/**************************************************
Name: ReporteController.php
Autor name: Sandro Alan Gomez Aceituno
Creation date: Mar 03 de Diciembre de 2019
Description: Controlador principal, Reportes Titulares
***************************************************/
namespace App\Http\Controllers\Titulares;
use App\Http\Classes\clsTools;
use App\Http\Models\Catalogos\C_Tipo_Documento;
use App\Http\Models\Catalogos\C_Area;
use App\Http\Models\Catalogos\C_Cargo;
use App\Http\Models\DocumentoInterno;
use App\Http\Models\Destinatario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QrCode;
use Auth;
use DB;

class ReporteController extends Controller
{
    private $route= 'ttl.borradores'; 
    public function __construct()
    {
        $this->middleware('auth');
        view()->share('titulo', 'Reportes');
        view()->share('current_route', $this->route);       
    }

    public function PDFDocumento($vid)
    {
        $vi=1;
        $vflDocumentoInterno=DocumentoInterno::findOrFail($vid);
        $vflTipoDocumento=C_Tipo_Documento::findOrFail($vflDocumentoInterno->id_tipo_documento);
        if($vflDocumentoInterno->sended_at==null) $vfechaEnvio=clsTools::dateText($vflDocumentoInterno->created_at, 1);
        else $vfechaEnvio=clsTools::dateText($vflDocumentoInterno->sended_at, 1);

        /*
         * Numero de documento, lugar y fecha de envio
         */
        $vhtml ='';
        $vhtml.='   <p style="font-size:13px; text-align:right">';
        $vhtml.=        $vflTipoDocumento->nombre.' No. <b>'.$vflDocumentoInterno->folio.'</b><br />';
        $vhtml.='       Tuxtla Gutiérrez, Chiapas <br />';
        $vhtml.=        $vfechaEnvio;
        $vhtml.='   </p>';
        unset($vflTipoDocumento);

        /*
         * Destinatario (s) del documento
         */
        $vhtml.='<p style="font-size:13px; text-align:left">';
        if($vflDocumentoInterno->sended_at==NULL) {
            if($vflDocumentoInterno->id_tipo_documento==3) {
                foreach(json_decode($vflDocumentoInterno['destinatario']) as $vcargo) {
                    $vflCargos=C_Cargo::search(['id'=>$vcargo])->get();
                    foreach($vflCargos as $vflCargo) {
                        $vhtml.='<strong>'. $vflCargo->nombre .'</strong><br/>';
                    }
                }
                unset($vflCargos);
            }
            else {
                foreach(json_decode($vflDocumentoInterno['destinatario']) as $vareaDestinatario) {
                    $vflArea=C_Area::search(['id_area'=>$vareaDestinatario])->first();
                    $vhtml.='<br/><strong>'. $vflArea->titulo.' '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno .'</strong><br/>'. $vflArea->area;
                    unset($vflArea);
                }
            }
        }
        else {
            if($vflDocumentoInterno->id_tipo_documento==3) {
                foreach(json_decode($vflDocumentoInterno['destinatario']) as $vcargo) {
                    $vflCargos=C_Cargo::search(['id'=>$vcargo])->get();
                    foreach($vflCargos as $vflCargo) {
                        $vhtml.='<strong>'. $vflCargo->nombre .'</strong><br/>';
                    }
                }
                unset($vflCargos);
            }
            else {
                $vfilter=array();
                $vfilter['id_tipo_envio']=1;
                $vfilter['id_documento_interno']=$vid;
                $vflDestinatarios=Destinatario::internos($vfilter)->get();                
                foreach($vflDestinatarios as $vdestinatario) {
                    $vhtml.='<br/><strong>'.$vdestinatario->area_responsable .'</strong><br/>'. $vdestinatario->responsable_area;
                }                
                unset($vflDestinatarios);
            }            
        }
        $vhtml.='</p>';

        /*
         * Contenido del documento
         */
        $vhtml.='   '. $vflDocumentoInterno->cuerpo;

        /*
         * Responsable del area quien firma
         */
        $vhtml.='   <p style="font-size:13px;text-align:left"><strong>Atentamente.</strong><br />';
        $vhtml.='       '. $vflDocumentoInterno->responsable_area .'<br/>'. $vflDocumentoInterno->cargo_responsable;
        $vhtml.='   </p>';
        
        /*
         * Asignación de copias al documento
         */
        $vhtml.='   <p style="font-size: 8px;">';
        $vhtml.='       <strong>C.c.p.-</strong>';
        if(($vflDocumentoInterno->destinatario==NULL) && ($vflDocumentoInterno->sended_at==NULL)) {
            foreach(json_decode($vflDocumentoInterno['ccp']) as $vareaCopia) {
                $vflArea=C_Area::findOrFail($vareaCopia);
                $vtipoCopia='para su Conocimiento';
                if($vi > 1) $vtipoCopia='Copia';
                $vhtml.='   '.$vflArea->nombre.' '.$vflArea->ap_paterno.' '.$vflArea->ap_materno.' .-'.$vflArea->area.' .-'.$vtipoCopia;
                unset($vflArea);
                $vi++;
            }
        }
        else {
            $vfilter=array();
            $vfilter['id_tipo_envio']=2;
            $vfilter['id_documento_interno']=$vid;
            $vflDestinatarios=Destinatario::internos($vfilter)->get();
            foreach($vflDestinatarios as $vdestinatario) {               
                $vtipoCopia='para su Conocimiento';
                if($vi > 1) $vtipoCopia='Copia';
                $vhtml.='   '. $vdestinatario->area_responsable .' .-'. $vdestinatario->responsable_area.' .-'.$vtipoCopia.'<br />';
                $vi++;
            }
            unset($vflDestinatarios);
        }
        $vhtml.='       <br>Archivo/Minutario';
        $vhtml.='   </p>';

        //Begin: Imagen Qr
        $vtextQr='El documento se encuentra en proceso de revisión.';
        if($vflDocumentoInterno->sended_at!=NULL) $vtextQr='http://web.shyfpchiapas.gob.mx/sgdv2/titular/documento/'. $vid .'/pdf';
        $vimagenQR=QrCode::format('svg')->size(140)->color(10,14,244)->generate($vtextQr);
        $vimagenQR=base64_encode($vimagenQR);


        $vhtml.='   <table style="width: 100%;">';
        $vhtml.='       <tr>';
        $vhtml.='           <td style="width: 20%; text-align: justify;">';
        $vhtml.='               <img src="data:image/svg;base64,' .$vimagenQR. '">'; 
        $vhtml.='           </td>';               
        $vhtml.='           <td style="font-size: 8px; width: 80%; font-family: "Arial", serif; text-align: justify;">';
        if($vflDocumentoInterno->sended_at!=NULL) {
            $vhtml.='           <p style="text-align:justify">||'.$vflDocumentoInterno->serie.'|'.$vflDocumentoInterno->secuencia.'|'.$vflDocumentoInterno->fecha_firma.'||</p>';
            $vhtml.='           <p style="text-align:justify">'.substr($vflDocumentoInterno->firma, 0, 72).'<br />' .substr($vflDocumentoInterno->firma, 72, 72).'<br />' .substr($vflDocumentoInterno->firma, 144, 72) .'</p>';
            $vhtml.='           <br /><p style="text-align:justify">Este documento ha sido Firmado Electrónicamente, Teniendo el mismo valor que la';
            $vhtml.='           firma autógrafa de acuerdo a los Artículos 1, 3, 8 y 11 de la Ley de Firma Electrónica Avanzada del Estado de Chiapas.</p>';
            $vhtml.='           <br /><strong> URL de Validacion de firma Electrónica.</strong>';
            $vhtml.='           <br />http://firmaelectronica.chiapas.gob.mx/verificacion/index.php?vfolio='. $vflDocumentoInterno->secuencia .'&vsistema=38&vclaveSistema=7sBknKro';
        }
        else {
            $vhtml.='           <p style="text-align:justify">El documento se encuentra en proceso de revisión.</p>';
        }
        $vhtml.='           </td>';
        $vhtml.='       </tr>';          
        $vhtml.='   </table>';

        $vestilo=public_path().'/css/style.css';
        clsTools::PDFVertical($vhtml, $vestilo, 0, $vid.'-Documento.pdf', $vid);
    }
}