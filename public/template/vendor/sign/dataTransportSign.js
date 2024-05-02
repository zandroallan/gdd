/*********************************************************
Name: DataTrasportSign.js
Version: 0.0.1
Autor name: Sandro Alan G&oacute;mez Aceituno.
			Roberto D. Hern&aacute;ndez Mart&iacute;nez.
Creation date: 01/12/2016
Modification date: 07/04/2017
*********************************************************/
class DataTransportSign {
    constructor() {
        this._vdataEncrypted = null;
        this._vencrypted = null;
        this._vsignature = null;
        this._vserie = "";
        this._vcurp = "";
    }

    set dataEncrypted( vdataEncrypted ) {
        this._vdataEncrypted = vdataEncrypted;
    }

    set encrypted( vencrypted ) {
        this._vencrypted = vencrypted;
    }

    set serie( vserie ) {
        this._vserie = vserie;
    }

    set curp( vcurp ) {
        this._vcurp = vcurp;
    }

    set signature( vsignature ) {
        this._vsignature = vsignature;
    }

    get dataEncrypted() {
        return this._vdataEncrypted;
    }

    get encrypted() {
        return this._vencrypted;
    }

    get serie() {
        return this._vserie;
    }

    get curp() {
        return this._vcurp;
    }

    get signature() {
        return this._vsignature;
    }

    get dataEncryptedString() {
        return forge.util.encode64(this._vdataEncrypted.data);
    }

    get encryptedString() {
        return forge.util.encode64(this._vencrypted);
    }

    get signatureString() {
        return forge.util.encode64(this._vsignature);
    }
}
