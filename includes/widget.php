<?php
// Register and load the widget
function gp_branches_load_widget() {
    register_widget( 'gp_branches_widget' );
}
add_action( 'widgets_init', 'gp_branches_load_widget' );
 
// Creating the widget 
class gp_branches_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'gp_branches_widget', 
 
// Widget name will appear in UI
__('Branches', 'generatepress'), 
 
// Widget description
array( 'description' => __( 'Add branch contact information as an accordion', 'generatepress' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
$address = $instance['gp_branches_address'];
$address_link = str_replace(array(' '),'+',$address);
$fax = $instance['gp_branches_fax'];
$fax_link = str_replace(array('(',')', ' '),'',$fax);
$email = $instance['gp_branches_email'];
$code = !empty( $instance['gp_branches_code'] ) ? $instance['gp_branches_code'] : '+61';
$phone = $instance['gp_branches_phone'];
$phone_link = str_replace(array('(',')', ' '),'',$phone);
$second_phone = $instance['gp_branches_second_phone'];
$second_phone_link = str_replace(array('(',')', ' '),'',$second_phone);

// before and after widget arguments are defined by themes
echo $args['before_widget'];
 
// This is where you run the code and display the output
?>
<button class="branch-accordion"><?php echo $title; ?></button>
<div class="branch-panel">
    <p><a class="branch-link" href="https://www.google.com/maps/place/<?php echo $address_link; ?>" target="_blank"><i class="fa fa-home footer-icon"></i> <?php echo $address; ?></a></p>
    <p><a class="branch-link" href="tel:<?php echo $code . ltrim($phone_link, '0'); ?>"><i class="fa fa-phone footer-icon"></i> <?php echo $phone; ?></a></p>
    <p><a class="branch-link" href="tel:<?php echo $code . ltrim($second_phone_link, '0'); ?>"><i class="fa fa-phone footer-icon"></i> <?php echo $second_phone; ?></a><p>
    <p><a class="branch-link" href="tel:<?php echo $code . ltrim($fax_link, '0'); ?>"><i class="fa fa-fax footer-icon"></i> F: <?php echo $fax; ?></a></p>
    <p><a class="branch-link" href="mailto:<?php echo $email; ?>"><i class="fa fa-envelope footer-icon"></i> <?php echo $email; ?></a></p>
</div>
<?php

echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
// Set default values
$instance = wp_parse_args( (array) $instance, array( 
    'gp_branches_title' => '',
    'gp_branches_name' => '',
    'gp_branches_address' => '',
    'gp_branches_phone' => '',
    'gp_branches_second_phone' => '',
    'gp_branches_fax' => '',
    'gp_branches_email' => '',
    'gp_branches_code' => '+61',
) );

// Retrieve an existing value from the database
$title = !empty( $instance['title'] ) ? $instance['title'] : '';
$gp_branches_address = !empty( $instance['gp_branches_address'] ) ? $instance['gp_branches_address'] : '';
$gp_branches_phone = !empty( $instance['gp_branches_phone'] ) ? $instance['gp_branches_phone'] : '';
$gp_branches_second_phone = !empty( $instance['gp_branches_second_phone'] ) ? $instance['gp_branches_second_phone'] : '';
$gp_branches_fax = !empty( $instance['gp_branches_fax'] ) ? $instance['gp_branches_fax'] : '';
$gp_branches_email = !empty( $instance['gp_branches_email'] ) ? $instance['gp_branches_email'] : '';
$gp_branches_code = !empty( $instance['gp_branches_code'] ) ? $instance['gp_branches_code'] : '';
// Widget admin form
echo '<p>';
echo '	<label for="' . $this->get_field_id( 'title' ) . '" class="gp_branches_title_label">' . __( 'Branch Name', 'generatepress' ) . '</label>';
echo '<input class="widefat" id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="text" value="' . esc_attr( $title ) . '" />';
echo '</p>';

echo '<p>';
echo '	<label for="' . $this->get_field_id( 'gp_branches_address' ) . '" class="gp_branches_address_label">' . __( 'Branch Address', 'generatepress' ) . '</label>';
echo '	<textarea id="' . $this->get_field_id( 'gp_branches_address' ) . '" name="' . $this->get_field_name( 'gp_branches_address' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'generatepress' ) . '">' . $gp_branches_address . '</textarea>';
echo '</p>';

echo '<p>';
echo '	<label for="' . $this->get_field_id( 'gp_branches_phone' ) . '" class="gp_branches_phone_label">' . __( 'Branch Phone Number', 'generatepress' ) . '</label>';
echo '	<input type="text" id="' . $this->get_field_id( 'gp_branches_phone' ) . '" name="' . $this->get_field_name( 'gp_branches_phone' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'generatepress' ) . '" value="' . esc_attr( $gp_branches_phone ) . '">';
echo '</p>';

echo '<p>';
echo '	<label for="' . $this->get_field_id( 'gp_branches_second_phone' ) . '" class="gp_branches_second_phone">' . __( 'Additional Phone Number', 'generatepress' ) . '</label>';
echo '	<input type="text" id="' . $this->get_field_id( 'gp_branches_second_phone' ) . '" name="' . $this->get_field_name( 'gp_branches_second_phone' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'generatepress' ) . '" value="' . esc_attr( $gp_branches_second_phone ) . '">';
echo '</p>';

echo '<p>';
echo '	<label for="' . $this->get_field_id( 'gp_branches_fax' ) . '" class="gp_branches_fax_label">' . __( 'Branch Fax', 'generatepress' ) . '</label>';
echo '	<input type="text" id="' . $this->get_field_id( 'gp_branches_fax' ) . '" name="' . $this->get_field_name( 'gp_branches_fax' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'generatepress' ) . '" value="' . esc_attr( $gp_branches_fax ) . '">';
echo '</p>';

echo '<p>';
echo '	<label for="' . $this->get_field_id( 'gp_branches_email' ) . '" class="gp_branches_email_label">' . __( 'Branch Email', 'generatepress' ) . '</label>';
echo '	<input type="email" id="' . $this->get_field_id( 'gp_branches_email' ) . '" name="' . $this->get_field_name( 'gp_branches_email' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'generatepress' ) . '" value="' . esc_attr( $gp_branches_email ) . '">';
echo '</p>';

echo '<p>';
echo '	<label for="' . $this->get_field_id( 'gp_branches_code' ) . '" class="gp_branches_code_label">' . __( 'Country Code', 'generatepress' ) . '</label>';
echo '	<input type="text" id="' . $this->get_field_id( 'gp_branches_code' ) . '" name="' . $this->get_field_name( 'gp_branches_code' ) . '" class="widefat" placeholder="' . esc_attr__( '', 'generatepress' ) . '" value="' . esc_attr( $gp_branches_code ) . '">';
echo '</p>';
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    $instance['title'] = !empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['gp_branches_address'] = !empty( $new_instance['gp_branches_address'] ) ? strip_tags( $new_instance['gp_branches_address'] ) : '';
    $instance['gp_branches_phone'] = !empty( $new_instance['gp_branches_phone'] ) ? strip_tags( $new_instance['gp_branches_phone'] ) : '';
    $instance['gp_branches_second_phone'] = !empty( $new_instance['gp_branches_second_phone'] ) ? strip_tags( $new_instance['gp_branches_second_phone'] ) : '';
    $instance['gp_branches_fax'] = !empty( $new_instance['gp_branches_fax'] ) ? strip_tags( $new_instance['gp_branches_fax'] ) : '';
    $instance['gp_branches_email'] = !empty( $new_instance['gp_branches_email'] ) ? strip_tags( $new_instance['gp_branches_email'] ) : '';
    $instance['gp_branches_code'] = !empty( $new_instance['gp_branches_code'] ) ? strip_tags( $new_instance['gp_branches_code'] ) : '';

    return $instance;
}
} // Class gp_branches_widget ends here