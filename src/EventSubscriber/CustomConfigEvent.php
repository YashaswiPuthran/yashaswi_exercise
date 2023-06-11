<?php

namespace Drupal\yashaswi_exercise\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * This is for config event.
 *
 * @package Drupal\yashaswi_exercise\EventSubscriber
 *
 * Redirects /news/* to '/blog/*'
 */
class CustomConfigEvent implements EventSubscriberInterface {

  /**
   * For redirecting.
   */
  public function checkForRedirection(RequestEvent $event) {
    // This checks for redirection.
    // function is used to get the requests.
    $request = $event->getRequest();
    // Path is obtained using getrequesturi and stored in path variable.
    $path = $request->getRequestUri();
    if (strpos($path, 'node/add/page') !== FALSE) {
      // Redirect old  urls.
      // When the node add page is entered it gets redirected to node 1.
      $new_url = str_replace('node/add/page', 'node/1', $path);
      // 301 is a redirect indication
      $new_response = new RedirectResponse($new_url, '301');
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
    // The dynamic cache subscribes an event with priority 27.
    $events[KernelEvents::REQUEST][] = ['checkForRedirection', 29];
    return $events;
  }

}
