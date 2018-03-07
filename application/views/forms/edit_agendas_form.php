<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($manager['response']);
$id = @$agendas['response']['id'];
//if ($this->session->userdata('user')['client_type'] == 'admin') {
//    if ($clients['response']['clients']) {
//        foreach ($clients['response']['clients'] as $row) {
//            $array[$row['id']] = $row['full_name'];
//        }
//    }
//}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>EDITAR AGENDA
            </strong></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo form_open("Agendas/edit_agenda/$id", ['role' => 'form']);
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
                                    'value' => set_value('company_name',@$agendas['response']['company_name']),
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
                                    'value' => set_value('number',@$agendas['response']['number']),
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
                                    'value' => set_value('state',@$agendas['response']['state']),
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
                                    'value' => set_value('city',@$agendas['response']['city']),
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
                                    'value' => set_value('address',@$agendas['response']['address']),
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
                                    'value' => set_value('neighborhood',@$agendas['response']['neighborhood']),
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
                                    'value' => set_value('day',@$agendas['response']['day']),
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
                                    'value' => set_value('hour',@$agendas['response']['hour']),
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
            <button type="submit" name="submit" value="salvar_alterar_usuario" class="btn btn-success">
                Salvar Alterações
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

