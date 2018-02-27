<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//foreach ($relatorio as $row) {
//    print_r($row['employee']['id']);
//    print_r($row['employee']['departament']['name']);
//    print_r($row['employee']['departament']['client_id']);
//    foreach ($row['employee']['locals'] as $local) {
//        print_r($local['company_name']);
//        echo '<br/>';
//    }
//    foreach ($row['employee']['routes'] as $rout) {
//        print_r($rout['total_km']);
//        echo '<br/>';
//        print_r($rout['check_in']);
//        print_r($rout['check_out']);
//        print_r($rout['updated_at']);
//        print_r($rout['value_km']);
//        echo '<br/>';
//    }
//
//echo '<pre>';
//print_r($relatorio['clients']);
//echo '<br/>';
//}
//foreach ($relatorio['clients'] as $roe) {
//    if ($roe['departaments']) {
//        print_r($roe['departaments']);
//        echo '<br/>';
//    }
//
//}
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><strong style="color: #1ab7ea"> Relatórios
                    </strong></h3>
                <p style="color: gray;"> Veja relatórios de visitas check ins e check outs, quiômetros rodados e valores
                    reembolsados

            </div>
            <div class="panel-body">
                <?php

                $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_relatorios">']);
                $this->table->set_heading('Clientes Masters ', 'Departamentos', 'Colaboradores ', 'Locais Visitados',
                    'Data', 'check in', 'check out', ' Quilômetros rodados ', 'Valor reembolsado');
                if (isset($relatorio['clients'])) {
                    foreach ($relatorio['clients'] as $row) {
//                        foreach ($row['employee']['locals'] as $local) {
//                            foreach ($row['employee']['routes'] as $rout) {
//                                $idusuario = $usuario['id'];
//                                $url_edit = base_url() . 'Clients/edit_client/' . $idusuario;
//                                $url_delete = base_url() . 'Clients/delete_client/' . $idusuario;

                        $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                        $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                        if ($row['departaments']) {

                            foreach ($row['departaments'] as $departament) {
                                $this->table->add_row(
                                    ['data' => @$row['name']],
                                    ['data' => @$departament['title']],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""]

                                );
                            }
                        } else {

                            $this->table->add_row(
                                ['data' => @$row['name']],
                                ['data' => ""],
                                ['data' => ""],
                                ['data' => ""],
                                ['data' => ""],
                                ['data' => ""],
                                ['data' => ""],
                                ['data' => ""],
                                ['data' => ""]

                            );

                        }
//                        $this->table->add_row(
//
//                            ['data' => @$row['name']]
////                                ['data' => @$row['']],
////                                ['data' => @$usuario["employees"]['nickname']],
////                                ['data' => @$row['employee']['departament']['company_name']],
////                                ['data' => @$rout['updated_at']],
////                                ['data' => @$rout['check_in']],
////                                ['data' => @$rout['check_out']],
////                                ['data' => @$rout['total_km']],
//////                        ['data' => anchor("usuarios/editar/" . @$usuario["id"] . "", "<p class='fa fa-pencil'></p>", 'class = "btn btn-outline btn-primary btn-xs btn-block"'), 'align' => 'center'],
////                                ['data' => @$rout['value_km']]
//                        );


                    }
//                        }
//                    }
                }
                echo $this->table->generate();
                ?>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('.delete').bind('click', function () {

            var comf = confirm('Deseja mesmo excluir?');

            if (comf == true) {

            } else {
                event.preventDefault();
            }

        });
        dataTableInit("#tb_relatorios");
    });
</script>

