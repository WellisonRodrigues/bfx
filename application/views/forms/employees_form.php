<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
//print_r($departaments);
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($clients['response']);
if ($this->session->userdata('user')['client_type'] == 'admin'
) {
    if ($clients) {
        foreach ($clients['response']['clients'] as $client) {
            $array[$client['id']] = $client['nome'];
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
    $disabled = array('readyonly' => 'readyonly', 'class' => 'form-control');
}
//print_r($array);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>CADASTRAR COLABORADOR
            </strong></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo form_open('Employees/new_employeer', ['role' => 'form']);
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
                                    'value' => set_value('cliente'),
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
                                    'value' => set_value('cliente'),
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
                                    'type' => 'text',
                                    'id' => 'cpf',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente'),
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
                                    'value' => set_value('cliente'),
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
                                    'value' => set_value('cliente'),
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
                                    'required' => 'required',
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
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'value' => set_value('cliente'),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($this->session->userdata('user')['client_type'] != 'managers'
                    ) {
                        ?>
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
                        <?php if ($this->session->userdata('user')['client_type'] == 'admin'

                        ) { ?>
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
                        <?php } ?>
                    <?php } ?>

                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label>Departamento*</label>
                            <?php
                            echo form_dropdown(
                                'departament',
                                @$arraydp,
                                set_value('departament'), $disabled

                            );

                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 " align="center">
                    <button type="submit" name="submit" id="submit" value="salvar_alterar_usuario"
                            class="btn btn-success"> Concluir Cadastro
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