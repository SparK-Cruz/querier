<?php
namespace Querier;

class Raw implements \JsonSerializable {
    private $string;

    public function __construct($string) {
        $this->string = $string;
    }

    public function toString() {
        return '<![RAW]>'.$this->string;
    }

    public function __toString() {
        return $this->toString();
    }

    public function jsonSerialize() {
        return $this->toString();
    }
}
