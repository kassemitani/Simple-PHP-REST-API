<?php
$app->get('/api/contents', function ($request, $response, $args) {  //GET example

    $pdo =$this->pdo;
    $selectStatement = $pdo->select()
                            ->from('contents');
	$stmt = $selectStatement->execute();
	$categories = $stmt->fetchAll();

	$res['success'] = true;
	$res['data'] = $categories;
	$response->write(json_encode($res));
	$pdo = null;
	return $response;
});

$app->post('/api/category', function ($request, $response, $args) { //POST example

 	$pdo =$this->pdo;
	$params = $request->getParsedBody();
	$categoryName = $params['categoryName'];
	$color = $params['color'];
	$active = $params['active'];

    $icon = '';
	$files = $request->getUploadedFiles();
	if (!empty($files['icon'])) {
		$newfile = $files['icon'];
		if ($newfile->getError() === UPLOAD_ERR_OK) {
			$newName = str_replace(' ','', $newfile->getClientFilename());
			$uploadFileName = md5($newName. time()).'.'.pathinfo($newName, PATHINFO_EXTENSION);
			$newfile->moveTo("./uploads/icons/$uploadFileName");
			$icon = $uploadFileName;
		}
	}

    $insertStatement = $pdo->insert(array( 'name', 'color', 'icon', 'active' ))
								->into('category')
								->values(array($categoryName, $color, $icon, $active));
    $insert =  $insertStatement->execute();

	$pdo = null;
	return;
});

?>
