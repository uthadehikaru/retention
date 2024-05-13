<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    public const CALL_TYPE_PHONE = "phone";
    public const CALL_TYPE_WHATSAPP = "whatsapp";

    const CALL_TYPE = [
        'phone' => self::CALL_TYPE_PHONE,
        'whatsapp' => self::CALL_TYPE_WHATSAPP,
    ];

    public const CALL_RESULT_CONTACTED = "contacted";
    public const CALL_RESULT_UNCONTACTED = "uncontacted";
    public const CALL_RESULT_DELIVERED = "delivered";

    const CALL_RESULT = [
        'contacted' => self::CALL_RESULT_CONTACTED,
        'uncontacted' => self::CALL_RESULT_UNCONTACTED,
        'delivered' => self::CALL_RESULT_DELIVERED,
    ];

    const CALL_RESPONSE_CONTACTED = [
        'Masalah Keuangan' => "Masalah Keuangan",
        'Pindah Rumah' => 'Pindah Rumah',
        'Janji Bayar' => 'Janji Bayar',
        'Internet Lambat' => 'Internet Lambat',
        'Internet Sering Mati' => 'Internet Sering Mati',
        'Sales tidak menepati janji' => 'Sales tidak menepati janji',
        'Pembayaran Susah' => 'Pembayaran Susah',
        'Move to Competitor' => 'Move to Competitor',
        'Perbaikan Lama' => 'Perbaikan Lama',
    ];

    const CALL_RESPONSE_UNCONTACTED = [
        'RNA' => 'RNA',
        'Invalid Number' => 'Invalid Number',
        'Mailbox' => 'Mailbox',
        'Busy' => 'Busy',
    ];

    public function invoiceAgent():BelongsTo
    {
        return $this->belongsTo(InvoiceAgent::class);
    }

    public function promo():BelongsTo
    {
        return $this->belongsTo(Promo::class);
    }
}
