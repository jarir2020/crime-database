<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

trait SelfHealing
{
    /**
     * Boot the trait.
     */
    protected static function bootSelfHealing()
    {
        static::healTable();
    }

    /**
     * Check and heal the table structure.
     */
    protected static function healTable()
    {
        $instance = new static;
        $table = $instance->getTable();
        $schema = method_exists($instance, 'getSchemaDefinition') ? $instance->getSchemaDefinition() : [];

        if (!Schema::hasTable($table)) {
            Schema::create($table, function (Blueprint $table) use ($schema) {
                $table->id();
                foreach ($schema as $column => $type) {
                    if ($type === 'rememberToken') {
                        $table->rememberToken();
                    } else {
                        $table->{$type}($column)->nullable();
                    }
                }
                $table->timestamps();
            });
            return;
        }

        // Check for missing columns
        foreach ($schema as $column => $type) {
            if ($type === 'rememberToken') {
                if (!Schema::hasColumn($table, 'remember_token')) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->rememberToken();
                    });
                }
            } elseif (!Schema::hasColumn($table, $column)) {
                Schema::table($table, function (Blueprint $table) use ($column, $type) {
                    $table->{$type}($column)->nullable();
                });
            }
        }
    }
}
