<?php

namespace Drupal\drupalhacks\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

/**
 * Class DrupalHacksConfigSubscriber.
 *
 * @package Drupal\drupalhacks\EventSubscriber
 */
class DrupalHacksConfigSubscriber implements EventSubscriberInterface {

  /**
   * Example of logger factory implemented through DI.
   * Injecting whole logger factory.
   * Logger factory object.
   */
  protected $loggerFactory;

  /**
   * {@inheritdoc}
   */
  public function __construct(LoggerChannelFactoryInterface $logger_factroy) {
    $this->loggerFactory = $logger_factroy;
  }

  /**
   * {@inheritdoc}
   *
   * @return array
   *   The event names to listen for, and the methods that should be executed.
   */
  public static function getSubscribedEvents() {
    return [
      ConfigEvents::SAVE => ['configSave', 10],
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
    $this->loggerFactory->get('drupalhacks')->notice('Notification for saved config: ' . $config->getName());
    \Drupal::messenger()->addStatus('Notification for saved config: ' . $config->getName());
  }

  /**
   * React to a config object being deleted.
   *
   * @param \Drupal\Core\Config\ConfigCrudEvent $event
   *   Config crud event.
   */
  public function configDelete(ConfigCrudEvent $event) {
    $config = $event->getConfig();
    \Drupal::messenger()->addStatus('Notification for deleted config: ' . $config->getName());
  }

}
