<?php


namespace ONET\Entity\Job;


class Element {
  /**
   * @var string
   */
  private $id;
  /**
   * @var string
   */
  private $name;
  /**
   * @var string
   */
  private $description;
  /**
   * @var int
   */
  private $score;
  /**
   * @var string
   */
  private $type;

  /**
   * @param string $id
   * @param string $name
   * @param string $description
   * @param int $score
   * @param string $type
   */
  public function __construct($id, $name, $description, $score, $type) {

    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->score = $score;
    $this->type = $type;
  }

  /**
   * @return string
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @return int
   */
  public function getScore() {
    return $this->score;
  }

  /**
   * @return string
   */
  public function getType() {
    return $this->type;
  }

}