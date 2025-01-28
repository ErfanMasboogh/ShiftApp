<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function createRole($name, $over_payment): Role{
        $role = new Role();
        $role->name = $name;
        $role->over_payment = $over_payment;
        $role->save();
        return $role;
    }
    public function deleteRole($id){
        $role = Role::find($id);
        $role->delete();
        return $role;
    }
    public function updateRole(Role $role): Role{
        $role->save();
        return $role;
    }
}
