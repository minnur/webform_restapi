<?php

namespace Drupal\webform_restapi\Model;

class ResponseBase {

  protected $data;
  protected $code;

  private $messages = [
    'success'           => 'Success',
    'invalid_webform'   => 'Invalid Webform Entity ID supplied',
    'nid_not_found'     => 'Entity ID not found',
    'not_authorized'    => 'Invalid Comment ID supplied',
    'webform_not_found' => 'Webform not found',
  ];

  public function setData($data) {
    $this->data = $data;
    return $this;
  }

  public function getData() {
    return $this->data;
  }

  public function setCode($code) {
    $this->code = $code;
    return $this;
  }

  public function getCode() {
    return $this->code;
  }

  public function getMessage() {
    return !empty($this->messages[$this->getCode()])
      ? $this->messages[$this->getCode()]
      : 'Unknown error occured';
  }

  public function model() {
    return [
      'code'    => $this->getCode(),
      'message' => $this->getMessage(),
      'data'    => $this->getData(),
    ];
  }

}
