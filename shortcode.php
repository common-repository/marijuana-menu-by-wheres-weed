<?php

function ww_menu_shortcode_handler(){
	global $ww_menu_plugin_url;
	$biz_url = get_option('ww_menu_business_url');
	if($biz_url === false){
		return 'No business url set. Check the plugin settings for ww_menu.';
	} else {
		//include js for iframe resize
		$js_url = plugin_dir_url(__FILE__).'libraries/iframeResizer.min.js'; 
		$js_include = '<script src="'.$js_url.'"></script>';
				
		//print the iframe itself
		$site = 'https://wheresweed.com';
		$path = rtrim(parse_url($biz_url,PHP_URL_PATH),'/');
		$locality = explode('/',trim($path,'/'));
		
		include_once dirname(__FILE__).'/libraries/state_list.php';
		if(isset($state_list) && in_array($locality[0],$state_list)){
			$display = $locality[1];
			$locality = $locality[0].'/'.$locality[1];
		} else {
			$display = $locality[0];
			$locality = $locality[0];
		}
		
		$display = ucwords(str_replace('-',' ',$display));
		
		$iframe = '
					<iframe src="'.$site.$path.'/widget_menu?v=2&menu_indication=0" width="100%" height="0" frameborder="0" scrolling="no"></iframe>
					<br />';
		$link = '
					<a href="https://wheresweed.com/'.$locality.'/marijuana-dispensaries" target="_blank" 
						style="position:absolute; z-index:99; font-size:12px; margin:-2px 0 0 0px; color:#333; text-decoration:none; font-family:arial,sans-serif">
							'.$display.' Marijuana Dispensaries
					</a>';
					
		$js_trigger = '<script>iFrameResize({log:true})</script>';
		
		$show_link = get_option('ww_menu_show_link') === 'checked';
		return $js_include.$iframe.$js_trigger.($show_link ? $link : '');
	}
}

add_shortcode('ww_menu','ww_menu_shortcode_handler');
 