<?php

namespace ONET\Resource\MyNextMove;


use GuzzleHttp\Psr7\Response;
use ONET\Entity\Job\Green;
use ONET\Entity\Job\Outlook;
use ONET\Entity\JobOutlook as JobOutlookEntity;
use ONET\Resource\ResourceInterface;
use Sabre\Xml\Element\KeyValue;
use Sabre\Xml\Reader;

class JobOutlook implements ResourceInterface {
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
    return 'mnm/careers/' . $this->onet . '/job_outlook';
  }

  /**
   * @param \GuzzleHttp\Psr7\Response $response
   * @return JobOutlookEntity
   *
   */
  public function map(Response $response) {
    $reader = new Reader();

    $reader->elementMap = [
      '{}outlook' => function(Reader $reader) {
        $parsed = KeyValue::xmlDeserialize($reader);

        return new Outlook($parsed['{}category'], $parsed['{}description']);
      },
      '{}bright_outlook' => function(Reader $reader) {
        $parsed = KeyValue::xmlDeserialize($reader);

        return new Outlook($parsed['{}category'], $parsed['{}description'], TRUE);
      },
      '{}green' => function(Reader $reader) {
        $parsed = KeyValue::xmlDeserialize($reader);

        return new Green($parsed['{}description'], $parsed['{}category']);
      },
      '{}salary' => function(Reader $reader) {
        $parsed = KeyValue::xmlDeserialize($reader);

        return $parsed['{}annual_median'];
      },
      '{}job_outlook' => function(Reader $reader) {

        $outlooks = [];
        $children = $reader->parseGetElements();
        $green = NULL;
        $salary = NULL;
        foreach ($children as $child) {
          if (isset($child['name'])) {
            switch ($child['name']) {
              case '{}outlook':
                $outlooks[] = $child['value'];
                break;
              case '{}bright_outlook':
                $outlooks[] = $child['value'];
                break;
              case '{}green':
                $outlooks[] = $child['value'];
                break;
              case '{}salary':
                $salary = $child['value'];
                break;
            }
          }
        }

        return new JobOutlookEntity($outlooks, $salary, $green);
      }
    ];

    $reader->xml($response->getBody());
    $parsed = $reader->parse();

    return $parsed['value'];
  }
}