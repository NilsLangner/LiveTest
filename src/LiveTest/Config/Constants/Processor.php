<?php

// @todo könnte auch in base liegen
namespace LiveTest\Config\Constants;

class Processor
{
  private $replacement = array ();
  private $delimiter;
  
  public function __construct($delimiter = '%')
  {
    $this->delimiter = $delimiter;
  }
  
  public function setReplacement($key, $value)
  {
    $this->replacement[$key] = $value;
  }
  
  private function getReplacement( $key )
  {
  	return $this->replacement[$key];
  }
  
  private function hasReplacement($key)
  {
    return array_key_exists($key, $this->replacement);
  }
  
  public function processRecursivly($array)
  {
    $processedArray = array ();
    
    foreach ($array as $key => $value)
    {
      if (is_array($value))
      {
        $processedArray[$key] = self::processRecursivly($value);
      }
      else
      {
        preg_match_all('#' . $this->delimiter . '(.*?)' . $this->delimiter . '#', $value, $matches);
        if (count($matches[0]) > 0)
        {
          foreach ($matches[1] as $placeholder)
          {
          	if( $this->hasReplacement($placeholder))
          	{
          		$value = str_replace($this->delimiter.$placeholder.$this->delimiter, $this->getReplacement($placeholder), $value);
          	}
          }
        }
        $processedArray[$key] = $value;
      }
    }
    return $processedArray;
  }
}