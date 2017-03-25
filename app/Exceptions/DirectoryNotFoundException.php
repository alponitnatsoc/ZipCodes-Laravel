<?php
namespace App\Exceptions;

use Exception;

class DirectoryNotFoundException extends \Exception {
    private $path;

    public function __construct($path = "", $message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct("Directory ".$path." not found.", $code, $previous);
        $this->path = $path;
    }
}

?>