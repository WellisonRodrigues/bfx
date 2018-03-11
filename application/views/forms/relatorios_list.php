<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//echo '<pre>';
//print_r($relatorio);
//
//foreach ($relatorio['employees'] as $res) {
//    if ($res['agendas']) {
//        foreach ($res['agendas'] as $agenda) {
//            if ($agenda['routes']) {
//                foreach ($agenda as $router) {
//                    print_r($res['name']);
//                    print_r($router['created_at']);
//                }
//            }
//        }
//
//    } else {
//        print_r($res['name']);
//    }
//
//}

//if ($this->session->userdata('user')['client_type'] == 'admin'
//) {
//    $url = "$this->url/admin/reports/dashboard?q[name_cont]=";
////            dashboard-client
////            dashboard-manager
//}
//if ($this->session->userdata('user')['client_type'] == 'managers') {
//    $url = "$this->url/admin/reports/dashboard-manager?q[name_cont]=";
//}
//if ($this->session->userdata('user')['client_type'] == 'clients') {
//    $url = "$this->url/admin/reports/dashboard-client?q[name_cont]=";
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
                if ($this->session->userdata('user')['client_type'] == 'admin'
                ) {
                    if (isset($relatorio['clients'])) {
                        foreach ($relatorio['clients'] as $row) {
                            $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                            $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                            if ($row['departaments']) {

                                foreach ($row['departaments'] as $departament) {
                                    if ($departament['employees']) {
                                        foreach ($departament['employees'] as $employee) {
                                            if ($employee['locals']) {
                                                foreach ($employee['locals'] as $local) {
                                                    $this->table->add_row(
                                                        ['data' => @$row['name']],
                                                        ['data' => @$departament['title']],
                                                        ['data' => @$employee['name']],
                                                        ['data' => @$local['company_name']],
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
                                                    ['data' => @$departament['title']],
                                                    ['data' => @$employee['name']],
                                                    ['data' => ""],
                                                    ['data' => ""],
                                                    ['data' => ""],
                                                    ['data' => ""],
                                                    ['data' => ""],
                                                    ['data' => ""]);
                                            }
                                        }
                                    } else {
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


                        }
                        //                        }
                        //                    }
                    }
                }
                if ($this->session->userdata('user')['client_type'] == 'managers') {

                    $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_relatorios">']);
                    $this->table->set_heading('Colaboradores ', 'Locais Visitados',
                        'Data', 'check in', 'check out', ' Quilômetros rodados ', 'Valor reembolsado');
                    if (isset($relatorio['employees'])) {

                        foreach ($relatorio['employees'] as $row) {
                            if ($row['agendas'] != null) {
                                foreach ($row['agendas'] as $newrow) {
                                    if ($newrow) {
                                        foreach ($newrow as $newrow2) {
                                            $this->table->add_row(
                                                ['data' => @$row['name']],
                                                ['data' => @$newrow['company_name']],
                                                ['data' => @$newrow2['created_at']],
                                                ['data' => @$newrow2['check_in']],
                                                ['data' => @$newrow2['check_out']],
                                                ['data' => @$newrow2['total_km']],
                                                ['data' => @$newrow2['value_km']]

                                            );
                                        }
                                    }
                                }
                            } else {
                                $this->table->add_row(
                                    ['data' => @$row['name']],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""],
                                    ['data' => ""]
                                );
                            }
                        }
                    }
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

