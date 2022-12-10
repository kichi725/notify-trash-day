<?php

declare(strict_types=1);

namespace App\Models\Weeks;

use App\Enum\Category;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monday extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'trash',
    ];

    // protected $casts = [
    //     'trash' => Category::class,
    // ];

    // protected function trash(): Attribute
    // {
    //     return Attribute::make(
    //         get: function ($value, $attributes) {
    //             info('monday', ['value' => $value, 'attr' => $attributes]);
    //             // return `これは{$value}です`;
    //             $a = $value->category;
    //             return `これは{$}です`;
    //         },
    //     );
    // }
}
