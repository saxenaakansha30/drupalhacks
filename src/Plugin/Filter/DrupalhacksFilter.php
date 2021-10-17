<?php

declare(strict_types=1);

namespace Drupal\drupalhacks\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides Drupal Filter to CkEditor Filter.
 *
 * @Filter(
 *   id = "drupalhacks_filter",
 *   title = @Translation("Drupalhacks Filter"),
 *   description = @Translation("Replaces drupalhacks token with Hacks Home Page."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class DrupalhacksFilter extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $replace = '<span class="drupalhacks_link"><a href="/abc">Hacks Page Link</a></span>';
    $new_text = str_replace('[drupalhacks]', $replace, $text);

    $result = new FilterProcessResult($new_text);

    if ($this->settings['drupalhacks_attach_library'] ?? NULL) {
      $result->setAttachments(array(
        'library' => array('drupalhacks/filter'),
      ));
    }

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['drupalhacks_attach_library'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Attach Library'),
      '#default_value' => $this->settings['drupalhacks_attach_library'],
      '#description' => $this->t('Show link in animated gradient colour.'),
    ];
    return $form;
  }

}
