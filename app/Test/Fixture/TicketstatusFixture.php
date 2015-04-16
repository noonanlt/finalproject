<?php
/**
 * TicketstatusFixture
 *
 */
class TicketstatusFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ticketstatus';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'ticket_status_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 2, 'unsigned' => false, 'key' => 'primary'),
		'ticket_status_description' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'ticket_status_code', 'unique' => 1)
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
			'ticket_status_code' => 1,
			'ticket_status_description' => 'Lorem ipsum dolor sit amet'
		),
	);

}
