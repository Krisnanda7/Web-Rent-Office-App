<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class OfficeSpaceTransaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'is_paid',
        'started_at',
        'total_amount',
        'duration',
        'ended_at',
        'office_space_id',
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'FO';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $randomString)->exists());
        return $randomString;
    }

    public function officeSpace()
    {
        return $this->belongsTo(OfficeSpace::class, 'office_space_id');
    }
    public function show($id)
    {
        return response()->json([
            'data' => OfficeSpaceTransaction::with(['officeSpace', 'user'])->findOrFail($id)
        ]);
    }
}
