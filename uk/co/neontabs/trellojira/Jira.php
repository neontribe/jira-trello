<?php

namespace uk\co\neontabs\trellojira;

use chobie\Jira\Api;
use chobie\Jira\Api\Authentication\Basic;
use chobie\Jira\Issues\Walker;

// bottybot
// tobias+trellobot@neontribe.co.uk

class Jira {

  static protected $api = FALSE;

  public static function getApiInstance() {
    if (!self::$api) {
      $url = self::getProperty('jira_url');
      $name = self::getProperty('jira_name');
      $pass = self::getProperty('jirs_pass');
      $auth = new Basic($name, $pass);
      self::$api = new Api($url, $auth);
//      self::$api = new Api(
//        'https://jira.neontribe.org', new Basic('nt_trellobot', 'houserabbitdogtoy')
//      );
    }

    return self::$api;
  }

  public static function getProperty($key) {
    $vars = array(
      'project' => 'TEST',
      'jira_url' => 'https://jira.neontribe.org',
      'jira_name' => 'nt_trellobot',
      'jirs_pass' => 'houserabbitdogtoy',
    );

    if (isset($vars[$key])) {
      return $vars[$key];
    }

    return FALSE;
  }

  /**
   * Load the Jira issue that matches the card.  If auto vratre is set true crate it if it doesn't exist.
   *
   * @param \stdClass $card
   * @param type $autocreate
   */
  public static function getIssueFromCard(\stdClass $card, $autocreate = TRUE) {
    $name = $card->name;
    $issue_id = Issue::parseTitle($name);
    if ($issue_id) {
      return Issue::getIssue($issue_id);
    }
    else {
      return Issue::createNewIssue($name, self::getProperty('project'));
    }
  }

}
