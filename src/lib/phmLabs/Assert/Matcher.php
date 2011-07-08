<?php

namespace phmLabs\Assert;

class Matcher
{
	private $expectedElement;

	public function __construct(Expect $expectHandler, $expectedElement)
	{
		$this->expectedElement = $expectedElement;
		$this->expectHandler = $expectHandler;
	}

  /**
   * This method implements the Selenium RC protocol.
   *
   * @method unknown toContain()
   * @method unknown toBeGreaterThan()
   *
   * @return Expect
   */
  public function __call($name, $arguments)
  {
    $fullName = __NAMESPACE__ . "\\Matchers\\" . ucfirst($name);

    if (class_exists($fullName, true))
    {
      $matched = call_user_func_array(array ($fullName, 'match'),
                                           array_merge( array($this->expectedElement),$arguments));

      if (!$matched)
      {
        $this->expectHandler->markAsFailed();
      }
    }
    else
    {
    	throw new \Exception('The matcher "'.$name.'" was not found.');
    }

    return $this->expectHandler;
  }
}