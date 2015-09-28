<?php

namespace ONET\Resource\Online;


use GuzzleHttp\Psr7\Response;
use ONET\Entity\Job\Element;
use ONET\Resource\ResourceInterface;
use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;

class KnowledgeDetailed implements ResourceInterface {
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
    return 'online/occupations/' . $this->onet . '/details/knowledge';
  }

  /**
   * @param \GuzzleHttp\Psr7\Response $response
   * @return Element[]
   */
  public function map(Response $response) {
    $reader = new Reader();

    $reader->elementMap = [
      '{}element' => function(Reader $reader) {

        $id = $reader->getAttribute('id');

        $parsed = KeyValue::xmlDeserialize($reader);

        $name = $parsed['{}name'];
        $desc = $parsed['{}description'];
        $score = $parsed['{}score'];

        return new Element($id, $name, $desc, $score, 'knowledge');
      },
      '{}knowledge' => function(Reader $reader) {
        $items = [];

        $children = $reader->parseGetElements();
        foreach ($children as $child) {
          $items[] = $child['value'];
        }

        return $items;
      }
    ];

    $reader->xml($response->getBody());
    $parsed = $reader->parse();

    return $parsed['value'];
  }
}