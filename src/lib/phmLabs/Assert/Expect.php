<?php

namespace phmLabs\Assert;

use Base\Cli\Exception;

class Expect
{
  private $expectedElement;

  private $missedAssertCallback;

  private $failed = false;

  public function __construct($missedAssertCallback)
  {
    $this->missedAssertCallback = $missedAssertCallback;
  }

  /**
   * @return Expect
   */
  public function __invoke($expectedElement)
  {
    $this->expectedElement = $expectedElement;
    return $this;
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
    $fullName = __NAMESPACE__."\\Matchers\\" . ucfirst($name);

    if (class_exists($fullName, true))
    {
      $this->failed = call_user_func_array(array ($fullName, 'match'),
                                           array_merge( array($this->expectedElement),$arguments));
    }
    else
    {
    	throw new \Exception('The matcher "'.$name.'" was not found.');
    }

    return $this;
  }

  /**
   * @return Expect
   */
  public function otherwise($message)
  {
    if ($this->failed)
    {
      $callBack = $this->missedAssertCallback;
      return $callBack($message);
    }
    return $this;
  }
}