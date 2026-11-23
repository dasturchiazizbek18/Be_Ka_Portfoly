<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasTranslations;

    protected $fillable = [
        'period',
        'company',
        'role_uz',
        'role_ru',
        'role_en',
        'description_uz',
        'description_ru',
        'description_en',
        'sort_order',
    ];
}
