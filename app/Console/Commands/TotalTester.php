<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
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
        $this->user = User::find(2);

//        $this->testCharge();
//        $this->testChargeCreateRegistration();
//        $this->testCreateRegistration();
        $this->testSubscribe();
//        $this->testRefund();
//        $this->testCancelSubscription();

        $this->info('Done... '.$this->user->email);
    }

    private function testChargeCreateRegistration() {
        $paymentData = [
            'amount' => '97.00',
            'paymentBrand' => 'VISA',
            'card.number' => '4200000000000000',
            'card.holder' => 'Jane Jones',
            'card.expiryMonth' => '05',
            'card.expiryYear' => '2019',
            'card.cvv' => '123',
        ];

        $response = $this->user->charge($paymentData, true);
        dd($response);
    }
    private function testCharge() {

        $paymentData = [
            'amount' => '20.00',
            'paymentBrand' => 'VISA',
            'paymentType' => 'DB',
            'card.number' => '4200000000000000',
            'card.holder' => 'Jane Jones',
            'card.expiryMonth' => '05',
            'card.expiryYear' => '2019',
            'card.cvv' => '123',
        ];

        $response = $this->user->charge($paymentData);
        dd($response);
    }
    private function testSubscribe() {

        $paymentData = [
            'paymentBrand' => 'VISA',
            'card.number' => '4200000000000000',
            'card.holder' => 'Jane Jones',
            'card.expiryMonth' => '05',
            'card.expiryYear' => '2019',
            'card.cvv' => '123',
        ];

        $response = $this->user->register($paymentData);

        if($response && isset($response['id'])) {

            $paymentData = [
                'amount' => '17.00',
            ];

            $response = $this->user->subscribe(1, Carbon::now()->toDateTimeString(), $paymentData);
            dd($response);
        } else {
            dd($response);
        }
    }
    private function testCreateRegistration() {

        $paymentData = [
            'paymentBrand' => 'VISA',
            'card.number' => '4200000000000000',
            'card.holder' => 'Jane Jones',
            'card.expiryMonth' => '05',
            'card.expiryYear' => '2019',
            'card.cvv' => '123',
        ];

        $response = $this->user->register($paymentData);
        dd($response);
    }
    private function testRefund() {
        $response = $this->user->refund('8a82944963f3154c0163f84e8a913e07', 15.00);
        dd($response);
    }
    private function testCancelSubscription() {
        $response = $this->user->cancelSubscription(1);
        dd($response);
    }
}
