<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
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
                    'Data', 'check in', 'check out', ' Quilômetros rodados ', 'Valor reembolsado', 'KM Value');
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
                                                    $valor = @$local['km_travelled'];

                                                    $new = number_format($valor, 2, ',', ' ');
                                                    $reembolso = (@$local['km_travelled']) * @$departament['value'];
                                                    $this->table->add_row(
                                                        ['data' => @$row['name']],
                                                        ['data' => @$departament['title']],
                                                        ['data' => @$employee['name']],
                                                        ['data' => @$local['company_name']],
                                                        ['data' => @$local['created_at']],
                                                        ['data' => @$local['check_in']],
                                                        ['data' => @$local['check_out']],
                                                        ['data' => @$new . ' Km'],
                                                        ['data' => 'R$ ' . @$reembolso],
                                                        ['data' => 'R$ ' . @$departament['value']]

                                                    );
                                                }
                                            }
                                            if ($employee['agendas']) {
                                                foreach ($employee['agendas'] as $agendas) {
                                                    $valor = @$agendas['routes']['km_travelled'];

                                                    $new = number_format($valor, 2, ',', ' ');
                                                    $this->table->add_row(
                                                        ['data' => @$row['name']],
                                                        ['data' => @$departament['title']],
                                                        ['data' => @$employee['name']],
                                                        ['data' => @$agendas['company_name']],
                                                        ['data' => @$agendas['routes']['created_at']],
                                                        ['data' => @$agendas['routes']['check_in']],
                                                        ['data' => @$agendas['routes']['check_out']],
                                                        ['data' => @$new . ' Km'],
                                                        ['data' => 'R$ ' . @$reembolso],
                                                        ['data' => 'R$ ' . @$departament['value']]
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
                        'Data', 'check in', 'check out', ' Quilômetros rodados ', 'Valor reembolsado', 'KM Value');
                    if (isset($relatorio['employees'])) {

                        foreach ($relatorio['employees'] as $row) {
                            if ($row['agendas'] != null) {
                                foreach ($row['agendas'] as $newrow) {
                                    if ($newrow) {
//                                        foreach ($newrow as $newrow2) {
//                                        $reembolso = (@$local['km_traveled'] / 1000) * @$departament['value'];
                                        $valor = @$newrow['km_travelled'];

                                        $new = number_format($valor, 2, ',', ' ');
                                        $reembolso = (@$newrow['km_travelled']) * @$row['departament_value'];
                                        $this->table->add_row(
                                            ['data' => @$row['name']],
                                            ['data' => @$newrow['company_name']],
                                            ['data' => @$newrow['routes']['created_at']],
                                            ['data' => @$newrow['routes']['check_in']],
                                            ['data' => @$newrow['routes']['check_out']],
                                            ['data' => @$new . ' Km'],
                                            ['data' => 'R$ ' . @$reembolso],
                                            ['data' => 'R$ ' . @$row['departament_value']]

                                        );
//                                        }
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
                                    ['data' => 'R$ ' .@$row['departament_value']]
                                );
                            }
                        }
                    }
                }
//                echo '<pre>';
//                print_r($relatorio);
//
                if ($this->session->userdata('user')['client_type'] == 'clients') {
                    $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_relatorios">']);
                    $this->table->set_heading('Departamentos', 'Colaboradores ', 'Locais Visitados',
                        'Data', 'check in', 'check out', ' Quilômetros rodados ', 'Valor reembolsado', 'KM Value');
                    if ($relatorio['departaments']) {
                        foreach ($relatorio['departaments'] as $res) {
                            if ($res['employees']) {
                                foreach ($res['employees'] as $employee) {
                                    if ($employee['agendas']) {
                                        foreach ($employee['agendas'] as $agenda) {
                                            @$reembolso = (@$agenda['routes']['km_travelled']) * @$res['value'];
                                            $valor = @$agenda['routes']['km_travalled'];
//                                            print_r(@$agenda['routes']['km_travalled']);
                                            $new = number_format($valor, 2, ',', ' ');
                                            $this->table->add_row(
                                                ['data' => @$res['title']],
                                                ['data' => @$employee['name']],
                                                ['data' => @$agenda['company_name']],
                                                ['data' => @$agenda['routes']['created_at']],
                                                ['data' => @$agenda['routes']['check_in']],
                                                ['data' => @$agenda['routes']['check_out']],
                                                ['data' => @$new . ' Km'],
                                                ['data' => 'R$ ' . @$reembolso],
                                                ['data' => 'R$ ' . @$res['value']]
                                            );
                                        }

                                    } else {
                                        $this->table->add_row(
                                            ['data' => @$res['title']],
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
                            } else {
                                $this->table->add_row(
                                    ['data' => @$res['title']],
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
//        $('.km').mask("##.#00", {reverse: true, maxlength: false});
    });
</script>
