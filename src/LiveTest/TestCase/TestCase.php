<?php

namespace LiveTest\TestCase;

use Base\Www\Uri;

use Base\Http\Response;
use Base\Http\Client;

// @todo die Parameter k�nnen bis jetzt nur eine Liste sein, keine Struktur m�glich.

interface TestCase
{
  public function __construct( $parameter );
  public function test(Response $httpResponse, Uri $uri);
}