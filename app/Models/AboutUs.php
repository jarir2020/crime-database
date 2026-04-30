<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SelfHealing;

class AboutUs extends Model
{
    use HasFactory, SelfHealing;

    protected $table = 'about_us';
    protected $fillable = ['text'];

    /**
     * Define the schema for auto-healing.
     */
    public function getSchemaDefinition(): array
    {
        return [
            'text' => 'text',
        ];
    }
}
