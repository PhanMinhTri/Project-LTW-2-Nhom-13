<?php 
	return [
			'client_id' => 'AVhM943neXB011PFmlSutW5LIEZIbUWvuAbMioITm3FDjRFHKsGzxeKYQA-VewHX5v8xb-AugZhd4cEM',
			'secret' => 'EBb9GafzghewhedTJcr4yh1eFTyCCQMrhVE3Tsd-SyV8-nHC_Q0UQFGK7Su6BQ8YCCfckFEGfCCmQ61l',
			'settings' => [
				'http.CURLOPT_CONNECTTIMEOUT'=> 30,
				// sandbox/live
				'mode'=> 'sandbox',
				'log.LogEnabled'=>true,
				'log.FileName'=> storage_path().'/logs/PayPal.php',
				'log.LogLevel'=>'INFO',	
			]  
	];
 ?>