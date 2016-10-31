<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class FirstKeyTest extends TestCase
{
    /** @test */
    public function it_provides_a_first_key_macro()
    {
        $this->assertTrue(Collection::hasMacro('firstKey'));
    }

    /** @test */
    public function it_returns_the_key_of_the_first_item()
    {
        $collection = Collection::make(['a' => 100, 'b' => 200, 'c' => 300]);

        $key = $collection->firstKey(function ($value) {
            return $value >= 150;
        });

        $this->assertEquals('b', $key);
        $this->assertEquals('a', $collection->firstKey());
    }

    /** @test */
    public function it_can_return_a_default_value()
    {
        $collection = Collection::make(['a' => 100, 'b' => 200, 'c' => 300]);

        $key = $collection->firstKey(function ($value) {
            return $value >= 350;
        }, 'd');

        $this->assertEquals('d', $key);
        $this->assertEquals('e', Collection::make([])->firstKey(null, 'e'));
    }
}
