<?php

namespace ONET\Resource\Online;


use GuzzleHttp\Psr7\Response;
use ONET\Entity\Activity;
use ONET\Resource\ResourceInterface;
use Sabre\Xml\Reader;

class WorkActivityDetailed implements ResourceInterface {
  /**
   * @var string
   */
  private $onet;

  /**
   * @param $onet
   */
  public function __construct($onet) {
    $this->onet= $onet;
  }

  /**
   * The HTTP method to use for the call
   *
   * @return string
   */
  public function getMethod() {
    return 'get';
  }

  /**
   * Get the relate path to the endpoint
   *
   * @return string
   */
  public function getPath() {
    return 'online/occupations/' .
    $this->onet . '/details/detailed_work_activities';
  }

  /**
   * Build a response object
   *
   * @param \GuzzleHttp\Psr7\Response $response
   * @return Activity[]
   */
  public function map(Response $response) {
    // Pares XML
    $reader = new Reader();

    $reader->xml($response->getBody());
    $parse = $reader->parse();

    $return = [];
    foreach($parse['value'] as $value) {
      $return[] = new Activity($value['attributes'], $value['value']);
    }

    return $return;
  }
}