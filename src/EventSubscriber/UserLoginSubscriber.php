<?php

/**
 * @file
 */

namespace Drupal\yashaswi_exercise\EventSubscriber;

// Use Drupal\Core\Database\Connection;
// use Drupal\Core\Messenger\MessengerInterface;
// use Drupal\Core\Datetime\DateFormatterInterface;
// use Drupal\yashaswi_exercise\Event\UserLoginEvent;
// use Symfony\Component\EventDispatcher\EventSubscriberInterface;.
// /**
//  * This is for login subscriber.
//  *
//  * @package Drupal\yashaswi_exercise\EventSubscriber
//  */
// class UserLoginSubscriber implements EventSubscriberInterface {
// /**
//    * The database connection.
//    *.
/**
 * * @var \Drupal\Core\Database\Connection .*/
// */
//   protected $database;
// /**
//    * The messenger service.
//    *
/**
 * * @var \Drupal\Core\Messenger\MessengerInterface .*/
// */
//   protected $messenger;
// /**
//    * The date formatter service.
//    *
/**
 * * @var \Drupal\Core\Datetime\DateFormatterInterface .*/
// */
//   protected $dateFormatter;
// /**
//    * UserLoginSubscriber constructor.
//    *
//    * @param \Drupal\Core\Database\Connection $database
//    *   The database connection.
//    * @param \Drupal\Core\Messenger\MessengerInterface $messenger
//    *   The messenger service.
//    * @param \Drupal\Core\Datetime\DateFormatterInterface $dateFormatter
//    *   The date formatter service.
//    */
//   public function __construct(Connection $database, MessengerInterface $messenger, DateFormatterInterface $dateFormatter) {
//     $this->database = $database;
//     $this->messenger = $messenger;
//     $this->dateFormatter = $dateFormatter;
//   }
// /**
//    * {@inheritdoc}
//    */
//   public static function getSubscribedEvents() {
//     return [
//       UserLoginEvent::EVENT_NAME => 'onUserLogin',
//     ];
//   }
// /**
//    * Subscribe to the user login event dispatched.
//    *
//    * @param \Drupal\yashaswi_exercise\Event\UserLoginEvent $event
//    *   Our custom event object.
//    */
//   public function onUserLogin(UserLoginEvent $event) {
//     $account_created = $this->database->select('users_field_data', 'ud')
//       ->fields('ud', ['created'])
//       ->condition('ud.uid', $event->account->id())
//       ->execute()
//       ->fetchField();
// $this->messenger->addStatus(t('Welcome, your account was created on %created_date.', [
//       '%created_date' => $this->dateFormatter->format($account_created, 'short'),
//     ]));
//   }
// }
