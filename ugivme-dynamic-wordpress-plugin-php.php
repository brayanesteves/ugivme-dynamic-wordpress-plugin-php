<?php
/**
* Plugin Name: Ugivme dynamic
* Plugin URI: https://ugivme.com/
* Description: All functions plataform
* Version: 0.0.1
* Author: Brayan Esteves
* Author URI: https://github.com/brayanesteves
**/
/**
 * Agrega campos personalizados en la pantalla "Editar producto" en la pestaña "General"
 */
function wc_custom_option_group() {
	echo '<div class="option_group">';
  
  // Creamos los campos HTML usando las funciones woocommerce_wp_*
  
  // En este caso crearemos un campo tipo "checkbox" con la función "woocommerce_wp_checkbox"
  /*woocommerce_wp_checkbox( array(
		'id'      => 'super_product',
		'value'   => get_post_meta( get_the_ID(), 'super_product', true ), // recupera el valor guardado usando la función get_post_meta()
		'label'   => 'This is a super product',
		'desc_tip' => true,
		'description' => 'If it is not a regular WooCommerce product',
	) );*/
  
  // Luego creamos un tipo de campo "select"
  /*woocommerce_wp_select( array(
		'id'      => 'select_options',
		'label'   => 'Options to be selected',
		'selected' => true,
		'value' => get_post_meta(get_the_ID(), 'select_options', true), // Recupera el valor seleccionado
	  'options' => [
      '' => 'Choose',
      'first-option' => 'Primera opción',
      'second-option' => 'Segunda opción',
    ],
	));*/

	// Y luego usamos la siguiente función para agregar un campo del tipo TEXT
	woocommerce_wp_text_input( array(
		'id'      => 'price_rebajado',
		'value'   => get_post_meta(get_the_ID(), 'price_rebajado', true), // Recupera el valor guardado usando "get_post_meta"
		'label'   => 'Precio Rebajado'. ' (' . get_woocommerce_currency_symbol() . ')',
		'class' => 'short',
	) );
  
  echo '</div>';
}
add_action( 'woocommerce_product_options_general_product_data', 'wc_custom_option_group' );

/**
 * Luego crearemos la función para guardar los datos de los campos
 */
function wc_save_custom_fields( $id, $post ) {
  update_post_meta( $id, 'super_product', $_POST['super_product'] );
  update_post_meta( $id, 'select_options', $_POST['select_options'] );
  update_post_meta( $id, 'text_field', $_POST['text_field'] );
}
add_action( 'woocommerce_process_product_meta', 'wc_save_custom_fields', 10, 2 );
