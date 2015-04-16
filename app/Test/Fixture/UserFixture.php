<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'user';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'UserNum' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'UserEmail' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'UserPassword' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'UserLastName' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 24, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'UserFirstName' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 24, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'AuthorityCode' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false),
		'UserStatus' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'UserNum', 'unique' => 1),
			'Email' => array('column' => 'UserEmail', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'UserNum' => 1,
			'UserEmail' => 'Lorem ipsum dolor sit amet',
			'UserPassword' => 'Lorem ipsum dolor sit amet',
			'UserLastName' => 'Lorem ipsum dolor sit ',
			'UserFirstName' => 'Lorem ipsum dolor sit ',
			'AuthorityCode' => 1,
			'UserStatus' => 1
		),
	);

}
