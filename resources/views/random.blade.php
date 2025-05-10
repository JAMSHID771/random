<!DOCTYPE html>
<html lang="uz">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Real Baraban</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body {
      background: radial-gradient(circle at center, #3f3f3f, #1a1a1a);
      color: white;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .wheel-wrapper {
      position: relative;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      overflow: hidden;
      margin-bottom: 40px;
    }

    .baraban {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      overflow: hidden;
      position: relative;
    }

    .segment {
      position: absolute;
      width: 50%;
      height: 50%;
      background-color: red;
      transform-origin: 100% 100%;
      clip-path: polygon(100% 100%, 0% 100%, 100% 0%);
    }

    .segment:nth-child(odd) {
      background-color: #ffcc00;
    }

    .segment:nth-child(even) {
      background-color: #ff6666;
    }

    .segment:nth-child(3n) {
      background-color: #66ccff;
    }

    .segment:nth-child(4n) {
      background-color: #66ff66;
    }

    .spin-btn {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100px;
      height: 100px;
      background: white;
      border-radius: 50%;
      border: none;
      font-size: 20px;
      font-weight: bold;
      color: #333;
      cursor: pointer;
      z-index: 2;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
      transition: all 0.3s ease;
    }

    .spin-btn:hover {
      transform: translate(-50%, -50%) scale(1.1);
    }

    .result {
      font-size: 32px;
      padding: 10px 30px;
      background: rgba(255,255,255,0.1);
      border-radius: 10px;
      backdrop-filter: blur(5px);
      box-shadow: 0 0 10px rgba(255,255,255,0.2);
    }

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

  <div class="wheel-wrapper">
    <div id="baraban" class="baraban">
      @for ($i = 0; $i < 12; $i++)
        <div class="segment" style="transform: rotate({{ $i * 30 }}deg);"></div>
      @endfor
    </div>
    <button class="spin-btn" id="spinBtn">SPIN</button>
  </div>

  <div class="result" id="result">---</div>

  <script>
    const btn = document.getElementById('spinBtn');
    const result = document.getElementById('result');
    const baraban = document.getElementById('baraban');

    btn.addEventListener('click', () => {
      result.textContent = '...';

      const randomDegree = Math.floor(Math.random() * 360) + 3600;  // 10+ aylanish
      baraban.style.transition = 'transform 4s ease-out';
      baraban.style.transform = `rotate(${randomDegree}deg)`;

      // Natijani olish
      fetch('/generate-random-numbers')
        .then(res => res.json())
        .then(data => {
          setTimeout(() => {
            result.textContent = data.numbers;
          }, 4000);
        });
    });
  </script>

</body>
</html>
