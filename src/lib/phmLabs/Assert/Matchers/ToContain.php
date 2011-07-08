<?php

namespace phmLabs\Assert\Matchers;

class ToContain
{
  public static function match($expectedElement, $containedElement)
  {
    if (is_scalar($expectedElement))
    {
      if (strpos($expectedElement, $containedElement) === false)
      {
        return true;
      }
    }
    else
    {
      throw new \Exception('toContain method does not work with the given datatype');
    }
    return false;
  }
}