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
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3><p class="fa fa-user"> CLIENTES MASTERS</p>
                </h3>
            </div>
            <div class="panel-body">
                <?php
                $this->table->set_template(['table_open' => '<table class="table table-striped table-bordered table-hover" id="tb_usuarios">']);
                $this->table->set_heading(' Nome ', ' Razão Social ', ' CNPJ ', ' E-mail ', ' N° Departamentos', 'N° Colaboradores', ' Alterar ');
                foreach (@$clients as $usuario) {
                    $created_at = date('d/m/Y H:i:s', strtotime(@$usuario["created_at"]));
                    $updated_at = date('d/m/Y H:i:s', strtotime(@$usuario["updated_at"]));
                    $this->table->add_row(
                        ['data' => @$usuario["name"]],
                        ['data' => @$usuario["razao_social"]],
                        ['data' => @$usuario["cnpj"]],
                        ['data' => @$usuario["email"]],
                        ['data' => $created_at],
                        ['data' => $updated_at],
//                        ['data' => anchor("usuarios/editar/" . @$usuario["id"] . "", "<p class='fa fa-pencil'></p>", 'class = "btn btn-outline btn-primary btn-xs btn-block"'), 'align' => 'center'],
                        ['data' => anchor("usuarios/excluir/" . @$usuario["id"] . "", "<p class='fas fa-wrench'></p>", array('class' => "btn btn-outline btn-primary btn-xs btn-block", 'onclick' => "return confirm('Deseja realmente excluir ?')", 'align' => 'center'))]
                    );
                }
                echo $this->table->generate();
                ?>
            </div>
        </div>
    </div>
</div>
