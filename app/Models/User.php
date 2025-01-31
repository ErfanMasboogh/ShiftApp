<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    public static function createUser($name, $email, $password,$role_id = 1): User{
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role_id = $role_id;
        return $user;
    }
    public static function updateUser(User $user): User{
        $user->save();
        return $user;
    }
    public static function deleteUser(int $id): bool{
        return User::find($id)->delete();
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function commutes()
    {
        return $this->hasMany(Commute::class);

    }
    public function payments()
    {
        return $this->hasMany(Payment::class);

    }
    public function commuteDetails()
    {
        return $this->hasMany(CommuteDetail::class);

    }

}
