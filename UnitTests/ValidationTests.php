
<?php
require_once ("../simpletest/autorun.php");
/**
 *
 * Class for testing the methods validation class
 * 
 * @author James & Fahim
 *        
 */
class ValidationTests extends UnitTestCase {

	private $validation;
	public function setUp() {
		require_once ("../app/models/Validation.php");
		$this->validation = new Validation ();
	}

	public function testEmail() {
		$this->assertTrue ( $this->validation->isEmailValid ( "luca.longo@dit.ie" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( "luca.@.com" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( ".com" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( "luca" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( "@" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( "123" ) );
		$this->assertFalse ( $this->validation->isEmailValid ( null ));
		$this->assertFalse ( $this->validation->isEmailValid ( array()));
		$this->assertFalse ( $this->validation->isEmailValid ( -1));
		$this->assertFalse ( $this->validation->isEmailValid ( 9999));
		$this->assertFalse ( $this->validation->isEmailValid ( "-1"));
	}
}

?>