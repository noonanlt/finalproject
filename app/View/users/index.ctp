<!-- Project Title: Work Order Management System

Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

Date:  02/17/2015

Purpose: The index view of all users (admin use only).

Last Revision: 02/17/2015

Dependencies: Controller.UsersController.php, Model.User.php

-->
<div class="users index">
    <h2><?php echo __('Manage Users'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <!--table headings -->
            <th><?php echo $this->Paginator->sort('user_number'); ?></th>
            <th><?php echo $this->Paginator->sort('user_email'); ?></th>
            <!-- <th><?php echo $this->Paginator->sort('user_password'); ?></th> -->
            <th><?php echo $this->Paginator->sort('user_last_name'); ?></th>
            <th><?php echo $this->Paginator->sort('user_first_name'); ?></th>
            <th><?php echo $this->Paginator->sort('authority_code'); ?></th>
            <th><?php echo $this->Paginator->sort('user_status'); ?></th>
            <th class="actions"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['user_number']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['user_email']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['user_last_name']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['user_first_name']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['authority_code']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['user_status']); ?>&nbsp;</td>
                <td class="actions">
                    <!--admin actions-->
                    <?php if ($user['User']['user_number']!=$userId){ ?>
                    <?php echo $this->Html->link(__('Elevate'), array('action' => 'elevate', $user['User']['user_number'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['user_number']), array(), __('Are you sure you want to delete # %s?', $user['User']['user_number'])); ?>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <!--paginator component-->
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
