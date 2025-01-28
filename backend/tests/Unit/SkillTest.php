<?php

namespace Tests\Unit;

use App\Models\Skill;
use Tests\TestCase;

class SkillTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $skill = new Skill();

        $fillable = $skill->getFillable();

        $this->assertContains('skil_id', $fillable);
        $this->assertContains('leve_id', $fillable);
        $this->assertContains('skil_label', $fillable);
    }

    public function test_table_name()
    {
        $skill = new Skill();

        $this->assertEquals('croc_skills', $skill->getTable());
    }

    public function test_prefix()
    {
        $skill = new Skill();

        $reflection = new \ReflectionClass($skill);
        $property = $reflection->getProperty('prefix');
        $property->setAccessible(true);

        $this->assertEquals('skil_', $property->getValue($skill));
    }

    public function test_level_relationship()
    {
        $skill = new Skill();
        $relation = $skill->level();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('leve_id', $relation->getForeignKeyName());
        $this->assertEquals('leve_id', $relation->getOwnerKeyName());
    }
}