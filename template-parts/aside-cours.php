<div class="listeCours">
  <?php
  $cargs = array(
      'child_of'      => 0,
      'orderby'       => 'name',
      'order'         => 'DESC',
      'hide_empty'    => 1,
      'taxonomy'      => 'category', //change this to any taxonomy
  );
  foreach (get_categories($cargs) as $tax) :
      // List posts by the terms for a custom taxonomy of any post type
      $args = array(
          'post_type'         => 'cours',
          'post_status'       => 'publish',
          'posts_per_page'    => -1,
          'tax_query' => array(
              array(
                  'taxonomy'  => 'category',
                  'field'     => 'slug',
                  'terms'     => $tax->slug
              )
          )
      );
      if (get_posts($args)) :
  ?>
      <h2><?php echo $tax->name; ?></h2>
      <?php
        foreach(get_posts($args) as $p) :
        $customMetaPost = get_post_custom($p->ID);
        $dates = $customMetaPost["dates"][0];
      ?>
          <p>
            <a href="<?php echo get_permalink($p); ?>">
              <?php echo $p->post_title; ?> (<?php echo $dates;?>)
            </a>
          </p>
      <?php
        endforeach;
      endif;
  endforeach;
  ?>

</div>
