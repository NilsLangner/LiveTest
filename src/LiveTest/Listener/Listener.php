<?php

namespace LiveTest\Listener;

use Annovent\Event\Dispatcher;

interface Listener extends \Annovent\Event\Listener
{
  public function __construct($runId, Dispatcher $eventDispatcher);
}