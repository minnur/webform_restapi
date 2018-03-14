<?php

namespace Drupal\webform_restapi\Model;

class WebformSubmissionsBase extends Base {

  protected $id;
  protected $webform;
  protected $submissions;

  public function setSubmissionId($id) {
    $this->id = $id;
    return $this;
  }

  public function getSubmissionId() {
    return $this->id;
  }

  public function setWebformObject($webform) {
    $this->webform = $webform;
    return $this;
  }

  public function getWebformObject() {
    return $this->webform;
  }

  public function setSubmissions($submissions) {
    $this->submissions = $submissions;
    return $this;
  }

  public function getSubmissions() {
    return $this->submissions;
  }

  public function model() {
    return [
      'submissions' => $this->getSubmissions(),
    ];
  }

}
