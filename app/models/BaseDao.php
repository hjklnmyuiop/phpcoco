<?php
namespace models;

use Medoo\Medoo;

class BaseDao extends Medoo
{
    function __construct()
    {
        $options = [
            'type' => 'mysql',
            'host' => '47.107.65.119',
            'database' => 'meinian',
            'username' => 'root',
            'password' => 'root'
        ];
        parent::__construct($options);
    }
}