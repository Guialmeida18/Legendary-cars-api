<?php

//Define o namespace onde a classe Car está localizada
namespace App\Domain\Entities;

//Inicia a definição da classe Car.
class Car {
    public string|null $name; //Declara uma propriedade pública chamada $name que pode armazenar valores do tipo string ou nulo (null).
    public string|null $color; //Declara uma propriedade pública chamada $color com o mesmo comportamento que $name
    public string|null $brand; // Declara uma propriedade pública chamada $brand com o mesmo comportamento que $name.
    public bool|null $twoDoors; //Declara uma propriedade pública chamada $twoDoors que pode armazenar valores do tipo booleano ou nulo (null).
    public string|null $ownerName; //Declara uma propriedade pública chamada $ownerName com o mesmo comportamento que $name.
    public float|null $carPrice; // Declara uma propriedade pública chamada $carPrice que pode armazenar valores do tipo float ou nulo (null).
    public function getName(): string|null //Declara um método público chamado getName que retorna um valor do tipo string ou nulo (null).
    {
        return $this->name; // implementação do método getName, que retorna o valor armazenado na propriedade $name da instância da classe.
    }

    public function setName(string|null $name): void //Declara um método público chamado setName que aceita um parâmetro do tipo string ou nulo (null).
    {
        $this->name = $name; //implementação do método setName, que define o valor da propriedade $name com o valor passado como parâmetro.
    }

    public function getColor(): string|null //Declara um método público chamado getcolor que aceita um parâmetro do tipo string ou nulo (null).

    {
        return $this->color;
    }

    public function setColor(string|null $color): void //Declara um método público chamado setcolor que aceita um parâmetro do tipo string ou nulo (null).

    {
        $this->color = $color;
    }

    public function getBrand(): string|null //Declara um método público chamado getbrand que aceita um parâmetro do tipo string ou nulo (null).
    {
        return $this->brand;
    }

    public function setBrand(string|null $brand): void //Declara um método público chamado setbrand que aceita um parâmetro do tipo string ou nulo (null).
    {
        $this->brand = $brand;
    }

    public function getTwoDoors(): bool|null //Declara um método público chamado gettwodoors que aceita um parâmetro do tipo string ou nulo (null).
    {
        return $this->twoDoors;
    }

    public function setTwoDoors(bool|null $twoDoors): void //Declara um método público chamado settwodoors que aceita um parâmetro do tipo string ou nulo (null).
    {
        $this->twoDoors = $twoDoors;
    }

    public function getOwnerName(): string|null //Declara um método público chamado getownername que aceita um parâmetro do tipo string ou nulo (null).
    {
        return $this->ownerName;
    }

    public function setOwnerName(string|null $ownerName): void //Declara um método público chamado setownername que aceita um parâmetro do tipo string ou nulo (null).
    {
        $this->ownerName = $ownerName;
    }

    public function getCarPrice(): float|null //Declara um método público chamado getcarprice que aceita um parâmetro do tipo string ou nulo (null).
    {
        return $this->carPrice;
    }

    public function setCarPrice(float|null $carPrice): void //Declara um método público chamado setcarprice que aceita um parâmetro do tipo string ou nulo (null).
    {
        $this->carPrice = $carPrice;
    }

    public function toArray(){ //Declara um método público chamado toArray, que retorna um array.

        return [ //{ return [: Inicia a definição do array associativo a ser retornado.


            'name' => $this->getName(), //Adiciona a chave 'name' ao array associativo com o valor retornado pelo método getName().
            'color' => $this->getColor(), //: Adiciona a chave 'color' ao array associativo com o valor retornado pelo método getColor().
            'brand' => $this->getBrand(), // Adiciona a chave 'brand' ao array associativo com o valor retornado pelo método getBrand()
            'two_doors' => $this->getTwoDoors(), //Adiciona a chave 'two_doors' ao array associativo com o valor retornado pelo método getTwoDoors().
            'owner_name' => $this->getOwnerName(), //Adiciona a chave 'owner_name' ao array associativo com o valor retornado pelo método getOwnerName()
            'car_price' => $this->getCarPrice() // Adiciona a chave 'car_price' ao array associativo com o valor retornado pelo método getCarPrice().
        ]; //Fecha a definição do array associativo e do método toArray.
    }
}