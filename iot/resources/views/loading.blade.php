<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      body {
        margin: 0;
        height: 100vh; /* Make the body fill the viewport height */
        display: flex;
        justify-content: center;
        background: #040f1f;
        align-items: center;
      }
    </style>
  </head>
  <body>
    <div class="bg-black">
      <dotlottie-player
        src="https://lottie.host/4bf49ec2-ec87-41d9-93f8-5296eeffbee0/Zg51ahaZcg.lottie"
        background="transparent"
        speed="1"
        style="width: 150px; height: 150px" 
        loop
        autoplay
      ></dotlottie-player>
    </div>
    <script
      src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
      type="module"
    ></script>
  </body>
</html>
