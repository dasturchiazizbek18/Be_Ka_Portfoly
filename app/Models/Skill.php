<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name_uz',
        'name_ru',
        'name_en',
        'subtitle_uz',
        'subtitle_ru',
        'subtitle_en',
        'type',
        'level',
        'sort_order',
    ];
}
