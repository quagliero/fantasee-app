<?php namespace Fantasee\Exceptions;

class DevOnlyException extends \Exception {
  public function __construct($route, $code = 0, $previous = null) {
    $this->message = "Unable to resolve $route as it is only intended for use in development environments.";
    parent::__construct($this->message, $code, $previous);
  }

  public function __toString() {
    return self::class . ': ' . $this->message;
  }
}