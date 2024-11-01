<?
/*
Plugin Name: wpClickBank
Plugin URI: http://wpClickBank.ReviewU.net
Description: Easy to get clickbank product.
Author: Todsaporn W.
Version: 1.01
Author URI: http://wpClickBank.ReviewU.net

*/


if(!is_home()){
	if(get_option('herb_ads_position') == "pre"){
		add_filter("the_content", "addPreContent");
	}else if(get_option('herb_ads_position') == "post"){
		add_filter("the_content", "addPostContent");
	}else if(get_option('herb_ads_position') == "both"){
		add_filter("the_content", "addBothContent");
	}
}

function herbCBAdsCode(){

	$herb_cb_acc = get_option('herb_cb_acc');
	$herb_ad_width = get_option('herb_ad_width','300');
	$herb_ad_number = get_option('herb_ad_number','3');
	$herb_tid = get_option('herb_tid','');
	$herb_keyword = get_option('herb_keyword','money');

	$herb_url = "http://www.hopfeed.com/serv/hopFeedServ.htm?type=LIST&fillAllSlots=true&width=$herb_ad_width&linkFontHoverColor=%233300FF&linkFontColor=%233300FF&backgroundColor=%23FFFFFF&font=Verdana%2C%20Arial%2C%20Helvetica%2C%20Sans%20Serif&fontSize=9pt&fontColor=%23000000&rows=$herb_ad_number&cols=1&keywords=$herb_keyword&tid=$herb_tid&affiliate=$herb_cb_acc";
?>
<link rel="stylesheet" type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/wpclickbank/wpcbstyle.css" /> 
<div class="herbCBAds">
<p class="hopfeed_header"><?php echo get_option('herb_ad_header');?></p>
<script type="text/javascript" src="<?php echo $herb_url;?>"></script>
</div>
<?
}

function addPreContent($content){
		echo herbCBAdsCode();
		echo $content."<br>";
}

function addPostContent($content){
		echo $content."<br>";
		echo herbCBAdsCode();
}

function addBothContent($content){
		echo herbCBAdsCode();
		echo $content."<br>";
		echo herbCBAdsCode();
}


if ( is_admin() ){

add_action('admin_menu', 'herbWPCB');
register_deactivation_hook("wpclickbank", 'herbCBdelOpt');

function herbWPCB() {
	add_options_page('wpClickBank', 'wpClickBank', 'administrator','wpClickBank', 'wpClickBankHTML');
	}

function herbCBdelOpt(){
	if (deleteOptions('herb_cb_acc', 'herb_tid', 'herb_keyword', 'herb_ad_number', 'herb_ad_width'))
   		echo 'Options have been deleted!';
	else
   		echo 'An error has occurred while trying to delete the options from database!';
}

function wpClickBankHTML() {
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/wpclickbank/wpcbstyle.css" /> 
	<div>
	<h2>wpClickBank Configurations</h2>

	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

	<table id="wp_cb_tb" style="margin-left:30px">
		<tbody>
		<tr style="line-height: 2.5em;">
			<th align="left" style="width:300px;"><label for="herb_cb_acc">ClickBank Account : </label></th>
			<td><input name="herb_cb_acc" type="text" id="herb_cb_acc" value="<?php echo get_option('herb_cb_acc'); ?>" /></td>
		</tr>
		<tr style="line-height: 2.5em;">
			<th align="left"><label for="herb_tid">ClickBank Trace ID : </label></th>
			<td><input name="herb_tid" type="text" id="herb_tid" value="<?php echo get_option('herb_tid'); ?>" /></td>
		</tr>
		<tr style="line-height: 2.5em;">
			<th align="left"><label for="herb_keyword">Keyword (comma separated) : </label></th>
			<td><input name="herb_keyword" type="text" id="herb_keyword" size="30px" value="<?php echo get_option('herb_keyword'); ?>" /></td>
		</tr>
		<tr style="line-height: 2.5em;">
			<th align="left"><label for="herb_ad_number">Number Of Ads : </label></th>
			<td><input name="herb_ad_number" type="text" id="herb_ad_number" value="<?php echo get_option('herb_ad_number'); ?>" /></td>
		</tr>
		<tr style="line-height: 2.5em;">
			<th align="left"><label for="herb_ad_width">Width : </label></th>
			<td><input name="herb_ad_width" type="text" id="herb_ad_width" value="<?php echo get_option('herb_ad_width'); ?>" /></td>
		</tr>
		<tr style="line-height: 2.5em;">
			<th align="left"><label for="herb_ads_position">Ads Position : </label></th>
			<td>
				<input type="radio" name="herb_ads_position" id="herb_ads_position_pre" 
						value="pre" <?php if(get_option('herb_ads_position') == "pre") echo "checked=\"checked\""; ?> > Pre-Content
				<input type="radio" name="herb_ads_position" id="herb_ads_position_post" value="post" 
						value="pre" <?php if(get_option('herb_ads_position') == "post") echo "checked=\"checked\""; ?> > Post-Content
				<input type="radio" name="herb_ads_position" id="herb_ads_position_both" value="both" 
						value="pre" <?php if(get_option('herb_ads_position') == "both") echo "checked=\"checked\""; ?> > Both-Content
			</td>
		</tr>
		<tr style="line-height: 2.5em;">
			<th align="left"><label for="herb_ad_header">Ads Header : </label></th>
			<td><input name="herb_ad_header" type="text" id="herb_ad_header" size="30px" value="<?php echo get_option('herb_ad_header'); ?>" /></td>
		</tr>
		<tr style="line-height: 2.5em;">
			<th align="left">
				<input type="hidden" name="page_options" value="herb_cb_acc, herb_tid, herb_keyword, herb_ad_number, herb_ad_width, herb_ads_position, herb_ad_header" />
				<input type="hidden" name="action" value="update" />
			</th>
			<td><p><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p></td>
		</tr>
		
		</tbody>
	</table>
	
	<table style="margin-left:30px">
		<tbody>
			<tr>
				<td colspan="4"> If you like this free plugin without condition, just donate a bit for developer :) Thanks <br>
								 note: 10% of this donation every months will be donated to Foundation for Children or other.
				</td>
			</tr>
			<tr>
			<td>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="http://wpclickbank.reviewu.net/files/2010/03/any.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

			</td>
				<td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="http://wpclickbank.reviewu.net/files/2010/03/paypal10.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
				</td>
			<td>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="http://wpclickbank.reviewu.net/files/2010/03/paypal5.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
			</td>
			
			<td>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="http://wpclickbank.reviewu.net/files/2010/03/paypal3.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

			</td>
			
			
			</tr>

		</tbody>
	</table>
	</form>
	</div>
	<?php
	}

}

?>
