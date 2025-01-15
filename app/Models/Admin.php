<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends User
{
    use HasFactory, Notifiable;

    protected $table = 'admins'; // Specify the table name if different
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

    // Adminテーブルのデータ検索
    public static function searchAdmin($keyword = null)
    {
        $query = self::query();

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhere('department_name', 'LIKE', "%{$keyword}%");
            });
        }

        return $query->get();
    }

    // Method to create a new admin
    public function createAdmin($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department_name' => $data['department_name'],
        ]);
    }

    public function deleteAdmin($id)
    {
        $admin = $this->findOrFail($id);
        $admin->delete($id);
        return $admin;
    }

    // 編集機能
    public static function findAdminById($id)
    {
        return self::findOrFail($id);
    }

    // Update on admins
    public static function updateAdmin($id, $data)
    {
        // Retrieve the admin by id
        $admin = self::findOrFail($id); // This will fetch the admin model by its ID, or fail if not found

        // Update the admin model with the validated data
        $admin->name = $data['name'];
        $admin->email = $data['email'];

        // Update password only if it's provided
        if (!empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }

        $admin->department_name = $data['department_name'];

        // Save the updated model and return the result
        return $admin->save();
    }
}
