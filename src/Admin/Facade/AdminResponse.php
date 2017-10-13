<?php

namespace Admin\Facade;

use Admin\Response\AdminResponseFactory;
use Gephart\Framework\Facade\Facade;

class AdminResponse extends Facade
{
    public static function getAccessor()
    {
        return AdminResponseFactory::class;
    }
}
