<?php

namespace Softwarescares\Safaricomdaraja\app\Contracts;

Interface TransactionInterface 
{
    public function transaction($request, $user);

    public function result($result);
}