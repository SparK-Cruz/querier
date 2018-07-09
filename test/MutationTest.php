<?php
namespace Test;

use Querier\Mutation;
use Querier\Field;

class MutationTest extends TestCase {
    public function testToString() {
        $expected = 'mutation{testCall(input:{property:"value"}){foo,bar,baz}}';

        $result = (new Mutation())
            ->want((new Field('testCall'))
                ->with('input', ['property' => 'value'])
                ->want('foo', 'bar', 'baz')
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }
    public function testToStringWithOperationNameInputAndComplexReturn() {
        $expected = 'mutation Main{testCall(input:{something:"else",should:"work"}){baz{a,b{c}}}}';

        $result = (new Mutation('Main'))
            ->want((new Field('testCall'))
                ->with('input', ['something' => 'else', 'should' => 'work'])
                ->want((new Field('baz'))
                    ->want(
                        'a',
                        (new Field('b'))
                            ->want('c')
                    )
                )
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }
}
