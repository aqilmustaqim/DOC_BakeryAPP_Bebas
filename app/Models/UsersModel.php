<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'email', 'password', 'hint', 'foto', 'role_id', 'is_active'];
}
