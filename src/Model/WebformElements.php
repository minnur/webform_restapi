<?php

namespace Drupal\webform_restapi\Model;

use Drupal\webform\Entity\Webform as WebformEntity;

class WebformElements extends WebformElementsBase {

  /**
   * Load webform elements.
   */
  public function load() {
    $webform = WebformEntity::load($this->getId());
    if ($webform) {
      $this->setElements($webform->getElementsInitialized());
      $this->setWebformObject($webform);
    }
    else {
      // Webform ID is invalid so we set it's ID to `null`.
      $this->setId(null);
    }
    return $this;
  }

}
