<?php

class Qcm{

    private array $students; // liste des élèves
    private array $questions; //Liste des questions posées
    private Era $era; //L'ère
    private int $size;


    public function __construct(array $students, Era $era, int $size){
        $this->students = $students;
        $this->size = $size;
        $query = "SELECT * FROM Questions WHERE ID = (lastname,name,login,password,roleID) VALUES (?,?,?,?,?)";
        $dao = DAO::get();

        for ($i=0; $i < $this->size; $i++) { 
            $res = $dao->query($query,$data);
            $this->questions.push();
        }

    }

    



}

?>