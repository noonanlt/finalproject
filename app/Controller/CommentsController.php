<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Controller for the comment model.

     Last Revision: 02/17/2015

     Dependencies: Model.User.php, AppController.php

 */
App::uses('AppController', 'Controller');

/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CommentsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * add to ticket method
     *
     * Accepts a ticket id and adds the comment to that ticket.
     * @param string $ticketId
     * @return void
     */
    public function addToTicket($ticketId = null)
    {
        //parameters for query
        $options = array('conditions' => array('Ticket.' . $this->Comment->Ticket->primaryKey => $ticketId));
        //read ticket info so we can make sure this user can comment
        $ticket = $this->Comment->Ticket->find('first', $options);
        if ($ticket['Ticket']['ticket_status_code'] == 1) { //if the ticket is open/unresolved
            //following if is satisfied if user owns the ticket, support staff is assigned same department as the ticket, or the user is an admin
            if ($this->Auth->user('user_number') == $ticket['User']['user_number'] || $this->Session->read('department') == $ticket['Department']['department_id'] || $this->Auth->user('authority_code') == 1) {
                if ($this->request->is('post')) {
                    //create the new comment object
                    $this->Comment->create();
                    //set non-form fields (user id, ticket id, date/time)
                    $this->request->data['Comment']['user_number'] = $this->Auth->user('user_number');
                    $this->request->data['Comment']['ticket_number'] = $ticketId;
                    $this->request->data['Comment']['comment_datetime'] = $this->datetime();
                    if ($this->Comment->save($this->request->data)) {
                        //display confirmation message if save is successful
                        $this->Session->setFlash(__('Your comment has been saved.'), 'default', array('class' => 'message success'));
                        //redirect to the ticket view
                        return $this->redirect(array('controller' => 'tickets', 'action' => 'view', $ticketId));
                    } else {
                        //if save is unsuccessful, display error message
                        $this->Session->setFlash(__('Your comment could not be saved. Please, try again.'));
                    }
                }
                $comments = $this->Comment->find('list'); //find comments for this ticket
                $this->set(compact('comments')); //pass comments to view as array
                //if not authorized, return to myTickets view
            } else return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets'));
        } else return $this->redirect(array('controller' => 'tickets', 'action' => 'myTickets'));//if not authorized, return to myTickets view
    }

}
