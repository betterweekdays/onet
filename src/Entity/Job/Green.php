<?php

namespace ONET\Entity\Job;


class Green {
  /**
   * @var string
   */
  private $description;
  /**
   * @var string
   */
  private $category;

  /**
   * @param $description
   * @param $category
   */
  public function __construct($description, $category) {

    $this->description = $description;
    $this->category = $category;
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

}