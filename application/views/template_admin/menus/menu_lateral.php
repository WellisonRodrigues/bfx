<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 13/03/2017
 * Time: 20:26
 */ ?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <?php echo anchor('usuarios', '<b style="color: #42A5F5"><i class="fas fa-list-ul"></i>&nbsp&nbspVER LISTA </b>'); ?>
                <ul class="nav nav-second-level">
                    <?php if ($this->session->userdata("user")['client_type'] == 'admin') { ?>
                        <li>
                            <?php echo anchor('Clients/index', ' Clientes Masters '); ?>
                        </li>
                    <?php }
                    if ($this->session->userdata('user')['client_type'] == 'admin' or
                        $this->session->userdata('user')['client_type'] == 'clients'
                    ) {
                        ?>
                        <li>
                            <?php echo anchor('Managers/index', ' Gestores '); ?>
                        </li>
                    <?php } ?>
                    <li>
                        <?php echo anchor('Employees/index', ' Colaboradores'); ?>
                    </li>
                    <li>
                        <?php echo anchor('Department/index', ' Departamentos'); ?>
                    </li>

                </ul>
            </li>

            <li>
                <?php echo anchor('tickets', '<b style="color: #42A5F5"><i class="fas fa-user-plus"></i> CADASTRAR </b>'); ?>
                <ul class="nav nav-second-level">
                    <?php if ($this->session->userdata("user")['client_type'] == 'admin') { ?>
                        <li>
                            <?php echo anchor('Clients/new_client', ' Clientes Masters '); ?>
                        </li>
                    <?php }
                    if ($this->session->userdata('user')['client_type'] == 'admin' or
                        $this->session->userdata('user')['client_type'] == 'clients'
                    ) {
                        ?>
                        <li>
                            <?php echo anchor('Managers/new_manager', ' Gestores '); ?>
                        </li>
                    <?php } ?>
                    <li>
                        <?php echo anchor('Employees/new_employeer', ' Colaboradores'); ?>
                    </li>

                    <li>
                        <?php echo anchor('Department/new_department', ' Departamentos'); ?>
                    </li>

                </ul>
            </li>
            <li>
                <?php echo anchor('Relatorios/index', '<b style="color: #42A5F5"><i class="fas fa-file-alt"> </i>&nbsp&nbsp RELATÓRIOS </b>'); ?>

            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>