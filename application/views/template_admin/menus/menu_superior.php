<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 13/03/2017
 * Time: 20:24
 */
//print_r($this->session->userdata('user')['nickname']);
if ($this->session->userdata('user')['client_type'] == 'admin') {
    $name = 'Master BFX';
} elseif ($this->session->userdata('user')['client_type'] == 'client') {
    $name = 'Master';
} elseif ($this->session->userdata('user')['client_type'] == 'managers') {
    $name = 'Gestor';
} else {
    $name = 'Funcionario';
}
if ($this->session->userdata('user')['nickname'] != '') {
    $name_user = $this->session->userdata('user')['nickname'];
} else {
    $name_user = 'Sem nick cadastrado';
}
?>
<div class="nav navbar-top-links navbar-right">

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9 menu-profile">
                <div style="font-size:1em;  margin-left: auto; margin-right: 25px">
                    <strong> <?php echo $name_user ?></strong><br/>
                    <?php echo $name ?>
                </div>
            </div>
            <div class="box">

            </div>
            <div class="box linha-vertical">
            </div>
            <div class="col-md-2 menu-confi">
                <div style="font-size:2em;  margin-left: 15px; margin-right: 60px">
                    <i class="fas fa-cog"></i>
                </div>
            </div>
        </div>
    </div>
</div>