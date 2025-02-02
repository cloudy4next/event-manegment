<h2>Event Registrations Report</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Registered At</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($registrations)): ?>
            <?php foreach($registrations as $reg): ?>
            <tr>
                <td><?= htmlspecialchars($reg['name']) ?></td>
                <td><?= htmlspecialchars($reg['email']) ?></td>
                <td><?= htmlspecialchars($reg['address']) ?></td>
                <td><?= htmlspecialchars($reg['mobile']) ?></td>
                <td><?= htmlspecialchars($reg['registered_at']) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No registrations found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
