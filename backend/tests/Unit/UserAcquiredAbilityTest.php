<?php

namespace Tests\Unit;

use App\Models\UserAcquiredAbility;
use Tests\TestCase;

class UserAcquiredAbilityTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $userAcquiredAbility = new UserAcquiredAbility();

        $fillable = $userAcquiredAbility->getFillable();

        $this->assertContains('user_id', $fillable);
        $this->assertContains('abil_id', $fillable);
    }

    public function test_table_name()
    {
        $userAcquiredAbility = new UserAcquiredAbility();

        $this->assertEquals('croc_users_acquired_abilities', $userAcquiredAbility->getTable());
    }

    public function test_primary_key()
    {
        $userAcquiredAbility = new UserAcquiredAbility();

        $this->assertEquals(['user_id', 'abil_id'], $userAcquiredAbility->getKeyName());
        $this->assertFalse($userAcquiredAbility->getIncrementing());
    }

    public function test_timestamps()
    {
        $userAcquiredAbility = new UserAcquiredAbility();

        $this->assertFalse($userAcquiredAbility->timestamps);
    }

    public function test_user_relationship()
    {
        $userAcquiredAbility = new UserAcquiredAbility();
        $relation = $userAcquiredAbility->user();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('user_id', $relation->getOwnerKeyName());
    }

    public function test_ability_relationship()
    {
        $userAcquiredAbility = new UserAcquiredAbility();
        $relation = $userAcquiredAbility->ability();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('abil_id', $relation->getForeignKeyName());
        $this->assertEquals('abil_id', $relation->getOwnerKeyName());
    }
}