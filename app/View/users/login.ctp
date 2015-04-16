<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The login view.

Last Revision: 02/17/2015

Dependencies: Controller.UsersController.php, Model.User.php

-->
<div class="users form">
    <!--create session-->
    <?php echo $this->Session->flash('Auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <h2><?php echo __('Login'); ?></h2>
    <fieldset>
        <!--login form-->
        <?php
        echo $this->Form->input('username',array('label'=>'Email Address'));
        echo $this->Form->input('password');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
</div>