<?php

namespace Tests\Unit;

use App\Models\Town;
use Tests\TestCase;

class TownTest extends TestCase
{
    public function test_fillable_attributes()
    {
        $town = new Town();

        $fillable = $town->getFillable();

        $this->assertContains('town_insee', $fillable);
        $this->assertContains('town_postal_code', $fillable);
        $this->assertContains('town_name', $fillable);
    }

    public function test_table_name()
    {
        $town = new Town();

        $this->assertEquals('croc_towns', $town->getTable());
    }

    public function test_prefix()
    {
        $town = new Town();

        $reflection = new \ReflectionClass($town);
        $property = $reflection->getProperty('prefix');
        $property->setAccessible(true);

        $this->assertEquals('town_', $property->getValue($town));
    }

    public function test_primary_key()
    {
        $town = new Town();

        $this->assertEquals('town_insee', $town->getKeyName());
        $this->assertFalse($town->getIncrementing());
    }

    public function test_timestamps()
    {
        $town = new Town();

        $this->assertFalse($town->timestamps);
    }
}