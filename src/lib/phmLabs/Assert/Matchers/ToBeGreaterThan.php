<?php

namespace phmLabs\Assert\Matchers;

class ToBeGreaterThan
{
  public static function match($expectedElement, $actualElement)
  {
    return ($expectedElement < $actualElement);
  }
}