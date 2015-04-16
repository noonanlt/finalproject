<div class="comments form">
    <h2><?php echo __('Add Comment'); ?></h2>
    <?php echo $this->Form->create('Comment'); ?>
    <fieldset>
        <?php
        echo $this->Form->input('comment_message', array('label' => 'Comment', 'type' => 'textarea'));

        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>