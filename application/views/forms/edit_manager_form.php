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
//if ($this->session->userdata('user')['client_type'] == 'admin') {
//    if ($clients['response']['clients']) {
//        foreach ($clients['response']['clients'] as $row) {
//            $array[$row['id']] = $row['full_name'];
//        }
//    }
//}
?>
<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($clients['response']['clients']);
//if ($this->session->userdata("user")['client_type'] == 'admin') {
//    if (isset($clients)) {
//        foreach ($clients['response']['clients'] as $client) {
//            $array[$client['id']] = $client['nome'];
//        }
//    }
//}
//
//company_name: nil,
// address: nil,
// number: nil,
// cep: nil,
// neighborhood: nil,
// complement: nil,
// city: nil,
// state: ni

//print_r($array);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>CADASTRAR AGENDA
            </strong></h3>
    </div>
    <div class="panel-body">
        <?php
        echo form_open('Agendas/new_agenda', ['role' => 'form']);
        ?>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8">

                    <div class="form-group">
                        <label>Nome do Local*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'company_name',
                                'type' => 'text',
                                'required' => 'required',
                                'class' => 'form-control',
                                'value' => set_value('name'),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label>N°*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'number',
                                'type' => 'number',
                                'required' => 'required',
                                'class' => 'form-control',
                                'value' => set_value('number'),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Estado*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'state',
                                'type' => 'text',
                                'required' => 'required',
                                'class' => 'form-control',
                                'value' => set_value('state '),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Cidade*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'city',
                                'type' => 'text',
                                'required' => 'required',
                                'class' => 'form-control',
                                'value' => set_value('city'),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Complemento*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'complement',
                                'type' => 'text',
                                'required' => 'required',
                                'class' => 'form-control',
                                'value' => set_value('complement'),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="form-group">
                        <label>Bairro*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'address',
                                'type' => 'text',
                                'required' => 'required',
                                'class' => 'form-control',
                                'value' => set_value('address'),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>data*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'day',
                                'type' => 'text',
//                                'required' => '',
                                'class' => 'form-control',
                                'value' => set_value('day'),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>hora*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'hour',
                                'type' => 'text',
//                                'required' => '',
                                'class' => 'form-control',
                                'value' => set_value('hour'),
                                'maxlength' => '70',
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div align="center">
            <button type="submit" name="submit" value="salvar_alterar_usuario"
                    class="btn btn-success"> Concluir Cadastro
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!---->
<!---->
<!---->
<!--<div class="panel panel-default">-->
<!--    <div class="panel-heading">-->
<!--        <h3 style="color:#1ab7ea;"><strong>EDITAR GERENTE-->
<!--            </strong></h3>-->
<!--    </div>-->
<!--    <div class="panel-body">-->
<!--        <div class="row">-->
<!--            --><?php
//            echo form_open("Managers/edit_manager/$id", ['role' => 'form']);
//            ?>
<!--            <div class="col-lg-12">-->
<!--                <div class="row">-->
<!--                    <div class="col-lg-8">-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label>Nome*</label>-->
<!--                            --><?php
//                            echo form_input(
//                                [
//                                    'name' => 'name',
//                                    'type' => 'text',
//                                    'required' => 'required',
//                                    'class' => 'form-control',
//                                    'value' => set_value('cliente', @$manager['response']['name']),
//                                    'maxlength' => '70',
//                                ]);
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-lg-8">-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label>Nome completo*</label>-->
<!--                            --><?php
//                            echo form_input(
//                                [
//                                    'name' => 'full_name',
//                                    'type' => 'text',
//                                    'required' => 'required',
//                                    'class' => 'form-control',
//                                    'value' => set_value('cliente', @$manager['response']['full_name']),
//                                    'maxlength' => '70',
//                                ]);
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-lg-4">-->
<!--                        <div class="form-group">-->
<!--                            <label>CPF:</label>-->
<!--                            --><?php
//                            echo form_input(
//                                [
//                                    'name' => 'cpf',
//                                    'type' => 'text',
//                                    'required' => 'required',
//                                    'class' => 'form-control',
//                                    'value' => set_value('cliente', @$manager['response']['cpf']),
//                                    'maxlength' => '70',
//                                ]);
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--                <div class="row">-->
<!--                    <div class="col-lg-4">-->
<!--                        <div class="form-group">-->
<!--                            <label>Telefone:</label>-->
<!--                            --><?php
//                            echo form_input(
//                                [
//                                    'name' => 'phone',
//                                    'type' => 'text',
//                                    'required' => 'required',
//                                    'class' => 'form-control',
//                                    'value' => set_value('cliente', @$manager['response']['phone']),
//                                    'maxlength' => '70',
//                                ]);
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-lg-4">-->
<!--                        <div class="form-group">-->
<!--                            <label>E-mail:</label>-->
<!--                            --><?php
//                            echo form_input(
//                                [
//                                    'name' => 'email',
//                                    'type' => 'email',
//                                    'required' => 'required',
//                                    'class' => 'form-control',
//                                    'value' => set_value('cliente', @$manager['response']['email']),
//                                    'maxlength' => '70',
//                                ]);
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="row">-->
<!--                    <div class="col-lg-4">-->
<!--                        <div class="form-group">-->
<!--                            <label>Senha provisória:</label>-->
<!--                            --><?php
//                            echo form_input(
//                                [
//                                    'name' => 'pass',
//                                    'type' => 'password',
//                                    'required' => '',
//                                    'class' => 'form-control',
//                                    'value' => set_value('cliente'),
//                                    'maxlength' => '70',
//                                ]);
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-lg-4">-->
<!--                        <div class="form-group">-->
<!--                            <label>Confirmar Senha provisória:</label>-->
<!--                            --><?php
//                            echo form_input(
//                                [
//                                    'name' => 'pass_comfirm',
//                                    'type' => 'password',
//                                    'required' => '',
//                                    'class' => 'form-control',
//                                    'value' => set_value('cliente'),
//                                    'maxlength' => '70',
//                                ]);
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php //if ($this->session->userdata('user')['client_type'] == 'admin') { ?>
<!--                    <div class="row">-->
<!--                        <div class="col-lg-8">-->
<!--                            <div class="form-group">-->
<!--                                <label>Cliente Master*</label>-->
<!--                                --><?php
//                                echo form_dropdown(
//                                    'client',
//                                    @$array,
//                                    set_value(''),
//                                    'class="form-control"'
//                                );
//
//                                ?>
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //} ?>
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="panel-footer">-->
<!--        <div align="center">-->
<!--            <button type="submit" name="submit" value="salvar_alterar_usuario" class="btn btn-success">-->
<!--                Salvar Alterações-->
<!--            </button>-->
<!--        </div>-->
<!--        --><?php //echo form_close(); ?>
<!--    </div>-->
<!--</div>-->

