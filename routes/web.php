<?php

use App\Mail\GoodMorningEmailSendToCustomer;
use App\Models\Customer;
use App\Notifications\SendGoodMorningEmailToCustomer;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Illuminate\Support\Facades\Route;
// use Notification;

Route::get('/', function () {

    // return rand(1210, 1220);
    // return view('welcome');
    $country = "Bangladesh";
    $postCode = 1216;

    return $customers = Customer::select('id', 'name', 'email')->where(
        function ($query) use ($country, $postCode) {
            return $query
                ->whereJsonContains('address->post_code', $postCode)
                ->whereJsonContains('address->country', $country)
                ->where('id', '!=', 1);
        }
    )->delete();

    return view('mailTemplate.goodMorningMail', ['customerName' => $customers[0]->name]);

    foreach ($customers as $customer) {
        Mail::to($customer->email)->send(new GoodMorningEmailSendToCustomer($customer->name));
    }
});
