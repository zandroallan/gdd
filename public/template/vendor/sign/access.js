/*******************************************************************
Name: access.js
Version: 0.1.3.
Autor name: Sandro Alan G&oacute;mez Aceituno.
			Roberto D. Hern&aacute;ndez Mart&iacute;nez.
Modification autor name:
Creation date: 01/12/2016
Description: JS file. File that will serve to sign the client side.
********************************************************************/
class Access {
    constructor() {
        this._vsecretKey = null;
        this._vivParameter = null;
    }

    set secretKey(vsecretkey) {
        this._vsecretKey = vsecretkey;
    }

    set ivParameter(vivParameter) {
        this._vivParameter = vivParameter;
    }

    get secretKey() {
        return this._vsecretKey;
    }

    get ivParameter() {
        return this._vivParameter;
    }

    get access() {
        return this._vsecretKey.data.concat(this._vivParameter.data);
    }
}
