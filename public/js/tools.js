function configTableBasic(className='table', searching=true)
 {
    let vhtml ='';
        vhtml+='<div class="alert alert-light alert-dismissible" role="alert">';
        vhtml+='    <h3 class="alert-heading h4 my-2">Lo sentimos !...</h3>';
        vhtml+='    <p class="mb-0">No se encontraron registros que mostrar.</p>';
        vhtml+='</div>';

    jQuery('.' + className).DataTable({
        pageLength: 30,
        searching: searching,
        dom: "Bfrtip",
        language: {
            "emptyTable": vhtml,
            "zeroRecords": vhtml,
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search..",
            info: "<strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
            paginate: {
                first: '<i class="bx bx-chevrons-left"></i>',
                previous: '<i class="bx bx-chevron-left"></i>',
                next: '<i class="bx bx-chevron-right"></i>',
                last: '<i class="bx bx-chevrons-right"></i>'
            }
        },
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function(e) {
                        e = e.data();
                        return "DETALLE "
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: "table"
                })
            }
        }
    });
 }

function swalFire(icon, title, text, _return=null)
 {
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        showConfirmButton: false,
        timer: 3000,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    }).then((result) => {
        if ( _return != null ) {
            window.location = vuri + _return;
        }
    });
 }