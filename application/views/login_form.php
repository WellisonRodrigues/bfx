<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div align="center">
                <!--                <img src="-->
                <?php //echo base_url(IMAGES); ?><!--/logos/logo.png" width="220px" height="100px">-->
            </div>
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title" align="center"><strong style="color: #1ab7ea">LOGIN</strong></h2>
                </div>
                <div class="panel-body">
                    <?php
                    echo form_open('login/entrar', ['role' => 'form']);
                    ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="sel1">Perfil de Acesso:</label>
                            <select class="form-control" id="sel1" name="type_login"
                                    onchange="yesnoCheck(this);">
                                <option id="companies" value="admin">Administrador</option>
                                <option id="companies" value="clients">Cliente</option>
                                <option id="companies" value="managers">Gerente</option>
                                <option id="users" value="employees">Funcionário</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" placeholder="E-mail" type="email" name="email" autofocus
                                   value="ingressoscaldas@gmail.com"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input class="form-control" placeholder="Senha" name="password" type="password"
                                   value="icnTDC"
                                   required>
                        </div>
                        <!--                        <div class="checkbox">-->
                        <!--                            <label>-->
                        <!--                                <input name="remember" type="checkbox" value="Remember Me">Lembrar de mim-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <!-- Change this to a button or input when using this as a form -->
                        <div class="text-center">
                            <input type="submit" class="btn btn-success" name="login"
                                   value=" ENTRAR "></div>
                    </fieldset>
                    <br>
                    <!--                    --><?php //echo anchor('login/cadastrar',' Cadastrar') ?>
                    <?php
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>