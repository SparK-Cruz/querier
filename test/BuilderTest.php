<?php
namespace Test;

use Querier\Builder as Q;

class BuilderTest extends TestCase {
    public function testQuery() {
        $expected = 'query Op(a:"b"){test{works}}';

        $result = Q::query('Op')
            ->with('a', 'b')
            ->want(Q::field('test')
                ->want('works')
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }

    public function testMutation() {
        $expected = 'mutation{call(input:{hello:"world"}){a,b,c}}';

        $result = Q::mutation()
            ->want(Q::field('call')
                ->with('input', ['hello' => 'world'])
                ->want('a', 'b', 'c')
            )
            ->toString();

        $this->assertEquals($expected, $result);
    }
}
