<?php
namespace Querier;

class Field {
    private $name;
    private $arguments = [];
    private $fields = [];

    /**
     * @param string $name Field name
     * @param array $arguments (optional) Associative array for filtering
     */
    public function __construct($name, $arguments = []) {
        $this->name = $name;
        $this->arguments = $arguments;
    }

    /**
     * @param string $argument Argument name
     * @param mixed $value Any value to filter
     */
    public function with($argument, $value) {
        $this->arguments[$argument] = $value;
        return $this;
    }

    /**
     * @param Field|string $field... Accepts multiple fields
     */
    public function want($field) {
        $this->fields = array_merge($this->fields, func_get_args());
        return $this;
    }

    public function toString() {
        $result = $this->name;

        if (!empty($this->arguments))
            $result .= self::arrayToArgs($this->arguments);

        if (!empty($this->fields))
            $result .= '{'
                .implode(
                    ',',
                    array_map(
                        function($field) {
                            if (is_string($field))
                                return $field;
                            return $field->toString();
                        },
                        $this->fields
                    )
                )
                .'}';

        return $result;
    }

    public static function arrayToArgs($array) {
        return preg_replace(
            '/^\{(.*)\}/',
            '($1)',
            preg_replace(
                '/\"(\w+)\"\:/',
                '$1:',
                json_encode($array)
            )
        );
    }
}
