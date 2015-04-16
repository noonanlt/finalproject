<?php
/**
 * CommentFixture
 *
 */
class CommentFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'comment';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'comment_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 7, 'unsigned' => false, 'key' => 'primary'),
		'comment_message' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 250, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'comment_datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'ticket_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'comment_id', 'unique' => 1)
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
			'comment_id' => 1,
			'comment_message' => 'Lorem ipsum dolor sit amet',
			'comment_datetime' => '2015-02-11 16:28:26',
			'ticket_number' => 1,
			'user_number' => 1
		),
	);

}
