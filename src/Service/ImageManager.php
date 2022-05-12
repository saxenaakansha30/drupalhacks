<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Service;

use Drupal\Core\Image\ImageFactory;
use Drupal\node\NodeInterface;
use Drupal\Core\File\FileSystemInterface;
use Psr\Log\LoggerInterface;

/**
 * Service to image creation related functionalities.
 */
class ImageManager {

  /**
   * Background image url.
   */
  private const BACKGROUND_IMAGE = __DIR__ . '/../../images/background.png';

  /**
   * Directory name for storing images.
   */
  private const DIRECTORY = 'public://drupalhacks_images/';

  /**
   * Directory name for storing images.
   */
  private const EXTENSION = 'png';

  /**
   * The image factory object.
   *
   * @var \Drupal\Core\Image\ImageFactory
   */
  private $imageFactory;

  /**
   * Image effect factory.
   *
   * @var \Drupal\drupalhacks\Service\ImageEffectFactory
   */
  private $imageEffectFactory;

  /**
   * The logger.
   *
   * @var \Psr\Log\LoggerInterface
   */
  private $logger;

  /**
   * The file system service.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  private $fileSystem;

  /**
   * Constructor for ImageManager.
   *
   * @param \Drupal\Core\Image\ImageFactory $imageFactory
   *   The image factory.
   * @param \Drupal\drupalhacks\Service\ImageEffectFactory $imageEffectFactory
   *   The image effect factory.
   * @param \Psr\Log\LoggerInterface $logger
   *   The Textimage logger.
   * @param \Drupal\Core\File\FileSystemInterface $fileSystem
   *   The file system service.
   */
  public function __construct(ImageFactory $imageFactory, ImageEffectFactory $imageEffectFactory, LoggerInterface $logger, FileSystemInterface $fileSystem) {
    $this->imageFactory = $imageFactory;
    $this->imageEffectFactory = $imageEffectFactory;
    $this->logger = $logger;
    $this->fileSystem = $fileSystem;
  }

  /**
   * Create social share image for the node.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return string
   *   Image url.
   */
  public function createImage(NodeInterface $node): string {
    $fileName = '';

    try {
      $image = $this->imageFactory->get(self::BACKGROUND_IMAGE);

      $effect = $this->imageEffectFactory->createInstance($node);
      $effect->applyEffect($image);

      $fileName = $this->getFileName($node);
      $image->save($fileName);
    }
    catch (\Exception $e) {
      $this->logger->error('Failed to create image, error: @error', ['@error' => $e->getMessage()]);
    }

    return $fileName;
  }

  /**
   * Remove social share image of the node.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   */
  public function removeImage(NodeInterface $node): void {
    $fileName = $this->getFileName($node);
    $this->fileSystem->delete($fileName);
  }

  /**
   * Provide social share image url with text.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return string
   *   Image url.
   */
  private function getFileName(NodeInterface $node): string {
    if ($this->ensureDirExistAndWritable() === FALSE) {
      $this->logger->error('Failed to create @dir directory', ['@dir' => self::DIRECTORY]);

      return '';
    }

    $filename = sprintf("node-%d-%s.%s", $node->id(), $node->get('langcode')->value, self::EXTENSION);

    return self::DIRECTORY . $filename;
  }

  /**
   * Check and create directory for storing social images.
   *
   * @return bool
   *   TRUE if the directory exists and is writable. FALSE otherwise.
   */
  private function ensureDirExistAndWritable(): bool {
    $directory = self::DIRECTORY;

    return $this->fileSystem->prepareDirectory(
      $directory,
      FileSystemInterface::CREATE_DIRECTORY | FileSystemInterface::MODIFY_PERMISSIONS);
  }

  /**
   * Provide social share image absolute url.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return string|null
   *   Image url if exist else null.
   */
  public function getImageAbsoluteUrl(NodeInterface $node): ?string {
    $imagePath = $this->getFileName($node);

    return file_exists($imagePath) ? file_create_url($imagePath) : NULL;
  }

}
