<?php

namespace ONET\Entity;


use ONET\Error\OnetEntityException;

class Activity {
  private $related;
  private $id;
  private $value;

  public function __construct(array $attributes, $value) {
    if (empty($attributes['id'] || empty($attributes['related']))) {
      throw new OnetEntityException('ID and Related required for Activity');
    }

    $this->related = $attributes['related'];
    $this->id = $attributes['id'];
    $this->value = $value;
  }

  /**
   * @return mixed
   */
  public function getRelated() {
    return $this->related;
  }

  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getValue() {
    return $this->value;
  }
}