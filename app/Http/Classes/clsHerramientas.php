<?php
namespace App\Http\Classes;
use Auth;

class clsHerramientas
{
    public static function NormalizaURL($str){
        $str = strtolower(utf8_decode($str)); $i=1;
        $str = strtr($str, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
        $str = preg_replace("/([^a-z0-9])/",'-',utf8_encode($str));
        while($i>0) $str = str_replace('--','-',$str,$i);
        if (substr($str, -1) == '-') $str = substr($str, 0, -1);
        return $str;
    }

    public static function generar_folio($data=[])
    {
    	$num_documentos= count(\App\Http\Models\Documentacion::search($data)->get());
    	$area= \App\Http\Models\Catalogos\Area::find($data['id_area_envia']);
    	$folio= 'SHyFP/'.$area->folio_estructura.'/'.str_pad($num_documentos+1, 5, '0', STR_PAD_LEFT).'/'.date('Y');
    	return $folio;
    }

    public static function generar_folio_direcciones($vrequest=[])
    {
        /*SANDRO
        $tipo_doc="";
        if($vrequest['id_tipo_documento']==1) $tipo_doc='OF';        
        if($vrequest['id_tipo_documento']==2) $tipo_doc='MEM';        
        if($vrequest['id_tipo_documento']==3) $tipo_doc='CIR';        
        if($vrequest['id_tipo_documento']==4) $tipo_doc='TI';        
        if($vrequest['id_tipo_documento']==5) $tipo_doc='INF';        
        if($vrequest['id_tipo_documento']==6) $tipo_doc='BOL';        
        if($vrequest['id_tipo_documento']==7) $tipo_doc='FT';       
       
        $num_documentos= count(\App\Http\Models\Documentacion::search($vrequest)->get());
        $area= \App\Http\Models\Catalogos\Area::find($vrequest['id_area_envia']);
        //SANDRO $folio= 'SHyFP/'.$area->folio_estructura.'/'.$tipo_doc.'/'.str_pad($num_documentos+1, 5, '0', STR_PAD_LEFT).'/'.date('Y');
        $folio=$folio= 'SHyFP/'.$area->folio_estructura.'/'.str_pad($num_documentos+1, 5, '0', STR_PAD_LEFT).'/'.date('Y');
        return $folio; 
        */
		
		$vnumeroFolioEspecial=0;
		$vnumeroFolioNuevo=$vrequest['numero_folio_nuevo'];
		if(Auth::User()->id_area==29){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 44;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==37){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 8;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==54){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 4;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==59){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 5;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==94){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 40;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==33){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 62;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==63){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 2;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==69){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 78;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==8){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 7;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==3){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 12;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==2){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 1;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else if(Auth::User()->id_area==11){
			if($vrequest['id_tipo_documento']==2)
				$vnumeroFolioEspecial=$vnumeroFolioNuevo + 2;
			else 
				$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		else {
			$vnumeroFolioEspecial=$vnumeroFolioNuevo;
		}
		
        $vfolioNuevo="";
        $vareaFolio=\App\Http\Models\Catalogos\Area::find($vrequest['id_area_envia']);
        $vfolioNuevo='SHyFP/'.$vareaFolio->folio_estructura.'/'.str_pad($vnumeroFolioEspecial + 1, 5, '0', STR_PAD_LEFT).'/'. date('Y');
        return $vfolioNuevo;
    }

    public static function generar_folio_borradores($data=[])
    {
        /*SANDRO
        $tipo_doc="";
        if($data['id_tipo_documento']==1)
        {
            $tipo_doc='OF';
        }
        if($data['id_tipo_documento']==2)
        {
            $tipo_doc='MEM';
        }
        if($data['id_tipo_documento']==3)
        {
            $tipo_doc='CIR';
        }
        if($data['id_tipo_documento']==4)
        {
            $tipo_doc='TI';
        }
        if($data['id_tipo_documento']==5)
        {
            $tipo_doc='INF';
        }
        if($data['id_tipo_documento']==6)
        {
            $tipo_doc='BOL';
        }
        if($data['id_tipo_documento']==7)
        {
            $tipo_doc='FT';
        }
        */
        $num_documentos= count(\App\Http\Models\ejecutiva\BorradoresCoordinacion::buscar_folio($data)->get());
        $area= \App\Http\Models\Catalogos\Area::find($data['id_area_envia']);
        // SANDRO $folio= 'SHyFP/'.$area->folio_estructura.'/'.$tipo_doc.'/'.str_pad($num_documentos+1, 5, '0', STR_PAD_LEFT).'/'.date('Y');
		if(Auth::User()->id_area==4){
			$vtotalFolioSistemaAnterior=$num_documentos + 112;
		}
		else {
			$vtotalFolioSistemaAnterior=$num_documentos;
		}
		 
        $folio= 'SHyFP/'.$area->folio_estructura.'/'.str_pad($vtotalFolioSistemaAnterior+1, 5, '0', STR_PAD_LEFT).'/'.date('Y');
        return $folio;
    }

    public static function generar_folio_oficialia($data=[])
    {
        /*
        $tipo_doc="";
        if($data['id_tipo_documento']==1)
        {
            $tipo_doc='OF';
        }
        if($data['id_tipo_documento']==2)
        {
            $tipo_doc='MEM';
        }
        if($data['id_tipo_documento']==3)
        {
            $tipo_doc='CIR';
        }
        if($data['id_tipo_documento']==4)
        {
            $tipo_doc='TI';
        }
        if($data['id_tipo_documento']==5)
        {
            $tipo_doc='INF';
        }
        if($data['id_tipo_documento']==6)
        {
            $tipo_doc='BOL';
        }
        if($data['id_tipo_documento']==7)
        {
            $tipo_doc='FT';
        }
        */
        $num_documentos= count(\App\Http\Models\Documentacion::search($data)->get());
        $area= \App\Http\Models\Catalogos\Area::find($data['id_area_envia']);
        // SANDRO $folio= 'SHyFP/'.$area->folio_estructura.'/'.$tipo_doc.'/'.str_pad($num_documentos+1, 5, '0', STR_PAD_LEFT).'/'.date('Y');
        $folio= 'SHyFP/'.$area->folio_estructura.'/'.str_pad($num_documentos+1, 5, '0', STR_PAD_LEFT).'/'.date('Y');
        return $folio;
    }
}
