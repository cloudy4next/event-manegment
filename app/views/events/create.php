<h2>Create Event</h2>
<?php if(isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="POST" action="/events/store">
    <div class="mb-3">
        <label for="name" class="form-label">Event Name</label>
        <input type="text" name="name" class="form-control" id="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" name="location" class="form-control" id="location">
    </div>
    <div class="mb-3">
        <label for="event_date" class="form-label">Event Date</label>
        <input type="date" name="event_date" class="form-control" id="event_date" required>
    </div>
    <div class="mb-3">
        <label for="max_capacity" class="form-label">Max Capacity</label>
        <input type="number" name="max_capacity" class="form-control" id="max_capacity" required>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>
