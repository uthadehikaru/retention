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

    public function invoiceAgent():BelongsTo
    {
        return $this->belongsTo(InvoiceAgent::class);
    }
}
