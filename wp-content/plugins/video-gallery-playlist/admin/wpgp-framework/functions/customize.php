<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * WP Customize custom panel
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WP_Customize_Panel_WPGP' ) && class_exists( 'WP_Customize_Panel' ) ) {
  class WP_Customize_Panel_WPGP extends WP_Customize_Panel {
    public $type = 'wpgp';
  }
}

/**
 *
 * WP Customize custom section
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WP_Customize_Section_WPGP' ) && class_exists( 'WP_Customize_Section' ) ) {
  class WP_Customize_Section_WPGP extends WP_Customize_Section {
    public $type = 'wpgp';
  }
}

/**
 *
 * WP Customize custom control
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! class_exists( 'WP_Customize_Control_WPGP' ) && class_exists( 'WP_Customize_Control' ) ) {
  class WP_Customize_Control_WPGP extends WP_Customize_Control {

    public $type   = 'wpgp';
    public $field  = '';
    public $unique = '';

    protected function render() {

      $depend = '';
      $hidden = '';

      if ( ! empty( $this->field['dependency'] ) ) {
        $hidden  = ' wpgp-dependency-control hidden';
        $depend .= ' data-controller="'. $this->field['dependency'][0] .'"';
        $depend .= ' data-condition="'. $this->field['dependency'][1] .'"';
        $depend .= ' data-value="'. $this->field['dependency'][2] .'"';
      }

      $id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
      $class = 'customize-control customize-control-' . $this->type . $hidden;

      echo '<li id="'. $id .'" class="'. $class .'"'. $depend .'>';
      $this->render_content();
      echo '</li>';

    }

    public function render_content() {

      $complex = array(
        'accordion',
        'background',
        'backup',
        'border',
        'button_set',
        'checkbox',
        'color_group',
        'date',
        'dimensions',
        'fieldset',
        'group',
        'image_select',
        'link_color',
        'media',
        'palette',
        'repeater',
        'sortable',
        'sorter',
        'spacing',
        'switcher',
        'tabbed',
        'typography'
      );

      $field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
      $custom     = ( ! empty( $this->field['customizer'] ) ) ? true : false;
      $is_complex = ( in_array( $this->field['type'], $complex ) ) ? true : false;
      $class      = ( $is_complex || $custom ) ? ' wpgp-customize-complex' : '';
      $atts       = ( $is_complex || $custom ) ? ' data-unique-id="'. $this->unique .'" data-option-id="'. $field_id .'"' : '';

      if( ! $is_complex && ! $custom ) {
        $this->field['attributes']['data-customize-setting-link'] = $this->settings['default']->id;
      }

      $this->field['name'] = $this->settings['default']->id;

      $this->field['dependency'] = array();

      echo '<div class="wpgp-customize-field'. $class .'"'. $atts .'>';

      WPGP::field( $this->field, $this->value(), $this->unique, 'customize' );

      echo '</div>';

    }

  }
}
