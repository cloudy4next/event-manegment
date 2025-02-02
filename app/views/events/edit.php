<h2>Edit Event: <?= htmlspecialchars($event['name']) ?></h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="/events/update/<?= $event['id'] ?>" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Event Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($event['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Event Description</label>
        <input type="text" name="description" id="description" class="form-control" value="<?= htmlspecialchars($event['description']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date</label>
        <input type="date" name="event_date" id="event_date" class="form-control" value="<?= htmlspecialchars(date('Y-m-d', strtotime($event['event_date']))) ?>" required>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" name="location" id="location" class="form-control" value="<?= htmlspecialchars($event['location']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="max_capacity" class="form-label">Max Capacity</label>
        <input type="number" name="max_capacity" id="max_capacity" class="form-control" value="<?= htmlspecialchars($event['max_capacity']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Event</button>
</form>
