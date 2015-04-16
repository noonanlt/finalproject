<?php
/**
 * AuthorityFixture
 *
 */
class AuthorityFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'authority';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'authority_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false, 'key' => 'primary'),
		'authority_description' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'authority_code', 'unique' => 1)
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
			'authority_code' => 1,
			'authority_description' => 'Lorem ipsum dolor sit amet'
		),
	);

}
