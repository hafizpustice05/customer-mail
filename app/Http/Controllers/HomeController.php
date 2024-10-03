<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    public function customersWithCountryPostCode()
    {
        $country = "Bangladesh";
        $postCode = 1216;
        $customers = Cache::remember('customers', 60 * 60, function () {
            return Customer::all();
        });

        // select('id', 'name', 'email')->where(
        //     function ($query) use ($country, $postCode) {
        //         return $query
        //             ->whereJsonContains('address->post_code', $postCode)
        //             ->whereJsonContains('address->country', $country);
        //     }
        // )->get();

        return $customers;
    }

    function create()
    {
        $address = array(
            'country' => \fake()->country(),
            'city' => \fake()->city(),
            // 'post_code' => \fake()->postcode(),
            'post_code' => rand(1210, 1240),
        );

        return Customer::create([
            'name' => $name = fake()->word(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '+8801750',
            'address' => json_encode($address)
        ]);
    }
}
