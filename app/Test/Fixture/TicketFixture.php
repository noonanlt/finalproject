<?php
/**
 * TicketFixture
 *
 */
class TicketFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ticket';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'ticket_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 9, 'unsigned' => false, 'key' => 'primary'),
		'department_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false),
		'ticket_status_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false),
		'ticket_priority_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 7, 'unsigned' => false),
		'ticket_open_date_time' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'ticket_close_date_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'ticket_room' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ticket_message' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'ticket_number', 'unique' => 1)
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
			'ticket_number' => 1,
			'department_code' => 1,
			'category_id' => 1,
			'ticket_status_code' => 1,
			'ticket_priority_code' => 1,
			'ticket_open_date_time' => '2015-02-10 15:44:30',
			'ticket_close_date_time' => '2015-02-10 15:44:30',
			'ticket_room' => 'Lorem ipsum dolor ',
			'ticket_message' => 'Lorem ipsum dolor sit amet',
			'user_number' => 1
		),
	);

}
