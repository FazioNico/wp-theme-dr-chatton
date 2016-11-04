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
          'post_type'         => 'coursen',
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
      //print_r(get_posts($args));
      if (get_posts($args)) :
  ?>
      <h2 class="catTitle"><?php echo $tax->name; ?></h2>
      <?php
        foreach(get_posts($args) as $p) :
        $customMetaPost = get_post_custom($p->ID);
        $dates = $customMetaPost["dates"][0];
      ?>
          <a href="<?php echo get_permalink($p); ?>">
            <p>
              <?php echo $p->post_title; ?> (<?php echo $dates;?>)
            </p>
          </a>
      <?php
        endforeach;
      endif;
  endforeach;
  ?>

</div>
