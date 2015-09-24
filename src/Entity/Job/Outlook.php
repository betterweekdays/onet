<?php

namespace ONET\Entity\Job;


class Outlook {
  /**
   * @var string
   */
  private $description;
  /**
   * @var string
   */
  private $category;
  /**
   * @var bool
   */
  private $bright;

  /**
   * @param string $category
   * @param string $description
   * @param boolean $bright
   */
  public function __construct($category, $description, $bright = FALSE) {
    $this->category = $category;
    $this->description = $description;
    $this->bright = $bright;
  }

  /**
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @return string
   */
  public function getCategory() {
    return $this->category;
  }

  /**
   * @return boolean
   */
  public function isBright() {
    return $this->bright;
  }
}