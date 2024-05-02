/*******************************************************************
Name: Validate.js
Version: 0.1.3.
Autor name: Sandro Alan G&oacute;mez Aceituno.
			Roberto D. Hern&aacute;ndez Mart&iacute;nez.
Creation date: 15/12/2016
Description: JS file. File that will serve to sign the client side.
********************************************************************/
class Validate {
	constructor(){
		this._vcertificateUser = null;
	}
	
	set certificateUser( vcertificateUser ){
		this._vcertificateUser = vcertificateUser;
	}
	
	get certificateUser(){
		return this._vcertificateUser;
	}
	
    certificateState(vfile) {
        var mistake = new Mistake();
        mistake.error = false;
        mistake.number = '00';
        mistake.description = 'Exito';

        var vnameFile = '';
        if (vfile == null) {
            mistake.error = true;
            mistake.number = '101';
            mistake.description = 'Seleccionar un Archivo .p12';
            return mistake;
        }
        return mistake;
    }
	
	certificateFile(vfile) {
        var mistake = new Mistake();
        mistake.error = false;
        mistake.number = '00';
        mistake.description = 'Exito';

        var vnameFile = '';
        if (vfile == null) {
            mistake.error = true;
            mistake.number = '101';
            mistake.description = 'Seleccionar un Archivo';
            return mistake;
        }
        return mistake;
    }
	
	certificateSAT(vfileCertificate, vfilePrivateKey) {
        var mistake = new Mistake();
        mistake.error = false;
        mistake.number = '00';
        mistake.description = 'Exito';

        if (vfileCertificate === null) {
            mistake.error = true;
            mistake.number = '101';
            mistake.description = 'Seleccionar un Archivo .cer';
            return mistake;
        }
		
		if (vfilePrivateKey === null) {
            mistake.error = true;
            mistake.number = '101';
            mistake.description = 'Seleccionar una Archivo .key';
            return mistake;
        }
        return mistake;
    }

    validateCertificateWithAC() {
        var validate = new Validate();
        var mistake = new Mistake();
        try {
            mistake.error = false;
			mistake.number = '00';
			mistake.description = 'Exito';
			
			if( this._vcertificateUser != null ){
				if ( !validate.validateCertificateWithCertificationAuthority(this._vcertificateUser) ) {
					mistake.error = true;
					mistake.number = '105';
					mistake.description = 'El Certificado no ha sido emitido por la SecretarÃ­a de la ContralorÃ­a General';
					return mistake;
				}
			}
			else {
				mistake.error = true;
				mistake.number = '203';
				mistake.description = 'Problemas al obtener la llave publica';
			} 
            return mistake;
        }
        catch (e) {
			mistake.error = true;
			mistake.number = '203';
			mistake.description = 'Problemas al Obtener la Llave Publica';
			return mistake;            
        }
    }

    validateDataFormFields(vpassword) {
        var mistake = new Mistake();
        mistake.error = false;
        mistake.number = '00';
        mistake.description = 'Exito';

        if (trim(vpassword) == '') {
            mistake.error = true;
            mistake.number = '103';
            mistake.description = 'Escribir una contraseÃ±a';
            return mistake;
        }

        if (trim(vpassword).length < 8) {
            mistake.error = true;
            mistake.number = '104';
            mistake.description = 'ContraseÃ±a Incorrecta, IntÃ©ntelo de Nuevo (1)';
        }

        if (trim(vpassword).length > 15) {
            mistake.error = true;
            mistake.number = '104';
            mistake.description = 'ContraseÃ±a Incorrecta, IntÃ©ntelo de Nuevo (2)';
        }
        return mistake;
    }
	
	participantNotNull(idParticipant) {
        var mistake = new Mistake();
        mistake.error = false;
        mistake.number = '00';
        mistake.description = 'Exito';

        if (idParticipant == '') {
            mistake.error = true;
            mistake.number = '04';
            mistake.description = 'El Participante Especificado no Existe.';
            return mistake;
        }
        return mistake;
    }
}
