<h2><?= htmlspecialchars($event['name']) ?></h2>
<p><strong>Date:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
<p><strong>Location:</strong> <?= htmlspecialchars($event['location']) ?></p>
<p><strong>Description:</strong> <?= htmlspecialchars($event['description']) ?></p>

<hr>

<div class="row">
    <div class="col-md-6">
        <h3>Register for this Event</h3>
        <div id="registration-message"></div>
        <form id="registration-form" method="POST">
            <input type="hidden" id="event_id" value="<?= $event['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" class="form-control" id="address" required></textarea>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" name="mobile" class="form-control" id="mobile" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <div class="col-md-6" style="position: relative; height: 400px;">
        <h3>Registered Users</h3>
        <ul id="registered-users" class="list-group"></ul>

        <nav style="position: absolute; right: 0;">
            <ul class="pagination" id="pagination"></ul>
        </nav>
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let currentPage = 1;
        const eventId = $("#event_id").val();

        function loadRegistrations(page) {
            $.ajax({
                url: `/registrations/list/${eventId}/${page}`,
                type: "GET",
                success: function (response) {
                    let data = JSON.parse(response);
                    let usersList = $("#registered-users");
                    let pagination = $("#pagination");

                    usersList.empty();
                    pagination.empty();

                    data.registrations.forEach(user => {
                        usersList.append(`<li class="list-group-item">${user.name} - ${user.email}</li>`);
                    });

                    for (let i = 1; i <= data.totalPages; i++) {
                        pagination.append(
                            `<li class="page-item ${i === data.currentPage ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                        </li>`
                        );
                    }
                }
            });
        }

        loadRegistrations(currentPage);

        $(document).on("click", ".pagination .page-link", function (e) {
            e.preventDefault();
            let page = $(this).data("page");
            if (page !== currentPage) {
                currentPage = page;
                loadRegistrations(page);
            }
        });

        $("#registration-form").on("submit", function (e) {
            e.preventDefault();
            $.ajax({
                url: `/registrations/store/${eventId}`,
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    let data = JSON.parse(response);
                    if (data.success) {
                        $("#registration-form")[0].reset();
                        loadRegistrations(1);
                    } else {
                        $("#registration-message").html('<div class="alert alert-danger">Registration failed!</div>');
                    }
                }
            });
        });
    });
</script>