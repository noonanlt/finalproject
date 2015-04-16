<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Controller for the report model.

     Last Revision: 02/17/2015

     Dependencies: Model.Report.php, AppController.php

 */
App::uses('AppController', 'Controller');

/**
 * Reports Controller
 *
 * This class handles generation of reports.
 *
 */
class ReportsController extends AppController
{

    public $components = array('Paginator', 'Session');

    public function index()
    {
        $this->Report->recursive = 0;
        //final all tickets and pass to view
        $this->set('tickets', $this->Paginator->paginate());
    }
}