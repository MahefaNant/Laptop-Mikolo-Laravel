<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SampleExport implements FromCollection, WithHeadings
{
    /**
    * @return Collection
    */
    public function collection()
    {
        $users = User::all();

        $users = $users->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'calcule' => $user->calcule(),
            ];
        });


        return $users;
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Calcule'];
    }
}
