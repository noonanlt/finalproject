<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Controller for the ticket model.

     Last Revision: 02/17/2015

     Dependencies: Model.Ticket.php, AppController.php

 */
App::uses('AppController', 'Controller');
App::import('Controller', 'Comments');

/**
 * Tickets Controller
 *
 * This class handles incoming and outgoing requests that deal with the ticket model.
 *
 * @property Ticket $Ticket
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TicketsController extends AppController
{
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
        //only accessible by the admin, otherwise redirect to myTickets
        if ($this->getUserAuthority(1)) {
            $this->Ticket->recursive = 0;
            $this->set('tickets', $this->Paginator->paginate());
        } else return $this->redirect($this->Auth->redirectUrl());
    }

    /**
     * user-specific index method
     *
     * @return void
     */
    public function myTickets()
    {
        $this->Ticket->recursive = 0;
        $this->set('tickets', $this->Paginator->paginate(
        //return tickets whose user number matches the logged in user's id
            array('Ticket.user_number =' => $this->Auth->user('user_number'))));
    }

    /**
     * department-specific index method
     *
     * @return void
     */
    public function deptTickets()
    {
        $this->Ticket->recursive = 0;
        //return tickets whose department id matches department of the logged in user
        $this->set('tickets', $this->Paginator->paginate(
            array('Ticket.department_id =' => $this->Session->read('department'))));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Ticket->exists($id)) {
            throw new NotFoundException(__('Invalid ticket'));
        }
        $options = array('conditions' => array('Ticket.' . $this->Ticket->primaryKey => $id));
        $ticket = $this->Ticket->find('first', $options);
        //following if is satisfied if user owns the ticket, support staff is assigned same department as the ticket, or the user is an admin
        if ($this->Auth->user('user_number') == $ticket['User']['user_number'] || $this->Session->read('department') == $ticket['Department']['department_id'] || $this->Auth->user('authority_code') == 1) {
            //pass ticket, user, and any associated comments to the view
            $this->set('ticket', $ticket);
            $this->set('user', $this->Auth->user('user_number'));
            $this->set('comment', $this->Ticket->Comment->findAllByTicketNumber($id, array(), array("Comment.comment_datetime" => "asc"))); //load comments attached to this ticket, sorted by date
            //if not authorized, redirect ot myTickets
        } else return $this->redirect(array('action' => 'myTickets'));
    }

    /**
     * add method
     *
     * creates a new ticket.
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Ticket->create();
            //programatically set user number, ticket status and the date.
            $this->request->data['Ticket']['user_number'] = $this->Auth->user('user_number');
            $this->request->data['Ticket']['ticket_status_code'] = 1;
            $this->request->data['Ticket']['ticket_open_date_time'] = $this->datetime();
            //set priority to 0 if not selected
            if (!isset($this->request->data['Ticket']['ticket_priority_code'])) $this->request->data['Ticket']['ticket_priority_code'] = 0;
            //save the ticket
            if ($this->Ticket->save($this->request->data)) {
                //confirmation message
                $this->Session->setFlash(__('Your ticket has been saved.'), 'default', array('class' => 'message success'));
                return $this->redirect(array('action' => 'myTickets'));
            } else {
                //error message
                $this->Session->setFlash(__('Your ticket could not be saved. Please, try again.'));
            }
        }
        //store categories and departments so they can be used in the view
        $categories = $this->Ticket->Category->find('list');
        $departments = $this->Ticket->Department->find('list');
        $users = $this->Ticket->User->find('list');
        $this->set(compact('categories', 'departments', 'users'));
    }

    /**
     * delete method
     *
     * deletes a ticket.
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        //only accessible by admin
        if ($this->getUserAuthority(1)) {
            $this->Ticket->id = $id;
            if (!$this->Ticket->exists()) {
                throw new NotFoundException(__('Invalid ticket'));
            }
            $this->request->allowMethod('post', 'delete');
            if ($this->Ticket->delete()) {
                //success message
                $this->Session->setFlash(__('The ticket has been deleted.'), 'default', array('class' => 'message success'));
            } else {
                //error message
                $this->Session->setFlash(__('The ticket could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index')); //if success, return to all tickets view
        } else return $this->redirect(array('action' => 'myTickets')); //if not authorized, return to myTickets view
    }

    /**
     * resolve method
     *
     * Marks the specified ticket as resolved by changing the value of the ticket_status column
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function resolve($id = null)
    {
        //parameters for query
        $options = array('conditions' => array('Ticket.' . $this->Ticket->primaryKey => $id));
        //read ticket info so we can make sure this user can mark as resolved
        $ticket = $this->Ticket->find('first', $options);
        //following if is satisfied if user owns the ticket, support staff is assigned same department as the ticket, or the user is an admin
        if ($this->Auth->user('user_number') == $ticket['User']['user_number'] || $this->Session->read('department') == $ticket['Department']['department_id'] || $this->Auth->user('authority_code') == 1) {
            $this->autoRender = false;
            if (!$this->Ticket->exists($id)) {
                throw new NotFoundException(__('Invalid ticket'));
            }
            $this->Ticket->id = $id;

            //set the ticket close date with current datetime
            $this->Ticket->saveField('ticket_close_date_time', $this->datetime());
            //set ticket status to closed
            $this->Ticket->saveField('ticket_status_code', 0);
            $this->Session->setFlash(__('This ticket has been closed.'), 'default', array('class' => 'message success'));
            //return user to ticket view
            return $this->redirect(array('action' => 'view/' . $id));
            //return user to myTickets if not authorized to resolve
        } else return $this->redirect(array('action' => 'myTickets'));
    }

}