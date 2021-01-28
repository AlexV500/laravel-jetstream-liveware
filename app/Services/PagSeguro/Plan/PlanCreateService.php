<?php


namespace App\Services\PagSeguro\Plan;


use Illuminate\Support\Facades\Http;

class PlanCreateService
{
    private $email;
    private $token;


    public function __construct()
    {
        $this->email = config('services.pagseguro.email');
        $this->token = config('services.pagseguro.token');

    }

    public function makeRequest(array $data)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1',
            'Content-Type' => 'application/json'
        ])->post("https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/request/?email={$this->email}&token={$this->token}",
            [
                'reference' => $data['slug'],
                'preApproval' => [
                    'name' => $data['name'],
                    'charge' => 'AUTO',
                    'period' => 'MONTHLY',
                    'amountPerPayment' => number_format (($data['price'] / 100), 2),
                ]
            ]
        );

        $response = $response->json();

        return $response['code'];
    }
}