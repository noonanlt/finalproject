<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the ticket status model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');

/**
 * Ticketstatus Model
 *
 */
class Ticketstatus extends AppModel
{

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'ticketstatus';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'ticket_status_code';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'ticket_status_description';

}
