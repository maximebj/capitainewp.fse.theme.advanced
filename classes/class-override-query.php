<?php

namespace Capitaine;

class OverrideQuery
{
  public function registerHooks(): void
  {
    add_filter("query_loop_block_query_vars", [$this, 'overrideRelatedPostsQuery'], 10, 2);
  }

  # Surcharger la requête de la boucle related posts dans single.html
  public function overrideRelatedPostsQuery($query_vars, $block_instance): array
  {
    if ($block_instance->context["queryId"] !== 3) {
      return $query_vars;
    }

    $current_post_id = get_the_ID();
    $current_post_categories = wp_get_post_categories($current_post_id, ["fields" => "ids"]);

    $query_vars["post__not_in"] = [$current_post_id];
    $query_vars["cat"] = $current_post_categories;

    return $query_vars;
  }
}
