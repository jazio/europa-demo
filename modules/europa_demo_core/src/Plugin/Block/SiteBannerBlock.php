<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Site banner' block.
 *
 * @Block(
 *   id = "europa_demo_site_banner",
 *   admin_label = @Translation("Site banner"),
 *   category = @Translation("Europa Demo")
 * )
 */
class SiteBannerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    return [
      'title' => '',
      'uri' => '',
      'background' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state): array {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Link title'),
      '#description' => $this->t('The text to be used for the link.'),
      '#default_value' => $this->configuration['title'],
      '#required' => TRUE,
    ];

    $form['uri'] = [
      '#type' => 'url',
      '#title' => $this->t('Link'),
      '#description' => $this->t('The location where this block link should point to.'),
      '#default_value' => $this->configuration['uri'],
      '#required' => TRUE,
    ];

    $form['background'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Background'),
      '#description' => $this->t('A path to an image to show as background for the entire block.'),
      '#default_value' => $this->configuration['background'],
      '#maxlength' => 255,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state): void {
    $this->configuration['title'] = $form_state->getValue('title');
    $this->configuration['uri'] = $form_state->getValue('uri');
    $this->configuration['background'] = $form_state->getValue('background');
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build = [
      '#theme' => 'europa_demo_site_banner',
      '#title' => $this->configuration['title'],
      '#uri' => $this->configuration['uri'],
      '#background' => $this->configuration['background'],
    ];

    return $build;
  }

}
