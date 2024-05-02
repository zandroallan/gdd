<?php
namespace App\Http\Classes;
use App\Http\Models\Catalogos\C_Area;
use App\Http\Models\DocumentoInterno;
use Auth;

class clsTools
{
    public static function generarFolioDocumentoInterno($vrequest=[])
    {
		$vtotalFolios=$vrequest['total_folios'];
        $vflArea=C_Area::findOrFail($vrequest['id_area_envia']);
        $vfolioNuevo='SHyFP/'.$vflArea->folio_estructura.'/'.str_pad($vtotalFolios + 1, 5, '0', STR_PAD_LEFT).'/'. date('Y');
        return $vfolioNuevo;
    }

    public static function generarFolio($vrequest=[])
    {
        $vtotalFolios=$vrequest['total_folios'];
        $vflArea=C_Area::findOrFail($vrequest['id_area_envia']);
        $vfolioNuevo='SHyFP/'.$vflArea->folio_estructura.'/'.str_pad($vtotalFolios + 1, 5, '0', STR_PAD_LEFT).'/'. date('Y');
        return $vfolioNuevo;
    }

    public static function getYYYYMMDD($vfecha_)
    {
        try {
            $vfecha=str_replace('/', '-', $vfecha_);
            $vnuevaFecha=date("Y-m-d", strtotime($vfecha));
        }
        catch(Exception $vexception){
            print_r($vexception->getMessage());
        }
        return $vnuevaFecha;   
    }

    public static function dateText($fecha, $tipus=1)
     {
        $año=substr($fecha,0,4);
        $mes=substr($fecha,5,2);
        $dia=substr($fecha,8,2);

        if ($fecha != '' && $tipus == 0 || $tipus == 1) {
            $mest = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            if ($tipus == 1){ 
            	$fecha=mktime(0,0,0,(int)$mes, (int)$dia, (int)$año); 
            }
            return date('d', $fecha).' de '.$mest[date('m',$fecha)-1].' de '.date('Y', $fecha);
        }
        else {
        	return 0;
        }
     }

    public static function add($vfldatos, $vfldato)
     {
        try {
            array_push($vfldatos, $vfldato);
        }
        catch (Exception $vexception) {
            throw new Exception($vexception->getMessage(), $vexception->getCode());
        }   
     }
    
    public static function total($vfldatos)
     {
        try {
            return count($vfldatos);
        }
        catch (Exception $vexception) {
            throw new Exception($vexception->getMessage(), $vexception->getCode());
        }
     }

    public static function PDFVertical($vcontenido, $vstyle, $vorientacionStatus, $vnombrePDF, $vid)
    {
    	$vorientacion='Letter';
    	if($vorientacionStatus==1) $vorientacion='Letter-L';
        $vimagenIzquierda=public_path()."/img/logo-shyfp.jpg";
        // $vimagenDerecha=public_path()."/tools/mpdf/img/declarachiapas.png";

        $vflDocumentoInterno=DocumentoInterno::findOrFail($vid);
        $vflArea=C_Area::findOrFail($vflDocumentoInterno->id_area_envia);
        unset($vflDocumentoInterno);

        $html='
            <html>
                <head></head>
	            <body>
	            <htmlpageheader name="myheader">
	                <table width="100%">
	                    <tr>
	                        <td width="40%" style="text-align: left; vertical-align: middle;">
	                            <img src="'. $vimagenIzquierda .'" width="30%" />
	                        </td>
	                        <td width="60%" style="text-align: right;">
								<p style="font-size:13px; text-align:right"><strong>'. $vflArea->area .'</strong></p>
	                        </td>
	                    </tr>
	                </table>
	            </htmlpageheader>
	            <htmlpagefooter name="myfooter">
	                <table style="background-color:#333333; color:#fff; margin-left:-80px; font-size:10px;">
	                    <tr>
	                        <td width="14%"></td>
	                        <td width="71%">
	                        	Blvd. Los Castillos No. 410, Fracc. Montes Azules C.P. 29056, Tuxtla Gutiérrez, Chiapas. <br>
	                        	Conmutador: 01(961) 61 8 75 30 Teléfono: Quejas y denuncias 01-800-900-9000<br>
	                        	www.shyfpchiapas.gob.mx 
	                        </td>
	                    </tr>
	                </table>
	            </htmlpagefooter>
	            <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
	            <sethtmlpagefooter name="myfooter" value="on" />	            	
	            	<!-- Begin Container -->
	            	'. $vcontenido .'
	            	<!-- End Container -->
	            </body>
            </html>';

        unset($vflArea);
        $mpdf=new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 40,
            'margin_bottom' => 29,
            'margin_header' => 10,
            'margin_footer' => 10,
            'format' => $vorientacion
        ]);
        $mpdf->SetProtection(array('print'));
        // $mpdf->SetProtection(array(), 'UserPassword', 'poa');
        $mpdf->SetTitle("Inventario de Baja Documental.");
        $mpdf->SetAuthor("Unidad de Informatica y Desarrollo Digital.");
        // marca de agua pero en imagen
        $mpdf->SetWatermarkImage(public_path()."/img/chiapas_agua.png");
        $mpdf->showWatermarkImage=true;
        $mpdf->watermarkImageAlpha=0.6;
        $mpdf->SetDisplayMode('fullpage');
        $stylesheet = file_get_contents($vstyle);
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $mpdf->Output($vnombrePDF, 'I');
    }
}