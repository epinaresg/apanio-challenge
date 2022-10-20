<?php

namespace App\Libraries;

class GuzzleLibrary
{
    protected string $baseUrl;

    public function setBaseUri(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function call(string $method, string $url, array $data = [], array $headers = []): object
    {
        if (!$this->baseUrl) {
            return false;
        }

        try {
            $client = new \GuzzleHttp\Client(['base_uri' => $this->baseUrl]);

            $params = [];
            if (!empty($data)) {
                $params = array_merge($params, $data);
            }

            if (!empty($headers)) {
                $params = array_merge($params, $headers);
            }

            $response = $client->request(
                $method,
                $url,
                $params
            );
            $content = $response->getBody()->getContents();

            return (object) [
                'status_code' => $response->getStatusCode(),
                'response' => $content,
                'response_formatted' => json_decode($content)
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $code = $e->getCode();
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();

            return (object) [
                'status_code' => $code,
                'response' => $responseBodyAsString,
                'response_formatted' => json_decode($responseBodyAsString)
            ];
        } catch (\Exception $e) {
            return (object) [
                'status_code' => 500,
                'response' => $e->getMessage(),
                'response_formatted' => json_decode($e->getMessage())
            ];
        }
    }
}
