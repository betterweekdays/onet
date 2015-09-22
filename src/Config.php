<?php

namespace ONET;

use ONET\Error\OnetConfigException;

/**
 * Configuration Class
 */
final class Config {
  /**
   * @var string
   */
  private $auth_hash;
  /**
   * @var string
   */
  private $base_url;

  /**
   * @param $auth_hash
   * @param $base_url
   * @throws OnetConfigException
   */
  public function __construct($auth_hash, $base_url) {
    if (empty(trim($auth_hash)) ||
      empty(trim($base_url))) {

      throw new OnetConfigException('Auth Hash is required.');
    }

    if (!filter_var($base_url, FILTER_VALIDATE_URL)) {
      throw new OnetConfigException('Base URL must be a valid URL');
    }

    $this->auth_hash = $auth_hash;
    $this->base_url = $auth_hash;
  }

  /**
   * @return string
   */
  public function getBaseUrl() {
    return $this->base_url;
  }

  /**
   * @return string
   */
  public function getAuthHash() {
    return $this->auth_hash;
  }

}