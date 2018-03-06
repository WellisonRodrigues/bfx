<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//echo '<pre>';
//print_r($agendas);
//print_r($clients);
//foreach ($clients['response'] as $client) {
//    $array['id'] = 'name';
//}
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
                    $this->table->set_heading(' Nome ', ' Departamento ', ' Cliente Master ', ' N° Colaboradores ', ' Telefone', 'CPF', ' Alterar ');
                } else {
                    $this->table->set_heading(' Nome da empresa ', ' Endereço ', 'Hora ', ' Dia', ' Alterar ');
                }
                if ($agendas) {
                    foreach (@$agendas as $usuario) {
                        $idusuario = $usuario['id'];
                        $url_edit = base_url() . 'Agendas/edit_agenda/' . $idusuario;
                        $url_delete = base_url() . 'Agendas/delete_agenda/' . $idusuario;
                        $options = "<div class='dropdown'><i class='fas fa-wrench center-block' id='$idusuario' style='color: gray' data-toggle='dropdown'></i><ul class='dropdown-menu'>
    <li><a href='$url_edit' class='center-block' style='color: gray'> <i class='fas fa-pencil-alt'> </i>&nbsp;&nbsp; Editar dados</a></li>
    <hr style='margin-top: 5px;margin-bottom: 5px'> 
    <li class='delete'><a href='$url_delete' class='center-block' style='color: gray'><i class='fas fa-trash'> </i>&nbsp;&nbsp; Excluir</a></li>
  </ul></div>";
                        $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                        $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                        if ($this->session->userdata("user")['client_type'] == 'admin') {
                            $this->table->add_row(
                                ['data' => @$usuario["company_name"]],
                                ['data' => @$usuario["address"]],
                                ['data' => @$usuario["hour"]],
                                ['data' => @$usuario["day"]],

//                                ['data' => @$usuario["employees_count"]],
//                        ['data' => anchor("usuarios / editar / " . @$usuario["id"] . "", " < p class='fa fa-pencil' ></p > ", 'class = "btn btn - outline btn - primary btn - xs btn - block"'), 'align' => 'center'],
                                ['data' => $options]
                            );
                        } else {
                            $this->table->add_row(
                                ['data' => @$usuario["company_name"]],
                                ['data' => @$usuario["address"]],
                                ['data' => @$usuario["hour"]],
                                ['data' => @$usuario["day"]],

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
