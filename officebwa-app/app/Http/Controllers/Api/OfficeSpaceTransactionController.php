<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficeSpaceTransactionRequest;
use App\Http\Resources\Api\OfficeSpaceTransactionResource;
use App\Models\OfficeSpace;
use App\Models\OfficeSpaceTransaction;
use Illuminate\Http\Request;

class OfficeSpaceTransactionController extends Controller
{
    public function booking_details (Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string',
            'booking_trx_id' => 'required|string',
        ]);

        $booking = OfficeSpaceTransaction::where('phone_number', $request->phone_number)
        ->where('booking_trx_id', $request->booking_trx_id)
        ->with(['officeSpace', 'officeSpace.city'])
        ->first();
        
        if (! $booking) {
            return response()->json([
                'message' => 'Booking not found'
            ], 404);
        }

        return new OfficeSpaceTransactionResource($booking);
    }

    //
    public function store (StoreOfficeSpaceTransactionRequest $request)
     {  
        $validateData = $request->validated();

        $officeSpace = OfficeSpace::find($validateData['office_space_id']);

        $validateData['is_paid'] = false;

        $validateData['booking_trx_id'] = OfficeSpaceTransaction::generateUniqueTrxId();

        $validateData['duration'] = $officeSpace->duration;

        $validateData['ended_at'] = (new \DateTime($validateData['started_at']))
        ->modify("+ {$officeSpace->duration} days")->format('y-m-d');;

        $officeSpaceTransaction = OfficeSpaceTransaction::create($validateData);

        //mengirim notifikasi melalui sms atau whatsapp dengan twilio

        //mengembalikan response hasil transaksi
         $officeSpaceTransaction->load('officeSpace');
         return new OfficeSpaceTransactionResource($officeSpaceTransaction);
     }
    }
