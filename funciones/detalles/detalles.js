$(document).ready(function () {
    var opcion;
    function listar() {
        opcion = 9;
        $('#tabledepa').DataTable().clear().destroy();
        $.ajax({
            url: "/departamentos-listar",
            type: "GET",
            datatype: "json",
            data: { opcion: opcion },
            success: function (data) {
                //RECORRER OBJETO JS
                let ObjetoJSS = JSON.parse(data);               
                for (let itemm of ObjetoJSS) { var listar = itemm.data; }
                if (listar == 0) {
                    var tabledepa = $('#tabledepa').DataTable({
                        "autoWidth": false,
                        "columns": [null, null, null, null, null, null, null]
                    });
                } else {
                    opcion = 0;
                    var tabledepa = $('#tabledepa').DataTable({
                        "ajax": {
                            "url": "/departamentos-listar",
                            "method": 'GET', //usamos el metodo POST
                            "data": { opcion: opcion },
                            "dataSrc": ""
                        },
                        "autoWidth": false,
                        "columns": [
                            { "data": "dep_id" },
                            { "data": "dep_nombre" },
                            { "data": "dep_representante" },
                            { "data": "dep_maxdoc" },
                            { "defaultContent": "<button class='btn btn-warning btn-sm mdi mdi-format-list-bulleted font-size-12 btnDeta' data-toggle='tooltip' data-placement='left' title='DETALLAR DOCUMENTOS POR DEPARTAMENTO'></button>" }
                        ],
                        "columnDefs": [
                            {
                                "targets": 0,
                                "render": function (data, type, row, meta) {
                                    //console.log(row.usu_id)
                                    return '<span style="display: block;margin: auto;text-align: center;" data-id="' + row.dep_id + '" >' + row.dep_id + '</span>';
                                }
                            }
                        ]
                    });
                    tabledepa.on('order.dt search.dt', function () {
                        tabledepa.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                            cell.innerHTML = '<span style="display: block;margin: auto;text-align: center;" data-id="' + $(cell.innerHTML).attr("data-id") + '" >' + (i + 1) + '</span>';
                        });
                    }).draw();
                }
            }
        });
    }

    listar();

    $(document).on("click", ".btnDeta", function () {
        //opcion = 2;//filtar
        fila = $(this).closest("tr");
        //idst = fila.find('td:eq(0)').text(); //capturo el ID
        idst = fila.find('td:eq(0)').find('span').attr("data-id");
        dnom = fila.find('td:eq(1)').text();
        $("#principal").hide();
        $('#detalle').load('views/detalles/detalles.php', { "idst": idst, "dnom": dnom });
    });
    
});