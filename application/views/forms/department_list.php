<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */

//echo '<pre>';

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
                    <div class="message"></div>
                    <?php
                    $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_departments">']);
                    $this->table->set_heading(' Nome ', ' Cliente Master', ' Gestor ', 'N° Colaboradores', ' Alterar ');
                    if ($departments) {
                        foreach (@$departments['departaments'] as $department) {
                            $created_at = date('d/m/Y H:i:s', strtotime(@$department["created_at"]));
                            $updated_at = date('d/m/Y H:i:s', strtotime(@$department["updated_at"]));
                            $iddepartment = $department['id'];
                            $url_edit = base_url() . 'Department/edit_department/' . $iddepartment;
                            $url_delete = base_url() . 'Department/delete_department/' . $iddepartment;
                            $url_deptopatch = base_url() . 'Department/path_department/' . $iddepartment;
                            $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$iddepartment' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
   <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li><a href=''  data-toggle=\"modal\" data-target=\"#modal_rota\" class='center-block' style='color: gray'> <i class='fas fa-paper-plane'> </i>&nbsp;&nbsp; Definições de variação de rota</ahr></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
     <li><a href='' data-toggle=\"modal\" data-target=\"#modal_value\" class='center-block' style='color: gray'> <i class='fas fa-dollar-sign'> </i>&nbsp;&nbsp; Definições de reembolso</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir Departamento</a></li>

  </ul></div>";
                            $this->table->add_row(
                                ['data' => @$department["name"]],
                                ['data' => @$department["client"]],
                                ['data' => @$department["manager"]],
                                ['data' => @$department["employees"]],
//                        ['data' => anchor("usuarios/editar/" . @$usuario["id"] . "", "<p class='fa fa-pencil'></p>", 'class = "btn btn-outline btn-primary btn-xs btn-block"'), 'align' => 'center'],
                                ['data' => $options]
                            );
                            ?>
                            <div id="modal_rota" class="modal fade cancel" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Definições de variação de rota</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Porcentagem*</label>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <?php
                                                        echo form_input(
                                                            [
                                                                'name' => 'percentage_out',
                                                                'id' => 'percentage_out',
                                                                'type' => 'text',
//                                                                'max' => 100,
                                                                'required' => 'required',
                                                                'class' => 'form-control percentage_out',
                                                                'value' => set_value(''),
                                                                'maxlength' => '70',
                                                            ]);
                                                        ?></div>
                                                    <strong> % </strong>

                                                </div>
                                            </div>
                                            <br/>
                                            <b>Porcentage atual:<?php echo @$department["percentage_out"] ?> </b><br/>
                                            <script>
                                                $(document).ready(function () {

                                                    var id = '<?php echo $iddepartment?>';
                                                    $('#salvar_percent_<?php echo $iddepartment ?>').bind('click', function () {
                                                        var percentage = ($("#percentage_out").val());

                                                        $.post('<?php echo base_url()?>Department/setconfigs/' + id, {percentage_out: percentage}, function (data) {
                                                            $.ajax({
                                                                statusCode: {
                                                                    200: function () {
                                                                        $('.message').addClass('alert alert-success role="alert"').text('Salvo');
                                                                        $("#modal_rota").modal("hide")
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    });

                                                });
                                            </script>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" id="salvar_percent_<?php echo $iddepartment ?>"
                                                    class="btn btn-success">Salvar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div id="modal_value" class="modal fade cancel" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Definições de reembolso</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Valor*</label>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <?php
                                                        echo form_input(
                                                            [
                                                                'name' => 'valor',
                                                                'id' => 'valor',
                                                                'type' => 'text',
//                                                                'max' => 100,
                                                                'required' => 'required',
                                                                'class' => 'form-control value',
                                                                'value' => set_value(''),
                                                                'maxlength' => '70',
                                                            ]);
                                                        ?></div>
                                                </div>
                                            </div>
                                            <br/>
                                            <b>Valor atual:<?php echo @$department["value"] ?> </b><br/>
                                            <script>
                                                $(document).ready(function () {

                                                    var id = '<?php echo $iddepartment?>';
                                                    $('#salvar_value_<?php echo $iddepartment ?>').bind('click', function () {
                                                        var value = ($("#valor").val());

                                                        $.post('<?php echo base_url()?>Department/setconfigs/' + id, {value: value}, function (data) {
                                                            $.ajax({
                                                                statusCode: {
                                                                    200: function () {
                                                                        $('.message').addClass('alert alert-success role="alert"').text('Salvo');
                                                                        $("#modal_value").modal("hide")
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    });

                                                });
                                            </script>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" id="salvar_value_<?php echo $iddepartment ?>"
                                                    class="btn btn-success">Salvar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <?php
                        }
                    }
                    echo $this->table->generate();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--    <script>-->
    <!---->
    <!--        $(document).ready(function () {-->
    <!--            $('.delete').bind('click', function () {-->
    <!---->
    <!--                var comf = confirm('Deseja mesmo excluir?');-->
    <!---->
    <!--                if (comf == true) {-->
    <!---->
    <!--                } else {-->
    <!--                    event.preventDefault();-->
    <!--                }-->
    <!---->
    <!--            });-->
    <!--//        dataTableInit("#tb_usuarios");-->
    <!--        });-->
    <!--    </script>-->
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
                    $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_departments">']);
                    $this->table->set_heading(' Nome ', 'N° Colaboradores', ' Alterar ');
                    if ($departments['departament']) {
//                        foreach (@$departments as $department) {
                        $created_at = date('d/m/Y H:i:s', strtotime(@$departments["created_at"]));
                        $updated_at = date('d/m/Y H:i:s', strtotime(@$departments["updated_at"]));
                        $iddepartment = $departments['departament']['id'];
                        $url_edit = base_url() . 'Department/edit_department/' . $iddepartment;
                        $url_delete = base_url() . 'Department/delete_department/' . $iddepartment;
                        $url_deptopatch = base_url() . 'Department/path_department/' . $iddepartment;
                        $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$iddepartment' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
  <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li><a data-toggle=\"modal\" data-target=\"#modal_rota\" class='center-block' style='color: gray'> <i class='fas fa-paper-plane'> </i>&nbsp;&nbsp; Definições de variação de rota</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
     <li><a data-toggle=\"modal\" data-target=\"#modal_money\" class='center-block' style='color: gray'> <i class='fas fa-dollar-sign'> </i>&nbsp;&nbsp; Definições de reembolso</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'>
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir Departamento</a></li>

  </ul></div>";
                        $this->table->add_row(
                            ['data' => @$departments['departament']["name"]],
                            ['data' => @$departments['departament']["employees"]],
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

<?php } ?>
<script>

    $(document).ready(function () {
        $("#percentage_out").inputmask("decimal", {min: 0, max: 100, allowMinus: true});
        $('.delete').bind('click', function () {

            var comf = confirm('Deseja mesmo excluir?');

            if (comf == true) {

            } else {
                event.preventDefault();
            }

        });
        dataTableInit("#tb_departments");
    });
</script>
