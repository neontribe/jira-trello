# Pseudocode

* Get a list of all my (open) trello cards
    * Loop through each card
        * If the card has a title that matches XX-123
            * Load the Jira issue
        * Else
            * Create a new Issue

        * Locate the metadata comment in the Jira issue
        * If there is no metat data comment
            * Create one

        * For each action on the Trello card
            * Find/Create the Jira Issue that matches the action
            * CRUD action/commnent based on last modified date
            * Update metadata object

            * For each attachment on the card
            * CRUD attachments to the issue

            * If there are attachemants on the issue that don't exist in the card
            * Create them on the card

        * If there are actions that don't have issues
        * Create on issue

            * If there are comments that don't have actions
            * Create on card.

            * Update metadata issue



    $boards = $me->idBoards;
    $me = $trello->members->get('me');
    
    print_r($boards);
    print_r($cards);
    
    foreach ($cards as $card) {
      if ($card->idBoard == '560aeda050cf02935cecdc83') {
        echo $card->name . "\n";
        $cid = $card->id;
        $_card = $trello->get('/cards/' . $cid);
        echo "*******************************\n";
        var_dump($_card);
        echo "*******************************\n";
        $_actions = $trello->get('/cards/' . $cid . '/actions');
        foreach ($_actions as $action) {
          echo $action->data->text . "\n";
          echo "===============================\n";
          var_dump($action);
          echo "===============================\n";
        }
      }
    }
    
    use chobie\Jira\Api;
    use chobie\Jira\Api\Authentication\Basic;
    use chobie\Jira\Issues\Walker;
    
    $api = new Api(
      'https://jira.neontribe.org', new Basic('nt_trellobot', 'houserabbitdogtoy')
    );
    
    $walker = new Walker($api);
    $walker->push(
      'project = "TEST" ORDER BY priority DESC'
    );
    
    foreach ($walker as $issue) {
      var_dump($issue);
      // Send custom notification here.
    }

