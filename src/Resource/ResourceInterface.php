<?php

namespace ONET\Resource;


use GuzzleHttp\Psr7\Response;
use ONET\Config;
use ONET\Response\ResponseInterface;

interface ResourceInterface {

  /**
   * The HTTP method to use for the call
   *
   * @return string
   */
  public function getMethod();

  /**
   * Get the relate path to the endpoint
   *
   * @return string
   */
  public function getPath();

  /**
   * @param \GuzzleHttp\Psr7\Response $response
   * @return mixed
   */
  public function map(Response $response);

}