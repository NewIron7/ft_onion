<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ft_onion Project 🧅</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
  }
  .header {
    background-color: #117a8b; /* Dark Cyan */
    color: #fff;
    padding: 20px;
    text-align: center;
  }
  .main {
    padding: 20px;
  }
  .main h2 {
    color: #333;
  }
  .content {
    background-color: #fff;
    padding: 20px;
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  }
  .tor-explanation {
    background-color: #d1ecf1; /* Light Blue */
    color: #0c5460; /* Dark Blue */
    padding: 20px;
    margin-top: 20px;
    border-left: 10px solid #117a8b; /* Dark Cyan */
  }
  #gameCanvas {
    border: 1px solid #000;
    display: block;
    margin: 50px auto;
    background-color: #fff;
    position: relative;
  }
  #score {
    text-align: center;
    font-size: 24px;
    margin-top: 20px;
  }
  #gameOver {
    display: none;
    font-size: 30px;
    color: red;
    text-align: center;
  }
</style>
</head>
<body>

<div class="header">
  <img src="logo42Tor.webp" alt="ft_onion Project Logo" style="max-width:100px; height:auto;">
  <h1>ft_onion Project 🧅</h1>
</div>

<div class="main">
  <h2>Welcome to the ft_onion Project 🚀</h2>
  <div class="content">
    <p>This project is an introduction to publishing a website on the Tor network 🕸️, providing an extra layer of privacy and security for both the site's publishers and its visitors. By navigating through the ft_onion curriculum, students learn about the fundamentals of web development, the principles of anonymity online, and the technical steps required to deploy a site on Tor.</p>
    <p>The goal of ft_onion is to equip learners with the knowledge and skills needed to utilize the Tor network for secure and private web publishing, emphasizing the importance of internet freedom and the right to privacy. 🔒</p>
  </div>
  <div class="tor-explanation">
    <h2>How Does Tor Work? 🧐</h2>
    <p>Tor, short for The Onion Router, helps in anonymizing internet activity. It routes your internet traffic through a worldwide network of thousands of relays. Each relay adds a layer of encryption 🛡️, similar to layers of an onion, before passing your data to the next relay. This process obscures your location, usage from surveillance, and traffic analysis, making it difficult for anyone to trace your internet activity back to you.</p>
    <p>Using Tor, users can access websites with privacy, without revealing their real IP address, and publishers can host sites anonymously. Tor is crucial for those advocating for privacy, freedom of expression, and resisting censorship. 🗣️✊</p>
  </div>

  <?php
    $dogApiUrl = "https://dog.ceo/api/breeds/image/random";
    $dogData = file_get_contents($dogApiUrl);
    $dogArray = json_decode($dogData, true);

    if ($dogArray && isset($dogArray['message'])) {
        $dogImageUrl = $dogArray['message'];
    } else {
        $error = "Unable to fetch dog image.";
    }
    ?>

  <div class="content">
    <h2>Bonus: Dog Game 🎮</h2>
    <p>As a bonus, here’s a fun, simple game inspired by the offline Chrome dinosaur game but using a random dog image. Use the spacebar to jump and avoid the obstacles!</p>

    <div id="score">Score: 0</div>
    <canvas id="gameCanvas" width="1200" height="400"></canvas>
    <div id="gameOver">Game Over! Press Space to Restart</div>

    <script>
      let canvas = document.getElementById('gameCanvas');
      let ctx = canvas.getContext('2d');

      // Load dog image
      let dinoImage = new Image();
      dinoImage.src = '<?php echo isset($dogImageUrl) ? $dogImageUrl : ""; ?>';

      let dino = {
          x: 50,
          y: canvas.height - 120,
          width: 80,
          height: 80,
          jumpSpeed: 10,
          gravity: 0.4,
          velocity: 0,
          jump: false,
          onGround: true,
      };

      let obstacle = {
          x: canvas.width,
          y: canvas.height - 80,
          width: 50,
          height: 30,
          speed: 6,
      };

      let score = 0;
      let gameOver = false;

      function resetGame() {
          obstacle.x = canvas.width;
          score = 0;
          dino.y = canvas.height - 120;
          dino.velocity = 0;
          gameOver = false;
          document.getElementById('gameOver').style.display = 'none';
      }

      function drawDino() {
          ctx.drawImage(dinoImage, dino.x, dino.y, dino.width, dino.height);
      }

      function drawObstacle() {
          ctx.fillStyle = '#f00';
          ctx.fillRect(obstacle.x, obstacle.y, obstacle.width, obstacle.height);
      }

      function handleJump() {
          if (dino.jump && dino.onGround) {
              dino.velocity = -dino.jumpSpeed;
              dino.onGround = false;
          }
      }

      function update() {
          if (!gameOver) {
              ctx.clearRect(0, 0, canvas.width, canvas.height);

              handleJump();
              if (!dino.onGround) {
                  dino.velocity += dino.gravity;
                  dino.y += dino.velocity;

                  if (dino.y >= canvas.height - 120) {
                      dino.y = canvas.height - 120;
                      dino.onGround = true;
                      dino.velocity = 0;
                  }
              }

              obstacle.x -= obstacle.speed;

              if (obstacle.x + obstacle.width < 0) {
                  obstacle.x = canvas.width;
                  score++;
                  document.getElementById('score').textContent = 'Score: ' + score;
              }

              if (dino.x < obstacle.x + obstacle.width &&
                  dino.x + dino.width > obstacle.x &&
                  dino.y < obstacle.y + obstacle.height &&
                  dino.height + dino.y > obstacle.y) {
                  gameOver = true;
                  document.getElementById('gameOver').style.display = 'block';
              }

              drawDino();
              drawObstacle();
          }

          requestAnimationFrame(update);
      }

      document.addEventListener('keydown', (e) => {
          if (e.code === 'Space') {
              dino.jump = true;
          }

          if (gameOver && e.code === 'Space') {
              resetGame();
          }
      });

      document.addEventListener('keyup', (e) => {
          if (e.code === 'Space') {
              dino.jump = false;
          }
      });

      dinoImage.onload = function() {
          update();
      };
    </script>
  </div>
</div>

</body>
</html>
