<?php
namespace AffWP\Graph;

use AffWP\Tests\UnitTestCase;

/**
 * Tests for Affiliate_WP_Graph.
 *
 * @covers Affiliate_WP_Graph
 * @group graph
 */




class Tests extends UnitTestCase {

	/**
	 * @covers affwp_get_report_dates()
	 */
	public function test_get_report_dates_correct_this_month_at_the_end_of_the_month_utc() {

		global $AFFWP_TEST_TIME, $AFFWP_TEST_UTC_OFFSET;

		$AFFWP_TEST_TIME       = strtotime( '2016/08/31 23:59 UTC' );
		$AFFWP_TEST_UTC_OFFSET = 0;

		date_default_timezone_set( 'UTC' );

		$dates = affwp_get_report_dates();

		$this->assertEquals( $dates['day'], 1 );
		$this->assertEquals( $dates['m_start'], 8 );
		$this->assertEquals( $dates['year'], 2016 );
		$this->assertEquals( $dates['day_end'], 31 );
		$this->assertEquals( $dates['m_end'], 8 );
		$this->assertEquals( $dates['year_end'], 2016 );

	}

	/**
	 * @covers affwp_get_report_dates()
	 */
	public function test_get_report_dates_correct_this_month_at_the_end_of_the_month_nz() {

		global $AFFWP_TEST_TIME, $AFFWP_TEST_UTC_OFFSET;

		$AFFWP_TEST_TIME       = strtotime( '2016/08/31 12:00 UTC' );
		$AFFWP_TEST_UTC_OFFSET = 12;

		date_default_timezone_set( 'Pacific/Auckland' );

		$dates = affwp_get_report_dates();

		$this->assertEquals( $dates['day'], 1 );
		$this->assertEquals( $dates['m_start'], 9 );
		$this->assertEquals( $dates['year'], 2016 );
		$this->assertEquals( $dates['day_end'], 30 );
		$this->assertEquals( $dates['m_end'], 9 );
		$this->assertEquals( $dates['year_end'], 2016 );

	}

	/**
	 * @covers affwp_get_report_dates()
	 */
	public function test_get_report_dates_correct_this_month_at_the_beginning_of_the_month_utc() {

		global $AFFWP_TEST_TIME, $AFFWP_TEST_UTC_OFFSET;

		$AFFWP_TEST_TIME       = strtotime( '2016/09/01 00:00 UTC' );
		$AFFWP_TEST_UTC_OFFSET = 0;

		date_default_timezone_set( 'UTC' );

		$dates = affwp_get_report_dates();

		$this->assertEquals( $dates['day'], 1 );
		$this->assertEquals( $dates['m_start'], 9 );
		$this->assertEquals( $dates['year'], 2016 );
		$this->assertEquals( $dates['day_end'], 30 );
		$this->assertEquals( $dates['m_end'], 9 );
		$this->assertEquals( $dates['year_end'], 2016 );

	}

	/**
	 * @covers affwp_get_report_dates()
	 */
	public function test_get_report_dates_correct_this_month_at_the_beginning_of_the_month_pdt() {

		global $AFFWP_TEST_TIME, $AFFWP_TEST_UTC_OFFSET;

		$AFFWP_TEST_TIME       = strtotime( '2016/09/01 00:00 UTC' );
		$AFFWP_TEST_UTC_OFFSET = - 7;

		date_default_timezone_set( 'America/Los_Angeles' );

		$dates = affwp_get_report_dates();

		$this->assertEquals( $dates['day'], 1 );
		$this->assertEquals( $dates['m_start'], 8 );
		$this->assertEquals( $dates['year'], 2016 );
		$this->assertEquals( $dates['day_end'], 31 );
		$this->assertEquals( $dates['m_end'], 8 );
		$this->assertEquals( $dates['year_end'], 2016 );

	}

	/**
	 * @covers affwp_get_report_dates()
	 */
	public function test_get_report_dates_correct_this_moment() {

		unset( $GLOBALS['AFFWP_TEST_TIME'] );
		unset( $GLOBALS['AFFWP_TEST_UTC_OFFSET'] );

		date_default_timezone_set( 'UTC' );

		$current_time = current_time( 'timestamp', 1 );
		$dates = affwp_get_report_dates();

		$this->assertEquals( $dates['day'], 1 );
		$this->assertEquals( $dates['m_start'], date( 'n', $current_time ) );
		$this->assertEquals( $dates['year'], date( 'Y', $current_time ) );
		$this->assertEquals( $dates['day_end'], cal_days_in_month( CAL_GREGORIAN, $dates['m_start'], $dates['year'] ) );
		$this->assertEquals( $dates['m_end'], date( 'n', $current_time ) );
		$this->assertEquals( $dates['year_end'], date( 'Y', $current_time ) );

	}

}