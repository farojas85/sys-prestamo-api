<?php

namespace App\Services\ApiDniRuc\Api;

use GuzzleHttp\Client;
class ApisNet
{
    private Client $client;
    private string $token;
    private array $parameters;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config("app.url_apis_net"), 'verify' => false]);
        $this->token = config('app.url_apis_net');
    }

    public function setParameters(string $numeroDocumento)
    {
        $this->parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer '.$this->token,
                'Referer' => 'https://apis.net.pe',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $numeroDocumento]
        ];
    }


    public function consultaDni(string $numeroDocumento)
    {
        $this->setParameters($numeroDocumento);

        $consulta = $this->client->request('GET','/v2/reniec/dni',$this->parameters);
        $respuesta = $consulta->getBody()->getContents();

        return json_encode($respuesta,true);
    }

    public function consultaRuc(string $numeroDocumento)
    {
        $this->setParameters($numeroDocumento);

        $consulta = $this->client->request('GET','/v2/sunat/ruc',$this->parameters);
        $respuesta = $consulta->getBody()->getContents();

        return json_encode($respuesta,true);
    }

    public function consultaTipoCambio(string $numeroDocumento)
    {
        $this->setParameters($numeroDocumento);

        $consulta = $this->client->request('GET','/v2/sunat/tipo-cambio',$this->parameters);
        $respuesta = $consulta->getBody()->getContents();

        return json_encode($respuesta,true);
    }

}
