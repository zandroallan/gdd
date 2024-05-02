/*********************************************************
Name: Mistake.js
Version: 0.1.1
Autor name: Sandro Alan G&oacute;mez Aceituno.
			Roberto D. Hern&aacute;ndez Mart&iacute;nez.
Creation date: 19/01/2017.
Modification date: 07/04/2017.
**********************************************************/
class Mistake {
    constructor() {
        this._verror = true;
        this._vnumber = '';
        this._vdescription = '';
    }
	
    set error( verror ) {
        this._verror = verror;
    }

    set number( vnumber ) {
        this._vnumber = vnumber;
    }

    set description( vdescription ) {
        this._vdescription = vdescription;
    }

    get error() {
        return this._verror;
    }

    get number() {
        return this._vnumber;
    }

    get description() {
        return this._vdescription;
    }
}
