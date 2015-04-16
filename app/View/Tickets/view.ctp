<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The view for an individual, specified ticket. Shows ticket details and associated comments.

Last Revision: 02/17/2015

Dependencies: Controller.TicketsController.php, Model.Ticket.php, Controller.CommentsController.php, Model.Comment.php

-->
<div class="tickets view">
    <!--heading and glyphicon representing priority and status-->
    <h2><?php echo __('Ticket # ' . h($ticket['Ticket']['ticket_number']) . ': ' . h($ticket['Category']['category_description']));
        if ($ticket['Ticket']['ticket_status_code'] == 0) echo " &nbsp <span class='glyphicon glyphicon-ok'></span> <small>Resolved</small>";
        else if ($ticket['Ticket']['ticket_priority_code'] == 1) echo " &nbsp <span class='glyphicon glyphicon-flag'></span> <small>Priority Issue</small>";
        else echo " &nbsp<span class='glyphicon glyphicon-question-sign'></span> <small>Unresolved</small>"; ?></h2>
    <!-- hyperlink to mark as resolved -->
    <?php
    if ($ticket['Ticket']['ticket_status_code'] == 1) if ($ticket['Ticket']['department_id'] == $this->Session->read('department') || $ticket['User']['user_number'] == $userId || $userAuth == 1) {
        echo "&nbsp <span class='glyphicon glyphicon-ok'></span><a class='resolve' href='../resolve/" . $ticket['Ticket']['ticket_number'] . "'>Mark as resolved</a>";
    } ?>

    <div id="ticket-details">
        <!-- Department -->
        <div class="col-md-2 heading">Department:</div>
        <div class="col-md-4"><?php echo h($ticket['Department']['department_description']); ?></div>
        <br>
        <!-- Ticket Status -->
        <div class="col-md-2 heading">Status:</div>
        <div class="col-md-4"><?php echo h($ticket['TicketStatus']['ticket_status_description']); ?></div>
        <br>
        <!-- Priority Level -->
        <div class="col-md-2 heading">Priority:</div>
        <div
            class="col-md-4"><?php if ($ticket['Ticket']['ticket_priority_code'] == 0) echo "No"; else if ($ticket['Ticket']['ticket_priority_code'] == 1) echo "Yes"; ?></div>
        <br>
        <!-- Room -->
        <div class="col-md-2 heading">Room Number:</div>
        <div class="col-md-4"><?php echo h($ticket['Ticket']['ticket_room']); ?></div>
        <br>
        <!-- Created at -->
        <div class="col-md-2 heading">Submitted:</div>
        <div class="col-md-4"><?php echo h($ticket['Ticket']['ticket_open_date_time']); ?></div>
        <br>
        <?php if ($ticket['Ticket']['ticket_status_code'] == 0) { ?>
            <!-- Closed at -->
            <div class="col-md-2 heading">Closed:</div>
            <div class="col-md-4"><?php echo h($ticket['Ticket']['ticket_close_date_time']); ?></div>
            <br>
        <?php } ?>
        <!-- Ticket user -->
        <div class="col-md-2 heading">Submitted by:</div>
        <?php if (empty($ticket['User']['user_first_name'])) echo "<div class='col-md-4'>(Deleted User)</div>"; else { ?>
            <div
                class="col-md-4"><?php echo $ticket['User']['user_first_name'] . " " . $ticket['User']['user_last_name']; ?></div><?php } ?>
        <br>
        <hr>
        <!-- Ticket Message -->
        <div class="col-md-2 heading">Issue Description:</div>
        <br>

        <div class="col-md-10"><?php echo h($ticket['Ticket']['ticket_message']); ?></div>
        <br>
        <hr>
        <!-- Comments Pane -->
        <div class="related">
            <h3><?php echo __('Comments'); ?></h3>

            <?php if (empty($comment)) {
                echo "<div class='col-md-9'><p>There are no comments at this time.</p></div>";
            } else { ?>
                <hr>
                <?php foreach ($comment as $aComment): ?>
                    <div class="col-md-9">
                        <div class="col-md-8 comment-info-line">
                            <!--display user name in a different color dependent on authority code-->
                            <?php
                            if ($aComment['User']['authority_code'] == 2) $rowClass = "red-text";
                            else if ($aComment['User']['authority_code'] == 3) $rowClass = "green-text";
                            else if ($aComment['User']['authority_code'] == 1) $rowClass = "blue-text";
                            else if (empty($aComment['User']['authority_code'])) $rowClass = "";
                            ?>
                            <span class="<?php echo $rowClass; ?>">
                <?php
                if (empty($aComment['User']['user_first_name'])) echo "(Deleted User)";
                echo $aComment['User']['user_first_name'] . " " . $aComment['User']['user_last_name']; ?></span>
                            <small>
                                at <?php echo $aComment['Comment']['comment_datetime']; ?>
                            </small>
                        </div>
                        <br>

                        <p><?php echo '"' . $aComment['Comment']['comment_message'] . '"'; ?></p>
                        <hr>
                    </div>

                <?php
                endforeach;
            }

            //allow users to add comment if they are linked to the ticket (through user num or department) or an admin
            if ($ticket['Ticket']['ticket_status_code'] == 1) if ($ticket['Ticket']['department_id'] == $this->Session->read('department') || $ticket['User']['user_number'] == $userId || $userAuth == 1) {
                ?>
                <div class="col-md-9">
                    <?php echo $this->Html->link(__('Add Comment'), array('controller' => 'comments', 'action' => 'addToTicket', $ticket['Ticket']['ticket_number'])); ?>
                </div>
            <?php }
            if ($ticket['Ticket']['ticket_status_code'] == 0) { ?>
                <div class="col-md-9">
                    <!--If closed, hide add comment link-->
                    <?php echo "<p>This ticket has been closed. No further comments may be added.</p>"; ?>
                </div>

            <?php } ?>


        </div>
