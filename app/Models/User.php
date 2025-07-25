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
        'email',
        'password',
        'dni',
        'phone',
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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn(string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    // Si el usuario es cliente
    public function photoshootsAsClient()
    {
        return $this->hasMany(Photoshoot::class, 'client_id');
    }

    public function packs()
    {
        if (!$this instanceof Photographer) {
            return null; // o throw new Exception('Not a photographer');
        }
        return $this->hasMany(Pack::class, 'photographer_id');
    }

    public function products()
    {
        if (!$this instanceof Photographer) {
            return null; // o throw new Exception('Not a photographer');
        }
        return $this->hasMany(Product::class, 'photographer_id');
    }

    public function photoshoots()
    {
        if (!$this instanceof Photographer) {
            return null; // o throw new Exception('Not a photographer');
        }
        return $this->hasMany(Photoshoot::class, 'photographer_id');
    }
}
