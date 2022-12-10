<?php

declare(strict_types=1);

namespace App\Models\Weeks;

use App\Enum\Trashes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sunday extends Model
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

    protected $casts = [
        'trash' => Trashes::class,
    ];

    // protected function trash()
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $value ?? 'なし',
    //     );
    // }
}
