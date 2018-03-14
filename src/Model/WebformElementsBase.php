<?php

namespace Drupal\webform_restapi\Model;

class WebformElementsBase extends Base {

  protected $id;
  protected $properties;
  protected $elements;
  protected $webform;
  protected $created_at;
  protected $changed_at;

  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  public function getId() {
    return $this->id;
  }

  public function setProperties($properties = []) {
    $this->properties = $properties;
    return $this;
  }

  public function setElements(array $elements) {
    $this->elements = $elements;
    return $this;
  }

  public function getElements() {
    $elements = (new Elements())
      ->setProperties($this->properties)
      ->setElements($this->elements);
    return $elements;
  }

  public function setWebformObject($webform) {
    $this->webform = $webform;
    return $this;
  }

  public function getWebformObject() {
    return $this->webform;
  }

  public function model() {
    return [
      'id'      => $this->getId(),
      'webform' => $this->getElements()->model(),
    ];
  }

}
