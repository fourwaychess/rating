<?php

namespace FourWayChess\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase($this->app);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            RatingServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('username');
        });
        include_once __DIR__.'/../database/migrations/2021_01_03_000001_create_rating_columns.php';
        (new \CreateRatingColumns())->up();
        User::create(['email' => 'test1@user.com'], 'username' => 'user1', 'rating' => 1400.0);
        User::create(['email' => 'test2@user.com'], 'username' => 'user2', 'rating' => 1600.0);
        User::create(['email' => 'test3@user.com'], 'username' => 'user3', 'rating' => 1800.0);
        User::create(['email' => 'test4@user.com'], 'username' => 'user4', 'rating' => 2000.0);
    }
}
