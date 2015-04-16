<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The new ticket creation form view.

Last Revision: 02/17/2015

Dependencies: Controller.TicketsController.php, Model.Ticket.php

-->
<div class="tickets form">
    <h2><?php echo __('Submit Ticket'); ?></h2>
    <!--the ticket form-->
    <?php echo $this->Form->create('Ticket'); ?>
    <fieldset>
        <label for="TicketDepartmentId">Select Department</label>
        <select id="departmentSelect" name="data[Ticket][department_id]" onchange="setCategories()">
            <option value="1">Computer Services</option>
            <option value="2">Facilities</option>
            <option value="3">Student Services</option>
        </select>
        <?php
        echo $this->Form->input('category_id');
        echo $this->Form->input('ticket_room');
        echo $this->Form->input('ticket_message', array('type' => 'textarea')); ?>
        <div id="mark-priority">
            <?php
            echo $this->Form->input('ticket_priority_code', array('label' => "<span class='glyphicon glyphicon-flag'></span> Mark as priority?", 'type' => 'checkbox'));
            ?>    </div>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

