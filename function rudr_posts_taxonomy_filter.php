//place in functions.php of wordpress

function rudr_posts_taxonomy_filter() {
	global $typenow; // this variable stores the current custom post type
	if( $typenow == 'post' ){ // choose one or more post types to apply taxonomy filter for them if( in_array( $typenow  array('post','games') )
		$taxonomy_names = array('platform', 'device');
		foreach ($taxonomy_names as $single_taxonomy) {
			$current_taxonomy = isset( $_GET[$single_taxonomy] ) ? $_GET[$single_taxonomy] : '';
			$taxonomy_object = get_taxonomy( $single_taxonomy );
			$taxonomy_name = strtolower( $taxonomy_object->labels->name );
			$taxonomy_terms = get_terms( $single_taxonomy );
			if(count($taxonomy_terms) > 0) {
				echo "<select name='$single_taxonomy' id='$single_taxonomy' class='postform'>";
				echo "<option value=''>All $taxonomy_name</option>";
				foreach ($taxonomy_terms as $single_term) {
					echo '<option value='. $single_term->slug, $current_taxonomy == $single_term->slug ? ' selected="selected"' : '','>' . $single_term->name .' (' . $single_term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
 
add_action( 'restrict_manage_posts', 'rudr_posts_taxonomy_filter' );