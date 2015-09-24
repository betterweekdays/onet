<?php


namespace ONET\Response;


use GuzzleHttp\Psr7\Response;
use Sabre\Xml\Reader;

class Error {
  /**
   * @var \GuzzleHttp\Psr7\Response
   */
  private $response;

  public function __construct(Response $response) {
    $this->response = $response;
  }

  /**
   * Get the error message from the error xml.
   *
   * @return string
   */
  public function getError() {
    $reader = new Reader();
    $reader->xml($this->response->getBody()->getContents());
    return '';
  }
}