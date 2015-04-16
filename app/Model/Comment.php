<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the comment model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');

/**
 * Comment Model
 *
 * @property Comment $Comment
 */
class Comment extends AppModel
{

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'comment';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'comment_id';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'comment_message' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 250),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Ticket' => array(
            'className' => 'Ticket',
            'foreignKey' => 'ticket_number',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_number',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
