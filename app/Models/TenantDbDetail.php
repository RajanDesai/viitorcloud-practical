<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantDbDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 'db_name', 'db_host', 'db_port', 'db_username', 'db_password'
    ];

    /**
     * Decrypt db name
     */
    public function getDbNameAttribute()
    {
        return decrypt($this->attributes['db_name']);
    }

    /**
     * Decrypt db username
     */
    public function getDbUsernameAttribute()
    {
        return decrypt($this->attributes['db_username']);
    }

    /**
     * Decrypt db password
     */
    public function getDbPasswordAttribute()
    {
        return decrypt($this->attributes['db_password']);
    }
}
