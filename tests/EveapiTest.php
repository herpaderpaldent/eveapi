<?php


namespace Seat\Eveapi\Test;


use Seat\Eveapi\Models\Character\CharacterInfo;

class EveapiTest extends TestCase
{
    public function testMigration()
    {
        $characters = CharacterInfo::all();

        $this->assertEquals(0, $characters->count());
    }

}