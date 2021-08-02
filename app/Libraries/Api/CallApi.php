<?php

namespace App\Libraries\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class CallApi
{
    /**
     * method for call api eksternal
     */
    public function forwarderApi($method, $url, $request, $headers, $body = [])
    {
        $statusCode = ['200', '404', '422', '401'];
        $statusCodeError = ['500', '400', '414'];

        $data = [];
        $data['headers'] = $headers;

        empty($body) ? $input = $request->all() : $input = $body;

        $method == 'GET' ? $data['query'] = $input : $data['form_params'] = $input;

        $data['connect_timeout'] = 3;
        $data['auth'] =  [config('slightly_big_flip.token'), ''];
        $http = new Client();
        $tryAgain = 0;
        $countTry = 0;
        do {
            try {
                $response = $http->request($method, $url, $data);
                $tryAgain = 0;
            } catch (ClientException $e) {
                $tryAgain = 1;
                $countTry++;
                $response = $e->getResponse();
                $responseBodyAsJson = $response->getBody()->getContents();

                if (in_array($response->getStatusCode(), $statusCodeError) && $countTry == 3) {
                    $result = ['data' => json_decode($responseBodyAsJson, true), 'code' => $response->getStatusCode()];
                    return $result;
                }
            }
        } while ($tryAgain && $countTry < 3);

        if (in_array($response->getStatusCode(), $statusCode)) {
            $result = ['data' => json_decode($response->getBody(), true), 'code' => $response->getStatusCode()];
            return $result;
        } else {
            return ['data' => json_decode($response->getBody(), true), 'code' => $response->getStatusCode()];
        }
    }

    /**
     * method for set headers general
     */
    public function setHeaders($method)
    {
        $headers['Accept'] = 'application/json';
        if ($method == 'PUT') {
            $header['Content-Type'] = 'application/x-www-form-urlencoded';
        }
        return $headers;
    }
}
