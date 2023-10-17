<?php

/**
 * @package oik-ms
 * @copyright (C) Copyright Bobbing Wide 2023
 *
 * Unit tests to load all the PHP files for PHP 8.2
 */
class Tests_load_php extends BW_UnitTestCase
{

	/**
	 * set up logic
	 *
	 * - ensure any database updates are rolled back
	 * - we need oik-googlemap to load the functions we're testing
	 */
	function setUp(): void 	{
		parent::setUp();
	}

	function test_load_admin_php() {
		oik_require( 'admin/oik-activation.php', 'oik-ms');
		oik_require( 'admin/oik-ms.php', 'oik-ms');
		$this->assertTrue( true );
	}

	function test_load_shortcodes_php() {
		oik_require( 'shortcodes/oik-blog.php', 'oik-ms');
		oik_require( 'shortcodes/oik-blogs.php', 'oik-ms');
		$this->assertTrue( true );
	}

	function test_load_plugin_php() {
		oik_require( 'oik-ms.php', 'oik-ms');
		$this->assertTrue( true );
	}
}
