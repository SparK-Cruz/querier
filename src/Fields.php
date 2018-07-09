<?php
namespace Querier;

trait Fields {
    protected $fields = [];

    /**
     * @param Field|string|array $field... Accepts multiple fields
     */
    public function want($field) {
        if (is_array($field)) {
            $this->fields = array_merge($this->fields, $field);
            return $this;
        }

        $this->fields = array_merge($this->fields, func_get_args());
        return $this;
    }

    protected function fieldsToString() {
        if (empty($this->fields))
            return '';

        return '{'
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
    }
}
