<?php
class BaseController
{
    protected function render($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../views/layouts/main.php';
    }

    protected function redirect($url, $type = null, $message = null)
    {
        if ($type && $message) {
            $_SESSION[$type] = $message;
        }
        header("Location: $url");
        exit;
    }

    protected function redirectBack($fallbackUrl = '/', $type = null, $message = null)
    {
        if ($type && $message) {
            $_SESSION[$type] = $message;
        }
        $previousUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $fallbackUrl;
        header("Location: " . $previousUrl);
        exit();
    }
}
