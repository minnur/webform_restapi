<?php

namespace Drupal\webform_restapi\Plugin\rest\resource;

use Drupal\rest\ResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\webform_restapi\Model\Response as ResponseModel;
use Drupal\webform_restapi\Model\Webform as WebformModel;

/**
 * Provides webform resource.
 *
 * @RestResource(
 *   id = "webform_restapi",
 *   label = @Translation("Webform REST API"),
 *   uri_paths = {
 *     "canonical" = "/webform-restapi/{webform_id}",
 *     "https://www.drupal.org/link-relations/create" = "/webform-restapi/{webform_id}"
 *   }
 * )
 */
class WebformResource extends ResourceBase {

  /**
   * Get webform build data.
   */
  public function get($webform_id = NULL) {
    $webform = new WebformModel();
    $response = new ResponseModel();
    $response->setCode('webform_not_found');

    if (empty($webform_id)) {
      $response->setCode('invalid_webform');
    }
    else {
      $webform->setId($webform_id)->load();
      if ($webform->getId()) {
        $response->setData($webform->model())
          ->setCode('success');
      }
      else {
        $response->setCode('invalid_webform');
      }
    }

    $res = (new ResourceResponse($response->model()));
    if ($form = $webform->getWebformObject()) {
      // Output the most recent webform elements data.
      $build = [
        '#cache' => [
          'tags' => $form->getCacheTags(),
        ]
      ];
      $cache_metadata = CacheableMetadata::createFromRenderArray($build);
      $res->addCacheableDependency($cache_metadata);
    }
    return $res;
  }

  /**
   * Submit webform.
   */
  public function post($webform_id = NULL) {}

  /**
   * Update webform.
   */
  public function put($webform_id = NULL) {}

}
