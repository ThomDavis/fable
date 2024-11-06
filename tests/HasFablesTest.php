<?php

namespace ThomDavis\Fable\Tests;

use Illuminate\Support\Facades\DB;
use ThomDavis\Fable\Traits\HasFables;

class HasFablesTest extends TestCase
{
    /** @test */
    public function it_has_a_created_fable()
    {
        $this->assertNotNull($this->testUser->fables->first());
    }

    /** @test */
    public function it_has_an_updated_fable(): void
    {
        $this->testUser->update(['first_name' => 'Updated Name']);
        $this->assertEquals('Updated Name', $this->testUser->lastFable->new_value['first_name']);
    }

    /** @test */
    public function it_has_a_defined_fable_relationship(): void
    {
        $this->assertEquals(1, $this->testUser->fables->count());
    }
}