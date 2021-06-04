<?php

namespace App\Http\Controllers;

use App\Models\User;
use Notification;
use App\Notifications\OffersNotification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }

    public function sendOfferNotification()
    {
        $userSchema = User::first();

        $offerData = [
            'name' => $userSchema->name,
            'body' => 'You received an offer.',
            'thanks' => 'Thank you',
            'offerText' => 'Check out the offer',
            'offerUrl' => url('/'),
            'offer_id' => 007
        ];

        Notification::send($userSchema, new OffersNotification($offerData));

        dd('Message Sent ! Check Your Mail');
    }
}
