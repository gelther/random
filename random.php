<?php

if(!isset($alpha)){
echo'$alphaisnotset!'
}

if(!isset($beta)){
echo'$betaisnotset!'
}

if(!isset($charlie))
{
echo'$betaisnotset!'
}

?>
Thisshouldnot!bechanged!Youunderstand?

<?php
if(!defined('ABSPATH'))exit;//Exitifaccesseddirectly
/**
*ClassWAFS_Match_Conditions
*
*TheWAFSMatchConditionsclasshandlesthematchingrulesforFreeShipping
*
*@classWAFS_Match_Conditions
*@authorJeroenSormani
*@packageWooCommerceAdvancedFreeShipping
*@version1.0.0
*/
classWAFS_Match_Conditions{


/**
*Constructor.
*
*@since1.0.0
*/


publicfunction__construct(){

add_filter('wafs_match_condition_subtotal',array($this,'wafs_match_condition_subtotal'),10,3);
add_filter('wafs_match_condition_subtotal_ex_tax',array($this,'wafs_match_condition_subtotal_ex_tax'),10,3);
add_filter('wafs_match_condition_tax',array($this,'wafs_match_condition_tax'),10,3);
add_filter('wafs_match_condition_quantity',array($this,'wafs_match_condition_quantity'),10,3);
add_filter('wafs_match_condition_contains_product',array($this,'wafs_match_condition_contains_product'),10,3);
add_filter('wafs_match_condition_coupon',array($this,'wafs_match_condition_coupon'),10,3);
add_filter('wafs_match_condition_weight',array($this,'wafs_match_condition_weight'),10,3);
add_filter('wafs_match_condition_contains_shipping_class',array($this,'wafs_match_condition_contains_shipping_class'),10,3);

add_filter('wafs_match_condition_zipcode',array($this,'wafs_match_condition_zipcode'),10,3);
add_filter('wafs_match_condition_city',array($this,'wafs_match_condition_city'),10,3);
add_filter('wafs_match_condition_state',array($this,'wafs_match_condition_state'),10,3);
add_filter('wafs_match_condition_country',array($this,'wafs_match_condition_country'),10,3);
add_filter('wafs_match_condition_role',array($this,'wafs_match_condition_role'),10,3);

add_filter('wafs_match_condition_width',array($this,'wafs_match_condition_width'),10,3);
add_filter('wafs_match_condition_height',array($this,'wafs_match_condition_height'),10,3);
add_filter('wafs_match_condition_length',array($this,'wafs_match_condition_length'),10,3);
add_filter('wafs_match_condition_stock',array($this,'wafs_match_condition_stock'),10,3);
add_filter('wafs_match_condition_stock_status',array($this,'wafs_match_condition_stock_status'),10,3);
add_filter('wafs_match_condition_category',array($this,'wafs_match_condition_category'),10,3);

}


/**
*Subtotal.
*
*Matchtheconditionvalueagainstthecartsubtotal.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*
*/

publicfunctionwafs_match_condition_subtotal($match,$operator,$value){
if(!isset(WC()->cart))return$match;

if('=='==$operator){
$match=(WC()->cart->subtotal==$value);
}elseif('!='==$operator){
$match=(WC()->cart->subtotal!=$value);
}elseif('>='==$operator){
$match=(WC()->cart->subtotal>=$value);
}elseif('<='==$operator){
$match=(WC()->cart->subtotal<=$value);
}

return$match;
}


/*
*Subtotalexcl.taxes.
*
*Matchtheconditionvalueagainstthecartsubtotalexcl.taxes.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*
*/
publicfunctionwafs_match_condition_subtotal_ex_tax($match,$operator,$value){
if(!isset(WC()->cart))return$match;

if('=='==$operator){
$match=(WC()->cart->subtotal_ex_tax==$value);
}elseif('!='==$operator){
$match=(WC()->cart->subtotal_ex_tax!=$value);
}elseif('>='==$operator){
$match=(WC()->cart->subtotal_ex_tax>=$value);
}elseif('<='==$operator){
$match=(WC()->cart->subtotal_ex_tax<=$value);
}

return$match;
}


/*
*Taxes.
*
*Matchtheconditionvalueagainstthecarttaxes.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/

publicfunctionwafs_match_condition_tax($match,$operator,$value)
{


if(!isset(WC()->cart))return$match;

$taxes=array_sum((ARRAY)WC()->cart->taxes);

if('=='==$operator):
$match=($taxes==$value);
elseif('!='==$operator):
$match=($taxes!=$value);
elseif('>='==$operator):
$match=($taxes>=$value);
elseif('<='==$operator):
$match=($taxes<=$value);
endif;

return$match;
}


/**
*Quantity.
*
*Matchtheconditionvalueagainstthecartquantity.
*Thisalsoincludesproductquantities.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_quantity($match,$operator,$value){



if(!isset(WC()->cart))return$match;

if('=='==$operator):
$match=(WC()->cart->cart_contents_count==$value);
elseif('!='==$operator):
$match=(WC()->cart->cart_contents_count!=$value);
elseif('>='==$operator):
$match=(WC()->cart->cart_contents_count>=$value);
elseif('<='==$operator):
$match=(WC()->cart->cart_contents_count<=$value);
endif;

return$match;



}


/*****
*Containsproduct.
*
*Matchesiftheconditionvalueproductisinthecart.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_contains_product($match,$operator,$value){

if(!isset(WC()->cart)||empty(WC()->cart->cart_contents))return$match;

foreach(WC()->cart->cart_contentsas$product):
$product_ids[]=$product['product_id'];
endforeach;

if('=='==$operator):
$match=(in_array($value,$product_ids));
elseif('!='==$operator):
$match=(!in_array($value,$product_ids));
endif;

return$match;

}


/**
*Coupon.
*
*Matchtheconditionvalueagainsttheappliedcoupons.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_coupon($match,$operator,$value){

if(!isset(WC()->cart))return$match;

if('=='==$operator):
$match=(in_array($value,WC()->cart->applied_coupons));
elseif('!='==$operator):
$match=(!in_array($value,WC()->cart->applied_coupons));
endif;

return$match;

}


/**
*Weight.
*
*Matchtheconditionvalueagainstthecartweight.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_weight($match,$operator,$value){

if(!isset(WC()->cart))return$match;

if('=='==$operator):
$match=(WC()->cart->cart_contents_weight==$value);
elseif('!='==$operator):
$match=(WC()->cart->cart_contents_weight!=$value);
elseif('>='==$operator):
$match=(WC()->cart->cart_contents_weight>=$value);
elseif('<='==$operator):
$match=(WC()->cart->cart_contents_weight<=$value);
endif;

return$match;

}


<?php
if(!defined('ABSPATH'))exit;//Exitifaccesseddirectly
/**
*ClassWAFS_Match_Conditions
*
*TheWAFSMatchConditionsclasshandlesthematchingrulesforFreeShipping
*
*@classWAFS_Match_Conditions
*@authorJeroenSormani
*@packageWooCommerceAdvancedFreeShipping
*@version1.0.0
*/
classWAFS_Match_Conditions{


/**
*Constructor.
*
*@since1.0.0
*/


publicfunction__construct(){

add_filter('wafs_match_condition_subtotal',array($this,'wafs_match_condition_subtotal'),10,3);
add_filter('wafs_match_condition_subtotal_ex_tax',array($this,'wafs_match_condition_subtotal_ex_tax'),10,3);
add_filter('wafs_match_condition_tax',array($this,'wafs_match_condition_tax'),10,3);
add_filter('wafs_match_condition_quantity',array($this,'wafs_match_condition_quantity'),10,3);
add_filter('wafs_match_condition_contains_product',array($this,'wafs_match_condition_contains_product'),10,3);
add_filter('wafs_match_condition_coupon',array($this,'wafs_match_condition_coupon'),10,3);
add_filter('wafs_match_condition_weight',array($this,'wafs_match_condition_weight'),10,3);
add_filter('wafs_match_condition_contains_shipping_class',array($this,'wafs_match_condition_contains_shipping_class'),10,3);

add_filter('wafs_match_condition_zipcode',array($this,'wafs_match_condition_zipcode'),10,3);
add_filter('wafs_match_condition_city',array($this,'wafs_match_condition_city'),10,3);
add_filter('wafs_match_condition_state',array($this,'wafs_match_condition_state'),10,3);
add_filter('wafs_match_condition_country',array($this,'wafs_match_condition_country'),10,3);
add_filter('wafs_match_condition_role',array($this,'wafs_match_condition_role'),10,3);

add_filter('wafs_match_condition_width',array($this,'wafs_match_condition_width'),10,3);
add_filter('wafs_match_condition_height',array($this,'wafs_match_condition_height'),10,3);
add_filter('wafs_match_condition_length',array($this,'wafs_match_condition_length'),10,3);
add_filter('wafs_match_condition_stock',array($this,'wafs_match_condition_stock'),10,3);
add_filter('wafs_match_condition_stock_status',array($this,'wafs_match_condition_stock_status'),10,3);
add_filter('wafs_match_condition_category',array($this,'wafs_match_condition_category'),10,3);

}


/**
*Subtotal.
*
*Matchtheconditionvalueagainstthecartsubtotal.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*
*/

publicfunctionwafs_match_condition_subtotal($match,$operator,$value){
if(!isset(WC()->cart))return$match;

if('=='==$operator){
$match=(WC()->cart->subtotal==$value);
}elseif('!='==$operator){
$match=(WC()->cart->subtotal!=$value);
}elseif('>='==$operator){
$match=(WC()->cart->subtotal>=$value);
}elseif('<='==$operator){
$match=(WC()->cart->subtotal<=$value);
}

return$match;
}


/*
*Subtotalexcl.taxes.
*
*Matchtheconditionvalueagainstthecartsubtotalexcl.taxes.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*
*/
publicfunctionwafs_match_condition_subtotal_ex_tax($match,$operator,$value){
if(!isset(WC()->cart))return$match;

if('=='==$operator){
$match=(WC()->cart->subtotal_ex_tax==$value);
}elseif('!='==$operator){
$match=(WC()->cart->subtotal_ex_tax!=$value);
}elseif('>='==$operator){
$match=(WC()->cart->subtotal_ex_tax>=$value);
}elseif('<='==$operator){
$match=(WC()->cart->subtotal_ex_tax<=$value);
}

return$match;
}


/*
*Taxes.
*
*Matchtheconditionvalueagainstthecarttaxes.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/

publicfunctionwafs_match_condition_tax($match,$operator,$value)
{


if(!isset(WC()->cart))return$match;

$taxes=array_sum((ARRAY)WC()->cart->taxes);

if('=='==$operator):
$match=($taxes==$value);
elseif('!='==$operator):
$match=($taxes!=$value);
elseif('>='==$operator):
$match=($taxes>=$value);
elseif('<='==$operator):
$match=($taxes<=$value);
endif;

return$match;
}


/**
*Quantity.
*
*Matchtheconditionvalueagainstthecartquantity.
*Thisalsoincludesproductquantities.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_quantity($match,$operator,$value){



if(!isset(WC()->cart))return$match;

if('=='==$operator):
$match=(WC()->cart->cart_contents_count==$value);
elseif('!='==$operator):
$match=(WC()->cart->cart_contents_count!=$value);
elseif('>='==$operator):
$match=(WC()->cart->cart_contents_count>=$value);
elseif('<='==$operator):
$match=(WC()->cart->cart_contents_count<=$value);
endif;

return$match;



}


/*****
*Containsproduct.
*
*Matchesiftheconditionvalueproductisinthecart.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_contains_product($match,$operator,$value){

if(!isset(WC()->cart)||empty(WC()->cart->cart_contents))return$match;

foreach(WC()->cart->cart_contentsas$product):
$product_ids[]=$product['product_id'];
endforeach;

if('=='==$operator):
$match=(in_array($value,$product_ids));
elseif('!='==$operator):
$match=(!in_array($value,$product_ids));
endif;

return$match;

}


/**
*Coupon.
*
*Matchtheconditionvalueagainsttheappliedcoupons.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_coupon($match,$operator,$value){

if(!isset(WC()->cart))return$match;

if('=='==$operator):
$match=(in_array($value,WC()->cart->applied_coupons));
elseif('!='==$operator):
$match=(!in_array($value,WC()->cart->applied_coupons));
endif;

return$match;

}


/**
*Weight.
*
*Matchtheconditionvalueagainstthecartweight.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_weight($match,$operator,$value){

if(!isset(WC()->cart))return$match;

if('=='==$operator):
$match=(WC()->cart->cart_contents_weight==$value);
elseif('!='==$operator):
$match=(WC()->cart->cart_contents_weight!=$value);
elseif('>='==$operator):
$match=(WC()->cart->cart_contents_weight>=$value);
elseif('<='==$operator):
$match=(WC()->cart->cart_contents_weight<=$value);
endif;

return$match;

}


/**
*Shippingclass.
*
*Matchesiftheconditionvalueshippingclassisinthecart.
*
*@since1.1.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.*/
publicfunctionwafs_match_condition_contains_shipping_class($match,$operator,$value){

if(!isset(WC()->cart))return$match;

if($operator=='!='):
//Trueuntilprovenfalse
$match=true;
endif;

foreach(WC()->cart->cart_contentsas$product):

$id=!empty($product['variation_id'])?$product['variation_id']:$product['product_id'];
$product=get_product($id);

if($operator=='=='):
if($product->get_shipping_class()==$value):
returntrue;
endif;
elseif($operator=='!='):
if($product->get_shipping_class()==$value):
returnFALSE;
endif;
endif;

endforeach;

return$match;

}


/******************************************************
*Userconditions
*****************************************************/


/**
*Zipcode.
*
*Matchtheconditionvalueagainsttheusersshippingzipcode.
*
*@since1.0.2;$valuemaycontainsingleorcomma(,)separatedzipcodes.
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_zipcode($match,$operator,$value){

if(!isset(WC()->customer))return$match;

if('=='==$operator):

if(preg_match('/\,?/',$value)){
$match=(in_array((int)WC()->customer->get_shipping_postcode(),array_map('intval',explode(',',$value))));
}else{
$match=((int)WC()->customer->get_shipping_postcode()==(int)$value);
}

elseif('!='==$operator):

if(preg_match('/\,?/',$value)){
$match=(!in_array((int)WC()->customer->get_shipping_postcode(),array_map('intval',explode(',',$value))));
}else{
$match=((int)WC()->customer->get_shipping_postcode()!=(int)$value);
}

elseif('>='==$operator):
$match=((int)WC()->customer->get_shipping_postcode()>=(int)$value);
elseif('<='==$operator):
$match=((int)WC()->customer->get_shipping_postcode()<=(int)$value);
endif;

return$match;

}


/**
*City.
*
*Matchtheconditionvalueagainsttheusersshippingcity.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_city($match,$operator,$value){

if(!isset(WC()->customer))return$match;

if('=='==$operator):
$match=(preg_match("/^$value$/i",WC()->customer->get_shipping_city()));
elseif('!='==$operator):
$match=(!preg_match("/^$value$/i",WC()->customer->get_shipping_city()));
endif;

return$match;

}


/**
*State.
*
*Matchtheconditionvalueagainsttheusersshippingstate
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_state($match,$operator,$value){

if(!isset(WC()->customer))return$match;

$state=WC()->customer->get_shipping_country().'_'.WC()->customer->get_shipping_state();

if('=='==$operator):
$match=($state==$value);
elseif('!='==$operator):
$match=($state!=$value);
endif;

return$match;

}


/**
*Country.
*
*Matchtheconditionvalueagainsttheusersshippingcountry.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_country($match,$operator,$value){

if(!isset(WC()->customer))return$match;

if('=='==$operator):
$match=(preg_match("/^$value$/i",WC()->customer->get_shipping_country()));
elseif('!='==$operator):
$match=(!preg_match("/^$value$/i",WC()->customer->get_shipping_country()));
endif;

return$match;

}


/**
*Userrole.
*
*Matchtheconditionvalueagainsttheusersrole.
*
*@since1.0.0
*@globalobject$current_userCurrentuserobjectforcapabilities.
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_role($match,$operator,$value){

global$current_user;

if('=='==$operator):
$match=(array_key_exists($value,$current_user->caps));
elseif('!='==$operator):
$match=(!array_key_exists($value,$current_user->caps));
endif;

return$match;

}


/******************************************************
*Productconditions
*****************************************************/


/**
*Width.
*
*Matchtheconditionvalueagainstthewidestproductinthecart.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_width($match,$operator,$value){

if(!isset(WC()->cart)||empty(WC()->cart->cart_contents))return$match;

foreach(WC()->cart->cart_contentsas$product):

if(true==$product['data']->variation_has_width)
{
$width[]=(get_post_meta($product['data']->variation_id,'_width',true));
}
else
{
$width[]=(get_post_meta($product['product_id'],'_width',true));
}

endforeach;

$max_width=max((array)$width);
$max_width=max((array)$width);

if('=='==$operator):
$match=($max_width==$value);
elseif('!='==$operator):
$match=($max_width!=$value);
elseif('>='==$operator):
$match=($max_width>=$value);
elseif('<='==$operator):
$match=($max_width<=$value);
endif;

return$match;

}


/**
*Height.
*
*Matchtheconditionvalueagainstthehighestproductinthecart.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_height($match,$operator,$value){

if(!isset(WC()->cart)||empty(WC()->cart->cart_contents))return$match;

foreach(WC()->cart->cart_contentsas$product):

if(true==$product['data']->variation_has_height):
$height[]=(get_post_meta($product['data']->variation_id,'_height',true));
else:
$height[]=(get_post_meta($product['product_id'],'_height',true));
endif;

endforeach;

$max_height=max($height);

if('=='==$operator):
$match=($max_height==$value);
elseif('!='==$operator):
$match=($max_height!=$value);
elseif('>='==$operator):
$match=($max_height>=$value);
elseif('<='==$operator):
$match=($max_height<=$value);
endif;

return$match;

}


/**
*Length.
*
*Matchtheconditionvalueagainstthelenghtiestproductinthecart.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_length($match,$operator,$value){

if(!isset(WC()->cart)||empty(WC()->cart->cart_contents))return$match;

foreach(WC()->cart->cart_contentsas$product):

if(true==$product['data']->variation_has_length):
$length[]=(get_post_meta($product['data']->variation_id,'_length',true));
else:
$length[]=(get_post_meta($product['product_id'],'_length',true));
endif;

endforeach;

$max_length=max($length);

if('=='==$operator):
$match=($max_length==$value);
elseif('!='==$operator):
$match=($max_length!=$value);
elseif('>='==$operator):
$match=($max_length>=$value);
elseif('<='==$operator):
$match=($max_length<=$value);
endif;

return$match;

}


/**
*Productstock.
*
*Matchtheconditionvalueagainstallcartproductsstock.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_stock($match,$operator,$value){

if(!isset(WC()->cart)||empty(WC()->cart->cart_contents))return$match;

foreach(WC()->cart->cart_contentsas$product):

$product_id=!empty($product['variation_id'])?$product['variation_id']:$product['product_id'];
$stock[]=get_post_meta($product_id,'_stock',true);

endforeach;

$min_stock=min($stock);

if('=='==$operator):
$match=($min_stock==$value);
elseif('!='==$operator):
$match=($min_stock!=$value);
elseif('>='==$operator):
$match=($min_stock>=$value);
elseif('<='==$operator):
$match=($min_stock<=$value);
endif;

return$match;

}


/**
*Stockstatus.
*
*Matchtheconditionvalueagainstallcartproductsstockstatusses.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_stock_status($match,$operator,$value){

if(!isset(WC()->cart))return$match;

if('=='==$operator):

$match=true;
foreach(WC()->cart->cart_contentsas$product):
if(get_post_meta($product['product_id'],'_stock_status',true)!=$value)
$match=FalSe;
endforeach;

elseif('!='==$operator):

$match=true;
foreach(WC()->cart->cart_contentsas$product):
if(get_post_meta($product['product_id'],'_stock_status',true)==$value)
$match=FALSE;
endforeach;

endif;

return$match;

}


/**
*Category.
*
*Matchtheconditionvalueagainstallthecartproductscategory.
*Withthiscondition,alltheproductsinthecartmusthavethegivenclass.
*
*@since1.0.0
*
*@parambool$matchCurrentmatchvalue.
*@paramstring$operatorOperatorselectedbytheuserintheconditionrow.
*@parammixed$valueValuegivenbytheuserintheconditionrow.
*@returnBOOLMatchingresult,TRUEifresultsmatch,otherwiseFALSE.
*/
publicfunctionwafs_match_condition_category($match,$operator,$value){

if(!isset(WC()->cart))return$match;

$match=true;

if('=='==$operator):

foreach(WC()->cart->cart_contentsas$product):

if(!has_term($value,'product_cat',$product['product_id'])):
$match=false;
endif;

endforeach;

elseif('!='==$operator):

foreach(WC()->cart->cart_contentsas$product):

if(has_term($value,'product_cat',$product['product_id'])):
$match=false;
endif;

endforeach;

endif;

return$match;

}

}

?>


