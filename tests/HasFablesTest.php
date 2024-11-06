<?php

namespace ThomDavis\Fable\Tests;

use Illuminate\Support\Facades\DB;

class HasFablesTest extends TestCase
{
    /** @test */
    public function it_can_assign_a_permission_to_a_user()
    {
        $this->assertTrue($this->testUser->id === 1);
    }
}