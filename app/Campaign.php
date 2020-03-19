<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Campaign extends Model
{
    // Relations
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function status()
    {
        return $this->belongsTo('App\CampaignStatus');
    }

    public function template()
    {
        return $this->belongsTo('App\CampaignTemplate');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }

    // Helper functions
    public function deleteLogo()
    {
        if (Storage::disk('local')->exists('logos/'.$this->image)) {
            Storage::disk('local')->delete('logos/'.$this->image);
        }

        return true;
    }
}
