<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/autoload.php';


  use \Trello\Trello;
  use \uk\co\neontabs\trellojira\Jira;

  $trello = new Trello('409a0fff5f5f6656a56e8dee01100258', null, '45d325393239f6b8eeff4c06ea8b7bbc2a2b4d69fe68699e580e22d46f461910');
  $me = $trello->members->get('me');

// Get a list of all my (open) trello cards
$cards = $trello->get('members/' . $me->username . '/cards');

//  Loop through each card
foreach ($cards as $card) {

  // If the card has a title that matches XX-123 then load it else create new
  $jira = Jira::getIssueFromCard($card, TRUE);

  // Locate the metadata comment in the Jira issue
  // $issues = Jira::getIssues()
  // If there is no meta data comment
  // Create one
  // For each action on the Trello card
  //   Find/Create the Jira Issue that matches the action
  //   CRUD action/commnent based on last modified date
  //   Update metadata object
  //  CRUD attachments based on title
  //  If there are actions that don't have issues
  //  Create them
  //  If there are commnets that don't have actions note them in the metadata
  //  Update metadata issue
  break;
}


