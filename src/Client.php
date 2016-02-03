<?php namespace Rap2hpoutre\Jacky;

/**
 * Class Client
 * @package Rap2hpoutre\Jacky
 */
class Client
{

    /**
     * @param $method
     * @param $server
     * @param $path
     * @param $query
     * @return Response
     */
    private function request($method, $server, $path, $query)
    {
        $client = new \GuzzleHttp\Client();

        $params = config("jacky.servers.$server.request_options");
        if ($query) {
            $params[($method == 'POST' || $method == 'PUT' || $method == 'PATCH') ? 'form_params' : 'query'] = $query;
        }
        $params['http_errors'] = false;
        
        $guzzle_response = $client->request(
            $method, 
            $path, 
            $params
        );
        
        $response = new Response(
            $guzzle_response->getBody(),
            config("jacky.servers.$server.accessors")
        );
        
        $status_code = $guzzle_response->getStatusCode();
        if ($status_code >= 400 && $status_code < 500) {
            $exception_subclass_name = "\\Rap2hpoutre\\Jacky\\Exception\\Http{$status_code}Exception";
            if (class_exists($exception_subclass_name)) {
                throw new $exception_subclass_name($response, $status_code, $guzzle_response->getReasonPhrase());
            }
            throw new Exception\ClientException($response, $status_code, $guzzle_response->getReasonPhrase());
        } elseif ($status_code >= 500 && $status_code < 600) {
            throw new Exception\ServerException($response, $status_code, $guzzle_response->getReasonPhrase());
        }
        
        return $response; 
    }

    /**
     * @param $server
     * @param $path
     * @param null $query
     * @return Response
     */
    public function get($server, $path, $query = null)
    {
        return $this->request('GET', $server, $path, $query);
    }

    /**
     * @param $server
     * @param $path
     * @param null $query
     * @return Response
     */
    public function post($server, $path, $query = null)
    {
        return $this->request('POST', $server, $path, $query);
    }

    /**
     * @param $server
     * @param $path
     * @param null $query
     * @return Response
     */
    public function patch($server, $path, $query = null)
    {
        return $this->request('PATCH', $server, $path, $query);
    }

    /**
     * @param $server
     * @param $path
     * @param null $query
     * @return Response
     */
    public function put($server, $path, $query = null)
    {
        return $this->request('PUT', $server, $path, $query);
    }

    /**
     * @param $server
     * @param $path
     * @param null $query
     * @return Response
     */
    public function delete($server, $path, $query = null)
    {
        return $this->request('DELETE', $server, $path, $query);
    }


}
