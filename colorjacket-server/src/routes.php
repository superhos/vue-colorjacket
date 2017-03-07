<?php
// Routes

// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });
$app->get('/color/{page}/{sort}',  'getColors');
$app->get('/getColor/{id}',  'getColor');

$app->get('/color/like/{id}',  'addLike'); 
$app->get('/color/dislike/{id}',  'addDisLike'); 
// $app->get('/color/:id',  'getColor'); // Using Get HTTP Method and process getUser function
// $app->get('/color/search/:query', 'findById'); // Using Get HTTP Method and process findById function
$app->post('/addColor', 'addColor'); // Using Post HTTP Method and process addUser function
// // $app->put('/color/:id', 'updateColor'); // Using Put HTTP Method and process updateUser function
// $app->delete('/color/:id', 'deleteColor'); // Using Delete HTTP Method and process deleteUser function
// $app->run();

function crossset(){
	header('content-type: application/json; charset=utf-8');
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET,POST,PUT,DELETE,OPTIONS");
	header("Access-Control-Allow-Headers:Content-Type");
}

function addColor($request, $response, $args) {
    $paramCode = $request->getParam('code'); // Getting parameter with names
    crossset();
    if (!isset($paramCode)){
    	echo '{"error":{"msg":"大兄弟你傳什麼給我了啊"}}'; 
    	return;
    }
    $sql = "INSERT INTO color VALUE (null,1,now(),:code,0,0)";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("code", $paramCode);
        $stmt->execute();
        $colorId = $dbCon->lastInsertId();
        $dbCon = null;
        echo '{"code": "1"}'; 
    } catch(PDOException $e) {
        echo '{"error":{"msg":'. $e->getMessage() .'}}'; 
    }
}

function getColors($request, $response, $args) {
	$page = $args['page'];
	$sort = isset($args['sort'])?$args['sort']:'new';
	
	switch ($sort) {
		case 'popular':
			$order = "likes desc";
			break;
		default:
			$order = "pulishdate desc";
			break;
	}

	if (!isset($page)){$page = 0;}
	crossset();
	$start = intval($page-1)*12;
    $sql_query = "select * FROM color ORDER BY ".$order." LIMIT ".$start.",12";
    try {
        $dbCon = getConnection();
        $stmt   = $dbCon->query($sql_query);
        $colors  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"colors": ' . json_encode($colors) . '}';
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}

function getColor($request, $response, $args) {
	$id = $args['id'];
	crossset();
    $sql_query = "select * FROM color Where id=".$id;
    try {
        $dbCon = getConnection();
        $stmt   = $dbCon->query($sql_query);
        $colors  = $stmt->fetch(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"color": ' . json_encode($colors) . '}';
    }
    catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }    
}

function addLike($request, $response, $args) {
    $id = $args['id'];
    $sql = "UPDATE color SET likes=likes+1 WHERE id=:id";
    crossset();
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("id", $id);
        $status = $stmt->execute();

        $dbCon = null;
        echo json_encode($status); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function addDisLike($request, $response, $args) {
    $id = $args['id'];
    $sql = "UPDATE color SET dislikes=dislikes+1 WHERE id=:id";
    crossset();
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("id", $id);
        $status = $stmt->execute();

        $dbCon = null;
        echo json_encode($status); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}