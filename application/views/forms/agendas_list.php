<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//echo '<pre>';
//print_r($agendas);


if ($employees) {
    foreach ($employees['employees'] as $manage) {
        $arraydp[$manage['id']] = $manage['name'];
    }

}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><strong style="color: #1ab7ea"> AGENDAS
                    </strong></h3>
                <p style="color: gray;"></p>

            </div>
            <div class="panel-body">
                <?php
                $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_managers">']);
                if ($this->session->userdata("user")['client_type'] == 'admin') {
                    $this->table->set_heading(' Nome da empresa ', ' Endereço ', 'Hora ', ' Dia', 'Alterar', 'Justf.');
                } else {
                    $this->table->set_heading(' Nome da empresa ', ' Endereço ', 'Hora ', ' Dia', 'Alterar', 'Justf.');
                }
                if ($agendas) {
                    foreach (@$agendas as $usuario) {
                        $idusuario = @$usuario['id'];
                        $url_edit = base_url() . 'Agendas/edit_agenda/' . $idusuario;
                        $url_delete = base_url() . 'Agendas/delete_agenda/' . $idusuario;
                        $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$idusuario' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li class='vincular'><a  href=''  data-toggle=\"modal\" data-target=\"#modal\" class='center-block' style='color: gray'><i class='fas fa-edit'> </i>&nbsp;&nbsp; Vincular Colaborador</a></li> 
    <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir</a></li>
  </ul></div>";
                        $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                        $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                        if ($this->session->userdata("user")['client_type'] == 'admin') {
                            if (@$usuario["need_justification"] !== true) {
                                $button = "<button type='button' id='requisitar_$idusuario' class='btn btn-primary center-block'><i class='fas fa-comments'></i></button>";
                            } else {
                                $button = "<button type='button' class='btn btn-danger center-block'> <i class='fas fa-ban'></i></button>";
                            }
                            $this->table->add_row(
                                ['data' => @$usuario["company_name"]],
                                ['data' => @$usuario["address"]],
                                ['data' => @$usuario["hour"]],
                                ['data' => @$usuario["day"]],
                                ['data' => $options],
                                ['data' => $button]

                            );
                        } else {
                            if (@$usuario["need_justification"] !== true) {
                                $button = "<button type='button' id='requisitar_$idusuario' class='btn btn-primary center-block'><i class='fas fa-comments'></i></button>";
                            } else {
                                $button = "<button type='button' class='btn btn-danger center-block'> <i class='fas fa-ban'></i></button>";
                            }
                            $this->table->add_row(
                                ['data' => @$usuario["company_name"]],
                                ['data' => @$usuario["address"]],
                                ['data' => @$usuario["hour"]],
                                ['data' => @$usuario["day"]],
                                ['data' => $options],
                                ['data' => $button]
                            );
                        }
                        ?>

                        <div id="modal" class="modal fade cancel" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Vincular colaborador</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label>Colaborador*</label>
                                                        <?php
                                                        echo form_dropdown(
                                                            'employee',
                                                            @$arraydp,
                                                            set_value('employee'),
                                                            'class="form-control employee"'
                                                        );

                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function () {

                                                var id = '<?php echo @$idusuario?>';
                                                $('#salvar_user_<?php echo @$idusuario ?>').bind('click', function () {
                                                    var id_employee = ($(".employee").val());
                                                    alert(id_employee);
                                                    $.post('<?php echo base_url()?>Agendas/justificativa/' + id, {id_employee: id_employee}, function (data) {
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
                                        <button type="button" id="salvar_user_<?php echo @$idusuario ?>"
                                                class="btn btn-success">Salvar
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var id = '<?php echo $idusuario?>';
                                $('#requisitar_<?php echo $idusuario?>').bind('click', function () {
                                    var value = true;
                                    $.post('<?php echo base_url()?>Agendas/justificativa/' + id, {value: value}, function (data) {
                                        $.ajax({
                                            statusCode: {
                                                200: function () {
                                                    alert('Justificativa requisitada!');
                                                    location.reload();
                                                }
                                            }
                                        });
                                    });
                                });

                            });
                        </script>

                        <?php
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



