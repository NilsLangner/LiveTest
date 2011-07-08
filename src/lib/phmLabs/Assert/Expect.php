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

  public function markAsFailed()
  {
    $this->failed = true;
  }

  /**
   * @return Expect
   */
  public function __invoke($expectedElement)
  {
    $this->expectedElement = $expectedElement;
    return new Matcher($this, $expectedElement);
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