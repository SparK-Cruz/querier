<?php
namespace Querier;

class Mutation {
    use Fields;
    use Arguments;

    private $name;

    /**
     * @param string $name Field name
     */
    public function __construct($operationName = null, $arguments = []) {
        $this->name = $operationName;
        $this->arguments = $arguments;
    }

    public function toString() {
        return 'mutation'
            . self::wrap(' ', $this->name)
            . self::wrap('(', $this->argumentsToString(), ')')
            . $this->fieldsToString();
    }

    public function __toString() {
        return $this->toString();
    }
}
