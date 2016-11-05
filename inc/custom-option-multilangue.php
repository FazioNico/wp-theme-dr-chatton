<?php
// create custom plugin settings menu
add_action('admin_menu', 'translation_plugin_menu');

function translation_plugin_menu() {
	//create new top-level menu
	add_menu_page('Multilangue', 'Multilangue', 'administrator', __FILE__, 'translation_plugin_plugin_page' , 'dashicons-translation', 79);
	//call register settings function
	add_action( 'admin_init', 'register_translation_plugin' );
}


function register_translation_plugin() {
	//register our settings
  register_setting( 'translation-plugin-settings-group', 'translation' );
}

function translation_plugin_plugin_page() {
?>
  <div class="wrap">
  <h1>Configuration Multilangue</h1>

  <form method="post" action="options.php">
      <?php settings_fields( 'translation-plugin-settings-group' ); ?>
      <?php do_settings_sections( 'translation-plugin-settings-group' );
      //print_r('>'.get_option('translation') );
      ?>
      <div class="mnt-radio">
        <input type="radio" name="translation" value="1" <?php if(get_option('translation') === '1'){echo('checked');}?>/> Activé
      </div>
      <div class="mnt-radio">
        <input type="radio" name="translation" value="0" <?php if(get_option('translation') === '0'){echo('checked');}?> /> Désactivé
      </div>
      <?php submit_button(); ?>

  </form>
  </div>
<?php
}
?>
