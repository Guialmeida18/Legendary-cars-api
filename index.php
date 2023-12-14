<?php

require_once "./vendor/autoload.php"; //Essa linha inclui o arquivo de autoload do Composer, que é responsável por carregar automaticamente as classes utilizadas no projeto.

use App\Domain\UseCases\CarUseCase;
use App\Infra\Database\Connector;

$Connector = new Connector("root", "1234", "legendary_cars", "mysql"); //Connector é utilizado para estabelecer a conexão com o banco de dados, enquanto
$CarUseCase = new CarUseCase($Connector); //representa a lógica de negócios relacionada a carros.

function returnResponse($data, $code) //Essa função é responsável por definir o cabeçalho HTTP, o código de resposta e imprimir os dados em formato JSON. Ela é utilizada para padronizar as respostas do servidor.
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($code);

    echo json_encode($data); //json_encode converte uma estrutura de dados php em uma string no formato JSON
}

$requestUri = $_SERVER['REQUEST_URI']; //Obtém a URI da requisição atual.

$uriSegments = explode("?", $requestUri); //Separa a URI da string de consulta (query string) e extrai o segmento da URI.
$uri = array_shift($uriSegments);

$uriSegments = str_replace('id=', '', $uriSegments); //Remove o prefixo 'id=' dos segmentos.

$routes = [ //Define um array associativo $routes que mapeia URIs para métodos HTTP e ações correspondentes.
    "/list" => ["method" => 'GET', 'action' => 'list'],
    "/edit" => ["method" => 'PUT', 'action' => 'edit'],
    "/delete" => ["method" => 'DELETE', 'action' => 'delete'],
    "/find" => ["method" => 'GET', 'action' => 'find'],
    "/create" => ["method" => 'POST', 'action' => 'create'],
];

$route = $routes[$uri] ?? null; //Obtém a configuração da rota correspondente à URI atual ou define $route como null se a rota não for encontrada.

if ($route) { //Inicia o bloco de código que trata as rotas existentes.
    switch ($route['action']) { //Inicia um switch para determinar a ação a ser executada com base na rota.
        case "list": //Se a ação for "list", chama o método list do $CarUseCase para obter a lista de carros e retorna a resposta usando a função returnResponse.
            returnResponse($CarUseCase->list(), 200);
            break;
        case "edit": //Se a ação for "edit", lê os dados da requisição PUT, os decodifica e chama o método edit do $CarUseCase para editar um carro, retornando a resposta.
            $data = file_get_contents("php://input");
            parse_str($data, $params);

            returnResponse($CarUseCase->edit($uriSegments[0], $params), 200);
            break;
        case "delete": //Se a ação for "delete", chama o método delete do $CarUseCase para excluir um carro e retorna a resposta.
            returnResponse($CarUseCase->delete($uriSegments[0]), 200);
            break;
        case "find": //Se a ação for "find", chama o método find do $CarUseCase para buscar um carro e retorna a resposta.
            returnResponse($CarUseCase->find($uriSegments[0]), 200);
            break;
        case "create": //Se a ação for "create", chama o método create do $CarUseCase para criar um novo carro usando os dados do formulário POST e retorna a resposta.
            returnResponse($CarUseCase->create($_POST), 200);
            break;
    }
} else { //Fecha o bloco do switch e, se a rota não for encontrada, retorna uma resposta de erro 404 e encerra a execução do script.
    returnResponse([], 404);
    die("404 Not Found");
}