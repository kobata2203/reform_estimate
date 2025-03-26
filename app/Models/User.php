<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_SALES = 'sales';

    protected $table = 'users';
    protected $fillable = [
        'name',
        'department_id',
        'email',
        'password',
        'role',
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
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'department_id' => $data['department_id'],
            'password' => Hash::make($data['password']),
            'role' => self::ROLE_SALES,
        ]);
    }

    public function fetchUserById($id)
    {
        return $this->findOrFail($id);
    }

    public function searchUsers($keyword, $users)
    {
        $us_table = $this->table;
        $d_table = 'departments';
        $us_table_join = $us_table . '.';
        $d_table_join = $d_table . '.';

        $columns = [
            $us_table_join . 'id',
            $us_table_join . 'name',
            $us_table_join . 'department_id',
            $us_table_join . 'email',
        ];

        $query = $this->select($columns);

        $query->leftJoin($d_table, $us_table . '.department_id', '=', $d_table_join . 'id');

        if ($users) {
            $query->where($us_table . '.role', $users);
        }

        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword, $us_table_join, $d_table_join) {
                $query->orWhere($us_table_join . 'name', 'LIKE', "%{$keyword}%")
                    ->orWhere($us_table_join . 'email', 'LIKE', "%{$keyword}%")
                    ->orWhere($d_table_join . 'name', 'LIKE', "%{$keyword}%");
            });
        }

        $query->groupBy($columns)
            ->orderBy($us_table_join . 'created_at', 'asc');

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

    public function searchAdmin($keyword = null)
    {
        return self::where('role', self::ROLE_ADMIN)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('email', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('department', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', "%{$keyword}%");
                    });
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function createAdmin($data)
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department_id' => $data['department_id'],
            'role' => self::ROLE_ADMIN,
        ]);
    }

    public function deleteAdmin($id)
    {
        $admin = self::where('role', self::ROLE_ADMIN)->findOrFail($id);
        return $admin->delete();
    }

    public static function findAdminById($id)
    {
        return self::where('role', self::ROLE_ADMIN)->findOrFail($id);
    }

    public static function updateAdmin($id, $data)
    {
        $admin = self::where('role', self::ROLE_ADMIN)->findOrFail($id);

        $admin->name = $data['name'];
        $admin->email = $data['email'];

        if (!empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }

        $admin->department_id = $data['department_id'];

        return $admin->save();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
