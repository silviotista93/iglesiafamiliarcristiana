/**
 *
 * -----------------------------------------------------------
 *
 * Codestar Framework Gutenberg Block
 * A Simple and Lightweight WordPress Option Framework
 *
 * -----------------------------------------------------------
 *
 */
( function( blocks, editor, element, components ) {

  if( !window.wpgp_gutenberg_blocks ) { return; }

  window.wpgp_gutenberg_blocks.forEach( function( block ) {

    var registerBlockType = blocks.registerBlockType;
    var PlainText         = editor.PlainText;
    var createElement     = element.createElement;
    var RawHTML           = element.RawHTML;
    var Button            = components.Button;

    registerBlockType('wpgp-gutenberg-block/block-'+block.hash, {
        title: block.gutenberg.title,
        icon: block.gutenberg.icon,
        category: block.gutenberg.category,
        description: block.gutenberg.description,
        keywords: block.gutenberg.keywords,
        supports: {
          html: false,
          className: false,
          customClassName: false,
        },
        attributes: {
          shortcode: {
            string: 'string',
            source: 'text',
          }
        },
        edit: function (props) {
          return (
            createElement('div', {className: 'wpgp-shortcode-block'},

              createElement(Button, {
                'data-modal-id': block.modal_id,
                'data-gutenberg-id': block.hash,
                className: 'button is-button is-default is-large wpgp-shortcode-button',
                onClick: function () {
                  window.wpgp_gutenberg_props = props;
                },
              }, block.button_title ),

              createElement(PlainText, {
                placeholder: block.gutenberg.placeholder,
                className: 'input-control',
                onChange: function (value) {
                  props.setAttributes({
                    shortcode: value
                  })
                },
                value: props.attributes.shortcode
              })

            )
          );
        },
        save: function (props) {
          return createElement(RawHTML, {}, props.attributes.shortcode);
        }
    });

  });

})(
  window.wp.blocks,
  window.wp.editor,
  window.wp.element,
  window.wp.components
);
