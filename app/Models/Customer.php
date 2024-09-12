<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['name', 'email', 'phone', 'address'];



    public static function customersWithCountryPostCode($country, $postCode)
    {
        $customers = Customer::select('id', 'name', 'email')->where(
            function ($query) use ($country, $postCode) {
                return $query
                    ->whereJsonContains('address->post_code', $postCode)
                    ->whereJsonContains('address->country', $country);
            }
        )->get();

        return $customers;
    }
}
