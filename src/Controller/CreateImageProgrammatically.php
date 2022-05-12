<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\drupalhacks\Service\ImageManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\node\NodeInterface;

/**
 * Provides class to generate Social Share Image by URL.
 */
class CreateImageProgrammatically extends ControllerBase {

  /**
   * Image Manager.
   *
   * @var \Drupal\drupalhacks\Service\ImageManager
   */
  protected $imageManager;

  /**
   * Constructor of ListVideos form.
   *
   * @param \Drupal\drupalhacks\Service\ImageManager $imageManager
   *   The ImageManager object.
   */
  public function __construct(ImageManager $imageManager) {
    $this->imageManager = $imageManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('drupalhacks.image_manager')
    );
  }

  /**
   * Display the image url.
   *
   * @return array
   *   Return markup array.
   */
  public function getLink(NodeInterface $node): array {
    $imageUrl = $this->imageManager->createImage($node);

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Image URL: @url', ['@url' => $imageUrl]),
    ];
  }

}
