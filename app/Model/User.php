<?php
/*   Project Title: Work Order Management System

     Author: Logan Noonan, Michael Fesser, Andrew Reid, Roger Myers

     Date:  02/17/2015

     Purpose: Description of the user model.

     Last Revision: 02/17/2015

     Dependencies: AppModel.php

 */
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * Holds information about a user.
 */
class User extends AppModel
{
    public $virtualFields = array(
        'username' => 'user_email',
        'password' => 'user_password'
    );

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'user_number'
        )
    );

    /**
     * Before save method
     *
     * handles hashing of password before registration and login
     *
     * @param options array
     * @return boolean whether password matches or not
     */
    public function beforeSave($options = array())
    {
        if (!empty($this->data[$this->alias]['user_password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
            $this->data[$this->alias]['user_password'] = $passwordHasher->hash(
                $this->data[$this->alias]['user_password']
            );
        }
        return true;
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'user_number' => array(
            'blank' => array(
                'rule' => 'blank',
                'on' => 'create',
            ),
        ),
        'user_email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Email must be entered',
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Email must be entered',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 40),
                'message' => 'Email maximum length is 40 characters',
            ),
        ),
        'user_password' => array(
            'minLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password minimum length is 6 characters',
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 20),
                'message' => 'Password maximum length is 20 characters',
            ),
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
            'equaltofield' => array(
                'rule' => array('equaltofield', 'user_password'),
                'message' => 'Both passwords must match'
            )
        ),
        'user_last_name' => array(
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Must contain only alpha numeric characters',
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Must enter a last name',
            ),
        ),
        'user_first_name' => array(
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Must contain only alpha numeric characters',
            ),
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Must enter a first name',
            ),
        ),
    );
    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'user';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'user_number';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'user_email';

}
