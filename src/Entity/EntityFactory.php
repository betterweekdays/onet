<?php

namespace ONET\Entity;


use ONET\Error\OnetEntityException;

class EntityFactory {
  public static $map = [
    'activity', 'ONET\Entity\Activity'
  ];

  public static function build($element_name, $attr, $value) {
    if (!isset(self::$map[$element_name])) {
      throw new OnetEntityException($element_name . ' does not exist');
    }

    return new self::$map[$element_name]($attr, $value);
  }
}