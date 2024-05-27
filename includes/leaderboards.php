<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="leaderboards.css">
    <link rel="shortcut icon" type="x-icon" href="images/faks.png">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboards</title>
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo-container">
                <img src="wordwiselogo.png" alt="Logo">
                <h2>CIELOES</h2>
                <hr>
            </div>
            <ul>
                <li class="active"><a href="dashboard.html"><i class="fas fa-book"></i> Learn</a></li>
                <li><a href="#"><i class="fas fa-pen"></i> Practice</a></li>
                <li><a href="leaderboards.php" id="leaderboard-btn"><i class="fas fa-trophy"></i> Leaderboards</a></li>
                <li><a href="shop.html"><i class="fas fa-shopping-cart"></i> Shop</a></li>
                <li><a href="Profile.html"><i class="fas fa-user"></i> Profile</a></li>
            </ul> 
        </div>

        <div class="main_content">
            <main class="content" id="leaderboard-content">
                <h1>Leaderboard</h1>
                <section class="content__body">
                    <div class="table-container leaderboard-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>RANK</th>
                                    <th>USERNAME</th>
                                    <th>EXP</th>
                                    <th>REWARD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Database connection details
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "g2cieloes";  // Updated to the correct database name

                                // Create connection
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // SQL query to fetch leaderboard data
                                $sql = "SELECT rank, username, user_exp, reward FROM leaderboard ORDER BY rank ASC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["rank"] . "</td>";
                                        echo "<td>" . $row["username"] . "</td>";
                                        echo "<td>" . $row["user_exp"] . "</td>";
                                        echo "<td><img src='" . $row["reward"] . "' class='icon'></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No results found</td></tr>";
                                }
                                // Close the connection
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
            <div class="xp_hearts">
                <div class="xp">
                    <img src="exp.svg" alt="EXP">
                    <h2>1100</h2>
                </div>
                <div class="hearts">
                    <img src="hearts.svg" alt="Hearts">
                    <h2>3</h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
