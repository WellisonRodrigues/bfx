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
        <h3 style="color:#1ab7ea;"><strong>CADASTRAR LOCAL
            </strong></h3>
    </div>
    <div class="panel-body">
        <?php
        echo form_open('Rotas/new_rota', ['role' => 'form']);
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
                                'value' => set_value('company_name'),
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
                <div class="col-lg-6">

                    <div class="form-group">
                        <label>Bairro*</label>
                        <?php
                        echo form_input(
                            [
                                'name' => 'neighborhood',
                                'type' => 'text',
                                'required' => 'required',
                                'class' => 'form-control',
                                'value' => set_value('neighborhood'),
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
                                'type' => 'date',
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
                                'type' => 'time',
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


