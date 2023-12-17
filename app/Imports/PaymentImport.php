<?php

namespace App\Imports;

use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PaymentImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $invoice = Invoice::where('invoice_no',$row['invoice_no'])->firstOrFail();

            $data = [
                'invoice_id' => $invoice->id,
                'payment_date' => $this->convertDate($row['payment_date']),
            ];
            Payment::updateOrCreate($data,['amount'=>$row['amount']]);
        }
    }

    private function convertDate($value)
    {
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
    }
}
