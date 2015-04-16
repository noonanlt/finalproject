<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the category model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');

/**
 * Category Model
 *
 */
class Category extends AppModel
{

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'category';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'category_id';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'category_description';

}
