<?php
namespace Querier;

trait Arguments {
    protected $arguments = [];

    /**
     * @param string $argument Argument name
     * @param mixed $value Any value to filter
     */
    public function with($argument, $value) {
        $this->arguments[$argument] = $value;
        return $this;
    }

    protected function argumentsToString() {
        if (empty($this->arguments))
            return '';

        $filters = [
            ['/^\{(.*)\}/', '$1'],
            ['/\"((?:\$|\.\.\.)?[\w\d]+)\"\:/', '$1:'],
            ['/:\"(\$[\w\d]+)\"/', ':$1'],
            ['/:\"\<\!\[RAW\]\>([\w\d]+)\"/', ':$1'],
        ];

        return array_reduce($filters, function($last, $filter) {
            return preg_replace($filter[0], $filter[1], $last);
        }, json_encode($this->arguments));
    }

    protected static function wrap($before, $content, $after = '') {
        if (!$content)
            return '';

        return $before.$content.$after;
    }
}
