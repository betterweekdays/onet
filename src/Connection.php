<?php


namespace ONET;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use ONET\Error\OnetResponseException;
use ONET\Resource\ResourceInterface;
use ONET\Response\Error;
use ONET\Response\ResponseInterface;

final class Connection {
  /**
   * @var Config
   */
  private $config;
  /**
   * @var HandlerStack
   */
  private $stack;

  /**
   * @param \ONET\Config $config
   */
  public function __construct(Config $config) {
    $this->config = $config;
  }

  public function setHandlerStack(HandlerStack $stack) {
    $this->stack = $stack;
  }

  /**
   * Make a call to the ONET
   *
   * @param \ONET\Resource\ResourceInterface $resource
   * @return mixed|\Psr\Http\Message\ResponseInterface
   *
   * @throws \ONET\Error\OnetResponseException
   */
  public function call(ResourceInterface $resource) {
    // Add auth header
    $client_options = [
      'headers' => [
        'Authorization' => 'Basic ' . $this->config->getAuthHash(),
      ],
      'base_uri' => $this->config->getBaseUrl(),
    ];

    // If a handler is set then use that to build the client
    if ($this->stack) {
      $client_options['handler'] = $this->stack;
    }


    // make the call to the API
    try {
      // Build guzzle objects
      $client = new Client($client_options);
      $response = $client->request($resource->getMethod(), $resource->getPath());
    }
    catch (\Exception $e) {
      throw new OnetResponseException("Error calling ONET API", $e->getCode(), $e);
    }

    // if error is 422 then look for a xml response
    if ($response->getStatusCode() === 422) {
      $error = new Error($response);
      throw new OnetResponseException($error->getError(), 422);
    }

    if ($response->getStatusCode() !== 200) {
      throw new OnetResponseException($response->getReasonPhrase(), $response->getStatusCode());
    }

    return $response;
  }
}