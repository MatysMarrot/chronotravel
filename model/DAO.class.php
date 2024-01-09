//DAO avec PSQL
<?php

//Ici les requires des objects

// Le Data Access Object pour la base de donnée
class DAO {
    //Singleton de la classe, accesseur de la db et credentials de la db
    private static $instance = null;
    private PDO $db;
    
    //voir https://www.php.net/manual/fr/ref.pdo-pgsql.php
    private string $database = "pgsql:host=IP;dbname=nom_de_votre_base_de_donnees";
    private string $user = "username";
    private string $password = "password";
  
    // Constructeur chargé d'ouvrir la BD
    private function __construct() {
      try {
        $this->db = new PDO($this->database, $this->user, $this->password);
        //var_dump($this);
        if (!$this->db) {
          throw new Exception("Impossible d'ouvrir $this->database with username $this->username");
          ("Database error");
        }
        // Positionne PDO pour lancer les erreurs sous forme d'exeptions
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
        throw new Exception("Erreur PDO : ".$e->getMessage().' sur '.$this->database);
      }
  
    }
  
    // Méthode statique pour acceder au singleton
    public static function get() : DAO {
      // Si l'objet n'a pas encore été crée, le crée
      if(is_null(self::$instance)) {
        self::$instance = new DAO();
      }
      return self::$instance;
    }
  
  
    // Lance une requête sur la BD, et retourne une table
    public function query(string $query, array $data = []): array{
      try {
        // Compile la requête, produit un PDOStatement
        $s = $this->db->prepare($query);
        // Exécute la requête avec les données
        $s->execute($data);
      } catch (Exception $e) {
        // Attrape l'exception pour y ajouter la requête
        throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . $e->getMessage() . " Query=\"" . $query . '"');
      }

      // Affiche en clair l'erreur PDO si la requête ne peut pas s'exécuter
      if ($s === false) {
        throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . implode('|', $this->db->errorInfo()) . " Query=\"" . $query . '"');
      }
      $table = $s->fetchAll();
      return $table;
    }

    public function exec(string $query, array $data = []): void{
      try {
        // Compile la requête, produit un PDOStatement
        $s = $this->db->prepare($query);
        // Exécute la requête avec les données
        $r = $s->execute($data);
      } catch (Exception $e) {
        // Attrape l'exception pour y ajouter la requête
        throw new PDOException(__METHOD__ . " at " . __LINE__ . ": " . $e->getMessage() . " Query=\"" . $query . '"');
      }

      // Affiche en clair l'erreur PDO si la requête ne peut pas s'exécuter
      if ($r === false) {
        throw new PDOException(__METHOD__ . " at " . __LINE__ . ": ".implode('|', $this->db->errorInfo()) . " Query: \"" . $query . '"');
      }
      // 
    }


    // Demande l'identifiant du dernier élémnt qui a été inséré
    public function lastInsertId(): string
    {
      return $this->db->lastInsertId();
    }
  
  
  }



?>