<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the report model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');


class Report extends AppModel
{

    public $useTable = 'ticket';

    public $primaryKey = 'ticket_number';

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

}