<?php
namespace Test;

use Querier\Field;

class FieldTest extends TestCase {
    public function testToString() {
        $expected = 'test(foo:"bar"){baz}';

        $result = (new Field('test'))
            ->with('foo', 'bar')
            ->want(new Field('baz'))
            ->toString();

        $this->assertEquals($expected, $result);
    }

    public function testToStringWithStringSubFields() {
        $expected = 'test(foo:"bar"){baz}';

        $result = (new Field('test'))
            ->with('foo', 'bar')
            ->want('baz')
            ->toString();

        $this->assertEquals($expected, $result);
    }
}
