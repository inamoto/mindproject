<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['userid', 'uuid', 'title', 'mindmap','gantt'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
     public function user()
     {
         return $this->belongsTo('App/User');
     }

}
