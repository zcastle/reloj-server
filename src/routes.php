<?php

use Slim\Http\Request;
use Slim\Http\Response;
//
use Lib\Data;
// Routes

/*$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/

$app->group("/reloj/v1", function(\Slim\App $app){

    $app->post('/server', function(Request $request, Response $response, $args) {
        $result = array("success" => true, "error" => false, "message" => null);

        $body = $request->getParsedBody();
        $rows = json_decode(base64_decode($body["data"]));

        $data = new Data($this->db, $this->logger);
        foreach($rows AS $row){
            $data->insertarRegistro($row);
        }
        
        return $response->withJson($result);
    });
});
