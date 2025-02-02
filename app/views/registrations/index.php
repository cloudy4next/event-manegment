<h2>Registration</h2>

<table id="registrationTable" class="table table-bordered table-striped mt-2">
    <thead>
        <tr>
            <th>Event Name</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Registered At</th>
        </tr>
    </thead>
    <tbody>

        <?php if (!empty($registrations)): ?>
            <?php foreach ($registrations as $reg): ?>
                <tr>
                    <td><?= htmlspecialchars($reg['ev_name']) ?></td>
                    <td><?= htmlspecialchars($reg['user_name']) ?></td>
                    <td><?= htmlspecialchars($reg['email']) ?></td>
                    <td><?= htmlspecialchars($reg['address']) ?></td>
                    <td><?= htmlspecialchars($reg['mobile']) ?></td>
                    <td><?= htmlspecialchars($reg['registered_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No registrations found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#registrationTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>