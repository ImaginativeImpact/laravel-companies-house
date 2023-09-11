<?php

namespace ImaginativeImpact\LaravelCompaniesHouse\Traits;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

trait GuzzleClientTrait {
    /**
     * Set the base url that all API requests use
     * @var string
     */
    protected static $baseUrl = 'https://api.companieshouse.gov.uk/';

    /**
     * __call catches all requests when no found method is requested
     * @param $function
     * @param $args
     * @return string
     * @throws Exception
     * @throws GuzzleException
     */
    public function __call($function, $args)
    {
        $options = ['get'];
        $path = (isset($args[0])) ? $args[0] : null;

        if (in_array($function, $options)) {
            return self::guzzle($path);
        } else {
            //request verb is not in the $options array
            throw new Exception($function.' is not a valid HTTP Verb');
        }
    }

    /**
     * @param $request
     * @return mixed
     * @throws GuzzleException
     */
    protected function guzzle($request)
    {
        try {
            $client = new Client;

            $response = $client->get(self::$baseUrl.$request, [
                'headers' => [
                    'Authorization' => config('companieshouse.apiKey'),
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (Exception $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }
}