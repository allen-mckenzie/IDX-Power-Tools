<?php
/**
 * IDX_Power_Tools.
 *
 * @since   0.0.1
 * @package IDX_Power_Tools
 */
class IDX_Power_Tools_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.1
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'IDX_Power_Tools') );
	}

	/**
	 * Test that our main helper function is an instance of our class.
	 *
	 * @since  0.0.1
	 */
	function test_get_instance() {
		$this->assertInstanceOf(  'IDX_Power_Tools', idx_power_tools() );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  0.0.1
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
