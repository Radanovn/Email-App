<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'first_name', 'last_name', 'email'];

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new ContactCollection($models);
    }

    // Relations
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault([
            'name' => '-'
        ]);
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    // Helper functions
    public function fullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
