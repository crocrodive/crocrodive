<?php

namespace Tests\Unit;
use App\Models\Site;
use App\Models\Town;
use Tests\TestCase;


class SiteTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $site = new Site();

        $fillable = $site->getFillable();

        $this->assertContains('site_id', $fillable);
        $this->assertContains('town_insee', $fillable);
        $this->assertContains('site_name', $fillable);
        $this->assertContains('site_address', $fillable);
    }

    public function test_table_name()
    {
        $site = new Site();

        $this->assertEquals('croc_sites', $site->getTable());
    }

    public function test_prefix()
    {
        $site = new Site();

        $reflection = new \ReflectionClass($site);
        $property = $reflection->getProperty('prefix');
        $property->setAccessible(true);

        $this->assertEquals('site_', $property->getValue($site));
    }

    public function test_town_relationship()
    {
        $site = new Site();
        $relation = $site->town();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relation);
        $this->assertEquals('town_insee', $relation->getForeignKeyName());
        $this->assertEquals('town_insee', $relation->getOwnerKeyName());
    }
}