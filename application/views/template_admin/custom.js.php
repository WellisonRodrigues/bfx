<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Stefan
 * Date: 03/06/2017
 * Time: 11:42
 */
?>
<script language="JavaScript">


    function dataTableInit(seletorTabela) {

//    $.extend(true, $.fn.DataTable.TableTools.classes, {
//        "container": "btn-group tabletools-btn-group pull-right",
//        "buttons": {
//            "normal": "btn btn-sm default",
//            "disabled": "btn btn-sm default disabled"
//        }
//    });

    $(seletorTabela).DataTable({
//        dom: 'Bfrtip',
        dom: '<"col-md-6"f><"col-md-12"t><"col-md-4"i><"col-md-8"p>',


        responsive: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ ",
//            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },

        }
    });
}
</script>
