<?php

namespace phojure;

class CollTest extends \PHPUnit_Framework_TestCase
{
    function testSeq()
    {
        $this->assertEquals(1, Coll::first([1, 2, 3]));
    }

    function testSeqIterator()
    {
        $arr = [];
        foreach(Coll::range(0, 100) as $x){
            array_push($arr, $x);
        }

        $this->assertTrue(Val::eq(Coll::range(0, 100), $arr));
    }

    function testLazySeq()
    {
        $this->assertNotNull(Coll::repeat("hello"));
        $this->assertNotNull(Coll::drop(1000000000000, Coll::repeat("hello")));

        $this->assertEquals("hello", Coll::first(Coll::drop(100000, Coll::repeat("hello"))));
    }

    function testLast()
    {
       $this->assertEquals("foo", Coll::last(Coll::take(100000, Coll::repeat("foo"))));
    }
    
    function testFirst()
    {
        $this->assertEquals(2,
            Val::threadl([1, 2, 3])
                ->_(Coll::$map, function($x){return $x + 1;})
                ->_(Coll::$first)
                ->deref());
    }

    function testNthOnSeq()
    {
        $this->assertEquals(3, Coll::nth(Coll::lst(1,2,3), 2));
    }
}