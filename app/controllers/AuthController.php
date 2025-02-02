<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends BaseController
{

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                $error = "All fields are required.";
                $this->render('auth/login', ['error' => $error]);
                return;
            }

            $user = User::findByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $this->redirect('events', 'success', 'Login successful.');
            } else {
                $error = "Invalid credentials.";
                $this->render('auth/login', ['error' => $error]);
            }
        } else {
            $this->render('auth/login');
        }
    }

    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $username = trim($_POST['username']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if (empty($username) || empty($password) || empty($confirmPassword)) {
                $error = "All fields are required.";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            if ($password !== $confirmPassword) {
                $error = "Passwords do not match.";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            if (User::findByUsername($username)) {
                $error = "Username already exists.";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            User::create($name,$username, $hashedPassword);
            $this->redirect('login', 'success', 'Registration successful. Please login.');
        } else {
            $this->render('auth/register');
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('login');
    }
}
