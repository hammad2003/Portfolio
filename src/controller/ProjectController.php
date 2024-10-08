<?php

require_once "DatabaseController.php";

class ProjectController {

    private $connection;

    public function __construct() {
        $this->connection = DatabaseController::connect();
    }

    public function getProjects() {
        try {
            $sql = "
                SELECT Project.id, Project.name, Project.description, 
                       GROUP_CONCAT(Technology.name SEPARATOR ', ') as technologies
                FROM Project
                LEFT JOIN ProjectTechnology ON Project.id = ProjectTechnology.projectId
                LEFT JOIN Technology ON ProjectTechnology.technologyId = Technology.id
                GROUP BY Project.id;
            ";

            $statement = $this->connection->prepare($sql);
            $statement->setFetchMode(PDO::FETCH_OBJ);
            $statement->execute();

            $result = $statement->fetchAll();

            return $result;

        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

}