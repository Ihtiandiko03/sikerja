<?php
// app/Services/Oauth2Client.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class Oauth2Client
{
    public $client_id;
    public $client_secret;
    public $redirect_uri;
    public $scope;

    public function __construct()
    {
        $config = config('sso');

        $this->client_id = $config['client_id'];
        $this->client_secret = $config['client_secret'];
        $this->redirect_uri = $config['redirect_uri'];
        $this->scope = $config['scope'];
    }

    public function userAuthentication($providerAuthUri, $moreArgs = [], $returnUri = false)
    {
        $args = array_merge([
            'client_id' => $this->client_id,
            'redirect_uri' => $this->redirect_uri,
        ], $moreArgs);

        $url = $providerAuthUri . '?' . http_build_query($args);

        if ($returnUri) {
            return $url;
        }

        return redirect($url);
    }

    public function getAccessToken($providerTokenUri, $code, $httpMethod = 'GET', $moreArgs = [])
    {
        $args = array_merge([
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $code,
            'redirect_uri' => $this->redirect_uri,
        ], $moreArgs);

        if ($httpMethod === 'POST') {
            $response = Http::asForm()->post($providerTokenUri, $args);
        } else {
            $response = Http::get($providerTokenUri, $args);
        }

        return $response->body();
    }

    public function accessUserResources($providerUri, $accessToken, $httpMethod = 'GET', $moreArgs = [])
    {
        $args = array_merge([
            'access_token' => $accessToken,
            'scope' => $this->scope,
        ], $moreArgs);

        if ($httpMethod === 'POST') {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->post($providerUri, $args);
        } else {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
            ])->get($providerUri, $args);
        }

        return $response->body();
    }
}
