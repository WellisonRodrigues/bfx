<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
//print_r($dados);

$dados = $dados['response'];
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="message"></div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>MEUS DADOS
            </strong></h3>
    </div>
    <?php if ($this->session->userdata("user")['client_type'] == 'clients') { ?>
        <div class="panel-body">
            <div class="row">
                <?php
                echo form_open('Myprofile/update_user', ['role' => 'form']);
                ?>
                <div class="col-lg-12">
                    <div class="row">
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
                                        'value' => set_value('full_name',@$dados['full_name']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Razão social*</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'razao_social',
                                        'type' => 'text',
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value('razao_social',@$dados['razao_social']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>CNPJ:</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'cnpj',
                                        'id' => 'cnpj',
                                        'type' => 'text',
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value('cnpj',@$dados['cnpj']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                        'value' => set_value('email',@$dados['email']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Senha:</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'pass',
                                        'id' => 'pass',
                                        'type' => 'password',
//                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value(''),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Confirmar Senha:</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'pass_comfirm',
                                        'id' => 'pass_comfirm',
                                        'type' => 'password',
//                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value(''),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    if ($this->session->userdata("user")['client_type'] == 'managers') {
        ?>
        <div class="panel-body">
            <div class="row">
                <?php
                echo form_open('Myprofile/update_user', ['role' => 'form']);
                ?>
                <div class="col-lg-12">
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
                                        'value' => set_value('name',@$dados['name']),
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
                                        'value' => set_value('name', @$dados['full_name']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>CPF*</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'cpf',
                                        'id' => 'cpf',
                                        'type' => 'text',
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value('cpf',@$dados['cpf']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Telefone*</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'phone',
                                        'type' => 'text',
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value('phone',@$dados['phone']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>E-mail*</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'email',
                                        'type' => 'email',
                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value('email',@$dados['email']),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Senha provisória*</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'pass',
                                        'id' => 'pass',
                                        'type' => 'password',
//                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value('cliente'),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Confirmar Senha provisória*</label>
                                <?php
                                echo form_input(
                                    [
                                        'name' => 'pass_comfirm',
                                        'id' => 'pass_comfirm',
                                        'type' => 'password',
//                                        'required' => 'required',
                                        'class' => 'form-control',
                                        'value' => set_value('cliente'),
                                        'maxlength' => '70',
                                    ]);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <div class="panel-footer">
        <div align="center">
            <button type="submit" name="submit" id="submit" value="salvar_alterar_usuario" class="btn btn-success">
                Concluir Cadastro
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('[name=phone]').mask('(00) 00000-0000');
        $("#cnpj").mask("99.999.999/9999-99");
        $('#submit').click(function () {
            var pass = $('#pass').val();
            var passcomfirm = $('#pass_comfirm').val();
            if (pass != passcomfirm) {
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