<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserGroupTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_user_group_table_name()
    {
        $userGroup = new \App\Models\UserGroup();
        $this->assertEquals('croc_users_groups', $userGroup->getTable());
    }

    public function test_user_group_primary_key()
    {
        $userGroup = new \App\Models\UserGroup();
        $this->assertEquals(['user_id', 'grou_id'], $userGroup->getKeyName());
    }

    public function test_user_group_fillable_attributes()
    {
        $userGroup = new \App\Models\UserGroup();
        $this->assertEquals(['user_id', 'grou_id'], $userGroup->getFillable());
    }

    public function test_user_group_incrementing()
    {
        $userGroup = new \App\Models\UserGroup();
        $this->assertFalse($userGroup->incrementing);
    }

    public function test_user_group_key_type()
    {
        $userGroup = new \App\Models\UserGroup();
        $this->assertEquals('string', $userGroup->getKeyType());
    }
}