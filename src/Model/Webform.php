<?php

namespace Drupal\webform_restapi\Model;

use Drupal\webform\Entity\Webform as WebformEntity;

class Webform extends WebformBase {

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

  /**
   * Save webform submission.
   */
  public function save() {}

  /**
   * Update webform submission.
   */
  public function update() {
    // Save submission
    // https://www.drupal.org/docs/8/modules/webform/webform-cookbook/how-to-programmatically-create-a-submission
  }

 /**
  * Delete webform submission.
  */
  public function delete() {}

}
