<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="images/faks.png">
    <link rel="stylesheet" href="css profile/profilestyle.css">
    <link rel="stylesheet" href="css/homepage.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Profile</title>
</head>
<body>

<?php
session_start();
require 'includes/dbh.inc.php';

if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if not logged in
    header("Location: mainlogin.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="wrapper">
    <div class="sidebar">
        <div class="logo-container">
            <img src="images/wordwiselogo.png" alt="Logo">
            <h2>CIELOES</h2>
            <hr>
        </div>
        <ul>
            <li class="active"><a href="dashboard.html"><i class="fas fa-book"></i> Learn</a></li>
            <li><a href="Practice.html"><i class="fas fa-pen"></i> Practice</a></li>
            <li><a href="leaderboards.html" id="leaderboard-btn"><i class="fas fa-trophy"></i> Leaderboards</a></li>
            <li><a href="shop.html"><i class="fas fa-shopping-cart"></i> Shop</a></li>
            <li><a href="Profile.html"><i class="fas fa-user"></i> Profile</a></li>
        </ul> 
    </div>

    <div class="main_content">
        <div class="profilemain">
            <div class="avatardv">
                <button class="editbtn" onclick="toggleAvatarForm()">edit</button>
                <div class="selected-avatar" id="selectedAvatar">
                    <img src="images/avatarboy1.png" alt="Selected Avatar">
                </div>
            </div>

            <div class="rank">
                <div class="rkdv">
                    <p id="ctr">Current Rank</p>
                </div>
            </div>
            <h2 id="name"><?php echo htmlspecialchars($user['username']); ?></h2>
            <p id="datejoin">joined date</p>

            <div class="xp_hearts1">
                <div class="xp1">
                    <img src="images/icons/exp.svg">
                    <h2>1100</h2>
                </div>
                <div class="hearts1">
                    <img src="images/icons/hearts.svg">
                    <h2>3</h2>
                </div>
            </div>

            <h2 id="statistics">Statistics</h2>
            <div class="daystreak">
                <div class="streak-sts">
                    <p id="tsp">Total Streak</p>
                </div>
                <p id="tspdb">get from database</p>
            </div>

            <div class="account">
                <h2 id="acct">Account</h2>
                <div class="lbusername"><label id="usernameLabel">Username</label></div>
                <div class="lbname"><label id="nameLabel">Email</label></div>

                <form action="includes/userupdate.inc.php" method="post" onsubmit="return confirmSaveChanges()">

                    <input type="text" name="username" id="p-username" value="<?php echo htmlspecialchars($user['username']); ?>" oninput="checkChanges()">
                    <input type="email" name="email" id="p-email" value="<?php echo htmlspecialchars($user['email']); ?>" oninput="checkChanges()">
                    <button id="savebtn" disabled>Save</button>
                </form>
                
                <form action="logout.php" method="post"> 
                    <button id="logoutbtn">Log out</button>
                </form>
            </div>
        
            <div class="modal-overlay" id="modalOverlay"> 
                <div class="modal-content">
                    <h2>Select Avatar</h2>
                    <form id="avatarForm" onsubmit="return updateAvatar()">
                        <div id="avatarOptions">
                            <img src="images/avatarboy1.png" alt="Fox" class="avatar-option selected" onclick="selectOption(this)">
                            <img src="images/avatarboy2.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatarboy3.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatarboy4.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatarboy5.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatargirl1.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatargirl2.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatargirl3.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatargirl4.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <img src="images/avatargirl5.png" alt="CAIEL" class="avatar-option" onclick="selectOption(this)">
                            <button id="closebtn" type="submit">close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const originalUsername = "<?php echo htmlspecialchars($user['username']); ?>";
const originalEmail = "<?php echo htmlspecialchars($user['email']); ?>";

function checkChanges() {
    const usernameInput = document.getElementById('p-username').value;
    const emailInput = document.getElementById('p-email').value;
    const saveButton = document.getElementById('savebtn');

    if (usernameInput !== originalUsername || emailInput !== originalEmail) {
        saveButton.disabled = false;
        saveButton.style.cursor = 'pointer';
    } else {
        saveButton.disabled = true;
        saveButton.style.cursor = 'not-allowed';
    }
}


function confirmSaveChanges() {
    return confirm('Do you really want to save the changes?');
}

function toggleAvatarForm() {
    var modal = document.getElementById('modalOverlay');
    if (modal.style.display === 'none' || modal.style.display === '') {
        modal.style.display = 'flex'; // Show the modal overlay
    } else {
        modal.style.display = 'none'; // Hide the modal overlay
    }
}

// Retrieve the selected avatar URL from local storage
var selectedAvatarUrl = localStorage.getItem('selectedAvatarUrl');

// Set the initial avatar image
if (selectedAvatarUrl) {
    document.getElementById('selectedAvatar').innerHTML = '<img src="' + selectedAvatarUrl + '" alt="Selected Avatar">';
}

var selectedOption = document.querySelector('.avatar-option.selected');

function selectOption(option) {
    if (selectedOption) {
        selectedOption.classList.remove('selected');
    }
    selectedOption = option;
    selectedOption.classList.add('selected');
    updateSelectedAvatar(); // Update the selected avatar when an option is clicked
}

function updateSelectedAvatar() {
    var selectedAvatar = document.getElementById('selectedAvatar');
    var selectedImageUrl = selectedOption.src;
    selectedAvatar.innerHTML = '<img src="' + selectedImageUrl + '" alt="Selected Avatar">';
}

function updateAvatar() {
    if (!selectedOption) {
        alert('Please select an avatar.');
        return false;
    }
    updateSelectedAvatar(); // Update the selected avatar when form is submitted
    hideAvatarForm(); // Hide the modal after updating avatar
    return false; // Prevent form submission
}

function hideAvatarForm() {
    var modal = document.getElementById('modalOverlay');
    modal.style.display = 'none'; // Hide the modal overlay
}

document.addEventListener('DOMContentLoaded', function() {
    var lis = document.querySelectorAll('.wrapper .sidebar ul li');
    lis.forEach(function(li) {
        li.addEvent
        li.addEventListener('click', function() {
            lis.forEach(function(item) {
                item.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});

window.addEventListener('scroll', function() {
    var container1 = document.querySelector('.text_container');
    var container2 = document.querySelector('.text_container_2');
    var rect1 = container1.getBoundingClientRect();
    var rect2 = container2.getBoundingClientRect();
    if (rect2.top < 0) {
        container2.style.position = 'sticky';
        container2.style.top = '15px';
    } else {
        container2.style.position = 'relative';
    }
});
</script>
</body>
</html>
