<?php

namespace Drupal\webform_restapi\Plugin\rest\resource;

use Drupal\rest\ResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\webform_restapi\Model\Response as ResponseModel;
use Drupal\webform_restapi\Model\WebformElements as WebformElementsModel;
use Drupal\webform_restapi\Model\WebformSubmissions as WebformSubmissionsModel;

/**
 * Provides webform submissions resource.
 *
 * @RestResource(
 *   id = "webform_restapi_submissions",
 *   label = @Translation("Webform REST API Submissions"),
 *   uri_paths = {
 *     "canonical" = "/webform-restapi/{webform_id}/submissions",
 *     "https://www.drupal.org/link-relations/create" = "/webform-restapi/{webform_id}/submissions"
 *   }
 * )
 */
class WebformSubmissions extends ResourceBase {

  /**
   * Get webform build data.
   */
  public function get($webform_id = NULL) {
    $webform = new WebformElementsModel();
    $webform_submissions = new WebformSubmissionsModel();
    $response = new ResponseModel();
    $response->setCode('webform_not_found');

    if (empty($webform_id)) {
      $response->setCode('invalid_webform');
    }
    else {
      $webform->setId($webform_id)->load();
      if ($webform->getId()) {
        $webform_submissions->setWebformObject($webform);
        $response->setData($webform_submissions->loadAll()->model())
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
