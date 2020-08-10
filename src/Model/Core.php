<?php

namespace App\Model;


class Core
{
    protected $DB = null;

    public function __construct() {
        $this->DB = DB::getInstance();
    }

}