<?php
namespace Unit\Assert;

/**
 * Test class for Run.
 */
use phmLabs\Assert\Expect;

class ExpectTest extends \PHPUnit_Framework_TestCase
{
  public function testGreaterThan()
  {
  	$missedAssertFuction = function($errorMessage) { throw new \Exception($errorMessage); };
		$expect = new Expect($missedAssertFuction);
		$expect(5)->greaterThan(4);
		$this->setExpectedException("\Exception");
		$expect(4)->greaterThan(5);
  }
}