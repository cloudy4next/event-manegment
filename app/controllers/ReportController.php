<?php
// app/controllers/ReportController.php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Registration.php';

class ReportController extends BaseController
{

    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $this->redirectBack('/events', 'error', 'Unauthorized access.');
        }
    }

    public function downloadEventReport($event_id)
    {
        $this->checkAdmin();
        $event = Event::findById($event_id);
        if (!$event) {
            $this->redirectBack('/events', 'error', 'Event not found.');
        }
        $registrations = Registration::findByEventId($event_id);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=event_' . $event_id . '_registrations.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Name', 'Email', 'Address', 'Mobile', 'Registered At']);
        foreach ($registrations as $reg) {
            fputcsv($output, [$reg['name'], $reg['email'], $reg['address'], $reg['mobile'], $reg['registered_at']]);
        }
        fclose($output);
        exit;
    }
}
