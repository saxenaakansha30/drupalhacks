<?php

namespace Drupal\drupalhacks\ParamConverter;

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Drupal\drupalhacks\Entity\Contact;
use Symfony\Component\Routing\Route;

/**
 * Defines custom parameter converter.
 */
class DrupalHacksParamConverter implements ParamConverterInterface {

  /**
   * {@inheritdoc}
   */
  public function convert($value, $definition, $name, array $defaults) {
    return Contact::load($value);
  }

  /**
   * {@inheritdoc}
   */
  public function applies($definition, $name, Route $route) {
    return (
      !empty($definition['type'])
      && ($definition['type'] == 'drupalhacks_menu')
    );
  }

}
