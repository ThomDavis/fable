<?php

namespace ThomDavis\Fable\Tests;

class TrackHistoryTest extends TestCase
{
    /** @test */
    public function it_has_a_created_history()
    {
        $this->assertNotNull($this->testUser->histories->first());
    }

    /** @test */
    public function it_has_an_updated_history(): void
    {
        $this->testUser->update(['first_name' => 'Updated Name']);
        $this->assertEquals('Updated Name', $this->testUser->lastHistory->new_value['first_name']);
    }

    /** @test */
    public function it_has_a_defined_history_relationship(): void
    {
        $this->assertEquals(1, $this->testUser->histories->count());
    }
}