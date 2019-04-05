<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 03.10.2018
 * Time: 19:27
 */

namespace Seat\Eveapi\Test;

use Herpaderpaldent\Seat\SeatGroups\GroupsServiceProvider;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Seat\Eveapi\EveapiServiceProvider;
use Seat\Eveapi\Models\Character\CharacterInfo;
use Seat\Eveapi\Models\RefreshToken;
use Seat\Services\ServicesServiceProvider;
use Seat\Web\Models\Group;
use Seat\Web\Models\User;
use Seat\Web\WebServiceProvider;

abstract class TestCase extends OrchestraTestCase
{

    protected $test_user;

    protected $group;
    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();

        // setup database
        $this->setupDatabase($this->app);
        $this->withFactories(__DIR__ . '/database/factories');
    }

    protected function setupDatabase($app)
    {
        // Path to our migrations to load
        $this->artisan('migrate', ['--database' => 'testbench']);

    }

    /**
     * Get application providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Orchestra\Database\ConsoleServiceProvider::class,
            EveapiServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Use memory SQLite, cleans it self up
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

}