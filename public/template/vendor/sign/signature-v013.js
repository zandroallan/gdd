/*******************************************************************
Name: sign.js
Version: 0.1.3.
Autor name: Sandro Alan G&oacute;mez Aceituno.
Creation date: 28/12/2016.
Modification date: 22/06/2017.
********************************************************************/
var vURLSignatureRecord="http://firmaelectronica.chiapas.gob.mx:8081/srvproductionES6Responsev011/srvEcmascript6Response";
var vURLSignature="http://firmaelectronica.chiapas.gob.mx";

var _vpassword = '';
var _vp12ASN1 = null;
var _vp12 = null;
var _vprivateKey = null;
var _vcertificate = null;
var _vfileCertificate = null;

$(document).ready(function( ) {	
	HTMLSignature();
	$("#btnmodal").attr("onclick", "cleanFormSignature();");
	
	$('#txtfileCertificate').change( function( veventReaderCertificate ) {
		_vfileCertificate = veventReaderCertificate.target.files;
		getFileInByteCertificate( _vfileCertificate[0] );
	});
});

function getFileInByteCertificate( vfileCertificate ) 
{
    try {		
		var vreaderCertificateP12 = new FileReader();
		vreaderCertificateP12.onload = function( veventReaderP12 ) {
			_vp12ASN1 = forge.asn1.fromDer(forge.util.decode64(veventReaderP12.target.result.split(",")[1]));
		};
		vreaderCertificateP12.readAsDataURL( vfileCertificate );		
    }
    catch ( vexception ) {
        console.log("Error in method, getFileInByteCertificate() ", vexception);
    }
}

function sign(vdataSign, vcurp, vpassword, vidSystem) 
{
	try {		
		var vresponseFinal;
		var dataTransportSign = signature(vdataSign, vcurp, vidSystem);
		var vcertificateSend = null;
		if (!dataTransportSign.error) {  			
				$.ajax({
				type: 'POST',
				url: vURLSignatureRecord,
				dataType: 'JSON',
				async: false,
				data: {
					dataEncrypted: dataTransportSign.dataEncrypted,
					encrypted: dataTransportSign.encrypted,
					signature: dataTransportSign.signature,
					serie: dataTransportSign.serie,
					curp: dataTransportSign.curp,
					idSystem: dataTransportSign.idSystem
				},
				beforeSend: function() {
				$('#vloading').html('<img src="' + vURLSignature + '/tools/images/loading.gif" alt="Firmando . . ." />');
				},
				success: function(vresponse, vtextStatus, vjqXHR) {
						$('#mdlLoadViewSignature').modal('hide');
						$('#vloading').hide('slow');	
						switch (vresponse.messageResponse.message) {
						case 0:
							vresponseFinal = {
								statusResponse: vresponse.signatureResponse.statusResponse,
								codeResponse: vresponse.signatureResponse.codeResponse,
								descriptionResponse: vresponse.signatureResponse.descriptionResponse
							};
							break;
						case -1:
							vresponseFinal = {
								statusResponse: true,
								codeResponse: vresponse.signatureResponse.codeResponse,
								descriptionResponse: vresponse.signatureResponse.descriptionResponse
							};
							break;
						case 1:
							vresponseFinal = {
								statusResponse: vresponse.signatureResponse.statusResponse,
								codeResponse: vresponse.signatureResponse.codeResponse,
								descriptionResponse: vresponse.signatureResponse.descriptionResponse,
								sequenceResponse: vresponse.signatureResponse.signatureSequence,
								certifiedSeries: dataTransportSign.serie,
								certifiedSubject: getSubject(),
								curp: dataTransportSign.curp,
								signedDateResponse:vresponse.signatureResponse.signedDate,
								signature: dataTransportSign.signature
							};
							cleanGlobalVaribals();							
							break;
					}					
				},
				error: function(vjqXHR, vtextStatus, verrorThrown) {
					$('#vloading').hide('slow');					
					vresponseFinal = {
						statusResponse: true,
						codeResponse: '114',
						descriptionResponse: 'El componente no puede conectarse al servidor de firma electrÃ³nica.'
					};
				}
			});
		}
		else {
			vresponseFinal = {
				statusResponse: true,
				codeResponse: dataTransportSign.number,
				descriptionResponse: dataTransportSign.description
			};
		}
		return vresponseFinal;
	}
    catch ( vexception ) {
        console.log("Error in method, sign() ", vexception);
    }
}

function signature(vdataSign, vcurp, vidSystem) 
{	
    var access = new Access();
    var mistake = new Mistake();
    var dataTransportSign = new DataTransportSign();
    var dataSign = new DataSign();

    try {
        mistake = validateFormData();
        if ( !mistake.error ) {
            dataSign.data = forge.util.createBuffer(vdataSign, 'utf8');
            dataSign.name = vcurp;
            dataSign.motive = vcurp;
            dataSign.type = 4;

            var vsecretKey = forge.util.createBuffer(getPasswordSync(16));
            var vIvParameter = forge.util.createBuffer(getPasswordSync(16));

            access.secretKey = vsecretKey;
            access.ivParameter = vIvParameter;

            var vdataToSign = JSON.stringify(dataSign);
            var cipher = forge.cipher.createCipher('AES-CBC', access.secretKey);
            cipher.start({
                iv: access.ivParameter
            });
            cipher.update(forge.util.createBuffer(vdataToSign, 'utf8'));
            cipher.finish();
            var vdataEncrypted = cipher.output;
            var vpublicKey = forge.pki.publicKeyFromPem(getKeyToEncryptInformation());
            var vencrypted = vpublicKey.encrypt(forge.util.encodeUtf8(access.access));

            if ( _vprivateKey != null ) {
                var md = forge.md.sha1.create();
                md.update(forge.util.createBuffer(vdataToSign), 'utf8');
                vsignature = _vprivateKey.sign(md);

                dataTransportSign.dataEncrypted = vdataEncrypted;
                dataTransportSign.encrypted = vencrypted;
                dataTransportSign.signature = vsignature;
                dataTransportSign.curp = forge.util.encodeUtf8(vcurp);
                dataTransportSign.serie = _vcertificate.serialNumber;

                var vdataTrasportRecord = {
                    dataEncrypted: dataTransportSign.dataEncryptedString,
                    encrypted: dataTransportSign.encryptedString,
                    signature: dataTransportSign.signatureString,
                    serie: dataTransportSign.serie,
                    curp: dataTransportSign.curp,
                    idSystem: vidSystem,
                    error: false,
                    numberError: '00',
                    descriptionError: 'Exito'					
                };
                return vdataTrasportRecord;
            }
            else {
				mistake.error = true;
				mistake.number = '108';
				mistake.description = 'No se puene encontrar la llave privada en el certificado especificado.';
				return mistake;
            }
        }
        else {
            return mistake;
        }
    }
    catch ( vexception ) {
		mistake.error = true;
		mistake.number = '112';
		mistake.description = 'Problemas al realizar el proceso de firma.';  
		console.log("Error in method, signature() ", vexception);
		return mistake;
    }
}

function validateFormData() 
{
    var validate = new Validate();
    var mistake = new Mistake();	

    try {		
		this._vpassword = document.getElementById('txtpassword').value;	
		
		mistake = validate.validateDataFormFields( _vpassword );		
		if ( !mistake.error ) {
			mistake = validate.certificateState( _vfileCertificate );			
		}
		if ( !mistake.error ) {
			mistake = openCertificate( );
		}			
		if ( !mistake.error ) {
			mistake = getPairOfKeys();
		}			  	
		if ( !mistake.error ) {		
			mistake = validationOfElectronicSignatureDate();
		}		
    }
    catch ( vexception ) {
		mistake.error = true;
		mistake.number = '112';
		mistake.description = 'Problemas en la verificaciÃ³n de los datos.';	
		console.log("Error in method, validateFormData() ", vexception);		
    }
	return mistake;
}

function openCertificate( ) 
{
    var mistake = new Mistake();
    try {			
        if ( _vp12ASN1 == null ) {
            mistake.error = true;
            mistake.number = '109';
            mistake.description = 'Problemas al leer el certificado, archivo no valido.';
        }
        else {
            _vp12 = forge.pkcs12.pkcs12FromAsn1( _vp12ASN1, _vpassword );
			mistake.error = false;
            mistake.number = '00';
            mistake.description = 'Exito';
        }
    }
    catch ( vexception ) {		
		mistake.error = true;
		mistake.number = '104';
		mistake.description = 'ContraseÃ±a incorrecta, intÃ©ntelo de nuevo (3).';
		console.log("Error in method, openCertificate() ", vexception);
    }
    return mistake;
}

function getPairOfKeys() 
{
    var mistake = new Mistake();
    try {
        for ( var sci = 0; sci < _vp12.safeContents.length; ++sci ) {
            var vsafeContents = _vp12.safeContents[sci];
            for ( var sbi = 0; sbi < vsafeContents.safeBags.length; ++sbi ) {
                var vsafeBag = vsafeContents.safeBags[sbi];
                if ( vsafeBag.type == forge.pki.oids.keyBag ) {
                    _vprivateKey = vsafeBag.type;
                }
                else if ( vsafeBag.type === forge.pki.oids.pkcs8ShroudedKeyBag ) {
                    _vprivateKey = vsafeBag.key;
                }
                else if ( vsafeBag.type === forge.pki.oids.certBag ) {
                    _vcertificate = vsafeBag.cert;
                }
            }
        }
		mistake.error = false;
		mistake.number = '00';
		mistake.description = 'Exito';
    }
    catch ( vexception ) {
		mistake.error = true;
		mistake.number = '109';
		mistake.description = 'Problemas al leer el certificado, archivo no valido.';
		console.log("Error in method, getPairOfKeys() ",vexception);
    }
    return mistake;
}

function validationOfElectronicSignatureDate()
{
	var mistake = new Mistake();	
	var vcurrentDate = new Date();
	
	try {
		var vdd 	= vcurrentDate.getDate();
		var vmm 	= vcurrentDate.getMonth() + 1; 
		var vyyyy 	= vcurrentDate.getFullYear();
		
		var vddCertificate = _vcertificate.validity.notAfter.getDate();
		var vmmCertificate = _vcertificate.validity.notAfter.getMonth() + 1;
		var vyyyyCertificate = _vcertificate.validity.notAfter.getFullYear();
		
		if(vdd < 10) {
			vdd= '0' + vdd;
		}
		if( vmm < 10) {
			vmm = '0' + vmm;
		} 		
	
		if(vddCertificate < 10) {
			vddCertificate = '0' + vddCertificate;
		}
		if( vmmCertificate < 10) {
			vmmCertificate = '0' + vmmCertificate;
		}
		
		var vtoday = vyyyy + '/' + vmm + '/' + vdd;
		var vdatenoAfterCertificate = vyyyyCertificate + '/' + vmmCertificate + '/' + vddCertificate;
		
		if( vtoday >= vdatenoAfterCertificate ) { 
			mistake.error = true;
			mistake.number = '107';
			mistake.description = 'El certificado ha expirado.';
		}
		else {		
			mistake.error = false;
			mistake.number = '00';
			mistake.description = 'Exito';
		}		
		// console.log('Fecha maxima del certificado ', vdatenoAfterCertificate, 'Fecha obtenida', vtoday );	
	}
    catch ( vexception ) {		
		mistake.error = true;
		mistake.number = '109';
		mistake.description = 'Problemas al Leer el Certificado, Archivo no Valido.';
		console.log("Error in method, validationOfElectronicSignatureDate() ", vexception);
		return mistake;
    }
	return mistake;
}

function getSubject()
{	
	var vsubjectString='';
	try {		
		var vsubject = this._vcertificate.subject.attributes; 
		vsubjectString += 'hash=' + this._vcertificate.subject.hash;
		for (vi = 0; vi < vsubject.length; vi++) {
			var vsubjectJoin='';
			vsubjectString += ', ';	
			if(vi < 5){
				var vshortName = vsubject[vi].shortName;
				var vvalue = vsubject[vi].value;
				vsubjectJoin = vshortName +'='+ vvalue;
			}
			else {
				var vshortName = vsubject[vi].type;
				var vvalue = vsubject[vi].value;
				vsubjectJoin = vshortName +', '+ vvalue;
			}
			vsubjectString += vsubjectJoin;				
		}
	}
    catch ( vexception ) {			
		console.log("Error in method, getSubject() ", vexception);
    }
	return vsubjectString;
}

function getKeyToEncryptInformation() 
{
    var vpublicKeyToEncrypt  = '-----BEGIN PUBLIC KEY-----';
        vpublicKeyToEncrypt += 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAw5frNJJ39i3muzunz6/l';
        vpublicKeyToEncrypt += 'wEF9uJ8pYGiHRkRP3HzzEd6mSLSQMtXu/6xi3+x9i8poBAfLUa2mDAcZnaCr/pjb';
        vpublicKeyToEncrypt += 'tjXN+K2MVimw8A9CtFI4p8kwqfotuZYlJVjcI8bN3zxtw8pAfQu9FEWZOZvp006z';
        vpublicKeyToEncrypt += 'aZaR0Uc4XKwiMF7F2bi/3ZjQiD4M/YO5vNhrygXzCUlpXzxNH32m6k5ppcxbKBzO';
        vpublicKeyToEncrypt += 'KzvX5fTwAjKhHfSZYznl+ghbk8UWhPRFMvPU6PSEbmqiNplfQwSWc4o6kX8g4XaH';
        vpublicKeyToEncrypt += 'tBpBvo4HmQnb6ElqCG/nT0frMGlFfBRZYj7ld1sD5nKchQ7BtrbVQ8MsIlc3A7C3';
        vpublicKeyToEncrypt += 'jwIDAQAB';
        vpublicKeyToEncrypt += '-----END PUBLIC KEY-----';
    return vpublicKeyToEncrypt;
}

function getPasswordSync(vlengthPassword) 
{	
    var vcharacterArray = new Array("abcdefghijkmnopqrstuvwxyz", "ABCDEFGHJKLMNOPQRSTUVWXYZ", "0123456789", "~!@#$%^&*()_+-=\|[]{};:,./<>?");
    var vcharactersToUseInThePassword = new String();
    vcharactersToUseInThePassword = vcharacterArray[0] + vcharacterArray[1] + vcharacterArray[2] + vcharacterArray[3];

    var vgeneratedPassword = new String();
    for (i = 0; i < vlengthPassword; i++) {
        vgeneratedPassword += vcharactersToUseInThePassword.charAt(Math.floor(Math.random() * vcharactersToUseInThePassword.length));
    }
    return vgeneratedPassword;
}

function cleanGlobalVaribals() 
{
	_vpassword = '';
	_vp12ASN1 = null;
	_vp12 = null;
	_vprivateKey = null;
	_vcertificate = null;
	_vfileCertificate = null;
}

function trim(str) 
{
    var resultStr = "";
    resultStr = trimLeft(str);
    resultStr = trimRight(resultStr);
    return resultStr;
}

function trimLeft(str) 
{
    var resultStr = "";
    var i = len = 0;

    if (str + "" == "undefined" || str == null)
        return "";
    str += "";

    if (str.length == 0)
        resultStr = "";
    else {
        len = str.length;
        while ((i <= len) && (str.charAt(i) == " "))
            i++;
        resultStr = str.substring(i, len);
    }
    return resultStr;
}

function trimRight(str) 
{
    var resultStr = "";
    var i = 0;
    if (str + "" == "undefined" || str == null)
        return "";
    str += "";
    if (str.length == 0)
        resultStr = "";
    else {
        i = str.length - 1;
        while ((i >= 0) && (str.charAt(i) == " "))
            i--;
        resultStr = str.substring(0, i + 1);
    }
    return resultStr;
}

function HTMLSignature()
{	
	var vHTMLPrintlnSignature = '';
		// vHTMLPrintlnSignature+=	'	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mdlLoadViewSignature" id="btnmodal" title="Firmar Electr&oacute;nicamente" >';
		// vHTMLPrintlnSignature+= '		<i class="inverted pencil icon"></i> Firmar Electr&oacute;nicamente';
		// vHTMLPrintlnSignature+= '	</button>';
		vHTMLPrintlnSignature+= '	<div class="modal fade" role="dialog" aria-hidden="true" id="mdlLoadViewSignature" style="display: none;">';
		vHTMLPrintlnSignature+= '		<div class="modal-dialog">';
		vHTMLPrintlnSignature+= '			<div class="modal-content">';
		vHTMLPrintlnSignature+= '				<div class="modal-header">';
		vHTMLPrintlnSignature+= '					<div class="row">';
		vHTMLPrintlnSignature+= '						<div class="col-md-12">';							
		vHTMLPrintlnSignature+= '							<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		vHTMLPrintlnSignature+= '								<strong><span aria-hidden="true">&times;</span></strong>';
		vHTMLPrintlnSignature+= '							</button>';																					
		vHTMLPrintlnSignature+= '						</div>';
		vHTMLPrintlnSignature+= '						<div class="col-md-4">'; 
		vHTMLPrintlnSignature+= '							<img src="' + vURLSignature + '/tools/images/scg.png" alt="Responsive image" width="180px" class="img-responsive" align="left" />';
		vHTMLPrintlnSignature+= '						</div>';
		vHTMLPrintlnSignature+= '						<div class="col-md-4" style="margin-top: 8px;">';
		vHTMLPrintlnSignature+= '							<img src="' + vURLSignature + '/tools/images/fea.png" alt="Responsive image" width="160px" class="img-responsive" align="center" />';
		vHTMLPrintlnSignature+= '						</div>';
		vHTMLPrintlnSignature+= '						<div class="col-md-4">';
		vHTMLPrintlnSignature+= '							<img src="' + vURLSignature + '/tools/images/gec.png" alt="Responsive image" width="160px" class="img-responsive" align="right" />';
		vHTMLPrintlnSignature+= '						</div>';																			
		vHTMLPrintlnSignature+= '					</div>';
		vHTMLPrintlnSignature+= '				</div>';									
		vHTMLPrintlnSignature+= '				<div class="modal-body" style="font-size: 13px;">';							
		vHTMLPrintlnSignature+= '					<div class="row">';							
		vHTMLPrintlnSignature+= '						<div class="col-md-12">';
		vHTMLPrintlnSignature+= '							<div style="text-align:center;">';
		vHTMLPrintlnSignature+= '								<label style="font-size: 18px;">';
		vHTMLPrintlnSignature+= '									<strong>M&oacute;dulo de Firmado Electr&oacute;nico</strong>';
		vHTMLPrintlnSignature+= '								</label>';
		vHTMLPrintlnSignature+= '							</div>';
		vHTMLPrintlnSignature+= '							<div id="vcertificate">';
		vHTMLPrintlnSignature+= '								<label for="txtfileCertificate" id="vtitle">Certificado .p12</label>';
		vHTMLPrintlnSignature+= '								<div class="fileinput fileinput-new input-group" data-provides="fileinput">';
		vHTMLPrintlnSignature+= '									<div class="form-control" data-trigger="fileinput">';
		vHTMLPrintlnSignature+= '										<i class="glyphicon glyphicon-file fileinput-exists"></i>';
		vHTMLPrintlnSignature+= '										<span class="fileinput-filename"></span>';
		vHTMLPrintlnSignature+= '									</div>';
		vHTMLPrintlnSignature+= '									<span class="input-group-addon input-sm btn-sm btn-default btn-file">';
		vHTMLPrintlnSignature+= '										<span class="fileinput-new"><i class="folder open icon"></i> Abrir</span>';
		vHTMLPrintlnSignature+= '										<span class="fileinput-exists"><i class="folder open icon"></i> Cambiar</span>';
		vHTMLPrintlnSignature+= '										<input type="file" id="txtfileCertificate" name="txtfileCertificate" accept=".p12"/>';
		vHTMLPrintlnSignature+= '									</span>';								
		vHTMLPrintlnSignature+= '								</div>';
		vHTMLPrintlnSignature+= '							</div>';	
		vHTMLPrintlnSignature+= '							<div class="form-group" id="vpassword">';
		vHTMLPrintlnSignature+= '								<label for="txtpassword">Contraseña de la llave privada</label>';
		vHTMLPrintlnSignature+= '								<input type="password" class="form-control" id="txtpassword" name="txtpassword" placeholder="Contrase&ntilde;a.">';
		vHTMLPrintlnSignature+= '							</div>';
		vHTMLPrintlnSignature+= '							<div id="vloading" style="text-align:center"></div>';	
		vHTMLPrintlnSignature+= '							<button type="button" class="btn btn-primary btn-block btn-sm" id="btnsignature" data-loading-text="Firmando..." autocomplete="off" >';
		vHTMLPrintlnSignature+= '								<i class="inverted pencil icon"></i> Firmar Electr&oacute;nicamente.';
		vHTMLPrintlnSignature+= '							</button>';											
		vHTMLPrintlnSignature+= '						</div>';							
		vHTMLPrintlnSignature+= '					</div>';							
		vHTMLPrintlnSignature+= '				</div>';
		vHTMLPrintlnSignature+= '				<div class="modal-footer">';
		vHTMLPrintlnSignature+= '					<div class="col-md-6 form-group" style="text-align:left; font-size: 13px;">';									
		vHTMLPrintlnSignature+= '						<label>';
		vHTMLPrintlnSignature+= '							Secretar&iacute;a de la Contralor&iacute;a General.<br />';
		vHTMLPrintlnSignature+= '							Unidad de Inf&oacute;rmatica.<br />';
		vHTMLPrintlnSignature+= '							&Aacute;rea de Firma Electr&oacute;nica.<br />';
		vHTMLPrintlnSignature+= '							Versi&oacute;n 0.1.3.';
		vHTMLPrintlnSignature+= '						</label>';
		vHTMLPrintlnSignature+= '					</div>';
		vHTMLPrintlnSignature+= '					<div class="col-md-6" style="margin-top: 10px;">';
		vHTMLPrintlnSignature+= '						<img src="' + vURLSignature + '/tools/images/cnu.png" alt="Responsive image" width="165px" class="img-responsive" align="right" />';
		vHTMLPrintlnSignature+= '					</div>';
		vHTMLPrintlnSignature+= '					<div class="col-md-12" style="text-align:center; font-size: 10px;">';
		vHTMLPrintlnSignature+= '						<label style="font-size: 11px;">';
		vHTMLPrintlnSignature+= '							Servicios Integrales de Firma Electr&oacute;nica Avanzada (SIFIA).<br/>';
		vHTMLPrintlnSignature+= '							Copyright 2012 | Todos los Derechos Reservados N&uacute;mero de Registro 03-2012091111432000-01.';
		vHTMLPrintlnSignature+= '						</label>';
		vHTMLPrintlnSignature+= '					</div>';
		vHTMLPrintlnSignature+= '				</div>';
		vHTMLPrintlnSignature+= '			</div>';
		vHTMLPrintlnSignature+= '		</div>';
		vHTMLPrintlnSignature+= '	</div>';		
	$('#vHTMLSignature').html(vHTMLPrintlnSignature);
}

function cleanFormSignature()
{
	$('#txtpassword').val('');
	$('.fileinput').fileinput('clear');
	cleanGlobalVaribals();
}