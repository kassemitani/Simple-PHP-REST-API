# Simple-PHP-REST-API
Create Simple RESTful API using PHP Slim Framework

# What is RESTful API?
A RESTful API is an application program interface (API) that uses HTTP requests to GET, PUT, POST and DELETE data.

A RESTful API -- also referred to as a RESTful web service -- is based on representational state transfer (REST) technology, an architectural style and approach to communications often used in web services development.

## The Purpose of the project 
Create a Simple HTTP REST API using PHP Slim framework and MySQL database 
 
### Get Started
Add you MySQL database credentials 
Go to index.php on line 17
```
$dsn = 'mysql:host=localhost;dbname=dbName;charset=utf8'; // replace Localhost with your mysql host ip and replace dbName with your database name
$usr = 'dbUSERNAME'; //replace dbUSERNAME with your database username
$pwd = 'dbPASSWORD'; //replace dbUSERNAME with your database password
    
```

## API Routes definitions

Go to the folder Routes:

Example: category.php 

### To handle a GET request
```
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
```
### To handle a POST resquest
```
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
```


## Authors

* **Kassem Itani** - (https://github.com/kassemitani)


## License

This project is licensed under the MIT License 

## Acknowledgments

* SlimFramework: https://www.slimframework.com/
* SlimFramework source-code: https://github.com/slimphp/Slim
* cloudways tutorial: https://www.cloudways.com/blog/simple-rest-api-with-slim-micro-framework/
