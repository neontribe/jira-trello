<?php

namespace uk\co\neontabs\trellojira;

use chobie\Jira\Api;
use chobie\Jira\Api\Authentication\Basic;
use chobie\Jira\Issues\Walker;
use chobie\Jira\Api\Result;

class Issue {

  public static function getIssue($issue_id) {
    $api = Jira::getApiInstance();
    $walker = new Walker($api);
    $walker->push(
      'issuekey = ' . $issue_id
    );

    foreach ($walker as $issue) {
      return $issue;
    }
  }

  public static function parseTitle($title) {
    $matches = array();
    $count = preg_match('/[a-zA-Z]{2}-\d+$/', $title, $matches);

    if ($count) {
      return $matches[0];
    }
    else {
      return FALSE;
    }
  }

  public static function createNewIssue($title, $project) {
    $api = Jira::getApiInstance();
    $response = $api->createIssue($project, $title, "3");

    $result = $response->getResult();
    if (array_key_exists('errorMessages', $result)) {
      var_dump($response);
      return FALSE;
    }
    else {
      $key = $result['key'];
    }
  }

}
