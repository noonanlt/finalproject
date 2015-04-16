<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the department model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');

/**
 * Department Model
 *
 */
class Department extends AppModel
{

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'department';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'department_id';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'department_description';

}
