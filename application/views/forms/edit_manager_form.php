<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($manager['response']);
$id = @$manager['response']['id'];
if ($this->session->userdata('user')['client_type'] == 'admin') {
    if ($clients['response']['clients']) {
        foreach ($clients['response']['clients'] as $row) {
            $array[$row['id']] = $row['full_name'];
        }
    }
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>EDITAR GERENTE
            </strong></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo form_open("Managers/edit_manager/$id", ['role' => 'form']);
            ?>
            <div class="col-lg-12">
                <div class="message"></div>
                <div class="row">
                    <div class="col-lg-8">

                        <div class="form-group">
                            <label>Nome*</label>
                            <?php
                            echo form_input(
                                [
                                    'name' => 'name',
                                    'type' => 'text',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$manager['response']['name']),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-8">

                        <div class="form-group">
                            <label>Nome completo*</label>
                            <?php
                            echo form_input(
                                [
                                    'name' => 'full_name',
                                    'type' => 'text',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$manager['response']['full_name']),
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
                                    'id' => 'cpf',
                                    'type' => 'text',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$manager['response']['cpf']),
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
                                    'type' => 'text',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente', @$manager['response']['phone']),
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
                                    'value' => set_value('cliente', @$manager['response']['email']),
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
                                    'id' => 'pass',
                                    'type' => 'password',
//                                    'required' => 'required',
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
                                    'id' => 'pass_comfirm',
                                    'type' => 'password',
//                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente'),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->userdata('user')['client_type'] == 'admin') { ?>
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
            <button type="submit" name="submit" id="submit" value="salvar_alterar_usuario" class="btn btn-success">
                Salvar Alterações
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('[name=phone]').mask('(00) 00000-0000');
        $('#submit').click(function () {
            if ($('#pass').val() != $('#pass_comfirm').val()) {
                $('.message').addClass('alert alert-danger role="alert"').text('Senhas diferentes');
                $('input[name=pass').val('');
                $('input[name=pass_comfirm').val('');
                // Remove caracteres inválidos do valor
                return false
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        var $seuCampoCpf = $("#cpf");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>