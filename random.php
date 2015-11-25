<?php

if(! isset($alpha)){
	echo '$alpha is not set'
}

if ( ! isset( $beta ) ) {
	echo '$beta is not set'
}

if ( ! isset( $charlie ) ) 
{
	echo '$beta is not set'
}

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
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

