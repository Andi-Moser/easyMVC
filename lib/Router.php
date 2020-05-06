<?php


class Router
{
    private static $routes = [];

    public static function loadRoutes() {
        $controllerDir = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "controller";

        foreach (scandir($controllerDir) as $controller) {
            if ($controller == "." || $controller == "..") {
                continue;
            }
            $controllerName = str_replace(".php", "", $controller);

            if (class_exists($controllerName)) {
                $methods = get_class_methods($controllerName);
                $reflectionClass = new ReflectionClass($controllerName);

                foreach ($methods as $method) {
                    if (strstr($method, "Action")) {
                        // we have found an action method
                        $annotation = $reflectionClass->getMethod($method)->getDocComment();

                        $matches = [];
                        if (preg_match_all("/@Route\(\\\"(.*)\\\"\);?/", $annotation, $matches, PREG_SET_ORDER) !== null) {
                            foreach ($matches as $match) {
                                self::$routes[] = [
                                    "pattern" => $match[1],
                                    "controller" => $controllerName,
                                    "action" => $method
                                ];
                            }
                        }
                    }
                }
            }
        }
    }

    private static function buildRegexForPattern($pattern) {
        $pattern = "@^" . $pattern . "$@";

        return $pattern;
    }

    public static function match($pattern) {
        foreach (self::$routes as $route) {
            if (preg_match(self::buildRegexForPattern($route['pattern']), $pattern)) {
                return $route;
            }
        }
    }
}