<?php
use app\controllers\ProfesorController;
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\EvaluacionController;
use app\controllers\CursoController;
use app\core\Application;
use app\models\Profesor;
use app\controllers\RolesController;
use app\models\Permisos;

use app\controllers\PermisosController;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config= [
    'userClass' => \app\models\User::class,
    'db' =>[
        'dsn' => $_ENV['DB_DSN'], 
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'], 

    ]
];

$app = new Application(dirname(__DIR__),$config);

$app->router->get('/', [SiteController::class,'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout',[AuthController::class, 'logout']);

// app/config/routes.php
$app->router->get('/profesor', [ProfesorController::class, 'ProfesorForm']);  
$app->router->post('/profesor', [ProfesorController::class, 'ProfesorForm']); 
$app->router->get('/evaluacion', [EvaluacionController::class, 'create']);  
$app->router->post('/evaluacion', [EvaluacionController::class, 'create']); 
$app->router->get('/curso', [CursoController::class, 'create']);
$app->router->post('/curso', [CursoController::class, 'create']);


$app->router->get('/roles', [RolesController::class, 'create']);  
$app->router->post('/roles', [RolesController::class, 'create']);
$app->router->get('/listRoles', [RolesController::class, 'index']);

$app->router->get('/permisos', [PermisosController::class, 'create']);  
$app->router->post('/permisos', [PermisosController::class, 'create']);
$app->router->get('/listPermisos', [PermisosController::class, 'index']);

$app->router->get('/editPermiso', [PermisosController::class, 'edit']);

// Para procesar la actualización del permiso (POST)
$app->router->post('/editPermiso', [PermisosController::class, 'update']);

// En routes.php
$app->router->post('/deletePermiso', [PermisosController::class, 'delete']);

$app->router->get('/listar', [CursoController::class, 'listar']);

$app->run();
