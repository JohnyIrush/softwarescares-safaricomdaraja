<?php

namespace Softwarescares\Safaricomdaraja\app\Contracts;

Interface TransactionInterface 
{
    public function transaction($request);

    public function result($result, $user);
}