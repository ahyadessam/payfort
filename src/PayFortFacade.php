<?php
namespace ahyadessam\payfort;

use Illuminate\Support\Facades\Facade;

class PayFortFacade extends Facade {
    protected static function getFacadeAccessor() {
        return 'payfort';
    }
}
