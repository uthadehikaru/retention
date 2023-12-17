<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoiceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $customer = Customer::where('billing_account',$row['billing_account'])->firstOrFail();

            $data = [
                'customer_id' => $customer->id,
                'invoice_date' => $this->convertDate($row['invoice_date']),
                'total_amount' => $row['total_amount'],
            ];
            
            if($row['suspend_date'])
                $data['suspend_date'] = $this->convertDate($row['suspend_date']);
            if($row['terminate_date'])
                $data['terminate_date'] = $this->convertDate($row['terminate_date']);
            Invoice::updateOrCreate([
                'invoice_no' => $row['invoice_no'],
            ],$data);
        }
    }

    private function convertDate($value)
    {
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    }
}
