<?php
use Application\Core\Model;
use Application\DB\Adapter;

class ModelUser extends Model
{
	public function getData()
	{
        $db = new Adapter();
        $resultRows = array();

        $result = $db->query('{
                               "type": "SELECT",
                               "vars": ["first_name", "last_name", "age"],
                               "table": "User",
                               "where": ["age > 0", "AND", "id < 100"],
                               "order": "id"
                              }');

        if ($result) {
            while($row = $result->fetch()) {
                array_push($resultRows, ['first_name' => $row['first_name'],
                                         'last_name' => $row['last_name'],
                                         'age' => $row['age']]);
            }
        } else {
            $resultRows = array('error' => 'Query Error');
        }

        return $resultRows;
	}
}