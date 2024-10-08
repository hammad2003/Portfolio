<?php

require_once "../vendor/autoload.php";
require_once "../src/controller/ProjectController.php";

// Inicializar el cargador de Twig
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
// 'cache' => 'cache',
]);

// Obtener los proyectos desde el controlador
$pc = new ProjectController();
$projects = $pc->getProjects();

// Renderizar la plantilla Twig con los proyectos
echo $twig->render('index.html', ['projects' => $projects]);

?>