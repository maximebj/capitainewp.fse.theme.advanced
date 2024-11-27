<?php

namespace Capitaine;

class CPT
{
  public function execute(): void
  {
    $this->registerHooks();
  }

  protected function registerHooks(): void
  {
    add_action('init', [$this, 'registerPostTypes']);
  }

  # Déclarer des types de publication personnalisés
  public function registerPostTypes(): void
  {
    # CPT « Portfolio »
    $labels = [
      'name' => 'Portfolio',
      'all_items' => 'Tous les projets',
      'singular_name' => 'Projet',
      'add_new_item' => 'Ajouter un projet',
      'edit_item' => 'Modifier le projet',
      'menu_name' => 'Portfolio'
    ];

    $args = [
      'labels' => $labels,
      'public' => true,
      'show_in_rest' => true,
      'has_archive' => true,
      'show_in_rest' => true,
      'supports' => ['title', 'editor', 'thumbnail', 'revisions', 'custom-fields'],
      'menu_position' => 5,
      'menu_icon' => 'dashicons-admin-appearance',
    ];

    register_post_type('portfolio', $args);

    # Taxonomy « Type de projets »
    $labels = [
      'name' => 'Types de projets',
      'singular_name' => 'Type de projet',
      'add_new_item' => 'Ajouter un Type de Projet',
      'new_item_name' => 'Nom du nouveau Projet',
      'parent_item' => 'Type de projet parent',
    ];

    $args = [
      'labels' => $labels,
      'public' => true,
      'show_in_rest' => true,
      'hierarchical' => true,
    ];

    register_taxonomy('type-projets', 'portfolio', $args);
  }
}
