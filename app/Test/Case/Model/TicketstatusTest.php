<?php
App::uses('Ticketstatus', 'Model');

/**
 * Ticketstatus Test Case
 *
 */
class TicketstatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ticketstatus'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ticketstatus = ClassRegistry::init('Ticketstatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ticketstatus);

		parent::tearDown();
	}

}
