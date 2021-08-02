<?php

namespace App\Libraries\Api;

use GuzzleHttp\Client;
use App\Libraries\Api\CallApi;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\ClientException;

class SlightlyBigFlipApi
{

    protected $accessApi;
    protected $slightlyBigFlipUrl;

    public function __construct(CallApi $accessApi)
    {
        $this->accessApi = $accessApi;
        $this->slightlyBigFlipUrl = config('slightly_big_flip.url');
    }
    /**
     * method send data disbursement to 3rd Party slightly-Big Flip
     */

    public function accessApi($method, $suffixUrl,  $request, $body = [])
    {

        $completeUrl = $this->slightlyBigFlipUrl . $suffixUrl;
        $body = $request->all();
        $body['auth'] =  [config('slightly_big_flip.token'), ''];
        $headers = $this->setHeaders($request, $method);
        $result =  $this->accessApi->forwarderApi($method, $completeUrl, $request, $headers, $body);
        return $result;
    }

    /**
     * method for set headers
     */
    public function setHeaders($method)
    {
        $header = $this->accessApi->setHeaders($method);
        $header['Content-Type'] = 'application/x-www-form-urlencoded';
        return $header;
    }
}
