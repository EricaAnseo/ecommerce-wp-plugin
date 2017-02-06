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
		__('Shop Filter Widget', 'shop_filter_widget'), 

		// Widget description
		array( 'description' => __( 'Allows the customer to filter through the shop products.', 'shop_filter_widget' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		echo __( 'Hello, World! <br/>', 'shop_filter_widget' );
		echo __( $title , 'shop_filter_widget' );
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
		// Widget admin form
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class greeting_widget ends here

// Register and load the widget
function simp_ec_load_shop_filter_widget() {
	register_widget( 'simp_ec_shop_filter_widget' );
}
add_action( 'widgets_init', 'simp_ec_load_shop_filter_widget' );





