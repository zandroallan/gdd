/*******************************************************************
Name: dataSign.js
Version: 0.1.3.
Autor name: Sandro Alan G&oacute;mez Aceituno.
			Roberto D. Hern&aacute;ndez Mart&iacute;nez.
Creation date: 05/12/2016
Description: Js file, which establishes the methods to receive and send the data.
********************************************************************/
class DataSign {
    constructor() {
        this._vdata = null;
        this._name = "";
        this._motive = "";
        this._type = 0;
    }

    set data( vdata ) {
        this._vdata = vdata;
    }

    set name( vname ) {
        this._vname = vname;
    }

    set motive( vmotive ) {
        this._vmotive = vmotive;
    }

    set type( vtype ) {
        this._vtype = vtype;
    }

    get data() {
        return this._vdata;
    }

    get name() {
        return this._vname;
    }

    get motive() {
        return this._vmotive;
    }

    get type() {
        return this._vtype;
    }
}
