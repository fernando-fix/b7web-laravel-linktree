<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'slug',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function search($filter = [])
    {
        return User::where(function ($query) use ($filter) {
            if (isset($filter['name']))
                $query->where('name', 'like', "%{$filter['name']}%");
        });
    }

    /**
     * Bootstrap any model services or events.
     */
    public static function boot(): void
    {
        parent::boot();

        static::saving(function ($user) {
            if (empty($user->slug) && !empty($user->username)) {
                $user->slug = Str::slug($user->username, '-'); // Gera o slug do username
            }
        });
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }
}
