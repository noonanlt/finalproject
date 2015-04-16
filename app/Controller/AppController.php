<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. All
 * application-wide controller-related methods are found here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * components array
     *
     * contains authentication and validation rules
     */
    public $components = array(
        'Session',
        'Auth' => array(
            //login redirect controller and action
            'loginRedirect' => array(
                'controller' => 'tickets',
                'action' => 'myTickets'
            ),
            //logout redirect controller and action
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'user_id' => 'current_user_id',
                        'user_first_name' => 'current_user_first_name',
                        'user_last_name' => 'current_user_last_name'
                    ),
                    //password hashing
                    'passwordHasher' => 'Simple',
                    'hashType' => 'sha1'
                )
            )
        )
    );

    /**
     * before filter method
     *
     * runs everytime a page is served
     *
     * @return
     **/
    public function beforeFilter()
    {
        //parent::beforeFilter();

        if ($this->Auth->user('authority_code') != null) { //if there is value stored in the auth array
            $this->set('userAuth', $this->Auth->user('authority_code')); //store the authority level of the logged in user
            $this->set('userId', $this->Auth->user('user_number')); //store the id of the logged in user
            $this->set('userName', $this->Auth->user('user_first_name') . ' ' . $this->Auth->user('user_last_name'));
            $this->set('loggedIn', true); //set loggedIn bool to true
        } else $this->set('loggedIn', false); //else set false, so the view knows not to check for authority level
    }

    /**
     * datetime method
     *
     * @return current datetime
     **/
    public function datetime()
    {
        date_default_timezone_set("America/Halifax");
        $date = date('Y\-m\-d h\:i:s');
        return $date;
    }

    /**
     * check user authority method
     *
     * @return true/false if user is specified authority level
     */
    public function getUserAuthority($authorityCode)
    {
        $bool = ($this->Auth->user('authority_code') == $authorityCode);
        return $bool;
    }

}
