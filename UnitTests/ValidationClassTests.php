<?php
require_once ("../simpletest/autorun.php");
/**
 *
 * Class for testing the methods validation class
 * 
 * @author Luke
 *        
 */
class ValidationClassTests extends UnitTestCase {
	private $validation;
	public function setUp() {
		require_once ("../app/models/Validation.php");
		$this->validation = new Validation ();
	}
	public function testIsEmailValid() {
		$this->assertTrue ( $this->validation->isEmailValid ( "luca.longo@dit.ie" ) );
		$this->assertTrue ( $this->validation->isEmailValid ( "luca.@.com" ) );
		$this->assertTrue ( $this->validation->isEmailValid ( ".com" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( "luca" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( "@" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( "123" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( array()));
		$this->assertFalse ( $this->validation->isEmailValid ( 9999));
		$this->assertFalse ( $this->validation->isEmailValid ( "-1"));
	}

	
	
}
?>