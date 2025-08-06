
<?php
// Database connection
include"db_connect.php";

if (isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $conn->query("DELETE FROM connect_enquiries WHERE id = $delete_id");
    header("Location: enquiry_deatils.php"); // Redirect to refresh the page
    exit();
}
// Fetch blogs
$sql = "SELECT * FROM connect_enquiries ORDER BY id DESC";
$result = $conn->query($sql);
?>

<?php
require 'header.php';  // Include the header
require 'sidebar.php'; // Include the sidebar
?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
<?php
require './navbar.php';  // Include the footer
?>
    <div class="container mt-4">
    <h4 class="mb-4">Enquiries List</h4>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Enquiry</th>
                     <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['contact']); ?></td>
                            <td><?php echo htmlspecialchars($row['enquiry']); ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No Enquiries Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
        
       
    

</div>
<?php
require 'footer.php';  // Include the footer

?>