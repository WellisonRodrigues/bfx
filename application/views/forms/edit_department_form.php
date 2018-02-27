<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($departments['response']);
$id = @$departments['response']['id'];

//
if ($this->session->userdata('user')['client_type'] != 'managers') {
    foreach ($managers as $row) {
        $array[$row['id']] = $row['name'];
    }
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>EDITAR DEPARTAMENTO
            </strong></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo form_open("Department/edit_department/$id", ['role' => 'form']);
            ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="form-group">
                            <label>Nome completo*</label>
                            <?php
                            echo form_input(
                                [
                                    'name' => 'name',
                                    'type' => 'text',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$departments['response']['name']),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->userdata('user')['client_type'] != 'managers') { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Gestor*</label>
                                <?php
                                echo form_dropdown(
                                    'manager',
                                    @$array,
                                    set_value(''),
                                    'class="form-control"'
                                );

                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div align="center">
            <button type="submit" name="submit" value="salvar_alterar_usuario" class="btn btn-success">
                Salvar Alterações
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

