<?php
session_start();
include "../db.php"; // Include your database connection file

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view your trips.";
    header("Location: login.php");
}

$user_id = $_SESSION['user_id']; // Get logged-in user ID
$username = $_SESSION['username']; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $budget = isset($_POST['budget']) ? $_POST['budget'] : '';
    $season = isset($_POST['season']) ? $_POST['season'] : '';
    $traveler = isset($_POST['traveler']) ? $_POST['traveler'] : '';
    $category = isset($_POST['category']) ? $_POST['category'] : '';


    // Base query
    $query = "SELECT * FROM destinations WHERE 1=1";
    $params = [];
    $types = "";

    // Add conditions based on user input
    if (!empty($budget)) {
        $query .= " AND average_cost <= ? ";
        $params[] = $budget;
        $types .= "d";
    }
    if (!empty($season)) {
        $query .= " AND best_season = ?";
        $params[] = $season;
        $types .= "s";
    }
    if (!empty($traveler)) {
        $query .= " AND FIND_IN_SET(?, recommended_for)";
        $params[] = $traveler;
        $types .= "s";
    }
    if (!empty($category)) {
        $query .= " AND category = ?";
        $params[] = $category;
        $types .= "s";
    }

    $query .= " ORDER BY average_cost DESC";

    // Prepare & bind
    $stmt = $conn->prepare($query);

    // Only bind if parameters exist
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    echo "<style>
        table, th, td {
            border: 1px solid white;
            padding:20px;
        }
        #table{
            margin-left: 39px;
            border: 1px solid gray;
        }
        th{
            background-image: linear-gradient(319deg, #fce055 0%, #4B70F5 51%, #03AED2 100%);
            background-size: 150% 220%;
            color: white;
        }
        td{
            border: 1px solid #D3D3D3 ;
        }
        button{
            background: #0d6efd;
            border: transparent;
            height: 56px;
            width: 166px;
            border-radius: 35px;
            color: white;
            font-size: 16px;
        }
        </style>";
    echo "<center><table border='1'>
            <tr>
              <th>Name</th><th>Location</th><th>Cost</th><th>Season</th><th>Category</th><th>Rating</th><th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['average_cost']}</td>
                <td>{$row['best_season']}</td>
                <td>{$row['category']}</td>
                <td>{$row['rating']}</td>
                <td>
                  <form method='POST' action='myTrips.php'>
                    <input type='hidden' name='destination_id' value='{$row['destination_id']}'>
                    <input type='hidden' name='name' value='{$row['name']}'>
                    <input type='hidden' name='location' value='{$row['location']}'>
                    <input type='hidden' name='average_cost' value='{$row['average_cost']}'>
                    <button type='submit' name='addToYourTrips'>Add to Your Trips</button>
                  </form>
                </td>
              </tr>";
    }

    echo "</table></center>";
    $stmt->close();
    $conn->close();
}
?>

<?php foreach ($results as $row): ?>
<tr>
    <td><?= htmlspecialchars($row['name']) ?></td>
    <td><?= htmlspecialchars($row['location']) ?></td>
    <td><?= htmlspecialchars($row['description']) ?></td>
    <td><?= number_format($row['average_cost'], 2) ?></td>
    <td><?= htmlspecialchars($row['recommended_duration']) ?></td>
    <td><?= htmlspecialchars($row['best_season']) ?></td>
    <td><?= htmlspecialchars($row['category']) ?></td>
    <td><?= htmlspecialchars($row['recommended_for']) ?></td>
    <td><?= htmlspecialchars($row['rating']) ?></td>
    <td>
        <form action="myTrips.php" method="POST">
            <input type="hidden" name="destination_id" value="<?= $row['destination_id'] ?>">
            <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']) ?>">
            <input type="hidden" name="location" value="<?= htmlspecialchars($row['location']) ?>">
            <input type="hidden" name="average_cost" value="<?= $row['average_cost'] ?>">
            <input type="hidden" name="category" value="<?= htmlspecialchars($row['category']) ?>">
            <!-- Add other necessary hidden inputs -->
            <button type="submit">Add to Your Trips</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
