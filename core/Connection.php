 <?php

 class Connection
 {
     public static function make($configs)
     {
         try{
             return new PDO(
                 $configs['connection'].
                 ';dbname='.$configs['name'],
                 $configs['username'],
                 $configs['password'],
                 $configs['options']
             );
         }catch(PDOException $e){
           file_put_contents(LOGS.'PDOErrors.log', $e->getMessage(), FILE_APPEND);
           die($e->getMessage());
         }
     }

  public static function makeConnection()
  {
    $db = include CONFIG.'db.php';

    $config = $db['database'];

    try {
      return new PDO(
        $config['connection'].';dbname='.$config['name'],
        $config['username'],
        $config['password'],
        $config['options']
      );
    }
    catch(PDOException $e) {
        echo "SQL, у нас проблемы.\n" . $e->getMessage();
        file_put_contents(LOGS.'PDOErrors.log', $e->getMessage(), FILE_APPEND);
    }
  }
 }
