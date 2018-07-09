<?php
namespace Test;

use Querier\Query;
use Querier\Field;

class QueryTest extends TestCase {
    public function testToString() {
        $expected = 'query{test(foo:"bar"){baz}}';

        $result = (new Query())
            ->want((new Field('test'))
                ->with('foo', 'bar')
                ->want(new Field('baz'))
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }

    public function testToStringWithOperationName() {
        $expected = 'query Operation{test(foo:"bar"){baz}}';

        $result = (new Query('Operation'))
            ->want((new Field('test'))
                ->with('foo', 'bar')
                ->want(new Field('baz'))
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }

    public function testToStringWithOperationNameAndVars() {
        $expected = 'query Operation($element:"Element!"){test(foo:"bar"){baz}}';

        $result = (new Query('Operation', ['$element' => 'Element!']))
            ->want((new Field('test'))
                ->with('foo', 'bar')
                ->want(new Field('baz'))
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }

    public function testToStringWithTypedNode() {
        $expected = 'query{node(id:"abc"){... on SubType{subTypeCode}}}';

        $result = (new Query())
            ->want((new Field('node'))
                ->with('id', 'abc')
                ->want((new Field('... on SubType'))
                    ->want('subTypeCode')
                )
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }
}
