<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//echo '<pre>';
//print_r($employees);
?>
<!--<li><a href='$url_deptopatch' class='center-block' style='color: gray'> <i class='fas fa-link'> </i>&nbsp;&nbsp; Vincular departamento</a></li>-->
<!--<hr style='margin-top: 5px;margin-bottom: 5px'>-->

<!--<div class="row">-->
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><strong style="color: #1ab7ea"> COLABORADORES
                </strong></h3>
            <p style="color: gray;"> vinculados a um departamento, obedecem a gestores
                um clientes masters</p>

        </div>
        <div class="panel-body"
        ">
        <?php
        $this->table->set_template(['table_open' => '<table  class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_employees">']);
        $this->table->set_heading(' Nome ', ' Departamento ', ' Gestor ', ' Cliente Master ', ' E-mail',
            'Telefone', 'CPF', ' Alterar ');
        if ($employees['employees']) {
            foreach (@$employees['employees'] as $usuario) {
                $idusuario = $usuario['id'];
                $url_edit = base_url() . 'Employees/edit_employee/' . $idusuario;
                $url_delete = base_url() . 'Employees/delete_employee/' . $idusuario;
//                $url_deptopatch = base_url() . 'Employees/path_employee/' . $idusuario;
                $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$idusuario' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir Usúario</a></li>

  </ul></div>";
                $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                $this->table->add_row(
                    ['data' => @$usuario["name"]],
                    ['data' => @$usuario["departament"]],
                    ['data' => @$usuario["manager"]],
                    ['data' => @$usuario["client"]],
                    ['data' => @$usuario["email"]],
                    ['data' => @$usuario["phone"]],
                    ['data' => @$usuario["cpf"]],
//                        ['data' => anchor("usuarios/editar/" . @$usuario["id"] . "", "<p class='fa fa-pencil'></p>", 'class = "btn btn-outline btn-primary btn-xs btn-block"'), 'align' => 'center'],
                    ['data' => $options]
                );
            }
        }
        echo $this->table->generate();
        ?>
    </div>
</div>
<!--</div>-->
<!--</div>-->
<script>

    $(document).ready(function () {
        $('.delete').bind('click', function () {

            var comf = confirm('Deseja mesmo excluir?');

            if (comf == true) {

            } else {
                event.preventDefault();
            }

        });
        dataTableInit("#tb_employees")
    });
</script>
