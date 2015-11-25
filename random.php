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

		if ( '==' == $operator ) {
			$match = ( WC()->cart->subtotal == $value );
		}	elseif ( '!=' == $operator ) {
			$match = ( WC()->cart->subtotal != $value );
		}  elseif ( '>=' == $operator ) {
			$match = ( WC()->cart->subtotal >= $value );
		} elseif ( '<=' == $operator ) {
			$match = ( WC()->cart->subtotal <= $value );
		}

		return $match;
	}


	/*
	 * Subtotal excl. taxes.
	 *
	 * Match the condition value against the cart subtotal excl. taxes.
	 *
	 * @since 1.0.0
	 *
	 * @param 	bool 	$match		Current match value.
	 * @param 	string 	$operator	Operator selected by the user in the condition row.
	 * @param 	mixed 	$value		Value given by the user in the condition row.
	 * @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 * 
	 */
	public function wafs_match_condition_subtotal_ex_tax	( $match, $operator, $value ){
		if (!isset( WC()->cart ) ) return $match;

		if ( '==' == $operator ) {
			$match = ( WC()->cart->subtotal_ex_tax == $value );
		} else if ( '!=' == $operator ) {
			$match = ( WC()->cart->subtotal_ex_tax != $value );
		} else  if ( '>=' == $operator ) {
			$match = ( WC()->cart->subtotal_ex_tax >= $value );
		} else	if ( '<=' == $operator ) {
			$match = ( WC()->cart->subtotal_ex_tax <= $value );
		}

		return $match;
	}


	/*
	 *  Taxes.
	 *
	 *  Match the condition value against the cart taxes.
	 *
	 *  @since 1.0.0
	 *
	 *  @param 	bool 	$match		Current match value.
	 *  @param 	string 	$operator	Operator selected by the user in the condition row.
	 *  @param 	mixed 	$value		Value given by the user in the condition row.
	 *  @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 */

	public function wafs_match_condition_tax  ( $match, $operator, $value ) 
	{


		if ( ! isset( WC()->cart ) ) return $match;

		$taxes = array_sum( (ARRAY ) WC()->cart->taxes );

		if ( '==' == $operator ) :
			$match = ( $taxes == $value );
		elseif ( '!=' == $operator ) :
			$match = ( $taxes != $value );
		elseif ( '>=' == $operator ) :
			$match = ( $taxes >= $value );
		elseif ( '<=' == $operator ) :
			$match = ( $taxes <= $value );
		endif;

		return $match;
	}


	/**
	 *	Quantity.
	 *
	 *	Match the condition value against the cart quantity.
	 *	This also includes product quantities.
	 *
	 *	@since 1.0.0
	 *
	 *	@param 	bool 	$match		Current match value.
	 *	@param 	string 	$operator	Operator selected by the user in the condition row.
	 *	@param 	mixed 	$value		Value given by the user in the condition row.
	 *	@return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 */
	public function wafs_match_condition_quantity( $match, $operator, $value )	{



		if ( ! isset( WC()->cart ) ) return $match;

		if ( '==' == $operator ) :
			$match = ( WC()->cart->cart_contents_count == $value );
		elseif ( '!=' == $operator ) :
			$match = ( WC()->cart->cart_contents_count != $value );
		elseif ( '>=' == $operator ) :
			$match = ( WC()->cart->cart_contents_count >= $value );
		elseif ( '<=' == $operator ) :
			$match = ( WC()->cart->cart_contents_count <= $value );
		endif;

		return $match;



	}


	/*****
	 * Contains product.
	 *
	 *Matches if the condition value product is in the cart.
	 *
	 * @since 1.0.0
	 *
	 *@param 	bool 	$match		Current match value.
	 *@param 	string 	$operator	Operator selected by the user in the condition row.
	 *@param 	mixed 	$value		Value given by the user in the condition row.
	 *@return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 */
	public function wafs_match_condition_contains_product( $match, $operator, $value ) {

		if ( ! isset( WC()->cart ) || empty( WC()->cart->cart_contents ) ) return $match;

		foreach ( WC()->cart->cart_contents as $product ) :
			$product_ids[] = $product[ 'product_id' ];
		endforeach;

		if ( '==' == $operator ) :
			$match = ( in_array( $value, $product_ids ) );
		elseif ( '!=' == $operator ) :
			$match = ( ! in_array( $value, $product_ids ) );
		endif;

		return $match;

	}


	/**
	 * Coupon.
	 *
	 * Match the condition value against the applied coupons.
	 *
	 * @since 1.0.0
	 *
	 * @param 	bool 	$match		Current match value.
	 * @param 	string 	$operator	Operator selected by the user in the condition row.
	 * @param 	mixed 	$value		Value given by the user in the condition row.
	 * @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 */
	public function wafs_match_condition_coupon( $match, $operator, $value ) {

		if ( ! isset( WC()->cart ) ) return $match;

		if ( '==' == $operator ) :
			$match = ( in_array( $value, WC()->cart->applied_coupons ) );
		elseif ( '!=' == $operator ) :
			$match = ( ! in_array( $value, WC()->cart->applied_coupons ) );
		endif;

		return $match;

	}


	/**
	* Weight.
	*
	* Match the condition value against the cart weight.
	*
	* @since 1.0.0
	*
	* @param 	bool 	$match		Current match value.
	* @param 	string 	$operator	Operator selected by the user in the condition row.
	* @param 	mixed 	$value		Value given by the user in the condition row.
	* @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	*/
	public function wafs_match_condition_weight( $match, $operator, $value ) {

		if ( ! isset( WC()->cart ) ) return $match;

		if ( '==' == $operator ) :
			$match = ( WC()->cart->cart_contents_weight == $value );
		elseif ( '!=' == $operator ) :
			$match = ( WC()->cart->cart_contents_weight != $value );
		elseif ( '>=' == $operator ) :
			$match = ( WC()->cart->cart_contents_weight >= $value );
		elseif ( '<=' == $operator ) :
			$match = ( WC()->cart->cart_contents_weight <= $value );
		endif;

		return $match;

	}


	/**
	 * Shipping class.
	 *
	 * Matches if the condition value shipping class is in the cart.
	 *
	 * @since 1.1.0
	 *
	 * @param 	bool 	$match		Current match value.
	 * @param 	string 	$operator	Operator selected by the user in the condition row.
	 * @param 	mixed 	$value		Value given by the user in the condition row.
	 * @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.	 */
	public function wafs_match_condition_contains_shipping_class( $match, $operator, $value ) {

		if ( ! isset( WC()->cart ) ) return $match;

		if ( $operator == '!=' ) :
			// True until proven false
			$match = true;
		endif;

		foreach ( WC()->cart->cart_contents as $product ) :

			$id 		= ! empty( $product[	'variation_id'	] ) ? $product[  'variation_id'  ] : $product[ 'product_id'];
			$product 	= get_product( $id );

			if ( $operator == '==' ) :
				if ( $product->get_shipping_class() == $value ) :
					return true;
				endif;
			elseif ( $operator == '!=' ) :
				if ( $product->get_shipping_class() == $value ) :
					return FALSE;
				endif;
			endif;

		endforeach;

		return $match;

	}


/******************************************************
 * User conditions
 *****************************************************/


	/**
	 * Zipcode.
	 *
	 * Match the condition value against the users shipping zipcode.
	 *
	 * @since 1.0.2; $value may contain single or comma (,) separated zipcodes.
	 *
	 * @param 	bool 	$match		Current match value.
	 * @param 	string 	$operator	Operator selected by the user in the condition row.
	 * @param 	mixed 	$value		Value given by the user in the condition row.
	 * @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 */
	public function wafs_match_condition_zipcode( $match, $operator, $value ) {

		if ( ! isset( WC()->customer ) ) return $match;

		if ( '==' == $operator ) :

			if ( preg_match( '/\, ?/', $value ) ) {
				$match = ( in_array( (int) WC()->customer->get_shipping_postcode(), array_map( 'intval', explode( ',', $value ) ) ) );
			} else {
				$match = ( (int) WC()->customer->get_shipping_postcode() == (int) $value );
			}

		elseif ( '!=' == $operator ) :

			if ( preg_match( '/\, ?/', $value ) ) {
				$match = ( ! in_array( (int) WC()->customer->get_shipping_postcode(), array_map( 'intval', explode( ',', $value ) ) ) );
			}else {
				$match = ( (int) WC()->customer->get_shipping_postcode() != (int) $value );
			}

		elseif ( '>=' == $operator ) :
			$match = ( (int) WC()->customer->get_shipping_postcode() >= (int) $value );
		elseif ( '<=' == $operator ) :
			$match = ( (int) WC()->customer->get_shipping_postcode() <= (int) $value );
		endif;

		return $match;

	}


	/**
	 * City.
	 *
	 * Match the condition value against the users shipping city.
	 *
	 * @since 1.0.0
	 *
	 * @param 	bool 	$match		Current match value.
	 * @param 	string 	$operator	Operator selected by the user in the condition row.
	 * @param 	mixed 	$value		Value given by the user in the condition row.
	 * @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
	 */
	public function wafs_match_condition_city( $match, $operator, $value ) {

		if ( ! isset( WC()->customer ) ) return $match;

		if ( '==' == $operator ) :
			$match = ( preg_match( "/^$value$/i", WC()->customer->get_shipping_city() ) );
		elseif ( '!=' == $operator ) :
			$match = ( ! preg_match( "/^$value$/i", WC()->customer->get_shipping_city() ) );
		endif;

		return $match;

	}

