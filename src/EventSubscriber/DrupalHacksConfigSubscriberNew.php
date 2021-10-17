<?php

namespace Drupal\drupalhacks\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;

/**
 * Class DrupalHacksConfigSubscriber.
 *
 * @package Drupal\drupalhacks\EventSubscriber
 */
class DrupalHacksConfigSubscriberNew implements EventSubscriberInterface {

  /**
   * Example of logger factory specific channel implemented through DI.
   * Injecting specific channel of logger factory.
   * Logger factory object.
   */
  protected $logger;

  /**
   * {@inheritdoc}
   */
  public function __construct(LoggerInterface $logger) {
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   *
   * @return array
   *   The event names to listen for, and the methods that should be executed.
   */
  public static function getSubscribedEvents() {
    return [
      ConfigEvents::SAVE => ['configSave', 9],
      ConfigEvents::DELETE => ['configDelete'],
    ];
  }

  /**
   * React to a config object being saved.
   *
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   *   Config crud event.
   */
  public function configSave(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    $this->logger->notice('New Notification for saved config: ' . $config->getName());
    \Drupal::messenger()->addStatus('New Notification for saved config: ' . $config->getName());
  }

  /**
   * React to a config object being deleted.
   *
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   *   Config crud event.
   */
  public function configDelete(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('New Notification for deleted config: ' . $config->getName());
  }

}
