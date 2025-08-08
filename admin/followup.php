<?php
require 'db_connect.php';

// Handle meeting status update FIRST
if (isset($_POST['update_meeting_status'])) {
    $meeting_id = $_POST['meeting_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE meetings SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $meeting_id);
    $stmt->execute();

    header("Location: followup.php");
    exit();
}

// Now include other files and output HTML
require 'header.php';
require 'sidebar.php';

$result = $conn->query("SELECT * FROM followup ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Client Follow Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .meeting-badge {
            font-size: 0.75rem;
            margin-left: 5px;
        }

        .meeting-scheduled {
            background-color: #ffc107;
            color: #000;
        }

        .meeting-completed {
            background-color: #28a745;
            color: #fff;
        }

        .meeting-action-btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.7rem;
            margin-left: 5px;
        }

        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            table-layout: auto;
            word-wrap: break-word;
        }

        .table th,
        .table td {
            vertical-align: middle;
            min-width: 100px;
            padding: 10px 12px;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.35em 0.65em;
        }

        .report-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .report-item:last-child {
            border-bottom: none;
        }

        @media (max-width: 768px) {
            .table-responsive {
                padding: 5px;
            }

            .table th,
            .table td {
                padding: 8px 5px;
                font-size: 0.85rem;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
            }

            .action-buttons {
                justify-content: flex-end;
            }
        }
    </style>
</head>

<body>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php require 'navbar.php'; ?>

        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Client Follow Up</h2>
                <a href="createfollowup.php" class="btn btn-primary">+ Add New Follow Up</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Enquiry</th>
                            <th scope="col">Meeting</th>
                            <th scope="col">Call/SMS</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()):
                            // Fetch reports and meetings for this client
                            $reports_result = $conn->query("SELECT * FROM report WHERE client_id = {$row['id']} ORDER BY report_date DESC");
                            $reports = $reports_result->fetch_all(MYSQLI_ASSOC);

                            $meeting_result = $conn->query("SELECT * FROM meetings WHERE client_id = {$row['id']} ORDER BY meeting_date DESC LIMIT 1");
                            $meeting = $meeting_result->fetch_assoc();
                        ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['client_name']) ?></td>
                                <td><?= htmlspecialchars($row['client_phone']) ?></td>
                                <td><?= htmlspecialchars($row['client_address']) ?></td>
                                <td><?= htmlspecialchars($row['enquiry']) ?></td>
                                <td>
                                    <?php if ($meeting): ?>
                                        <?php
                                        $meeting_status = $meeting['status'] ?? (strtotime($meeting['meeting_date']) > time() ? 'scheduled' : 'completed');
                                        $badge_class = ($meeting_status == 'scheduled') ? 'meeting-scheduled' : 'meeting-completed';
                                        $status_text = ($meeting_status == 'scheduled') ?
                                            date('d M Y h:i A', strtotime($meeting['meeting_date'])) : 'Done';
                                        ?>
                                        <span class="badge <?= $badge_class ?> meeting-badge">
                                            <?= $status_text ?>
                                        </span>

                                        <?php if ($meeting_status == 'scheduled'): ?>
                                            <!-- Done button for scheduled meetings -->
                                            <form method="post" style="display: inline;">
                                                <input type="hidden" name="meeting_id" value="<?= $meeting['id'] ?>">
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" name="update_meeting_status" class="btn btn-sm btn-success meeting-action-btn" title="Mark as Done">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <!-- Reschedule button for completed meetings -->
                                            <button type="button" class="btn btn-sm btn-warning meeting-action-btn"
                                                data-bs-toggle="modal" data-bs-target="#rescheduleMeetingModal<?= $row['id'] ?>"
                                                title="Reschedule Meeting">
                                                <i class="fas fa-calendar-alt"></i>
                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <!-- Schedule button when no meeting exists -->
                                        <span class="badge bg-secondary meeting-badge">No Meeting</span>
                                        <button type="button" class="btn btn-sm btn-primary meeting-action-btn"
                                            data-bs-toggle="modal" data-bs-target="#scheduleMeetingModal<?= $row['id'] ?>"
                                            title="Schedule Meeting">
                                            <i class="fas fa-calendar-plus"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="https://wa.me/91<?= $row['client_phone'] ?>" target="_blank" class="btn btn-sm btn-success me-1" title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="tel:<?= $row['client_phone'] ?>" class="btn btn-sm btn-primary me-1" title="Call">
                                            <i class="fas fa-phone-alt"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#reportModal<?= $row['id'] ?>" title="Send SMS/Message">
                                            <i class="fas fa-sms"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    switch ($row['statuts']) {
                                        case 1:
                                            echo '<span class="badge bg-primary">Open</span>';
                                            break;
                                        case 2:
                                            echo '<span class="badge bg-warning text-dark">In Progress</span>';
                                            break;
                                        case 3:
                                            echo '<span class="badge bg-success">Closed</span>';
                                            break;
                                        default:
                                            echo '<span class="badge bg-secondary">Unknown</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-end">
                                    <div class="action-buttons">
                                        <a href="edit_followup.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <button type="button" class="btn btn-sm btn-secondary me-1" data-bs-toggle="modal" data-bs-target="#viewModal<?= $row['id'] ?>" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="delete_followup.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Report Modal -->
                            <div class="modal fade" id="reportModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Report for <?= htmlspecialchars($row['client_name']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="save_report.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="client_id" value="<?= $row['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Number of Calls Today</label>
                                                    <input type="number" class="form-control" name="calls_count" min="0" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Message/Notes</label>
                                                    <textarea class="form-control" name="message" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Report</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Meeting Modal -->
                            <div class="modal fade" id="scheduleMeetingModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Schedule Meeting with <?= htmlspecialchars($row['client_name']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="save_meeting.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="client_id" value="<?= $row['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Meeting Date & Time</label>
                                                    <input type="datetime-local" class="form-control" name="meeting_date" id="meetingDateTime<?= $row['id'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Meeting Notes</label>
                                                    <textarea class="form-control" name="meeting_notes" rows="3"></textarea>
                                                </div>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" name="send_reminder" id="sendReminder<?= $row['id'] ?>" checked>
                                                    <label class="form-check-label" for="sendReminder<?= $row['id'] ?>">Send me a reminder</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Schedule Meeting</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Reschedule Meeting Modal -->
                            <div class="modal fade" id="rescheduleMeetingModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reschedule Meeting with <?= htmlspecialchars($row['client_name']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="reschedule_meeting.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" name="meeting_id" value="<?= $meeting['id'] ?>">
                                                <input type="hidden" name="client_id" value="<?= $row['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">New Meeting Date & Time</label>
                                                    <input type="datetime-local" class="form-control" name="new_meeting_date" id="rescheduleDateTime<?= $row['id'] ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Additional Notes</label>
                                                    <textarea class="form-control" name="additional_notes" rows="3"><?= htmlspecialchars($meeting['meeting_notes'] ?? '') ?></textarea>
                                                </div>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" name="send_reminder" id="rescheduleReminder<?= $row['id'] ?>" checked>
                                                    <label class="form-check-label" for="rescheduleReminder<?= $row['id'] ?>">Send me a reminder</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Reschedule Meeting</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- View Details Modal -->
                            <div class="modal fade" id="viewModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Client Details - <?= htmlspecialchars($row['client_name']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <h6>Basic Information</h6>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><strong>ID:</strong> <?= $row['id'] ?></li>
                                                        <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($row['client_name']) ?></li>
                                                        <li class="list-group-item"><strong>Phone:</strong> <?= htmlspecialchars($row['client_phone']) ?></li>
                                                        <li class="list-group-item"><strong>Address:</strong> <?= htmlspecialchars($row['client_address']) ?></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Enquiry Details</h6>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item"><strong>Enquiry:</strong> <?= htmlspecialchars($row['enquiry']) ?></li>
                                                        <li class="list-group-item">
                                                            <strong>Status:</strong>
                                                            <?php
                                                            switch ($row['statuts']) {
                                                                case 1:
                                                                    echo '<span class="badge bg-primary">Open</span>';
                                                                    break;
                                                                case 2:
                                                                    echo '<span class="badge bg-warning text-dark">In Progress</span>';
                                                                    break;
                                                                case 3:
                                                                    echo '<span class="badge bg-success">Closed</span>';
                                                                    break;
                                                                default:
                                                                    echo '<span class="badge bg-secondary">Unknown</span>';
                                                            }
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <?php if ($meeting): ?>
                                                <div class="mt-4">
                                                    <h5>Meeting Information</h5>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p><strong>Scheduled Date:</strong> <?= date('d M Y h:i A', strtotime($meeting['meeting_date'])) ?></p>
                                                                    <p><strong>Status:</strong>
                                                                        <?php if (($meeting['status'] ?? 'scheduled') == 'scheduled'): ?>
                                                                            <span class="badge bg-warning text-dark">Scheduled</span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-success">Completed</span>
                                                                        <?php endif; ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><strong>Notes:</strong></p>
                                                                    <p><?= htmlspecialchars($meeting['meeting_notes']) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="mt-4">
                                                <h5>Follow-up Reports</h5>
                                                <?php if (!empty($reports)): ?>
                                                    <div class="list-group">
                                                        <?php foreach ($reports as $report): ?>
                                                            <div class="report-item">
                                                                <div class="d-flex justify-content-between">
                                                                    <strong>Date:</strong>
                                                                    <span><?= date('d M Y H:i', strtotime($report['report_date'])) ?></span>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <strong>Calls:</strong>
                                                                    <span><?= $report['calls'] ?></span>
                                                                </div>
                                                                <div>
                                                                    <strong>Message:</strong>
                                                                    <p><?= htmlspecialchars($report['message']) ?></p>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="alert alert-info">No reports found for this client.</div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php require 'footer.php'; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals
            var modals = document.querySelectorAll('.modal');
            modals.forEach(function(modal) {
                new bootstrap.Modal(modal);
            });

            // Initialize datetime pickers
            document.querySelectorAll('[id^="meetingDateTime"], [id^="rescheduleDateTime"]').forEach(function(element) {
                flatpickr(element, {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today",
                    time_24hr: false
                });
            });
        });
    </script>
</body>

</html>