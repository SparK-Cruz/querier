<?php
namespace Querier;

class Builder {
    public static function query($name = null, $arguments = []) {
        return new Query($name, $arguments);
    }

    public static function mutation($name = null, $arguments = []) {
        return new Mutation($name, $arguments);
    }

    public static function field($name, $arguments = []) {
        return new Field($name, $arguments);
    }
}
