<h2>Events</h2>
<a href="/events/create" class="btn btn-success mb-3">Create Event</a>

<table id="eventTable" class="table table-bordered table-striped mt-2">
    <thead>
        <tr>
            <th>Name</th>
            <th>Event Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event['name']) ?></td>
                    <td><?= htmlspecialchars($event['event_date']) ?></td>
                    <td><?= htmlspecialchars($event['location']) ?></td>
                    <td>
                        <a href="/events/view/<?= $event['id'] ?>" class="btn btn-primary btn-sm">View</a>
                        <a href="/events/edit/<?= $event['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/events/delete/<?= $event['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</a>
                        <a href="/reports/event/<?= $event['id'] ?>" class="btn btn-info btn-sm">Report</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No events found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#eventTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>