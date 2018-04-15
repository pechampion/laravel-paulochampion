<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
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
    protected $table = 'files';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',	'name',	'folder_id', 'user_id', 'size', 'path', 'created_at', 'updated_at',
    ];
    /**
     * The foreign keys of model
     *
     * @var int
     */
    public function folder()
    {
        return $this->hasOne('App\Folder', 'foreign_key', 'folder_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'foreign_key', 'user_id');
    }

}
