<?php
namespace Payfort;

use Illuminate\Support\Facades\Facade;

class PayFortFacade extends Facade {
    protected static function getFacadeAccessor() {
        return 'PayFort';
    }
}
