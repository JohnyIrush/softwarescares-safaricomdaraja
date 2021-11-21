<?php

namespace Softwarescares\Safaricomdaraja\app\Contracts;

Interface TransactionInterface 
{
    public function transaction();

    public function result($result);
}