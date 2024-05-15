<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role_id' => '3',
            'status' => '1'
        ]);
    }
}
