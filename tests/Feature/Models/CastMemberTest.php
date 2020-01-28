<?php

namespace Tests\Feature\Models;

use App\Models\CastMember;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CastMemberTest extends TestCase
{
    use DatabaseMigrations;

    public function testList()
    {
        factory(CastMember::class, 1)->create();

        $castMembers = CastMember::all();
        $castMemberKeys = array_keys($castMembers->first()->getAttributes());

        $this->assertCount(1, $castMembers);

        $this->assertEquals([
            'id',
            'name',
            'type',
            'created_at',
            'updated_at',
            'deleted_at'
        ], $castMemberKeys);
    }

    public function testCreate()
    {
        $castMember = CastMember::create(['name' => 'test1', 'type' => CastMember::TYPE_DIRECTOR]);
        $castMember->refresh();

        $this->assertEquals(36, strlen($castMember->id));
        $this->assertEquals('test1', $castMember->name);
        $this->assertEquals(CastMember::TYPE_DIRECTOR, $castMember->type);
    }

    public function testUpdate()
    {
        /** @var CastMember $castMember */
        $castMember = factory(CastMember::class)->create([
            'type' => CastMember::TYPE_DIRECTOR
        ]);

        $data = [
            'name' => 'name_updated',
            'type' => CastMember::TYPE_ACTOR
        ];
        $castMember->update($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $castMember->{$key});
        }
    }

    public function testDelete()
    {
        /** @var CastMember $castMember */
        $castMember = factory(CastMember::class)->create();
        $castMember->delete();
        $this->assertNull(CastMember::find($castMember->id));

        $castMember->restore();
        $this->assertNotNull(CastMember::find($castMember->id));
    }
}
