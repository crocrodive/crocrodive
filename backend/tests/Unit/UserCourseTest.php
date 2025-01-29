<?php

namespace Tests\Unit;

use App\Models\UserCourse;
use Tests\TestCase;

class UserCourseTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $userCourse = new UserCourse();

        $fillable = $userCourse->getFillable();

        $this->assertContains('user_id', $fillable);
        $this->assertContains('cour_id', $fillable);
    }

    public function test_table_name()
    {
        $userCourse = new UserCourse();

        $this->assertEquals('croc_users_courses', $userCourse->getTable());
    }

    public function test_primary_key()
    {
        $userCourse = new UserCourse();

        $this->assertEquals(['user_id', 'cour_id'], $userCourse->getKeyName());
    }

    public function test_timestamps()
    {
        $userCourse = new UserCourse();

        $this->assertFalse($userCourse->timestamps);
    }

    public function test_user_relationship()
    {
        $userCourse = new UserCourse();
        $relation = $userCourse->user();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('user_id', $relation->getOwnerKeyName());
    }

    public function test_course_relationship()
    {
        $userCourse = new UserCourse();
        $relation = $userCourse->course();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('cour_id', $relation->getForeignKeyName());
        $this->assertEquals('cour_id', $relation->getOwnerKeyName());
    }
}