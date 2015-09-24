<?php

namespace ONET\Entity;


use ONET\Entity\Job\Green;
use ONET\Entity\Job\Outlook;

class JobOutlook {
  /**
   * @var Outlook[]
   */
  private $outlooks;
  /**
   * @var Green
   */
  private $green;

  /**
   * @var int
   */
  private $salary;

  /**
   * @param Outlook[] $outlooks
   * @param \ONET\Entity\Job\Green $green
   * @param \ONET\Entity\int $salary
   */
  public function __construct(array $outlooks, int $salary = NULL, Green $green = NULL) {

    $this->outlooks = $outlooks;
    $this->green = $green;
    $this->salary = $salary;
  }

  /**
   * @return Job\Outlook[]
   */
  public function getOutlooks() {
    return $this->outlooks;
  }

  /**
   * @return Green
   */
  public function getGreen() {
    return $this->green;
  }

  /**
   * @return int
   */
  public function getSalary() {
    return $this->salary;
  }

  /**
   * @return boolean
   */
  public function isGreen() {
    return (boolean) $this->green;
  }
}