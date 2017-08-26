<?php
/**
 * Created by RidaSmart Apps UG (haftungsbeschränkt).
 * Initial version by: ridaamirini
 * Initial version created on: 26.08.17 - 15:50
 */

namespace App\Exception;

use Throwable;

class NoAccessException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Error while writing dump in to given Path. (Insufficient Permission/Path not found)', $code, $previous);
    }
}