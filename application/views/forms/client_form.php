<?php
/**
 * Created by PhpStorm.
 * User: Wellison
 * Date: 03/10/2017
 * Time: 21:01
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 style="color:#1ab7ea;"><strong>CADASTRAR CLIENTE MASTER
            </strong></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php
            echo form_open('Clients/new_client', ['role' => 'form']);
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
                                    'value' => set_value('cliente'),
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
                                    'name' => 'razao',
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
                            <label>CNPJ:</label>
                            <?php
                            echo form_input(
                                [
                                    'name' => 'cnpj',
                                    'type' => 'text',
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
                                    'value' => set_value('cliente'),
                                    'maxlength' => '70',
                                ]);
                            ?>
                        </div>
                    </div>
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
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div align="center">
            <button type="submit" name="submit" value="salvar_alterar_usuario" class="btn btn-success">
                Concluir Cadastro
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

