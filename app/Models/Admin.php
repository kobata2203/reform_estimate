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
        'department_id',
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
    public function searchAdmin($keyword = null)
    {
        $ad_table = $this->table;
        $d_table = 'departments';
        $ad_table_join = $ad_table. '.';
        $d_table_join = $d_table. '.';

        $columns = [
            $ad_table_join . 'id',
            $ad_table_join . 'name',
            $ad_table_join . 'department_id',
            $ad_table_join . 'email',
        ];

        $query = $this->select($columns);

        $query->leftJoin($d_table, $ad_table . '.department_id', '=', $d_table_join . 'id');

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword, $ad_table_join, $d_table_join) {
                $query->orWhere($ad_table_join . 'name', 'LIKE', "%{$keyword}%")
                    ->orWhere($ad_table_join . 'email', 'LIKE', "%{$keyword}%")
                    ->orWhere($d_table_join . 'name', 'LIKE', "%{$keyword}%");
            });
        }

        $query->groupBy($columns)
            ->orderBy($ad_table_join . 'created_at', 'asc');

        return $query->get();
    }

    // Method to create a new admin
    public function createAdmin($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department_id' => $data['department_id'],
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

        $admin->department_id = $data['department_id'];

        // Save the updated model and return the result
        return $admin->save();
    }
}
