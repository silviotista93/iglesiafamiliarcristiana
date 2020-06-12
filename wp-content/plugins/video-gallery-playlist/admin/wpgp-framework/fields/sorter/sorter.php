<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: sorter
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WPGP_Field_sorter' ) ) {
  class WPGP_Field_sorter extends WPGP_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'disabled'       => true,
        'enabled_title'  => esc_html__( 'Enabled', 'wpgp' ),
        'disabled_title' => esc_html__( 'Disabled', 'wpgp' ),
      ) );

      echo $this->field_before();

      $this->value      = ( ! empty( $this->value ) ) ? $this->value : $this->field['default'];
      $enabled_options  = ( ! empty( $this->value['enabled'] ) ) ? $this->value['enabled'] : array();
      $disabled_options = ( ! empty( $this->value['disabled'] ) ) ? $this->value['disabled'] : array();

      echo ( $args['disabled'] ) ? '<div class="wpgp-modules">' : '';

      echo ( ! empty( $args['enabled_title'] ) ) ? '<div class="wpgp-sorter-title">'. $args['enabled_title'] .'</div>' : '';
      echo '<ul class="wpgp-enabled">';
      if( ! empty( $enabled_options ) ) {
        foreach( $enabled_options as $key => $value ) {
          echo '<li><input type="hidden" name="'. $this->field_name( '[enabled]['. $key .']' ) .'" value="'. $value .'"/><label>'. $value .'</label></li>';
        }
      }
      echo '</ul>';

      // Check for hide/show disabled section
      if( $args['disabled'] ) {

        echo '</div>';

        echo '<div class="wpgp-modules">';
        echo ( ! empty( $args['disabled_title'] ) ) ? '<div class="wpgp-sorter-title">'. $args['disabled_title'] .'</div>' : '';
        echo '<ul class="wpgp-disabled">';
        if( ! empty( $disabled_options ) ) {
          foreach( $disabled_options as $key => $value ) {
          echo '<li><input type="hidden" name="'. $this->field_name( '[disabled]['. $key .']' ) .'" value="'. $value .'"/><label>'. $value .'</label></li>';
          }
        }
        echo '</ul>';
        echo '</div>';

      }

      echo '<div class="clear"></div>';

      echo $this->field_after();

    }

    public function enqueue() {

      if( ! wp_script_is( 'jquery-ui-sortable' ) ) {
        wp_enqueue_script( 'jquery-ui-sortable' );
      }

    }

  }
}
