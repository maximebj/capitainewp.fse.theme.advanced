<?php

namespace Capitaine;

class Binding
{
  public function execute(): void
  {
    $this->registerHooks();
  }

  public function registerHooks(): void
  {
    add_action('init', [$this, 'registerMetas']);
    add_action('init', [$this, 'registerBindingSources']);
  }

  # Déclarer les méta-données personnalisées pour le binding
  public function registerMeta(): void
  {
    register_meta(
      'post',
      'meta_name',
      [
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
        'sanitize_callback' => 'wp_strip_all_tags',
        'default'           => 'default value',
        'label'             => 'Name',
      ]
    );
  }

  # Déclarer les sources de données pour le binding
  public function registerBindingSources(): void
  {
    register_block_bindings_source(
      'capitaine/source',
      [
        'label' => __('Nom de la source', 'capitaine'),
        'get_value_callback' => [$this, 'callbackOfTheSource']
      ]
    );
  }

  public function callbackOfTheSource($source_attrs, $block_instance, $attribute_name): string
  {
    return "value";
  }
}
