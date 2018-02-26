<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//print_r($departments);
if ($this->session->userdata('user')['client_type'] == 'admin' or
    $this->session->userdata('user')['client_type'] == 'clients'
) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3><strong style="color: #1ab7ea"> DEPARTAMENTOS
                        </strong></h3>
                    <p style="color: gray;"> Tem gestores e colaboradores vinculados, e obedecem a gestores e clientes
                        masters</p>

                </div>
                <div class="panel-body">
                    <?php
                    $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" id="tb_usuarios">']);
                    $this->table->set_heading(' Nome ', ' Cliente Master', ' Gestor ', 'N° Colaboradores', ' Alterar ');
                    if ($departments) {
                        foreach (@$departments as $department) {
                            $created_at = date('d/m/Y H:i:s', strtotime(@$department["created_at"]));
                            $updated_at = date('d/m/Y H:i:s', strtotime(@$department["updated_at"]));
                            $iddepartment = $department['id'];
                            $url_edit = base_url() . 'Department/edit_department/' . $iddepartment;
                            $url_delete = base_url() . 'Department/delete_department/' . $iddepartment;
                            $url_deptopatch = base_url() . 'Department/path_department/' . $iddepartment;
                            $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$iddepartment' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
  <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li><a href='$url_deptopatch' class='center-block' style='color: gray'> <i class='fas fa-link'> </i>&nbsp;&nbsp; Vincular departamento</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir Departamento</a></li>

  </ul></div>";
                            $this->table->add_row(
                                ['data' => @$department["name"]],
                                ['data' => @$department["client_id"]],
                                ['data' => @$department["manager_id"]],
                                ['data' => ''],
//                        ['data' => anchor("usuarios/editar/" . @$usuario["id"] . "", "<p class='fa fa-pencil'></p>", 'class = "btn btn-outline btn-primary btn-xs btn-block"'), 'align' => 'center'],
                                ['data' => $options]
                            );
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
//        dataTableInit("#tb_usuarios");
        });
    </script>
<?php } else { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3><strong style="color: #1ab7ea"> DEPARTAMENTOS
                        </strong></h3>
                    <p style="color: gray;"> Tem gestores e colaboradores vinculados, e obedecem a gestores e clientes
                        masters</p>

                </div>
                <div class="panel-body">
                    <?php
                    $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" id="tb_usuarios">']);
                    $this->table->set_heading(' Nome ', 'N° Colaboradores', ' Alterar ');
                    if ($departments) {
//                        foreach (@$departments as $department) {
                        $created_at = date('d/m/Y H:i:s', strtotime(@$departments["created_at"]));
                        $updated_at = date('d/m/Y H:i:s', strtotime(@$departments["updated_at"]));
                        $iddepartment = $departments['id'];
                        $url_edit = base_url() . 'Department/edit_department/' . $iddepartment;
                        $url_delete = base_url() . 'Department/delete_department/' . $iddepartment;
                        $url_deptopatch = base_url() . 'Department/path_department/' . $iddepartment;
                        $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$iddepartment' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
  <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li><a href='$url_deptopatch' class='center-block' style='color: gray'> <i class='fas fa-link'> </i>&nbsp;&nbsp; Vincular departamento</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir Departamento</a></li>

  </ul></div>";
                        $this->table->add_row(
                            ['data' => @$departments["name"]],
                            ['data' => ''],
//                        ['data' => anchor("usuarios/editar/" . @$usuario["id"] . "", "<p class='fa fa-pencil'></p>", 'class = "btn btn-outline btn-primary btn-xs btn-block"'), 'align' => 'center'],
                            ['data' => $options]
                        );
                    }
                    //                    }
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
//        dataTableInit("#tb_usuarios");
        });
    </script>
<?php } ?>