<?php

namespace Drupal\drupalhacks\Event;

use Drupal\node\NodeInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event to show author info of the node created.
 */
class NodeCreatedInfoEvent extends Event {

  const EVENT_NAME = 'author_info';

  /**
   * The node object.
   *
   * @var \Drupal\node\NodeInterface
   */
  public $node;

  /**
   * Constructs the object.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node object created.
   */
  public function __construct(NodeInterface $node) {
    $this->node = $node;
    \Drupal::messenger()->addStatus(t('Holla!!, Author %author has published the node %title.', [
      '%title' => $this->node->getTitle(),
      '%author' => $this->node->getOwner()->getDisplayName(),
    ]));
  }

}
