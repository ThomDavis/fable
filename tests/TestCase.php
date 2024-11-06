<?php

namespace ThomDavis\Fable\Tests;

use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use ThomDavis\Fable\Tests\TestModels\Movie;
use ThomDavis\Fable\Tests\TestModels\User;

abstract class TestCase extends Orchestra
{

    protected User $testUser ;
    protected Movie $testMovie ;

    protected function setUp(): void
    {
        parent::setUp();

        // Note: this also flushes the cache from within the migration
        $this->setUpDatabase($this->app);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    protected function setUpDatabase($app)
    {
        $schema = $app['db']->connection()->getSchemaBuilder();

        $schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('first_name');
            $table->softDeletes();
        });

        $schema->create('movie', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });

        $this->testUser = User::create(['email' => 'test@user.com', 'first_name' => 'test']);
        $this->testMovie = Movie::create(['name' => 'Jaws', 'user_id' => $this->testUser->id]);
    }
}