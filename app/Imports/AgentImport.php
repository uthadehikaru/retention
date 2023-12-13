<?php

namespace App\Imports;

use App\Models\Agent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgentImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $agent = Agent::where('nik',$row['nik'])->first();
            if($agent){
                $data =[
                    'name' => $row['name'],
                    'join_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['join_date'])),
                ];
                if($row['resign_date'])
                    $data['resign_date'] = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['resign_date']));
                $agent->update($data);

                $agent->user->update([
                    'email' => $row['email'],
                    'name' => $row['name'],
                ]);
            }else{
                $user = User::create([
                    'email' => $row['email'],
                    'name' => $row['name'],
                    'password' => Hash::make($row['nik']),
                    'role' => 'agent',
                ]);

                $data = [
                    'nik' => $row['nik'],
                    'name' => $row['name'],
                    'join_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['join_date'])),
                    'user_id' => $user->id,
                ];
                if($row['resign_date'])
                    $data['resign_date'] = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['resign_date']));
                $agent = Agent::create($data);
            }
        }
    }
}
