<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($clients['response']);
foreach ($clients['response'] as $client) {
    $array[$client['id']] = $client['name'];
}
//print_r($array);
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3><p class="fa fa-user"> Editar Usuario</p>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo form_open('Managers/new_manager', ['role' => 'form']);
            ?>
            <div class="col-lg-12">

                <div class="form-group">
                    <label>Nome completo:</label>
                    <?php
                    echo form_input(
                        [
                            'name' => 'name',
                            'type' => 'text',
                            'required' => 'required',
                            'class' => 'form-control',
                            'value' => set_value('cliente'),
                            'maxlength' => '70',
                        ]);
                    ?>
                </div>
                <div class="form-group">
                    <label>Telefone:</label>
                    <?php
                    echo form_input(
                        [
                            'name' => 'phone',
                            'type' => 'text',
                            'required' => 'required',
                            'class' => 'form-control',
                            'value' => set_value('cliente'),
                            'maxlength' => '70',
                        ]);
                    ?>
                </div>
                <div class="form-group">
                    <label>E-mail:</label>
                    <?php
                    echo form_input(
                        [
                            'name' => 'email',
                            'type' => 'email',
                            'required' => 'required',
                            'class' => 'form-control',
                            'value' => set_value('cliente'),
                            'maxlength' => '70',
                        ]);
                    ?>
                </div>
                <div class="form-group">
                    <label>CPF:</label>
                    <?php
                    echo form_input(
                        [
                            'name' => 'cpf',
                            'type' => 'text',
                            'required' => 'required',
                            'class' => 'form-control',
                            'value' => set_value('cliente'),
                            'maxlength' => '70',
                        ]);
                    ?>
                </div>
                <div class="form-group">
                    <label>Senha provisória:</label>
                    <?php
                    echo form_input(
                        [
                            'name' => 'pass',
                            'type' => 'password',
                            'required' => 'required',
                            'class' => 'form-control',
                            'value' => set_value('cliente'),
                            'maxlength' => '70',
                        ]);
                    ?>
                </div>
                <div class="form-group">
                    <label>Confirmar Senha provisória:</label>
                    <?php
                    echo form_input(
                        [
                            'name' => 'pass_comfirm',
                            'type' => 'password',
                            'required' => 'required',
                            'class' => 'form-control',
                            'value' => set_value('cliente'),
                            'maxlength' => '70',
                        ]);
                    ?>
                </div>
                <div class="form-group">
                    <label>Cliente Master:</label>
                    <?php
                    echo form_dropdown(
                        'client',
                        @$array,
                        set_value($array),
                        'class="form-control"'
                    );

                    ?>
                </div>
            </div>
            <div class="col-lg-12 " align="right">
                <button type="submit" name="submit" value="salvar_alterar_usuario" class="btn btn-primary btn-lg"><i
                            class="fa fa-save"></i> Concluir Cadastro
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

