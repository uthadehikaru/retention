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
        self::CALL_TYPE_PHONE,
        self::CALL_TYPE_WHATSAPP,
    ];

    public const CALL_RESULT_CONTACTED = "contacted";
    public const CALL_RESULT_UNCONTACTED = "uncontacted";
    public const CALL_RESULT_DELIVERED = "delivered";

    const CALL_RESULT = [
        self::CALL_RESULT_CONTACTED,
        self::CALL_RESULT_UNCONTACTED,
        self::CALL_RESULT_DELIVERED,
    ];

    public function invoice():BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
