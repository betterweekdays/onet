<?php

namespace ONET\Resource\Online;


use GuzzleHttp\Psr7\Response;
use ONET\Config;
use ONET\Entity\Activity;
use ONET\Resource\ResourceInterface;
use ONET\Response\ResponseInterface;
use Sabre\Xml\Element\Base;
use Sabre\Xml\Reader;
use Sabre\Xml\XmlDeserializable;

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

    $reader->elementMap = [
      '{}activity' => function(Reader $reader) {
        $parsed = Base::xmlDeserialize($reader);
        return new Activity($parsed['attributes'], $parsed['value']);
      },
    ];

    $reader->xml($response->getBody());
    $parse = $reader->parse();

    return $parse['value'];
  }
}