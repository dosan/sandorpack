<?php 
namespace Sandorpack;

use Sandorpack\Session;


class Factory
{
    public static function session()
    {
        return new Session();
    }
}