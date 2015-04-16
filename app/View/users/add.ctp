<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The new user registration form view.

Last Revision: 02/17/2015

Dependencies: Controller.UsersController.php, Model.User.php

-->
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <h2><?php echo __('Register'); ?></h2>
    <!--Registration form-->
    <fieldset>
        <?php
        echo $this->Form->input('user_email', array('label' => 'Email Address'));
        echo $this->Form->input('user_password', array('label' => 'Password', 'maxLength' => 20, 'title' => 'Password', 'type' => 'password'));
        echo $this->Form->input('password_confirm', array('label' => 'Confirm Password', 'maxLength' => 20, 'title' => 'Confirm password', 'type' => 'password'));
        echo $this->Form->input('user_first_name', array('label' => 'First Name'));
        echo $this->Form->input('user_last_name', array('label' => 'Last Name'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>