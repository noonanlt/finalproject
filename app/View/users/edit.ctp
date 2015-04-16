<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The edit view where a logged in user can change their first and last name.

Last Revision: 02/17/2015

Dependencies: Controller.UsersController.php, Model.User.php

-->
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <h2><?php echo 'Edit User'; ?></h2>
    <fieldset>
        <div class="hidden">
            <?php
            echo $this->Form->input('user_number');
            echo $this->Form->input('user_email');
            ?>
        </div>
        <!--only allow users to edit first name and last name-->
        <?php
        echo $this->Form->input('user_first_name');
        echo $this->Form->input('user_last_name');
        ?>
        <div class="hidden">
            <?php
            echo $this->Form->input('authority_code');
            echo $this->Form->input('user_status');
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
