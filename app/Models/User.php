<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Contracts\Auth\MustVerifyEmail;
=======
// use Illuminate\Contracts\Auth\MustVerifyEmail;
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

<<<<<<< HEAD
class User extends Authenticatable implements MustVerifyEmail
{
=======
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
<<<<<<< HEAD
     * @var array<int, string>
=======
     * @var list<string>
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
     */
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
=======
        'role',
        'subscription_status',
        'suspended_until',
        'profile_photo',
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
<<<<<<< HEAD
     * @var array<int, string>
=======
     * @var list<string>
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
<<<<<<< HEAD
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
=======
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'suspended_until' => 'datetime',
        ];
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function moderatedForums()
    {
        return $this->belongsToMany(Forum::class, 'forum_user');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class)->withPivot('assigned_at')->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isModerator(): bool
    {
        return $this->role === 'moderator';
    }

    public function isSuspended(): bool
    {
        return $this->suspended_until && $this->suspended_until->isFuture();
    }

    public function hasActiveSubscription(): bool
    {
        return $this->subscription_status === 'active';
    }

    /**
     * Get the profile photo URL or return null
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        if ($this->profile_photo) {
            return \Illuminate\Support\Facades\Storage::url($this->profile_photo);
        }
        return null;
    }
>>>>>>> a1fd054322ab54ed5b743f83ff0083053b55df6f
}
