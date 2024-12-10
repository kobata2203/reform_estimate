<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // Specify the table name if different
    protected $fillable = [
        'name',
        'department_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createUser($data)
    {
        $user = new self(); // Create a new instance of User
        $user->fill($data);
        $user->password = Hash::make($data['password']); // Hash the password
        return $user->save(); // Return true/false based on save success
    }

    public function fetchUserById($id)
    {
        return $this->findOrFail($id);
    }

    public static function searchUsers($keyword)
    {
        $query = self::query();

        if (!empty($keyword)) {
            $query->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('department_name', 'LIKE', "%{$keyword}%");
        }

        return $query->get();
    }

    public function updateUser($id, array $data)
    {
        $user = $this->findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->findOrFail($id);
        $user->delete($id);
        return $user;
    }

    public function findUserWithId($id)
    {
        return $this->findOrFail($id);
    }

    public function scopeSearchWithDepartment($query, $searchTerm)
    {
        if ($searchTerm) {
            $query->whereHas('department', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }
        return $query->with('department');
    }
}
