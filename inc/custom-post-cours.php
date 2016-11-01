<?php

function cours_module() {
	$args = array(
		'label' => __('Cours'),
		'singular_label' => __('Cour'),
		'public' => true,
		'show_ui' => true,
		'_builtin' => false, // It's a custom post type, not built in
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "cours"),
		'query_var' => "cours", // This goes to the WP_Query schema
		'supports' => array('title', 'editor'), //titre + zone de texte + champs personnalisés + miniature valeur possible : 'title','editor','author','thumbnail','excerpt'
		'taxonomies' => array('category')
	);
	register_post_type( 'cours' , $args ); // enregistrement de l'entité projet basé sur les arguments ci-dessus
	register_taxonomy_for_object_type('post_tag', 'cours','show_tagcloud=1&hierarchical=false'); // ajout des mots clés pour notre custom post type

	add_action("admin_init", "add_customFields"); //function pour ajouter des champs personnalisés
	add_action('save_post', 'save_cours'); //function pour la sauvegarde de nos champs personnalisés
	add_action('save_post','save_img_attachement_post',1,2);
	add_action( 'post_edit_form_tag' , 'post_edit_form_tag' ); // function for enable  multipart/form-data
}
add_action('init', 'cours_module');

function custom_field_dates(){
	global $post;
	$custom = get_post_custom($post->ID);
	$dates = $custom["dates"][0];
	echo '<input type="text" value="'.$dates.'" name="dates"/>';
}
function custom_field_formateurs(){
	global $post;
	$custom = get_post_custom($post->ID);
	$formateurs = $custom["formateurs"][0];
	$editor_id = 'formateurs';
	$settings = array(
		'media_buttons' => false
	);
	wp_editor( $formateurs, $editor_id, $settings );
}

function custom_field_file() {
		global $post;
    // If there is an existing image, show it
    if($existing_image_id) {
      //  echo '<div>Attached Image ID: ' . $existing_image_id . '</div>';
    }
    echo '<input type="file" name="upload_attachment" id="upload_attachment" />';
    // See if there's a status message to display (we're using this to show errors during the upload process, though we should probably be using the WP_error class)
    $status_message = get_post_meta($post->ID,'attached_pdf_upload_feedback', true);
    // Show an error message if there is one
    if($status_message) {
        echo '<div class="upload_status_message">';
            echo $status_message;
        echo '</div>';
    }
    // Put in a hidden flag. This helps differentiate between manual saves and auto-saves (in auto-saves, the file wouldn't be passed).
    echo '<input type="hidden" name="xxxx_manual_save_flag" value="true" />';
		echo '<hr />';
		$existing_image_id = get_post_meta($post->ID,'attached_pdf', true);
    if(is_numeric($existing_image_id)) {
        echo '<div>';
            $existing_pdf_url = wp_get_attachment_url($existing_image_id);
						echo '<b>Fichier actuel:</b> <a href="'.$existing_pdf_url.'" target="_blank"><img src="'.get_template_directory_uri().'/src/img/iconpdf.gif" /> PDF</a>';
        echo '</div>';
    }

}

// Enable multipart/form-data to upload img form custom type fiel
function post_edit_form_tag( ) {
   echo ' enctype="multipart/form-data"';
}

function save_img_attachement_post() {
	global $post;
	$post_id = $post->ID;
	//var_dump($_FILES['upload_attachment']);
    // Get the post type. Since this function will run for ALL post saves (no matter what post type), we need to know this.
    // It's also important to note that the save_post action can runs multiple times on every post save, so you need to check and make sure the
    // post type in the passed object isn't "revision"
    $post_type = $post->post_type;
    // Make sure our flag is in there, otherwise it's an autosave and we should bail.
    if($post_id) {

        // Logic to handle specific post types
        switch($post_type) {
            // If this is a post. You can change this case to reflect your custom post slug
            case 'cours':
                // HANDLE THE FILE UPLOAD
                // If the upload field has a file in it
                if(isset($_FILES['upload_attachment']) && ($_FILES['upload_attachment']['size'] > 0)) {
                    // Get the type of the uploaded file. This is returned as "type/extension"
                    $arr_file_type = wp_check_filetype(basename($_FILES['upload_attachment']['name']));
                    $uploaded_file_type = $arr_file_type['type'];
                    // Set an array containing a list of acceptable formats
                    $allowed_file_types = array('image/jpg','image/jpeg','image/gif','image/png', 'application/pdf');
                    // If the uploaded file is the right format
                    if(in_array($uploaded_file_type, $allowed_file_types)) {
                        // Options array for the wp_handle_upload function. 'test_upload' => false
                        $upload_overrides = array( 'test_form' => false );
                        // Handle the upload using WP's wp_handle_upload function. Takes the posted file and an options array
                        $uploaded_file = wp_handle_upload($_FILES['upload_attachment'], $upload_overrides);
                        // If the wp_handle_upload call returned a local path for the image
                        if(isset($uploaded_file['file'])) {
                            // The wp_insert_attachment function needs the literal system path, which was passed back from wp_handle_upload
                            $file_name_and_location = $uploaded_file['file'];
                            // Generate a title for the image that'll be used in the media library
                            $file_title_for_media_library = 'your title here';
                            // Set up options array to add this file as an attachment
                            $attachment = array(
                                'post_mime_type' => $uploaded_file_type,
                                'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),
                                'post_content' => '',
                                'post_status' => 'inherit'
                            );
                            // Run the wp_insert_attachment function. This adds the file to the media library and generates the thumbnails. If you wanted to attch this image to a post, you could pass the post id as a third param and it'd magically happen.
                            $attach_id = wp_insert_attachment( $attachment, $file_name_and_location );
                            require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                            $attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
                            wp_update_attachment_metadata($attach_id,  $attach_data);
                            // Before we update the post meta, trash any previously uploaded image for this post.
                            // You might not want this behavior, depending on how you're using the uploaded images.
                            // $existing_uploaded_image = (int) get_post_meta($post_id,'attached_pdf', true);
                            // if(is_numeric($existing_uploaded_image)) {
                            //     wp_delete_attachment($existing_uploaded_image);
                            // }
                            // Now, update the post meta to associate the new image with the post
                            update_post_meta($post_id,'attached_pdf',$attach_id);
                            // Set the feedback flag to false, since the upload was successful
                            $upload_feedback = false;
                        } else { // wp_handle_upload returned some kind of error. the return does contain error details, so you can use it here if you want.
                            $upload_feedback = 'There was a problem with your upload.';
                            update_post_meta($post_id,'attached_pdf',$attach_id);
                        }
                    } else { // wrong file type
                        $upload_feedback = 'Please upload only image files (jpg, gif or png). ->'.$uploaded_file_type;
                        update_post_meta($post_id,'attached_pdf',$attach_id);
                    }
                } else { // No file was passed
                    $upload_feedback = false;
                }
                // Update the post meta with any feedback
                update_post_meta($post_id,'attached_pdf_upload_feedback',$upload_feedback);

            break;
            default:
        } // End switch
    return;
} // End if manual save flag
    return;
}

function add_customFields(){
	//initialisation des champs spécifiques aux Custom Post
	add_meta_box("custom_field_dates", "Dates", "custom_field_dates", "cours", "normal", "low");  //il s'agit de notre champ personnalisé qui apelera la fonction url_projet()
	add_meta_box("custom_field_formateurs", "Formateurs", "custom_field_formateurs", "cours", "normal", "low");  //il s'agit de notre champ personnalisé qui apelera la fonction url_projet()
	add_meta_box("custom_field_file", "Fichiers", "custom_field_file", "cours", "normal", "low");  //il s'agit de notre champ personnalisé qui apelera la fonction url_projet()
}

function save_cours(){ //sauvegarde des champs spécifiques
	global $post;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { // fonction pour éviter  le vidage des champs personnalisés lors de la sauvegarde automatique
		return $postID;
	}

	update_post_meta($post->ID, "dates", $_POST["dates"]);
	update_post_meta($post->ID, "formateurs", $_POST["formateurs"]);
	update_post_meta($post->ID, "file", $_POST["file"]);
}
