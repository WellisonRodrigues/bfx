<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//echo '<pre>';
//print_r($clients);
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><strong style="color: #1ab7ea"> CLIENTES MASTERS
                    </strong></h3>
                <p style="color: gray;"> Clientes Masters possuem gestores, departamentos e colaboradores</p>

            </div>
            <div class="panel-body">
                <?php

                $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_clients">']);
                $this->table->set_heading('Nome', 'Razão Social', 'CNPJ ', 'E-mail', 'N° Departamentos', 'N° Colaboradores', ' Alterar ');
                foreach (@$clients['clients'] as $usuario) {
                    $idusuario = @$usuario['id'];
                    $url_edit = base_url() . 'Clients/edit_client/' . $idusuario;
                    $url_delete = base_url() . 'Clients/delete_client/' . $idusuario;
                    $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$idusuario' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir Usúario</a></li>

  </ul></div>";
                    $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                    $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                    $count = 0;
                    if (@$usuario["departaments"]) {
                        foreach (@$usuario["departaments"] as $employeer) {
                            $count = $employeer["number_employees"] + $count;
                        }
                    }
                    $this->table->add_row(
                        ['data' => @$usuario["full_name"]],
                        ['data' => @$usuario["razao_social"]],
                        ['data' => @$usuario["cnpj"]],
                        ['data' => @$usuario["email"]],
                        ['data' => @$usuario['number_departaments']],
                        ['data' => @$count],
//                        ['data' => anchor("usuarios/editar/" . @$usuario["id"] . "", "<p class='fa fa-pencil'></p>", 'class = "btn btn-outline btn-primary btn-xs btn-block"'), 'align' => 'center'],
                        ['data' => $options]
                    );

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
        dataTableInit("#tb_clients");
    });
</script>

