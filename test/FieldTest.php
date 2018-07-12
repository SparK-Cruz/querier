<?php
namespace Test;

use Querier\Field;
use Querier\Raw;

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
    public function testToStringWithComplexSubFields() {
        $expected = 'test(foo:"bar"){baz{x(a:15){y,z}}}';

        $result = (new Field('test'))
            ->with('foo', 'bar')
            ->want((new Field('baz'))
                ->want((new Field('x'))
                    ->with('a', 15)
                    ->want('y', 'z')
                )
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }
    public function testToStringWithRawProperties() {
        $expected = 'test(foo:{bar:BAZ,other:50,text:"ok"}){x}';

        $foo = ['bar' => new Raw('BAZ'), 'other' => 50, 'text' => 'ok'];
        $result = (new Field('test'))
            ->with('foo', $foo)
            ->want('x')
            ->toString();

        $this->assertEquals($expected, $result);
    }
}
