<?php

namespace Drupal\webform_restapi\Model;

use Drupal\webform\Entity\Webform as WebformEntity;

class WebformSubmissions extends WebformSubmissionsBase {

  /**
   * Load webform elements.
   */
  public function load() {
    return $this;
  }

  public function loadAll() {
    $webform = $this->getWebformObject();
    $storage = \Drupal::entityTypeManager()->getStorage('webform_submission');
    $webform_submission = $storage->loadByProperties([
      'entity_type' => 'node',
      'entity_id'   => $webform->getId(),
    ]);
    $submission_data = [];
    foreach ($webform_submission as $submission) {
      $submission_data[] = $submission->getData();
    }
    print_r($submission_data);exit;
    $this->setSubmissions($submission_data);
    return $this;
  }

}
