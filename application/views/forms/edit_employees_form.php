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
if ($this->session->userdata('user')['client_type'] != 'managers') {
    if ($departaments) {
        foreach ($departaments['departaments'] as $manage) {
            $arraydp[$manage['id']] = $manage['name'];
        }

    }
    $disabled = array('' => '', 'class' => 'form-control');
} else {

    if (isset($departaments)) {

        $arraydp[$departaments['departament']['id']] = $departaments['departament']['name'];
    }

    $disabled = array('disabled' => 'disabled', 'class' => 'form-control');
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
            echo form_open("Employees/edit_employee/$id", ['role' => 'form']);
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
                                    'value' => set_value('cliente', @$employee['response']['name']),
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
                                    'id' => 'cpf',
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
                                    'id' => 'phone',
                                    'type' => 'text',
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
                                    'id' => 'pass',
                                    'type' => 'password',
                                    'class' => 'form-control',
                                    'value' => set_value(''),
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
                                    'class' => 'form-control',
                                    'value' => set_value(''),
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

                    <!--                    <div class="row">-->
                    <!--                        <div class="col-lg-8">-->
                    <!--                            <div class="form-group">-->
                    <!--                                <label>Gestor*</label>-->
                    <!--                                --><?php
//                                echo form_dropdown(
//                                    'manager',
//                                    @$arraymanager,
//                                    set_value(''),
//                                    'class="form-control"'
//                                );
//
//                                ?>
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Departamento*</label>
                            <?php
                            echo form_dropdown(
                                'departament',
                                @$arraydp,
                                set_value(''),
                                $disabled
                            );

                            ?>
                        </div>
                    </div>
                </div>
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