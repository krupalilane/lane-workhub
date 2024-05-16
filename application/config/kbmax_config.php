<?php
$config['kbmax_base_url'] 			= 'https://lane.kbmax.com/api';
$config['product_list'] 			= $config['kbmax_base_url'].'/products/searchByCategory';
$config['quotes_save'] 				= $config['kbmax_base_url'].'/quotes/save';
$config['quotes_submit']    		= $config['kbmax_base_url'].'/quotes/submit';
$config['product_save']				= $config['kbmax_base_url'].'/quotes/%s/product';
$config['quotes_details']			= $config['kbmax_base_url'].'/quotes/%s';
$config['product_file_download']	= $config['kbmax_base_url'].'/quotes/productfile/download/%s';