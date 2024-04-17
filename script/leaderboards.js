var leaderboardBtn = document.getElementById('leaderboard-btn');
leaderboardBtn.addEventListener('click', function() {
  var leaderboardContent = document.getElementById('leaderboard-content');
  if (leaderboardContent) {
    leaderboardContent.style.display = (leaderboardContent.style.display === 'none' || !leaderboardContent.style.display) ? 'block' : 'none';
  } else {
    console.error("Leaderboard content element not found.");
  }
});

var otherBtns = document.querySelectorAll('.sidebar-menu a:not(#leaderboard-btn)');
otherBtns.forEach(function(btn) {
  btn.addEventListener('click', function() {
    var leaderboardContent = document.getElementById('leaderboard-content');
    if (leaderboardContent) {
      leaderboardContent.style.display = 'none';
    } else {
      console.error("Leaderboard content element not found.");
    }
  });
});
