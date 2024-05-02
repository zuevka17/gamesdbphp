<?php

namespace Infrastructure\Route;

use Application\Http\Request;
use Application\Http\Response;

class Router
{
    protected $routes = [];

    public function get($uri, $handler)
    {
        $this->routes['GET'][$uri] = $handler;
    }

    public function post($uri, $handler)
    {
        $this->routes['POST'][$uri] = $handler;
    }

    public function handle(Request $request)
    {
        $method = $request->getMethod();
        $uri = $request->getUri();

        if (isset($this->routes[$method][$uri])) {
            $handler = $this->routes[$method][$uri];
            // Обработка вызова обработчика (контроллера или метода)
            // Возвращаемый результат может быть Response объектом или строкой (текст ответа)
            return $this->callHandler($handler, $request);
        }

        // Если маршрут не найден, возвращаем 404 Not Found
        return new Response('404 Not Found', 404);
    }

    protected function callHandler($handler, Request $request)
    {
        // Проверяем, является ли обработчик строкой (например, имя контроллера)
        if (is_string($handler)) {
            // Разделяем строку обработчика на класс и метод
            list($controller, $method) = explode('@', $handler);
            // Создаем экземпляр контроллера
            $controllerInstance = new $controller();
            // Вызываем метод контроллера и передаем ему объект запроса
            return $controllerInstance->$method($request);
        }
        // Если обработчик является замыканием, просто вызываем его
        return $handler($request);
    }
}