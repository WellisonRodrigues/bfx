<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($employee);
$id = @$employee['response']['id'];
if ($this->session->userdata('user')['client_type'] == 'admin') {
    if ($clients['response']['clients']) {
        foreach ($clients['response']['clients'] as $row) {
            $array[$row['id']] = $row['nome'];
        }
    }
}
if ($this->session->userdata('user')['client_type'] == 'admin' or $this->session->userdata('user')['client_type'] == 'clients') {
    if ($manager) {
        foreach ($manager['managers'] as $manage) {
            $arraymanager[$manage['id']] = $manage['name'];
        }
    }
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>EDITAR FUNCIONARIO
            </strong></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo form_open("Managers/edit_manager/$id", ['role' => 'form']);
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
                                    'value' => set_value('cliente', @$employee['response']['name']),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>CPF:</label>
                            <?php
                            echo form_input(
                                [
                                    'name' => 'cpf',
                                    'type' => 'text',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$employee['response']['cpf']),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Telefone:</label>
                            <?php
                            echo form_input(
                                [
                                    'name' => 'phone',
                                    'type' => 'email',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$employee['response']['phone']),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>E-mail:</label>
                            <?php
                            echo form_input(
                                [
                                    'name' => 'email',
                                    'type' => 'email',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$employee['response']['email']),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
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
                    </div>
                    <div class="col-lg-4">
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
                    </div>
                </div>
                <?php
                if ($this->session->userdata('user')['client_type'] != 'managers'
                ) {
                    ?>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Gestor*</label>
                                <?php
                                echo form_dropdown(
                                    'manager',
                                    @$arraymanager,
                                    set_value(''),
                                    'class="form-control"'
                                );

                                ?>
                            </div>
                        </div>
                    </div>
                <?php }
                if ($this->session->userdata('user')['client_type'] == 'admin') { ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Cliente Master*</label>
                                <?php
                                echo form_dropdown(
                                    'client',
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

