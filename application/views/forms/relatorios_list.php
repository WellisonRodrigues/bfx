<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//echo '<pre>';
//print_r($relatorio);
////
//foreach ($relatorio['managers'] as $res) {
//    echo '<br>';
//    print_r($res['name']);
//    echo '<br>';
//    print_r($res['departament']['name']);
//    if ($res['employees']) {
//        foreach ($res['employees'] as $employee) {
//            print_r($employee['name']);
//            echo '<br>';
//        }
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
                                                    $reembolso = (@$local['km_traveled'] / 1000) * @$departament['value'];
                                                    $this->table->add_row(
                                                        ['data' => @$row['name']],
                                                        ['data' => @$departament['title']],
                                                        ['data' => @$employee['name']],
                                                        ['data' => @$local['company_name']],
                                                        ['data' => @$local['created_at']],
                                                        ['data' => @$local['check_in']],
                                                        ['data' => @$local['check_out']],
                                                        ['data' => @$local['total_km'] / 1000 . ' Km'],
                                                        ['data' => 'R$ ' . @$reembolso]

                                                    );
                                                }
                                            }
                                            if ($employee['agendas']) {
                                                foreach ($employee['agendas'] as $agenda) {
                                                    $this->table->add_row(
                                                        ['data' => @$row['name']],
                                                        ['data' => @$departament['title']],
                                                        ['data' => @$employee['name']],
                                                        ['data' => @$agenda['company_name']],
                                                        ['data' => @$agenda['routes']['created_at']],
                                                        ['data' => @$agenda['routes']['check_in']],
                                                        ['data' => @$agenda['routes']['check_out']],
                                                        ['data' => @$agenda['routes']['total_km'] / 1000 . ' Km'],
                                                        ['data' => 'R$ ' . @$reembolso]);
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
                if ($this->session->userdata('user')['client_type'] == 'clients') {
                    $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_relatorios">']);
                    $this->table->set_heading('Departamentos', 'Colaboradores ', 'Locais Visitados',
                        'Data', 'check in', 'check out', ' Quilômetros rodados ', 'Valor reembolsado');
                    if ($relatorio['managers']) {
                        foreach ($relatorio['managers'] as $res) {
                            if ($res['employees']) {
                                foreach ($res['employees'] as $employee) {
                                    $this->table->add_row(
                                        ['data' => @$res['departament']['name']],
                                        ['data' => @$employee['name']],
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
                                    ['data' => @$res['departament']['name']],
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

