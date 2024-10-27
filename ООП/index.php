<?php

echo "============================ МЕТОДЫ КЛАССА ========================================\n\n";
// методы - функции, которые объявлены внутри класса

class Text
{
    public function printText()
    { // функции, которые объявлены внутри класса называются методом
        return "Something text";
    }
}
$obj = new Text;
var_dump($obj->printText()); // Something text

class Point
{
    private $x; // private -напрямую изменять нельзя
    private $y;
    public function setX($x)
    {
        $this->x = $x; // $this - выбор переменной текущего класса
    }
    public function setY($y)
    {
        $this->y = $y;
    }
    public function getX()
    {
        return $this->x; // получаем х этого класса
    }
    public function getY()
    {
        return $this->y;
    }
    public function distance()
    {
        return sqrt($this->getX() ** 2 + $this->getY() ** 2);
    }
}
$point_1 = new Point;
$point_1->setX(5);
$point_1->setY(7);
var_dump($point_1->distance());



echo "========================== СТАТИЧЕСКИЕ МЕТОДЫ =====================================\n\n";

class Hello
{
    public static function sayHello()
    { // статический метод
        return "Hello everyone!";
    }
}
// объект создавать не нужно для статического метода
var_dump(Hello::sayHello()); // Hello everyone!



echo "========================== КЛЮЧЕВОЕ СЛОВО SELF =====================================\n\n";

class Page
{
    static $content = "Тело сайта \n";
    public static function footer()
    {
        return "Это подвал сайта \n";
    }
    public static function header()
    {
        return "Это шапка сайта \n";
    }
    public static function site()
    {
        // если писать Page::header() при изменении названия класса прийдётся менять названия везде
        return self::header() . self::$content . self::footer();
    }
}
var_dump(Page::site()); // Это шапка сайта \n Тело сайта \n Это подвал сайта



echo "========================== КОНСТРУКТОР КЛАССА =====================================\n\n";
// Конструктор (construct__) - это метод класса, который автоматически выполняется в момент создания объекта

class People
{
    private $name;
    public function __construct()
    {
        echo "Вызов конструктора";
        $this->name = "Ivan";
    }
}
$obj_p = new People; // Вызов конструктора - при создании объекта автоматически выполяется конструктор
echo PHP_EOL;
var_dump($obj_p);
// object(People)#3 (1) {
// ["name":"People":private]=> string(4) "Ivan"
//   }

class Number
{
    private $x;
    private $y;
    public function __construct($x = 10, $y = 20) // аргументы по умолчанию, чтобы можно быть создать объект без аргументов
    {
        $this->x = $x;
        $this->y = $y;
    }
    // можно выводить объект в строку, использовать echo
    public function __toString()
    {
        return $this->x . ", " . $this->y;
        // return "$this->x, $this->y";
        // или 
    }
}
$obj_n = new Number(1, 2);
$obj_n_1 = new Number();
var_dump($obj_n);
// object(Number)#4 (2) {
// ["x":"Number":private]=> int(1)
// ["y":"Number":private]=> int(2)
//   }
var_dump($obj_n_1);
// object(Number)#4 (2) {
// ["x":"Number":private]=> int(10)
// ["y":"Number":private]=> int(20)
//   }
echo $obj_n . "\n"; // 1, 2 - можно выводить объект в строку, использовать echo



echo "========================== НАСЛЕДОВАНИЕ =====================================\n\n";

class Animal
{
    // protected - недоступен из вне класса, как и private, но доступен при наследовании, но мы его никак не сможем изменить снаружи, увидеть или вызвать. Лучше использовать protected при наследовании
    protected $lenght = 4;
    public function info()
    {
        return "У меня $this->lenght лапы";
    }
}
$object_a = new Animal;
var_dump($object_a->info()); // У меня 4 лапы


// класс Dog наследуется (extends) от класса Animal и берёт его свойства, если у них доступ public или protected, иначе будет ошибка в случае с private
class Dog extends Animal
{
    public $name = "Собака";
    public function voice()
    {
        return "$this->name издаёт звук 'гав-гав'";
    }
}
$object_dog = new Dog;
var_dump($object_dog->info()); // У меня 4 лапы
var_dump($object_dog->voice()); // Собака издаёт звук 'гав-гав'


class Cat extends Animal
{
    public $name = "Кот";
    public function voice()
    {
        return "$this->name издаёт звук 'мяу!'";
    }
    // можно изменять методы - это называется перегрузкой методов
    public function info()
    {
        return "Я $this->name, У меня $this->lenght лапы";
    }
    // можно обратиться к родительскому методу, даже если мы его изменили
    public function parentInfo()
    {
        return parent::info();
    }
}
$object_cat = new Cat;
var_dump($object_cat->info()); // Я Кот, У меня 4 лапы
var_dump($object_cat->voice()); // Кот издаёт звук 'мяу!'
var_dump($object_cat->parentInfo()); // У меня 4 лапы



echo "======================== абстрактный класс abstract ================================\n\n";

// abstract - абстрактный класс, мы не можем создавать объекты этого класса, но можешь от него наследоваться. Такой класс используется только для наследования 
abstract class Laptop
{
    protected $color = "Чёрный";
    public function info()
    {
        return "$this->color ноутбук 15 дюйм";
    }
}

class Lenovo extends Laptop
{
    public $rgb_keyboard = "есть подсветка клавиатуры";
    public function gaming()
    {
        return "У ноутбка Lenovo $this->rgb_keyboard";
    }
}
$obj_lenovo = new Lenovo;
var_dump($obj_lenovo->info()); // Чёрный ноутбук 15 дюйм
var_dump($obj_lenovo->gaming()); // У ноутбка Lenovo есть подсветка клавиатуры
// $obj_abstract = new Laptop; // ошибка -  Cannot instantiate abstract class Laptop - нельзя создать объект абстрактного класса, абстрактный класс нужен только для наследования



echo "========= АБСТРАКТНЫЕ МЕТОДЫ (abstract) и ЗАПРЕТ ПЕРЕГРУЗКИ МЕТОДОВ (final) ========\n\n";

// если мы создаём абстрактные методы, то класс тоже должен быть абстрактным
abstract class Car
{
    protected $wheel = 4;
    // ключевое слово final запрещает перегружать методы в дочерних классах, иначе будет ошибка. Может быть применено к конструкторам
    final public function info()
    {
        return "В этой машине $this->wheel колеса";
    }
    // абстрактный метод, он должен быть определён при наследовании у всех дочерних классов. Он нужен для перегрузки методов в дочерних классах
    abstract public function color();
}

class Bmw extends Car
{
    public $country = "Германия";
    public $color = "чёрный";
    public function color()
    {
        return "Бмв покрашена в $this->color цвет";
    }
    public function deepInfo()
    {
        return "Бмв сделана в стране '$this->country' и покрашена в $this->color цвет";
    }
    // public function info () { // Cannot override final method - метод final нельзя перегружать
    //     return "Бмв сделана в стране '$this->country' и покрашена в $this->color цвет";
    // }
}
$object_bmw = new Bmw;
var_dump($object_bmw->country); // Германия
var_dump($object_bmw->color); // чёрный
var_dump($object_bmw->info()); // В этой машине 4 колеса
var_dump($object_bmw->color()); // Бмв покрашена в чёрный цвет
var_dump($object_bmw->deepInfo()); // Бмв сделана в стране 'Германия' и покрашена в чёрный цвет



echo "============================ ЗАПРЕТ НАСЛЕДОВАНИЯ ОТ КЛАССА (final) ==================\n\n";
// класс не может быть одновременно абстрактым и final классом

// у класса с ключевым словом final не может быть наследников. Запрет наследования от класса
final class Phone {
    public $color = "White";
    public function info(){
        return "Redmi 10 $this->color";
    }
}
// class Nokia extends Phone {} // Class Nokia cannot extend final class Phone