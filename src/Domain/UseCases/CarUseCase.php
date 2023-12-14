<?php

namespace App\Domain\UseCases;

use App\Domain\Entities\Car;
use App\Infra\Database\Connector;
use PDO;

class CarUseCase
{
    private Connector $connector; //Declara uma propriedade privada chamada $connector que é uma instância da classe Connector

    public function __construct(Connector $connector) //Método construtor da classe. Recebe uma instância de Connector como parâmetro e a atribui à propriedade $connector
    {
        $this->connector = $connector;
    }

    public function create($values) // Método que cria um novo registro de carro no banco de dados.
    {
        $Car = new Car(); // Cria uma nova instância da classe Car.
        $Car->setName($values['name'] ?? null); //configura as propriedades do objeto Car com os valores fornecidos no array $values usando métodos sets
        $Car->setColor($values['color'] ?? null);
        $Car->setBrand($values['brand'] ?? null);
        $Car->setTwoDoors($values['two_doors'] ?? null);
        $Car->setOwnerName($values['owner_name'] ?? null);
        $Car->setCarPrice($values['car_price'] ?? null);

        return $this->connector->create($Car->toArray()); //Chama o método create do objeto $this->connector (instância de Connector), passando um array associativo representando as propriedades do carro. O método toArray da classe Car é usado para obter esse array.
    }

    public function find($id) //Método que busca um registro de carro no banco de dados com base no ID.
    {
        return $this->connector->find($id) //Chama o método find do objeto $this->connector (instância de Connector) para obter um conjunto de resultados da consulta
            ->fetchObject(); //e em seguida, usa o método fetchObject para obter um objeto do tipo carro.
    }

    public function list() //Método que lista todos os registros de carros no banco de dados.
    {
        return $this->connector->list() //  Chama o método list do objeto $this->connector (instância de Connector) para obter um conjunto de resultados da consulta
            ->fetchAll(PDO::FETCH_CLASS); //usa o método fetchAll com PDO::FETCH_CLASS para obter um array de objetos do tipo carro
    }

    public function edit($id, $values) //Método que atualiza um registro de carro no banco de dados com base no ID.
    {
        $Car = new Car(); //Cria uma nova instância da classe Car e configura suas propriedades com os valores fornecidos no array $values
        $Car->setName($values['name'] ?? null);
        $Car->setColor($values['color'] ?? null);
        $Car->setBrand($values['brand'] ?? null);
        $Car->setTwoDoors($values['two_doors'] ?? null);
        $Car->setOwnerName($values['owner_name'] ?? null);
        $Car->setCarPrice($values['car_price'] ?? null);

        return $this->connector->edit($id, $Car->toArray()); //Chama o método edit do objeto $this->connector (instância de Connector), passando o ID e
    }

    public function delete($id) //Método que exclui um registro de carro no banco de dados com base no ID.
    {
        return $this->connector->delete($id); //Chama o método delete do objeto $this->connector (instância de Connector), passando o ID para excluir o registro correspondente.
    }


}