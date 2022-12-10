<?php

declare(strict_types=1);

namespace App\Models\Users;

use App\Models\Weeks\{Friday, Monday, Saturday, Sunday, Thursday, Tuesday, Wednesday};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function monday(): HasOne
    {
        return $this->hasOne(Monday::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tuesday(): HasOne
    {
        return $this->hasOne(Tuesday::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wednesday(): HasOne
    {
        return $this->hasOne(Wednesday::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thursday(): HasOne
    {
        return $this->hasOne(Thursday::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function friday(): HasOne
    {
        return $this->hasOne(Friday::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function saturday(): HasOne
    {
        return $this->hasOne(Saturday::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sunday(): HasOne
    {
        return $this->hasOne(Sunday::class, 'user_id', 'user_id');
    }
}
