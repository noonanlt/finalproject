<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Controller for the user model.

     Last Revision: 02/17/2015

     Dependencies: Model.User.php, AppController.php

 */
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController
{
    /**
     * beforeFilter method
     *
     * actions to be taken every time the controller is accessed
     */
    function beforeFilter()
    {
        parent::beforeFilter();
        //allow unlogged in users to register
        $this->Auth->allow('add', 'logout');
    }

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        //if user is an admin
        if ($this->getUserAuthority(1)) {
            $this->User->recursive = 0;
            $this->set('users', $this->Paginator->paginate());
            //if not admin, return to myTickets
        } else return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            //create the user object
            $this->User->create();
            //save the post data from the form
            if ($this->User->save($this->request->data)) {
                //show success message after registering
                $this->Session->setFlash(__('Thank you for registering.'), 'default', array('class' => 'message success'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            } else {
                //error message
                $this->Session->setFlash(__('Registration could not be completed. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        //ensure the user being edited is the user that is logged in
        if ($id == $this->Auth->user('user_number')) {
            //ensure user exists
            if (!$this->User->exists($id)) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is(array('post', 'put'))) {
                if ($this->User->save($this->request->data)) {
                    //refresh the auth component so that changes appear immediately, rather than on next login
                    $this->Session->write('Auth', $this->User->read(null, $this->Auth->User('user_number')));
                    //success message
                    $this->Session->setFlash(__('Your changes have been saved.'), 'default', array('class' => 'message success'));
                    return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets'));
                } else {
                    //error message
                    $this->Session->setFlash(__('Your changes could not be saved. Please, try again.'));
                }
            } else {
                $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                $this->request->data = $this->User->find('first', $options);
            }
        } else return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        //make sure logged in user is an admin, and also that the user to delete is not the logged in user
        if ($this->getUserAuthority(1) && $id != $this->Auth->user('user_number')) {
            $this->User->id = $id;
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            $this->request->allowMethod('post', 'delete');
            //delete the user
            if ($this->User->delete()) {
                //success message
                $this->Session->setFlash(__('The user has been deleted.'), 'default', array('class' => 'message success'));
            } else {
                //error message
                $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
            }
            //return to users index
            return $this->redirect(array('action' => 'index'));
            //if not authorized, send user to myTickets view
        } else return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets'));
    }

    /**
     * login method
     *
     * @return void
     */
    public function login()
    {
        //if already logged-in, redirect
        if ($this->Session->check('Auth.User')) {
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, ' . $this->Auth->user('user_first_name') . ' ' . $this->Auth->user('user_last_name')), 'default', array('class' => 'message success'));
                if ($this->Auth->user('authority_code') == 2) { //if support staff, get department code and store in session
                    $department = $this->User->query("SELECT `department_id` FROM `supportstaff` WHERE `user_number` = " . $this->Auth->user('user_number') . ";");
					echo print_r($department);
                    $this->Session->write('department', $department['0']['supportstaff']['department_id']);
                    return $this->redirect(array('controller' => 'tickets', 'action' => 'deptTickets')); //redirect to dept tickets

                } else return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets')); //if standard user, redirect to my tickets
            }
            //error message
            $this->Session->setFlash(
                __('Email or password is incorrect'));
        }
    }

    /**
     * logout method
     *
     * @return void
     */
    public function logout()
    {
        $this->Session->setFlash(__('You are now logged out.'), 'default', array('class' => 'message success'));
        $this->Session->delete('department'); //delete record of support staff department if it exists
        return $this->redirect($this->Auth->logout());

    }

    /**
     * elevate user method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function elevate($id = null)
    {
        //ensure user is an admin, and the user role to be change is not the logged in user
        if ($this->getUserAuthority(1) && $id != $this->Auth->user('user_number')) {
            if (!$this->User->exists($id)) {
                throw new NotFoundException(__('Invalid user'));
            }
            if ($this->request->is(array('post', 'put'))) {
                //before changing role, must delete any assigned departments from support staff table
                $this->User->query("DELETE FROM `supportstaff` WHERE `user_number` = " . $this->request->data['User']['user_number']);
                if ($this->User->save($this->request->data)) {
                    //success message
                    $this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'message success'));
                    //if the user is being changes to support staff, we have to link them to a department by adding a record to the support staff table
                    if ($this->request->data['User']['authority_code'] == 2) {
                        $this->User->query("INSERT INTO `supportstaff`(`user_number`, `department_id`) VALUES (" . $this->request->data['User']['user_number'] . "," . $this->request->data['User']['department_id'] . ")");
                    } else if ($this->request->data['User']['authority_code'] != 2) {

                    }
                    //return to users index
                    return $this->redirect(array('action' => 'index'));
                } else {
                    //error message
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                $this->request->data = $this->User->find('first', $options);
            }
            //if not authorized return to the myTickets view
        } else return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets'));
    }
}
