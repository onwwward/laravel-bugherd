<?php

namespace Onwwward\Bugherd\Facades;

use Illuminate\Support\Facades\Facade;

class Bugherd extends Facade
{
    /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
      return 'bugherd';
  }
}
