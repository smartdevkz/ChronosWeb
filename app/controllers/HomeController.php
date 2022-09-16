<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Core\Controller as Controller;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, View $view)
    {
        
        return $view->render($response, 'home.twig');
    }
}