<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vending Machine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="tailwind.css" />
    <style>
        /* Custom styles (same as before) */
        .yekanbold {
            font-family: "YekanBold", sans-serif;
            direction: rtl;
            unicode-bidi: embed;
            font-size: 1.7rem;
        }
        .yekanbold2 {
            font-family: "YekanBold", sans-serif;
            direction: rtl;
            unicode-bidi: embed;
            font-size: 1rem;
        }

        .blue-bar {
            width: 140px;
            height: 40px;
            background-color: #188ea0aa;
            border-radius: 15px 15px 0 0;
        }

        .proceed-btn {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #188ea0;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 1rem;
            font-family: 'YekanBold', sans-serif;
            display: none;
            z-index: 10;
        }
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #040f1f;
            z-index: 1000;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-[#07182F] flex items-center justify-center min-h-screen p-4">
    <!-- Loader -->
    <div id="loader" class="loader-wrapper">
        <dotlottie-player
            src="https://lottie.host/4bf49ec2-ec87-41d9-93f8-5296eeffbee0/Zg51ahaZcg.lottie"
            background="transparent"
            speed="1"
            style="width: 150px; height: 150px"
            loop
            autoplay
        ></dotlottie-player>
    </div>

    <button id="proceed-btn" class="proceed-btn" onclick="goToBuyBox()">ادامه به خرید</button>

    <!-- Page content that is initially hidden -->
    <div id="content" class="hidden w-full max-w-[90%] lg:w-[80%] mx-auto relative flex flex-col items-center">
        <div class="text-center w-[90%] mb-8">
            <h1 class="typewriter text-[#ACB9C9] yekanbold text-[25px] lg:text-3xl">
                بهترین نوشیدنی‌های گرم در دسترس شما
            </h1>
            <p class="fade-in text-[#ACB9C9] yekanbold2 mt-4">
                از بین محصولات خوشمزه ما انتخاب کنید و لذت ببرید.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 relative justify-center">
            @foreach ($drinks as $drink)
                <div class="card-container bg-gradient-to-r from-[#ffffff00] to-[#1c889616] w-[250px] h-[260px] rounded-[45px] flex flex-col items-center p-4 shadow-lg relative">
                    <div class="w-16 h-16 rounded-md flex items-center justify-center">
                        <img src="{{ asset('storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="w-15 h-15" />
                    </div>
                    <div class="text-center text-white mt-5 text-sm">
                        <p class="text-[#ACB9C9] mb-[15px] yekanbold">{{ $drink->name }}</p>
                        <hr class="border-t border-[#ACB9C9] w-[80px] mr-auto ml-auto my-2" />
                        <p class="yekanbold2">{{ number_format($drink->price) }} تومان</p>
                    </div>
                    <div class="blue-bar mt-[27px]"></div>
                    <div class="flex items-center justify-center mt-4">
                        <button class="bg-[#188ea0] hover:bg-[#145e6e] text-white px-3 py-2 rounded-lg text-sm yekanbold" onclick="updateDrinkCount('{{ $drink->id }}', -1)">−</button>
                        <span id="drink-count-{{ $drink->id }}" class="mx-3 text-[#ACB9C9] yekanbold2">0</span>
                        <button class="bg-[#188ea0] hover:bg-[#145e6e] text-white px-3 py-2 rounded-lg text-sm yekanbold" onclick="updateDrinkCount('{{ $drink->id }}', 1)">+</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const drinks = {};

        function updateDrinkCount(drinkId, change) {
            if (!drinks[drinkId]) drinks[drinkId] = 0;
            drinks[drinkId] = Math.max(0, drinks[drinkId] + change);

            // Update the display count
            document.getElementById(`drink-count-${drinkId}`).textContent = drinks[drinkId];

            // Show or hide the proceed button
            const totalDrinks = Object.values(drinks).reduce((sum, count) => sum + count, 0);
            const proceedBtn = document.getElementById('proceed-btn');
            proceedBtn.style.display = totalDrinks > 0 ? 'block' : 'none';
        }

        function goToBuyBox() {
            // Serialize the drinks object to a query string
            const queryString = Object.entries(drinks)
                .filter(([id, count]) => count > 0)
                .map(([id, count]) => `drink_${id}=${count}`)
                .join('&');

            // Redirect to the buy box page with the selected drinks as query parameters
            window.location.href = `{{ route('buybox') }}?${queryString}`;
        }

        // Hide loader and show content after the page has fully loaded
        window.addEventListener("load", () => {
            document.getElementById("loader").classList.add("hidden");
            document.getElementById("content").classList.remove("hidden");
        });
    </script>
</body>
</html>
