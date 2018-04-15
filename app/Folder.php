<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    /**
     * The primary key of model
     *
     * @var int
     */
    protected $primaryKey = 'id';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'folders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',	'name',	'sub_id', 'user_id',
    ];
    /**
     * The foreign keys of model
     *
     * @var int
     */
    public function sub()
    {
        return $this->hasOne('App\Folder', 'foreign_key', 'sub_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'foreign_key', 'user_id');
    }

}
