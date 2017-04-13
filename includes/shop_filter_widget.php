<?php 
/*
 *This section contains code for the Shop Filter widget
 *
*/

class simp_ec_shop_filter_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'simp_ec_shop_filter_widget', 

		// Widget name will appear in UI
		__('Simp Ecommerce Shop Filter Widget', 'shop_filter_widget'), 

		// Widget description
		array( 'description' => __( 'Allows the customer to filter through the shop products.', 'shop_filter_widget' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'shop_filter_widget', $instance['title'] );
		$filterCat = apply_filters( 'shop_filter_widget', $instance['filterCat'] );
		$filterPType = apply_filters( 'shop_filter_widget', $instance['filterPType'] );
		$filterAttribute = apply_filters( 'shop_filter_widget', $instance['filterAttribute'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		 // Check if checkbox is checked
	   	if( $filterCat AND $filterCat == '1' ) {
	     	echo '<p>'.__('filterCat is checked', 'shop_filter_widget').'</p>';
	   	}
	   	if( $filterPType AND $filterPType == '1' ) {
	     	echo '<p>'.__('filterPType is checked', 'shop_filter_widget').'</p>';
	   	}
	   	if( $filterAttribute AND $filterAttribute == '1' ) {
	     	echo '<p>'.__('filterAttribute is checked', 'shop_filter_widget').'</p>';
	   	}

		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'shop_filter_widget' );
		}

		if ( isset( $instance[ 'filterCat' ] ) ) {
			$filterCat = $instance[ 'filterCat' ];
		}
		else {
			$filterCat = '';
		}

		if ( isset( $instance[ 'filterPType' ] ) ) {
			$filterPType = $instance[ 'filterPType' ];
		}
		else {
			$filterPType = '';
		}

		if ( isset( $instance[ 'filterAttribute' ] ) ) {
			$filterAttribute = $instance[ 'filterAttribute' ];
		}
		else {
			$filterAttribute = '';
		}

		// Widget admin form
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'filterCat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filterCat' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $filterCat ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'filterCat' ) ); ?>"><?php _e( 'Category', 'shop_filter_widget' ); ?></label>

			<input id="<?php echo esc_attr( $this->get_field_id( 'filterPType' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filterPType' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $filterPType ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'filterPType' ) ); ?>"><?php _e( 'Product Type', 'shop_filter_widget' ); ?></label>

			<input id="<?php echo esc_attr( $this->get_field_id( 'filterAttribute' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filterAttribute' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $filterAttribute ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'filterAttribute' ) ); ?>"><?php _e( 'Attribute', 'shop_filter_widget' ); ?></label>

			<!-- <input type="checkbox" class="checkbox"  id="<?php //echo $this->get_field_id( 'category' ); ?>" name="<?php //echo $this->get_field_name( 'category' ); ?>" />
			 <label for="<?php //echo $this->get_field_id( 'category' ); ?>">Category</label> -->
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['filterCat'] = strip_tags($new_instance['filterCat']);
		$instance['filterPType'] = strip_tags($new_instance['filterPType']);
		$instance['filterAttribute'] = strip_tags($new_instance['filterAttribute']);
		return $instance;
	}
} // Class greeting_widget ends here

// Register and load the widget
function simp_ec_load_shop_filter_widget() {
	register_widget( 'simp_ec_shop_filter_widget' );
}
add_action( 'widgets_init', 'simp_ec_load_shop_filter_widget' );





