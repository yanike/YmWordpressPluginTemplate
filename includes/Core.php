<?php

class Core
{
	public function __construct(){

	}

	/**
	 * Add AJAX functionality to WP
	 */
	public function ajaxCalls(){
		$testSection = new TestSection();
		$testSection->ajaxCalls();
	}

	/**
	 * Shortcode function for testSection
	 *
	 * @param mixed $atts
	 */
	public function testSection($atts)
	{
		$testSection = new TestSection();
		$testSection->getContent($atts);
	}
}
