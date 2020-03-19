<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new GroupCollection($models);
    }

    // Relations
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault([
            'name' => '-'
        ]);
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }
}
