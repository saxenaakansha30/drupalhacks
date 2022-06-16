<?php

declare(strict_types = 1);

namespace Drupal\drupalhacks\Service;

use Drupal\image\ImageEffectManager;
use Drupal\node\NodeInterface;
use Drupal\image_effects\Plugin\ImageEffect\TextOverlayImageEffect;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Class to provide text overlay image effect instance.
 */
class ImageEffectFactory {

  use StringTranslationTrait;

  /**
   * Image effect name.
   */
  private const IMAGE_EFFECT = 'image_effects_text_overlay';

  /**
   * Image effect plugin manager.
   *
   * @var \Drupal\image\ImageEffectManager
   */
  private $imageEffectManager;

  /**
   * Constructor for ImageEffectFactory.
   *
   * @param \Drupal\image\ImageEffectManager $imageEffectManager
   *   The image effect plugin manager.
   */
  public function __construct(ImageEffectManager $imageEffectManager) {
    $this->imageEffectManager = $imageEffectManager;
  }

  /**
   * Create text overlay image style plugin instance.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return Drupal\image_effects\Plugin\TextOverlayImageEffect
   *   Effect plugin configured instance.
   */
  public function createInstance(NodeInterface $node): TextOverlayImageEffect {
    $effect = $this->imageEffectManager->createInstance(self::IMAGE_EFFECT);

    // Override text configs.
    $overlayTextConfig = $this->buildTextOverlayConfig($effect->getConfiguration(), $node);
    $effect->setConfiguration($overlayTextConfig);

    return $effect;
  }

  /**
   * Provide array of configuration for overlay text.
   *
   * @param array $configuration
   *   Array of default configuration.
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return array
   *   Array of overlay text image style configuration.
   */
  private function buildTextOverlayConfig(array $configuration, NodeInterface $node): array {
    $configuration['data'] = [
      'font' => $this->getFontOverrides() + $configuration['data']['font'],
      'layout' => $this->getLayoutOverrides() + $configuration['data']['layout'],
      'text' => $this->getTextOverrides() + $configuration['data']['text'],
      'text_string' => $this->getImageText($node),
    ];

    return $configuration;
  }

  /**
   * Provide array of font overrides.
   *
   * @@return array
   *   Array of font settings to override.
   */
  private function getFontOverrides(): array {
    return [
      'name' => 'Lato Regular',
      'uri' => $this->getFontUri(),
      'size' => 18,
      'color' => '#232C61FF',
      'stroke_mode' => 'outline',
      'stroke_color' => '#531818FF',
    ];
  }

  /**
   * Provide array of layout overrides.
   *
   * @@return array
   *   Array of layout settings to override.
   */
  private function getLayoutOverrides(): array {
    return [
      'padding_top' => 10,
      'padding_right' => 10,
      'padding_bottom' => 10,
      'padding_left' => 10,
      'x_pos' => 'left',
      'y_pos' => 'center',
      'x_offset' => 0,
      'y_offset' => 0,
      'overflow_action' => 'crop',
      'extended_color' => '',
      'background_color' => '#BFBBBB33',
    ];
  }

  /**
   * Provide array of text config overrides.
   *
   * @@return array
   *   Array of text settings to override.
   */
  public function getTextOverrides(): array {
    return [
      'strip_tags' => TRUE,
      'decode_entities' => TRUE,
      'maximum_width' => 400,
      'fixed_width' => TRUE,
      'align' => 'left',
      'case_format' => 'ucwords',
      'line_spacing' => 3,
      'maximum_chars' => 150,
      'excess_chars_text' => '…',
    ];
  }

  /**
   * Generate the dynamically generated node respective text.
   *
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   String to render over image.
   */
  private function getImageText(NodeInterface $node): TranslatableMarkup {
    return $this->t("%title", ['%title' => $node->getTitle()]);
  }

  /**
   * Provide font uri to use for text.
   *
   * @return string
   *   Desired Font from theme if exist else fall back on default.
   */
  private function getFontUri(): string {
    return __DIR__ . '/../../font/Lato-Regular.ttf';
  }

}
