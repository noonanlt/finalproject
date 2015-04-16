<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the ticket model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');

/**
 * Ticket Model
 *
 * @property Category $Category
 * @property Department $ticketDepartment
 * @property User $ticketUser
 */
class Ticket extends AppModel
{
    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'ticket';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'ticket_number';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Department' => array(
            'className' => 'Department',
            'foreignKey' => 'department_id',
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
        ),
        'TicketStatus' => array(
            'className' => 'TicketStatus',
            'foreignKey' => 'ticket_status_code',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'ticket_number'
        )
    );
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'ticket_room' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 20),
            ),
        ),
        'ticket_message' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 255),
            ),
        ),
    );


}
