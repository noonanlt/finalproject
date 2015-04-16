<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the user authority model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');

/**
 * Authority Model
 *
 * @property UserAuthority $userAuthority
 */
class Authority extends AppModel
{

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'authority';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'authority_code';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'authority_description';


}
