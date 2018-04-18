<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class TotalTester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'total:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test total processing api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->user = User::find(1);
        $this->testCreateRegistration();

        $this->info('Done... '.$this->user->email);
    }

    private function testCreateRegistration() {

        $paymentData = [
            'amount' => 98.20,
            'paymentBrand' => 'VISA',
            'paymentType' => 'DB',
            'card.number' => '4200000000000000',
            'card.holder' => 'Jane Jones',
            'card.expiryMonth' => '05',
            'card.expiryYear' => '2018',
            'card.cvv' => '123',
        ];

        $response = $this->user->createRegistration($paymentData);
        dd($response);
    }

    private function test() {
        $url = "https://test.oppwa.com/v1/payments";
        $data = "authentication.userId=8a829417567d952801568d9d9e9f0b88" .
            "&authentication.password=jay27at5s2" .
            "&authentication.entityId=8a829417567d952801568d9d9e3c0b84" .
            "&amount=92.00" .
            "&currency=GBP" .
            "&paymentBrand=VISA" .
            "&paymentType=DB" .
            "&card.number=4200000000000000" .
            "&card.holder=Jane Jones" .
            "&card.expiryMonth=05" .
            "&card.expiryYear=2018" .
            "&card.cvv=123" .
            "&createRegistration=true";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }
}
