<?php namespace Rap2hpoutre\HttpClient;

class Client 
{

    private function request($method, $server, $path, $query)
    {
        $client = new \GuzzleHttp\Client();
        
        $params = config("http-client.servers.$server.request_options");
        $params[($method == 'POST' || $method == 'PUT' || $method == 'PATCH') ? 'form_params' : 'query'] = $query;
        $params['http_errors'] = false;
        
        $guzzle_response = $client->request(
            $method, 
            $path, 
            $params
        );
        
        $response = new Response(
            $guzzle_response->getBody(),
            config("http-client.servers.$server.accessors")
        );
        
        $status_code = $guzzle_response->getStatusCode();
        if ($status_code >= 400 && $status_code < 500) {
            throw new Exceptions\ClientException($guzzle_response);
        } elseif($status_code >= 400 && $status_code < 500) {
            throw new Exceptions\ServerException($guzzle_response);
        }
        
        return $response; 
    }

}
