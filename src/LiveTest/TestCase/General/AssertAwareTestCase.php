<?php

namespace LiveTest\TestCase\General;

use LiveTest\TestCase\TestCase;
use LiveTest\TestCase\Exception;
use phmLabs\Assert\Expect;

abstract class AssertAwareTestCase implements TestCase
{
  protected $expect;

  public function __construct()
  {
    $missedAssertCallback = function ($message)
    {
      throw new Exception($message);
    };
    $this->expect = new Expect($missedAssertCallback);
  }

  /**
   * @return \phmLabs\Assert\Expect;
   */
  protected function expect($expectedElement)
  {
    $expectHandler = $this->expect;
    return $expectHandler($expectedElement);
  }
}