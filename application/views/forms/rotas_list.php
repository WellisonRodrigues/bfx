<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 24/02/2018
 * Time: 13:39
 */
//echo '<pre>';
//print_r($rotas);
//print_r($clients);
//foreach ($clients['response'] as $client) {
//    $array['id'] = 'name';
//}
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><strong style="color: #1ab7ea"> LOCALS
                    </strong></h3>
                <p style="color: gray;"></p>

            </div>
            <div class="panel-body">
                <?php
                $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" style="width: 100%" id="tb_managers">']);
                if ($this->session->userdata("user")['client_type'] == 'admin') {
                    $this->table->set_heading(' local ', ' Endereço ', 'Numero ', ' Bairro', ' Alterar ');
//                    $this->table->set_heading(' local ', ' Endereço ', 'Numero ', ' Bairro', ' Alterar ');
                } else {
                    $this->table->set_heading(' local ', ' Endereço ', 'Numero ', ' Bairro', ' Alterar ');
//                    $this->table->set_heading(' local ', ' Endereço ', 'Numero ', ' Bairro', ' Alterar ');
                }
                if ($rotas) {
                    foreach (@$rotas as $usuario) {
                        $idusuario = $usuario['id'];
                        $url_edit = base_url() . 'Rotas/edit_rota/' . $idusuario;
                        $url_delete = base_url() . 'Rotas/delete_rota/' . $idusuario;
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
                                ['data' => @$usuario["number"]],
                                ['data' => @$usuario["neighborhood"]],
//                                ['data' => @$usuario["employees_count"]],
//                        ['data' => anchor("usuarios / editar / " . @$usuario["id"] . "", " < p class='fa fa-pencil' ></p > ", 'class = "btn btn - outline btn - primary btn - xs btn - block"'), 'align' => 'center'],
                                ['data' => $options]
                            );
                        } else {
                            $this->table->add_row(
                                ['data' => @$usuario["company_name"]],
                                ['data' => @$usuario["address"]],
                                ['data' => @$usuario["number"]],
                                ['data' => @$usuario["neighborhood"]],


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
    $(document).ready(function(){
        $('#tb_managers').dataTable().yadcf([
            {column_number : 0,filter_default_label: "Local"},
            {column_number : 1,filter_default_label: "Endereço"},
            {column_number : 2,filter_default_label: "Numero"},
            ]);
    });
</script>
