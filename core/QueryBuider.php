<?php

class QueryBuider
{
    protected $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function selectAll($table){
        $statment = $this->pdo->prepare("select * from {$table}");
        $statment->execute();

        // dd($statment->fetchAll(PDO::FETCH_OBJ));

        // return a obs
        // $tasks = $statment->fetchAll(PDO::FETCH_OBJ);

        return $statment->fetchAll();
    }

    public function insert($table, $parameters){
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try{
            $statment = $this->pdo->prepare($sql);

            $statment->execute($parameters);
        }catch(Execption $e){
            die('Whooops, something went wrong');
        }

    }
}
