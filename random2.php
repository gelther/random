<?php

add_action( 'was_match_condition_contains_category', 'was_match_condition_contains_category', 10, 3 );    

/* Match contains category    
 *
 * @param bool $match
 * @param string $operator
 * @param mixed $value    
 * @return bool
 */
function was_match_condition_contains_category( $match, $operator, $value ) {

	global $woocommerce;

	if ( ! isset( $woocommerce->cart ) ) return;

	$match = false;    

	if ( '==' == $operator ) :

		foreach ( $woocommerce->cart->cart_contents as $product ) :

			if ( has_term( $value, 'product_cat', $product['product_id'] ) ) :
				return true;
			endif;   

		endforeach;

	elseif ( '!=' == $operator ) :

		$match = true;
		foreach ( $woocommerce->cart->cart_contents as $product ) :

			if ( has_term( $value, 'product_cat', $product['product_id'] ) ) :
				return false;
			endif;

		endforeach;
			
	endif;

	return $match;

}

add_filter( 'was_conditions', 'was_conditions_add_contains_category', 10, 1 );
function was_conditions_add_contains_category( $conditions ) {

	$conditions['Cart']['contains_category'] = 'Contains category';

	return $conditions;

}
		
add_filter( 'was_values', 'was_values_add_contains_category', 10, 2 );
function was_values_add_contains_category( $values, $condition ) {

	switch ( $condition ) {

		case 'contains_category':
			$values['field'] = 'select';

			$categories = get_terms( 'product_cat', array( 'hide_empty' => false ) );
			foreach ( $categories as $category ) :
				$values['options'][ $category->slug ] = $category->name;
			endforeach;

		break;

	}

	return $values;

}



?>
