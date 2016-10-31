<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class LastKeyTest extends TestCase
{
    /** @test */
    public function it_provides_a_last_key_macro()
    {
        $this->assertTrue(Collection::hasMacro('lastKey'));
    }

    /** @test */
    public function it_returns_the_key_of_the_last_item()
    {
        $collection = Collection::make(['a' => 100, 'b' => 200, 'c' => 300]);

        $key = $collection->lastKey(function ($value) {
            return $value < 250;
        });

        $this->assertEquals('b', $key);
        $this->assertEquals('c', $collection->lastKey());
    }

    /** @test */
    public function it_can_return_a_default_value()
    {
        $collection = Collection::make(['a' => 100, 'b' => 200, 'c' => 300]);

        $key = $collection->lastKey(function ($value) {
            return $value >= 350;
        }, 'd');

        $this->assertEquals('d', $key);
        $this->assertEquals('e', Collection::make([])->lastKey(null, 'e'));
    }
}
