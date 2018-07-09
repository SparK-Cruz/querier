<?php
namespace Querier;

class Query {
    use Fields;
    use Arguments;

    private $name;

    public function __construct($operationName = null, $arguments = []) {
        $this->name = $operationName;
        $this->arguments = $arguments;
    }

    public function toString() {
        return 'query'
            . self::wrap(' ', $this->name)
            . self::wrap('(', $this->argumentsToString(), ')')
            . $this->fieldsToString();
    }

    public function __toString() {
        return $this->toString();
    }
}
