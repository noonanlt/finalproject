<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The index view for all tickets (admin use only).

Last Revision: 02/17/2015

Dependencies: Controller.TicketsController.php, Model.Ticket.php

-->
<div class="tickets index">
    <h2><?php echo __('All Tickets'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <!--table headings-->
        <tr>
            <th><?php echo $this->Paginator->sort('ticket_priority_code'); ?></th>
            <th><?php echo $this->Paginator->sort('ticket_number'); ?></th>
            <th><?php echo $this->Paginator->sort('department_id'); ?></th>
            <th><?php echo $this->Paginator->sort('category_id'); ?></th>
            <th><?php echo $this->Paginator->sort('ticket_open_date_time'); ?></th>
            <th><?php echo $this->Paginator->sort('ticket_close_date_time'); ?></th>
            <th><?php echo $this->Paginator->sort('ticket_room'); ?></th>
            <th><?php echo $this->Paginator->sort('user_number'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tickets as $ticket): ?>
            <tr>
                <!--Glyphicon representing priority and status-->
                <td><?php if ($ticket['Ticket']['ticket_status_code'] == 0) echo " <span class='glyphicon glyphicon-ok'></span>";
                    else if ($ticket['Ticket']['ticket_priority_code'] == 1) echo " <span class='glyphicon glyphicon-flag'></span>";
                    else echo " <span class='glyphicon glyphicon-question-sign'></span>" ?>&nbsp;</td>
                <td><?php echo h($ticket['Ticket']['ticket_number']); ?>&nbsp;</td>
                <td>
                    <?php echo h($ticket['Department']['department_description']); ?>
                </td>
                <td>
                    <?php echo h($ticket['Category']['category_description']); ?>
                </td>
                <td><?php echo h($ticket['Ticket']['ticket_open_date_time']); ?>&nbsp;</td>
                <td><?php echo h($ticket['Ticket']['ticket_close_date_time']); ?>&nbsp;</td>
                <td><?php echo h($ticket['Ticket']['ticket_room']); ?>&nbsp;</td>
                <td>
                    <?php echo $ticket['User']['user_first_name'] . " " . $ticket['User']['user_last_name']; ?>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $ticket['Ticket']['ticket_number']));
                    if ($userAuth == 1) echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ticket['Ticket']['ticket_number']), array(), __('Are you sure you want to delete # %s?', $ticket['Ticket']['ticket_number'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <!--Paginator component-->
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>    </p>

    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>