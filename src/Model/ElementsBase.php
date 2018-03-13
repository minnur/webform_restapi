<?php

namespace Drupal\webform_restapi\Model;

class ElementsBase extends Base {

  protected $elements = [];

  // A list of properties that we might need.
  protected $properties = [
    'title',
    'type',
    'description',
    'default_value',
    'markup',
    'required',
    'help',
    'options',
    'header'
  ];

  public function setProperties($properties = []) {
    if (!empty($properties)) {
      $this->properties = array_merge($this->properties, $properties);
    }
    return $this;
  }

  public function setElements($elements = []) {
    $this->elements = $elements;
    return $this;
  }

  public function getElements() {
    return $this->formatElements($this->elements);
  }

  public function model() {
    return $this->getElements();
  }

  /**
   * Build nested array with elements and its properties recursively.
   */
  protected function formatElements($elements) {
    $new_elements = [];
    foreach ($elements as $key => $element) {
      $new_elements[$key] = $this->buildProperties($element);
      if ($childElement = $this->getFormElement($element)) {
        $new_elements[$key]['childElements'] = $this->formatElements($childElement);
      }
    }
    return $new_elements;
  }

  /**
   * Get a list of nested element names.
   */
  protected function getFormElement($element) {
    $elements = [];
    foreach ($element as $key => $info) {
      if (!strstr($key, '#')) {
        $elements[$key] = $info;
      }
    }
    return $elements;
  }

  /**
   * Make sure we only include element properties that we need.
   */
  protected function buildProperties($element) {
    $props = [];
    foreach ($this->properties as $prop) {
      $key = '#' . $prop;
      if (isset($element[$key])) {
        $props[$prop] = !empty($element[$key]) ? $element[$key] : null;
      }
    }
    return $props;
  }

}
