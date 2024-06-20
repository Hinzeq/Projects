<?php

declare(strict_types=1);

final class Router
{
    private array $routes = [];
    private array $requestUri;
    private string $method;

    public function addRoute(string $method, string $url, Closure $target): void
    {
        $this->routes[$method][$url] = $target;
    }

    public function matchRoute(): void
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        
        if (isset($this->routes[$this->method])) {
            $this->requestUri = explode('/', $_SERVER['REQUEST_URI']);
            if ($this->setRoute()) {
                return;
            }
        }

        throw new PageNotFoundException();
    }

    private function setRoute(): bool
    {
        foreach ($this->routes[$this->method] as $url => $target) {
            $routeUrl = explode('/', $url);

            $params = [];
            for ($i=0; $i < count($routeUrl); $i++) { 
                if (preg_match('/\{([^\/]+)}/', $routeUrl[$i])) {
                    $params[trim($routeUrl[$i], '\{\}')] =  $this->requestUri[$i];
                    $routeUrl[$i] = $this->requestUri[$i];
                }
            }
            
            if ($routeUrl === $this->requestUri) {
                call_user_func_array($target, $params);
                return true;
            }
        }

        return false;
    }
}
