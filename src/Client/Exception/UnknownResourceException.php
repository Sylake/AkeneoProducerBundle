<?php

namespace Sylake\Bundle\SylakimBundle\Client\Exception;

use Exception;

class UnknownResourceException extends \Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        $message = sprintf('The resource "%s" is not configured in the url resolver', $message);

        parent::__construct($message, $code, $previous);
    }
}
