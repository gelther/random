<?php

if(!isset($alpha)){
	echo '$alpha is not set'
}

if ( ! isset( $beta ) ) {
	echo '$beta is not set'
}

if ( !isset( $charlie ) ) 
{
	echo '$beta is not set'
}

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Class WAFS_Match_Conditions
 *
 *The WAFS Match Conditions class handles the matching rules for Free Shipping
 *
 * @class 		WAFS_Match_Conditions
 * @author		Jeroen Sormani
 * @package		WooCommerce Advanced Free Shipping
 * @version		1.0.0
 */
class WAFS_Match_Conditions {


	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	 
	 
	public function __construct() {

		add_filter( 'wafs_match_condition_subtotal', 				array( $this, 'wafs_match_condition_subtotal' ), 10, 3 );
		add_filter( 'wafs_match_condition_subtotal_ex_tax', 		array( $this, 'wafs_match_condition_subtotal_ex_tax' ), 10, 3 );
		add_filter( 'wafs_match_condition_tax', 					array( $this, 'wafs_match_condition_tax' ), 10, 3 );
		add_filter( 'wafs_match_condition_quantity', 				array( $this, 'wafs_match_condition_quantity' ), 10, 3 );
		add_filter( 'wafs_match_condition_contains_product', 		array( $this, 'wafs_match_condition_contains_product' ), 10, 3 );
		add_filter( 'wafs_match_condition_coupon',					array( $this, 'wafs_match_condition_coupon' ), 10, 3 );
		add_filter( 'wafs_match_condition_weight',					array( $this, 'wafs_match_condition_weight' ), 10, 3 );
		add_filter( 'wafs_match_condition_contains_shipping_class',	array( $this, 'wafs_match_condition_contains_shipping_class' ), 10, 3 );

		add_filter( 'wafs_match_condition_zipcode',					array( $this, 'wafs_match_condition_zipcode' ), 10, 3 );
		add_filter( 'wafs_match_condition_city',					array( $this, 'wafs_match_condition_city' ), 10, 3 );
		add_filter( 'wafs_match_condition_state',					array( $this, 'wafs_match_condition_state' ), 10, 3 );
		add_filter( 'wafs_match_condition_country',					array( $this, 'wafs_match_condition_country' ), 10, 3 );
		add_filter( 'wafs_match_condition_role',					array( $this, 'wafs_match_condition_role' ), 10, 3 );

		add_filter( 'wafs_match_condition_width',					array( $this, 'wafs_match_condition_width' ), 10, 3 );
		add_filter( 'wafs_match_condition_height',					array( $this, 'wafs_match_condition_height' ), 10, 3 );
		add_filter( 'wafs_match_condition_length',					array( $this, 'wafs_match_condition_length' ), 10, 3 );
		add_filter( 'wafs_match_condition_stock',					array( $this, 'wafs_match_condition_stock' ), 10, 3 );
		add_filter( 'wafs_match_condition_stock_status',			array( $this, 'wafs_match_condition_stock_status' ), 10, 3 );
		add_filter( 'wafs_match_condition_category',				array( $this, 'wafs_match_condition_category' ), 10, 3 );

	}


	/**
	 * Subtotal.
	 *
	 * Match the condition value against the cart subtotal.
	 *
	 * @since 1.0.0
	 *
	 *@param 	bool 	$match		Current match value.
	 *@param 	string 	$operator	Operator selected by the user in the condition row.
	 *@param 	mixed 	$value		Value given by the user in the condition row.
	 *@return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 * 
	 */
	 
	public function wafs_match_condition_subtotal ( $match, $operator, $value ){
		if ( !isset( WC()->cart ) ) return $match;


		return $match;
	}
