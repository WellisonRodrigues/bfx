<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//print_r($managers);
//print_r($clients);
//foreach ($clients['response'] as $client) {
//    $array['id'] = 'name';
//}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><strong style="color: #1ab7ea"> GESTORES
                    </strong></h3>
                <p style="color: gray;"> Gestores são vinculados a um departamento, possuem colaboradores e obedecem a
                    um cliente master</p>

            </div>
            <div class="panel-body">
                <?php
                $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_managers">']);
                if ($this->session->userdata("user")['client_type'] == 'admin') {
                    $this->table->set_heading(' Nome ', ' Departamento ', ' Cliente Master ', ' N° Colaboradores ', ' Telefone', 'CPF', ' Alterar ');
                } else {
                    $this->table->set_heading(' Nome ', ' Departamento ', ' N° Colaboradores ', ' Telefone', 'CPF', ' Alterar ');
                }
                if ($managers) {
                    foreach (@$managers as $usuario) {
                        $idusuario = $usuario['id'];
                        $url_edit = base_url() . 'Managers/edit_manager/' . $idusuario;
                        $url_deptopatch = base_url() . 'Managers/path_Managers/' . $idusuario;
                        $url_delete = base_url() . 'Managers/delete_manager/' . $idusuario;
                        $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$idusuario' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li><a href='$url_deptopatch' class='center-block' style='color: gray'> <i class='fas fa-link'> </i>&nbsp;&nbsp; Vincular departamento</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir Usúario</a></li>
  </ul></div>";
                        $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                        $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                        if ($this->session->userdata("user")['client_type'] == 'admin') {
                            $this->table->add_row(
                                ['data' => @$usuario["name"]],
                                ['data' => @$usuario["departament_id"]],
                                ['data' => @$usuario["client_id"]],
                                ['data' => ''],
                                ['data' => ''],
                                ['data' => ''],
//                        ['data' => anchor("usuarios / editar / " . @$usuario["id"] . "", " < p class='fa fa-pencil' ></p > ", 'class = "btn btn - outline btn - primary btn - xs btn - block"'), 'align' => 'center'],
                                ['data' => $options]
                            );
                        } else {
                            $this->table->add_row(
                                ['data' => @$usuario["name"]],
//                            ['data' => @$usuario["razao_social"]],
                                ['data' => @$usuario["cnpj"]],
                                ['data' => ''],
                                ['data' => ''],
                                ['data' => ''],
//                        ['data' => anchor("usuarios / editar / " . @$usuario["id"] . "", " < p class='fa fa-pencil' ></p > ", 'class = "btn btn - outline btn - primary btn - xs btn - block"'), 'align' => 'center'],
                                ['data' => $options]
                            );
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
        dataTableInit("#tb_managers");
    });
</script>
