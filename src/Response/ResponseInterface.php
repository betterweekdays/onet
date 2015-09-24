<?php

namespace ONET\Response;


use GuzzleHttp\Psr7\Response;

interface ResponseInterface {

  /**
   * @param \GuzzleHttp\Psr7\Response $response
   * @return ResponseInterface
   */
  public function buildResponse(Response $response);
}