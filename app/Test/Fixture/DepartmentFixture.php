<?php
/**
 * DepartmentFixture
 *
 */
class DepartmentFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'department';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'department_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false, 'key' => 'primary'),
		'department_description' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'department_code', 'unique' => 1)
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
			'department_code' => 1,
			'department_description' => 'Lorem ipsum dolor sit amet'
		),
	);

}
