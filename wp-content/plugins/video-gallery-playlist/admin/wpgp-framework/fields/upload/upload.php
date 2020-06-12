<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: upload
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_upload' ) ) {
  class WPGP_Field_upload extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'library'      => array(),
        'button_title' => esc_html__( 'Upload', 'wpgp' ),
        'remove_title' => esc_html__( 'Remove', 'wpgp' ),
      ) );

      echo $this->field_before();

      $library = ( is_array( $args['library'] ) ) ? $args['library'] : array_filter( (array) $args['library'] );
      $library = ( ! empty( $library ) ) ? implode(',', $library ) : '';
      $hidden  = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="wpgp--wrap">';
      echo '<input type="text" name="'. $this->field_name() .'" value="'. $this->value .'"'. $this->field_attributes() .'/>';
      echo '<a href="#" class="button button-primary wpgp--button" data-library="'. esc_attr( $library ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button button-secondary wpgp-warning-primary wpgp--remove'. $hidden .'">'. $args['remove_title'] .'</a>';
      echo '</div>';

      echo $this->field_after();

    }
  }
}
