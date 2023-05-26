<?php

namespace Drupal\yashaswi_exercise\EventSubscriber;

use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class CustomConfigEvent
 * @package Drupal\yashaswi_exercise\EventSubscriber
 *
 * Redirects /news/* to '/blog/*'
 */
class CustomConfigEvent implements EventSubscriberInterface {

  public function checkForRedirection(RequestEvent $event) { #this checks for redirection

    $request = $event->getRequest(); #getrequest function is used to get the request and is stored in request variable
    $path = $request->getRequestUri(); # path is obtained using getrequesturi and stored in path variable
    if(strpos($path, 'node/add/page') !== false) {
      // Redirect old  urls
      $new_url = str_replace('node/add/page','node/1', $path); #when the node add page is entered it gets redirected to node 1
      $new_response = new RedirectResponse($new_url, '301'); #301 is a redirect indication
      $new_response->send();
    }
// This is necessary because this also gets called on
    // node sub-tabs such as "edit", "revisions", etc.  This
    // prevents those pages from redirected.
    if ($request->attributes->get('_route') !== 'entity.node.canonical') {
        return;
      }

    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
      //The dynamic cache subscribes an event with priority 27. If you want that your code runs before that you have to use a priority >27:
      $events[KernelEvents::REQUEST][] = array('checkForRedirection', 29);
      return $events;
    }

  }