<?php

namespace App\Imports;

use App\Contact;
use Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'user_id' => Auth::user()->id,
            'first_name' => $row[0],
            'last_name' => $row[1],
            'email' => $row[2]
        ]);
    }
}
