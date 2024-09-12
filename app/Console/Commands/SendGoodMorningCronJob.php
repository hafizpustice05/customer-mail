<?php

namespace App\Console\Commands;

use App\Mail\GoodMorningEmailSendToCustomer;
use App\Models\Customer;
use App\Notifications\SendGoodMorningEmailToCustomer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendGoodMorningCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-good-morning-cron-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $country = "Bangladesh";
        $postCode = 1216;

        $customers = Customer::select('id', 'name', 'email')->where(
            function ($query) use ($country, $postCode) {
                return $query
                    ->whereJsonContains('address->post_code', $postCode)
                    ->whereJsonContains('address->country', $country);
            }
        )->get();

        foreach ($customers as $customer) {
            Mail::to($customer->email)->send(new GoodMorningEmailSendToCustomer($customer->name));
        }
    }
}
