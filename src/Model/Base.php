<?php

namespace Drupal\webform_restapi\Model;

use \Drupal\Component\Render\HtmlEscapedText;

class Base {

  protected $user;

  public function __construct() {
    $this->user = \Drupal::currentUser();
  }

  public function getUser() {
    return $this->user;
  }

  public function checkPlain($text) {
    return (new HtmlEscapedText($text))->__toString();
  }

}
