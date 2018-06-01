<?php
use Bookstore\Domain\Book;
use Bookstore\Domain\Customer;
use Bookstore\Domain\Person;
use Bookstore\Domain\Customer\Basic;
use Bookstore\Domain\Customer\Premium;
use Bookstore\Domain\Customer\CustomerFactory;
use Bookstore\Utils\Unique;
use Bookstore\Utils\Config;
use Bookstore\Exceptions\InvalidIdException;
use Bookstore\Exceptions\ExceededMaxAllowedException;


    function autoloader($classname) {
        $lastSlash = strpos($classname, '\\') + 1;
        $classname = substr($classname, $lastSlash);
        $directory = str_replace('\\', '/', $classname);
        $filename = __DIR__ . '/' . $directory . '.php';
        require_once($filename);
    }

    spl_autoload_register('autoloader');

    $config = Config::getInstance();
    $dbConfig = $config->get('db');
    var_dump($dbConfig);

    createBasicCustomer(1);
    createBasicCustomer(-1);
    createBasicCustomer(55);

    $addTaxes = function (array &$book, $index, $percentage) {
        $book['price'] += round($percentage * $book['price'], 2);
    };

    $percentage = 0.16;

    $addTaxes2 = function (array &$book, $index) use (&$percentage) {
        $book['price'] += round($percentage * $book['price'], 2);
    };

    $books = [
        ['title' => '1984', 'price' => 8.15],
        ['title' => 'Don Quijote', 'price' => 12.00],
        ['title' => 'Odyssey', 'price' => 3.55],
    ];

    $books2 = [
        ['title' => '1984', 'price' => 8.15],
        ['title' => 'Don Quijote', 'price' => 12.00],
        ['title' => 'Odyssey', 'price' => 3.55],
    ];

    $books3 = [
        ['title' => '1984', 'price' => 8.15],
        ['title' => 'Don Quijote', 'price' => 12.00],
        ['title' => 'Odyssey', 'price' => 3.55],
    ];

    $books4 = [
        ['title' => '1984', 'price' => 8.15],
        ['title' => 'Don Quijote', 'price' => 12.00],
        ['title' => 'Odyssey', 'price' => 3.55],
    ];

    foreach ($books as $index => &$book) {
        $addTaxes($book, $index, 0.16);
    }

    array_walk($books2, $addTaxes, 0.16);


    class Taxes {
        public static function add(array &$book, $index, $percentage) {
                if(isset($book['price'])) {
                    $book['price'] += round($percentage * $book['price'], 2);
                }
        }

        public function addTaxes(array &$book, $index, $percentage) {
                if(isset($book['price'])) {
                    $book['price'] += round($percentage * $book['price'], 2);
                }
        }
    }

    array_walk($books3, [new Taxes(), 'addTaxes'], 0.16);

    $percentage = 0.10;
    array_walk($books4, $addTaxes2);

    var_dump($books);

    echo('<br>');
    echo('<br>');
    echo('<br>');

    var_dump($books2);

    

    echo('<br>');
    echo('<br>');
    echo('<br>');

    var_dump($books3);


    echo('<br>');
    echo('<br>');
    echo('<br>');

    var_dump($books4);
    
    echo('<br>');
    echo('<br>');
    echo('<br>');


    $dbConfig = Config::getInstance()->get('db');

    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=bookstore',
        $dbConfig['user'],
        $dbConfig['password']
    );
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $rows = $db->query('select * from book order by title');

    foreach ($rows as $row) {
        echo('<br>');
        echo('<br>');
        echo('<br>');
        echo('NEW ROW');

        var_dump($row);
    }

    $query = "INSERT INTO book (isbn, title, author, price) VALUES (\"9788187981954\", \"Peter Pan\", \"J. M. Barrie\", 2.34)";

    $result = $db->exec($query);
    echo('<br>');
    echo('<br>');
    var_dump($result);

    $error = $db->errorInfo()[2];
    echo('<br>');
    echo('<br>');
    var_dump($error);

    $query = 'SELECT * FROM book WHERE author = :author';
    $statement = $db->prepare($query);
    $statement->bindValue('author','George Orwell');
    $statement->execute();
    $rows = $statement->fetchAll();
    echo('<br>');
    echo('<br>');
    var_dump($rows);

function addBook(int $id, int $amount =1) : void {
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=bookstore','root',
        '');

    $query = 'UPDATE book SET stock = stock + :n WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue('id', $id);
    $statement->bindValue('n', $amount);

    if (!$statement->execute()) {
        throw new Exception($statement->errorInfo()[2]);
        
    }

}

function addSale(int $userId, array $bookIds) : void {
    $db = new PDO('mysql:host=127.0.0.1; dbname=bookstore', 'root', ''
        );
    $db->beginTransaction();
    try {
        $query = 'INSERT INTO sale (customer_id, date)' . 'VALUES(:id, NOW())';
        $statement = $db->prepare($query);
        if (!$statement->execute(['id' => $userId])) {
            throw new Exception($statement->errorInfo()[2]);
        }
        $saleId = $db->lastInsertId();

        $query = 'INSERT INTO sale_book (book_id, sale_id)' . 'VALUES(:book, :sale)';
        $statement = $db->prepare($query);
        $statement->bindValue('sale', $saleId);
        foreach ($bookIds as $bookId){
            $statement->bindValue('book', $bookId);
            if(!$statement->execute()) {
                throw new Exeption($statement->errorInfo()[2]);
            }            
        }

        $db->commit();
    } catch (Exception $e) {
        $db->roolBack();
        throw $e;
    }    
}


function createBasicCustomer(int $id)
{
try {
echo "Trying to create a new customer with id $id.";
echo('<br>');
echo('<br>');
echo('<br>');
return CustomerFactory::factory('basic', $id, "name", "surname", "email");
} catch (InvalidIdException $e) {
echo "You cannot provide a negative id.\n";
echo('<br>');
echo('<br>');
echo('<br>');
} catch (ExceededMaxAllowedException $e) {
echo "No more customers are allowed.\n";
echo('<br>');
echo('<br>');
echo('<br>');
} catch (Exception $e) {
echo "Unknown exception: " . $e->getMessage();
echo('<br>');
echo('<br>');
echo('<br>');
}
}