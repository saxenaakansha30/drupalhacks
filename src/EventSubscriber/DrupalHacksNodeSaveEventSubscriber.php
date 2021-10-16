<?php

namespace Drupal\drupalhacks\EventSubscriber;

use Drupal\drupalhacks\Event\NodeCreatedInfoEvent;
use Drupal\Core\Config\ConfigEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class DrupalHacksNodeSaveEventSubscriber.
 *
 * @package Drupal\drupalhacks\EventSubscriber
 */
class DrupalHacksNodeSaveEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   *
   * @return array
   *   The event names to listen for, and the methods that should be executed.
   */
  public static function getSubscribedEvents() {
    return [
      NodeCreatedInfoEvent::EVENT_NAME => 'addNewMessage',
    ];
  }

  /**
   * Add new message to node save author info show event.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node object created.
   */
  public function addNewMessage(NodeCreatedInfoEvent $node) {
    \Drupal::messenger()->addStatus('This author is member since - 2 months.');
  }

}
