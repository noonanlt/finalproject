<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The form for elevating a user and assigning support staff to a department.

Last Revision: 02/17/2015

Dependencies: Controller.UsersController.php, Model.User.php

-->
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Elevate User'); ?></legend>
        <!--hidden fields, not to be modified-->
        <div style="display:none">
            <?php
            echo $this->Form->input('user_number');
            echo $this->Form->input('user_email');

            echo $this->Form->input('user_last_name');
            echo $this->Form->input('user_first_name');
            ?>
        </div>
        <!--div for selecting authority-->
        <div id="authoritySelectDiv">
            <label for="UserAuthorityCode">Select User Type</label>
            <select id="authoritySelect" name="data[User][authority_code]" onchange="showDepartments()">
                <option value="3">Regular User</option>
                <option value="2">Support Staff</option>
                <option value="1">Administrator</option>
            </select>
        </div>
        <!--div for selecting department, initially hidden-->
        <div id="departmentSelect" style="display:none;">
            <label for="UserDepartmentId">Select Department*</label>
            <select name="data[User][department_id]">
                <option value="1">Computer Services</option>
                <option value="2">Facilities</option>
                <option value="3">Student Services</option>
            </select>
        </div>
        <div id="user-active">
            <?php
            echo $this->Form->input('user_status', array('label' => '<strong>Active User?</strong>'));
            ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript">
    /**
     * showDepartments()
     *
     * When user sets authority to support staff, this function will reveal
     * the department selector. It also hides it otherwise.
     */
    function showDepartments() {
        var element = document.getElementById("authoritySelect");
        //if support staff, show selector
        if (element.value == 2) document.getElementById("departmentSelect").style.display = "block";
        //else hide the selector
        else document.getElementById("departmentSelect").style.display = "none";
    }
</script>
