<?php
// app/controllers/EventController.php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/Event.php';

class EventController extends BaseController
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
        $events = Event::getAll();
        $this->render('events/index', ['events' => $events]);
    }

    public function create()
    {
        $this->checkAuth();
        $this->render('events/create');
    }

    public function store()
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $location = trim($_POST['location']);
            $event_date = $_POST['event_date'];
            $max_capacity = (int) $_POST['max_capacity'];

            if (empty($name) || empty($event_date) || $max_capacity <= 0) {
                $error = "Name, event date, and capacity are required.";
                $this->render('events/create', ['error' => $error]);
                return;
            }
            var_dump($_SESSION['user']['id']);
            Event::create($_SESSION['user']['id'], $name, $description, $location, $event_date, $max_capacity);
            $this->redirect('/events', 'success', 'Event created.');
        }
    }

    public function edit($id)
    {
        var_dump($id);
        $this->checkAuth();
        $event = Event::findById($id);
        if (!$event) {
            echo "Event not found.";
            return;
        }
        $this->render('events/edit', ['event' => $event]);
    }

    public function update($id)
    {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $location = trim($_POST['location']);
            $event_date = $_POST['event_date'];
            $max_capacity = (int) $_POST['max_capacity'];

            if (empty($name) || empty($event_date) || $max_capacity <= 0) {
                $error = "Name, event date, and capacity are required.";
                $event = Event::findById($id);
                $this->render('events/edit', ['event' => $event, 'error' => $error]);
                return;
            }

            Event::update($id, $name, $description, $location, $event_date, $max_capacity);
            $this->redirect('/events', 'success', 'Event updated.');
        }
    }

    public function delete($id)
    {
        $this->checkAuth();
        Event::delete($id);
        $this->redirect('/events', 'success', 'Event deleted.');
    }

    public function view($id)
    {
        $this->checkAuth();
        $event = Event::findById($id);
        if (!$event) {
            echo "Event not found.";
            return;
        }
        $this->render('events/view', ['event' => $event]);
    }


    private function getSingleEventDetail($id)
    {
        return Event::findById($id);
    }

    public function getEventDetails($event_id)
    {
        $event = $this->getSingleEventDetail($event_id);

        if (!$event) {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Event not found']);
            exit;
        }

        echo json_encode([
            'id' => $event['id'],
            'name' => $event['name'],
            'event_date' => $event['event_date'],
            'location' => $event['location'],
            'description' => $event['description']
        ]);
        exit;
    }


    public function getEventDetailsWithAttendance($event_id)
    {
        $event = $this->getSingleEventDetail($event_id);

        if (!$event) {
            http_response_code(404);
            echo json_encode(['error' => 'Event not found']);
            exit;
        }

        $registrations = Registration::getByEventId($event_id);

        $attendees = array_map(function ($registration) {
            return [
                'name' => $registration['name'],
                'email' => $registration['email'],
                'address' => $registration['address'],
                'mobile' => $registration['mobile']
            ];
        }, $registrations);

        echo json_encode([
            'id' => $event['id'],
            'name' => $event['name'],
            'event_date' => $event['event_date'],
            'location' => $event['location'],
            'description' => $event['description'],
            'attendees' => $attendees
        ]);

        exit;
    }

}
