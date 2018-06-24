<?php
/**
 * Created by PhpStorm.
 * User: welli
 * Date: 23/06/2018
 * Time: 19:05
 */

//print_r($employees);

$dropdown_perfil = array();
if ($employees) {
    foreach ($employees['employees'] as $perfil) {
        $dropdown_perfil[$perfil['id']] = $perfil['name'];
    }
}
$dropdown_periodo = array('month' => 'Mensal', 'year' => 'Anual', 'week' => 'Semanal', 'day' => 'Diario');
//echo '<pre>';
//print_r($valores);
?>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">

            <!--            <div class="panel panel-default">-->
            <!--                <div class="panel-heading">-->
            <h3><strong style="color: #1ab7ea"> Cálculo de Reembolso
                </strong></h3>

            <p style="color: gray;"> Veja relatórios de valores reembolsado por periodo
            
        </div>
        <div class="panel-body">
            <div class="col-md-6 mx-auto">
                <div class="row">
                    <div class="col-md-5">
                        <?php
                        echo form_open('Reembolso');
                        echo form_dropdown(
                            'idusuario', $dropdown_perfil,
                            set_value('idusuario'),
                            'class="form-control"'
                        ); ?>
                    </div>
                    <div class="col-md-5">
                        <?php
                        echo form_dropdown(
                            'periodo', $dropdown_periodo,
                            set_value('periodo'),
                            'class="form-control"'
                        );
                        ?>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Buscar</button>
                    </div>

                </div>
            </div>

            <?php
            echo form_close()
            ?>
            <div class="col-md-12">


                <!--        --><?php
                if (isset($valores)) {
                    echo '<br><h4>';
                    echo 'Valor Total do funcionario : ' . $valores['response']['employees_total_value']['employees_total_value'];
                    echo '<br>';
                    echo '<br>';
                    echo 'Valor Total do departamento : ' . $valores['response']['employees_total_value']['departament_value'];
                    echo '</h4>';
                }

                //        $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_managers">']);
                //        $this->table->set_heading(' Nome ', ' Departamento ', ' N° Colaboradores ', ' Telefone', 'CPF', ' Alterar ');
                //
                //        if ($managers['managers']) {
                //            foreach (@$managers['managers'] as $usuario) {
                //                $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                //                $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                //                $this->table->add_row(
                //                    ['data' => @$usuario["name"]],
                //                    ['data' => @$usuario["departament"]],
                //                    //                                ['data' => @$usuario["client"]],
                //                    ['data' => @$usuario["employees_count"]],
                //                    ['data' => @$usuario["phone"]],
                //                    ['data' => @$usuario["cpf"]],
                //                    //                        ['data' => anchor("usuarios / editar / " . @$usuario["id"] . "", " < p class='fa fa-pencil' ></p > ", 'class = "btn btn - outline btn - primary btn - xs btn - block"'), 'align' => 'center'],
                //                    ['data' => $options]
                //                );
                ////                }
                //            }
                //        }
                //        echo $this->table->generate();
                //        ?>
            </div>
        </div>
    </div>
</div>
