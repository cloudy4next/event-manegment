<?php
// app/controllers/RegistrationController.php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Registration.php';

class RegistrationController extends BaseController
{

    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');
        }
    }

    public function index()
    {
        $this->checkAuth();
        $registrations = Registration::getAll();
        $this->render('registrations/index', ['registrations' => $registrations]);
    }

    public function register($event_id)
    {
        $this->checkAuth();
        $event = Event::findById($event_id);
        if (!$event) {
            $error = "Event not found.";
            $this->render('registrations/register', ['error' => $error]);
            return;
        }
        $this->render('registrations/register', ['event' => $event]);
    }

    public function store($event_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $address = trim($_POST['address']);
            $mobile = trim($_POST['mobile']);

            if (empty($name) || empty($email) || empty($address) || empty($mobile)) {
                $error = "All fields are required.";
                $event = Event::findById($event_id);
                $this->render('registrations/register', ['error' => $error, 'event' => $event]);
                return;
            }

            $event = Event::findById($event_id);
            if (!$event) {
                $error = "Event not found.";
                return;
            }

            $currentCount = Registration::countByEventId($event_id);
            if ($currentCount >= $event['max_capacity']) {
                $error = "Registration closed. Maximum capacity reached.";
                $this->render('registrations/register', ['error' => $error, 'event' => $event]);
                return;
            }

            $user_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : null;
            Registration::create($user_id, $event_id, $name, $email, $address, $mobile);
            $_SESSION['success'] = "Registration successful.";
            echo json_encode(['success' => true]);
            exit;
        }
    }

    public function listRegistrations($event_id, $page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $registrations = Registration::getPaginatedByEventId($event_id, $limit, $offset);
        $totalCount = Registration::countByEventId($event_id);
        $totalPages = ceil($totalCount / $limit);

        echo json_encode([
            'registrations' => $registrations,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
        exit;
    }


}
