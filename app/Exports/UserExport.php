<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::with('designation')
            ->select('id', 'name', 'email', 'dob', 'gender', 'phone', 'status', 'position_id')
            ->get()
            ->map(function ($user)
            {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'designation' => $user->designation ? $user->designation->designation : '',
                    'dob' => $user->dob,
                    'gender' => $user->gender,
                    'phone' => $user->phone,
                    'status' => $user->status,
                ];
            });
    }



    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Designation',
            'DOB',
            'Gender',
            'Phone',
            'Status',
        ];
    }
}
