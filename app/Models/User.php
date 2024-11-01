<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     *
     */

     protected $table = 'users'; // Specify the table name if different
     protected $fillable = [
        'name',
        'department_name',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //create on the SalespersonController
    public function createUser($data)
    {
        $user = new self(); // Create a new instance of User
        $user->name = $data['name'];
        $user->department_name = $data['department_name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']); // Hash the password
        return $user->save(); // Return true/false based on save success
    }

    //edit on the SalespersonCOntroller
    public function fetchUserById($id)
    {
        return $this->findOrFail($id);
    }

    //index method in the SalespersonController
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

    //update method in the salespersonController

    public function findUserById($id)
    {
        return $this->findOrFail($id);
    }
    public function updateUser($id, array $data)
    {
        $user = $this->findUserById($id);
        $user->update($data);
        return $user;
    }

    //show method in the SalespersonController
public function findUserWithId($id)
{
    return $this->findOrFail($id);
}


    //list method in the SalespersonController
    // public function scopeSearchWithDepartment($query, $searchTerm)
    // {
    //     if ($searchTerm) {
    //         $query->whereHas('department', function ($q) use ($searchTerm) {
    //             $q->where('name', 'like', '%' . $searchTerm . '%');
    //         });
    //     }
    //     return $query->with('department');
    // }

}
