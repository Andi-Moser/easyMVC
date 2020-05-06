<?php


class easyMVC
{
    public static function callAction($controller, $action)
    {
        $controllerFolder = str_replace("Controller", "", $controller);
        $actionFile = str_replace("Action", "", $action);

        if (class_exists($controller)) {
            $controllerObject = new $controller();

            if ($controllerObject instanceof BaseController) {
                if (method_exists($controllerObject, $action)) {
                    // execute controller action
                    $response = $controllerObject->$action();

                    if ($response instanceof Redirect) {
                        header("Location: " . $response->getUrl());
                        exit();
                    }
                    else {
                        // determine view file
                        $viewFile = __DIR__ .DS . ".." . DS . "view" . DS . $controllerFolder . DS . $actionFile . ".php";
                        if (file_exists($viewFile)) {
                            // get output from view
                            $output = self::renderWithParams($viewFile, get_object_vars($controllerObject->getView()));

                            // echo output and end execution
                            echo $output;
                            die();
                        } else {
                            throw new Exception("Cannot find view " . $viewFile);
                        }
                    }
                } else {
                    throw new Exception("Action " . $action . " was not found in controller " . $controller);
                }
            } else {
                throw new Exception("Invalid Controller " . $controller);
            }
        } else {
            throw new Exception("Controller " . $controller . " does not exist");
        }
    }

    private static function renderWithParams($viewFile, $params) {
        extract($params);

        ob_start();

        include $viewFile;

        return ob_get_clean();
    }

}