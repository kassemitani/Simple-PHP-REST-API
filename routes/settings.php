<?php


$app->get('/api/settings', function ($request, $response, $args) { // GET Example without database

	$res['success'] = true;
   $data = array('title'=>'settings page', 'post_content' => 'settings');
    $res['data'] = $data;
	$response->write(json_encode($res));
	$pdo = null;
	return $response;
});


?>
