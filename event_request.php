<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login_form.php');
    exit();
}

include 'config.php';
global $connection;

// Form validation server-side
function validateEventData($data)
{
    $errors = [];

    // Required fields check
    $required_fields = ['title', 'description', 'type', 'location', 'date_from', 'date_to'];
    foreach ($required_fields as $field) {
        if (empty(trim($data[$field]))) {
            $errors[$field] = ucfirst($field) . " is required";
        }
    }

    // Type validation
    $valid_types = ['Conference', 'Seminar', 'Workshop'];
    if (!empty($data['type']) && !in_array($data['type'], $valid_types)) {
        $errors['type'] = "Invalid event type";
    }

    // Date validation
    if (!empty($data['date_from']) && !empty($data['date_to'])) {
        $date_from = strtotime($data['date_from']);
        $date_to = strtotime($data['date_to']);

        if ($date_to < $date_from) {
            $errors['date_to'] = "End date must be after start date";
        }

        if ($date_from < strtotime('today')) {
            $errors['date_from'] = "Start date cannot be in the past";
        }

        $days = floor(($date_to - $date_from) / (60 * 60 * 24)) + 1;
        if ($days > 30) {
            $errors['date_to'] = "Event cannot exceed 30 days";
        }
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validateEventData($_POST);
    if (empty($errors)) {
        // Proceed with database insertion
        $title = htmlspecialchars(trim($_POST['title']));
        $description = htmlspecialchars(trim($_POST['description']));
        $type = htmlspecialchars(trim($_POST['type']));
        $location = htmlspecialchars(trim($_POST['location']));
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        $days = floor((strtotime($date_to) - strtotime($date_from)) / (60 * 60 * 24)) + 1;

        $sql = "INSERT INTO tbl_events_request (title, description, type, location, date_from, date_to) 
        VALUES ('$title', '$description', '$type', '$location', '$date_from', '$date_to')";

        if ($connection->query($sql)) {
            $_SESSION['success'] = "Event request submitted successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error = "Failed to submit event request. Please try again.";
        }
    } else {
        $error = "Please fill in all the required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://www.w3schools.com/w3images/forestbridge.jpg');
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: white;
            font-family: "Courier New", Courier, monospace;
            font-size: 18px;
            overflow-x: hidden;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar {
            margin-bottom: 20px;
        }

        .invalid-feedback {
            display: none;
            font-size: 0.875em;
            color: #dc3545;
        }

        .was-validated .form-control:invalid~.invalid-feedback,
        .was-validated .form-select:invalid~.invalid-feedback {
            display: block;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
            <a class="navbar-brand text-light" href="home.php"
                style="<?php echo $current_page == 'home.php' ? 'text-decoration: underline;' : ''; ?>">Home</a>
            <a class="navbar-brand text-light" href="products.php"
                style="<?php echo $current_page == 'products.php' ? 'text-decoration: underline;' : ''; ?>">Products</a>
            <a class="navbar-brand text-light" href="event_request.php"
                style="<?php echo $current_page == 'event_request.php' ? 'text-decoration: underline;' : ''; ?>">Event Request</a>
            <form action="logout.php" method="POST" class="ms-auto">
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container form-container">
        <h1 class="text-dark text-center mb-4">Event Request</h1>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']); // Clear the message after displaying it
                ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" id="eventForm" class="text-dark needs-validation" novalidate>
            <div class="mb-3">
                <label for="title" class="form-label">Event Title</label>
                <input type="text" name="title" id="title" class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : ''; ?>" required>
                <div class="invalid-feedback"><?php echo isset($errors['title']) ? $errors['title'] : 'Please enter an event title.'; ?></div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>" rows="3" required></textarea>
                <div class="invalid-feedback"><?php echo isset($errors['description']) ? $errors['description'] : 'Please provide an event description.'; ?></div>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Event Type</label>
                <select name="type" id="type" class="form-select <?php echo isset($errors['type']) ? 'is-invalid' : ''; ?>" required>
                    <option value="">-- Select Type --</option>
                    <option value="Conference">Conference</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Workshop">Workshop</option>
                </select>
                <div class="invalid-feedback"><?php echo isset($errors['type']) ? $errors['type'] : 'Please select an event type.'; ?></div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control <?php echo isset($errors['location']) ? 'is-invalid' : ''; ?>" required>
                <div class="invalid-feedback"><?php echo isset($errors['location']) ? $errors['location'] : 'Please enter an event location.'; ?></div>
            </div>

            <div class="mb-3">
                <label for="date_from" class="form-label">Date From</label>
                <input type="date" name="date_from" id="date_from" class="form-control <?php echo isset($errors['date_from']) ? 'is-invalid' : ''; ?>" required>
                <div class="invalid-feedback"><?php echo isset($errors['date_from']) ? $errors['date_from'] : 'Please select a start date.'; ?></div>
            </div>

            <div class="mb-3">
                <label for="date_to" class="form-label">Date To</label>
                <input type="date" name="date_to" id="date_to" class="form-control <?php echo isset($errors['date_to']) ? 'is-invalid' : ''; ?>" required>
                <div class="invalid-feedback" id="date-to-feedback"><?php echo isset($errors['date_to']) ? $errors['date_to'] : 'Please select an end date.'; ?></div>
            </div>

            <div class="mb-3">
                <label for="days" class="form-label">Total of Days</label>
                <input type="text" id="days" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <script>
        const dateFrom = document.getElementById('date_from');
        const dateTo = document.getElementById('date_to');
        const daysField = document.getElementById('days');
        const dateToFeedback = document.getElementById('date-to-feedback');
        const form = document.getElementById('eventForm');

        function calculateDays() {
            const fromDate = new Date(dateFrom.value);
            const toDate = new Date(dateTo.value);

            if (fromDate && toDate) {
                if (toDate >= fromDate) {
                    const diffTime = Math.abs(toDate - fromDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    daysField.value = diffDays;
                    dateTo.setCustomValidity('');
                    dateToFeedback.textContent = 'Please select an end date.';
                } else {
                    daysField.value = '';
                    dateTo.setCustomValidity('End date must be after start date');
                    dateToFeedback.textContent = 'End date must be after start date.';
                }
            } else {
                daysField.value = '';
            }
        }

        dateFrom.addEventListener('change', calculateDays);
        dateTo.addEventListener('change', calculateDays);

        // Form validation client-side
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>