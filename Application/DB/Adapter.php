<?php namespace Application\DB;

use \PDO;

/*
----- How to use it -----

require 'Adapter.php'; // or autoload it

use Application\DB\Adapter;

$db = new Adapter();

$result = $db->query('{
                       "type": "SELECT",
                       "vars": ["first_name", "last_name", "age"],
                       "table": "User",
                       "where": ["age > 0", "AND", "id < 100"],
                       "order": "id"
                      }');

if ($result) {
    while($row = $result->fetch()) {
        print(join(' ', [$row['first_name'], $row['last_name'], $row['age']]).'<br/>');
    }
} else {
  print('Query Error');
}
*/

class Adapter {
    private $pdo;
    
    public function __construct() {
        $host = 'localhost';
        $db = 'test_db';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }
    
    private function argumentsConvert($arguments) {
        if (is_string($arguments)) {
            return "`$arguments`";
        } else {
            return '`'.join('`, `', $arguments).'`';
        }
    }
    
    private function conditionsConvert($conditions, &$valuesToEscape) {
        if (is_string($conditions)) {
            $operands = explode(' ', $conditions);
            return "$operands[0] $operands[1] :$operands[0]";
        } else {
            $result = '';
            foreach($conditions as $condition) {
                $operands = explode(' ', $condition);
                if (count($operands) > 1) {
                    $result .= "$operands[0] $operands[1] :$operands[0]";
                    $valuesToEscape[":$operands[0]"] = $operands[2];
                } else {
                    $result .= " $operands[0] ";
                }
            }
            return $result;
        }
    }
    
    public function query($json) {
        $valuesToEscape = array();
        $decoded = json_decode($json, true);
        $type = strtoupper($decoded['type']);
        
        if ($type === 'SELECT') {
            $stmt = join(' ', ['SELECT', $this->argumentsConvert($decoded['vars']),
                               'FROM', $this->argumentsConvert($decoded['table']),
                               'WHERE', $this->conditionsConvert($decoded['where'], $valuesToEscape),
                               'ORDER BY', $this->argumentsConvert($decoded['order'])
                              ]);
        } elseif ($type === 'UPDATE') {
            // todo ...
        }
        
        $response = $this->pdo->prepare($stmt);
        
        if ($response->execute($valuesToEscape)) {
            return $response;
        } else {
            return false;
        }
    }
    
}
