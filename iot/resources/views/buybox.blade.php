<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>سبد خرید</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="tailwind.css">
    <style>
        .draggable-bar {
            cursor: pointer;
            height: 10px;
            background-color: #188ea0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .draggable-bar:hover {
            background-color: #145e6e;
        }

        .payment-option {
            border: 2px solid #0a4750;
            padding: 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: border-color 0.3s;
            margin: 10px;
            text-align: center;
        }

        .payment-option.selected {
            border-color: #26b9da;
        }

        .payment-option:hover {
            border-color: #26b9da;
        }

        .payment-option-text {
            font-size: 18px;
            color: white;
        }

        .payment-container {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .payment-container div {
            flex: 1;
        }
    </style>
</head>
<body class="bg-[#07182F] flex flex-col items-center min-h-screen p-4">
    <h1 class="text-white text-lg mb-4">سبد خرید شما</h1>
    <div id="order-list" class="w-full max-w-md bg-[#1e293b] p-4 rounded-lg text-white"></div>

    <div id="total-price" class="text-white text-xl mt-4">مجموع: 0 تومان</div>

    <button class="bg-[#188ea0] hover:bg-[#145e6e] text-white px-3 py-1 rounded-lg " onclick="openModalCustomizations()">مشاهده جزییات سفارش</button>

    <!-- Payment Method Options -->
    <h2 class="text-white fixed bottom-[250px] text-[20px] lg:text-[25px]">روش پرداخت خود را انتخاب کنید</h2>

    <div class="payment-container w-full max-w-md mt-4 mb-4 fixed bottom-[100px]">
        <div class="payment-option" id="gateway-option" onclick="selectPaymentMethod('gateway')">
            <div class="payment-option-text">پرداخت از طریق درگاه</div>
        </div>
        <div class="payment-option" id="pos-option" onclick="selectPaymentMethod('pos')">
            <div class="payment-option-text">پرداخت از طریق کارتخوان</div>
        </div>
    </div>

    <!-- Customization Display -->
    <div id="modal-customizations" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" onclick="closeOnOutsideClick(event)">
        <div id="customizations" class="bg-[#1e293b] p-6 rounded-lg w-full max-w-md" onclick="event.stopPropagation()">
            <div class="payment-option-text mb-3">تغییراتی ایجاد نکردید</div>
            <button class="w-full bg-red-500 text-white py-2 rounded-lg" onclick="closeModalCustomizations()">بستن</button>

        </div>
    </div>
    
    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" onclick="closeOnOutsideClick(event)">
        <div class="bg-[#1e293b] p-6 rounded-lg w-full max-w-md" onclick="event.stopPropagation()">
            <h2 id="modal-title" class="text-white text-lg mb-4">شخصی‌سازی</h2>
            <div class="mb-4">
                <label class="block text-white mb-2">میزان شیر</label>
                <div class="relative bg-gray-700 h-3 rounded-full">
                    <div id="milk-bar" class="bg-[#188ea0] h-3 rounded-full" style="width: 0%;"></div>
                </div>
                <div class="flex justify-between mt-2">
                    <button id="milk-minus" class="px-3 py-1 bg-[#188ea0] text-white rounded-lg" onclick="adjustLevel('milk', -1)">−</button>
                    <button id="milk-plus" class="px-3 py-1 bg-[#188ea0] text-white rounded-lg" onclick="adjustLevel('milk', 1)">+</button>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2">میزان کافئین</label>
                <div class="relative bg-gray-700 h-3 rounded-full">
                    <div id="caffeine-bar" class="bg-[#188ea0] h-3 rounded-full" style="width: 0%;"></div>
                </div>
                <div class="flex justify-between mt-2">
                    <button id="caffeine-minus" class="px-3 py-1 bg-[#188ea0] text-white rounded-lg" onclick="adjustLevel('caffeine', -1)">−</button>
                    <button id="caffeine-plus" class="px-3 py-1 bg-[#188ea0] text-white rounded-lg" onclick="adjustLevel('caffeine', 1)">+</button>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-white mb-2">میزان شکر</label>
                <div class="relative bg-gray-700 h-3 rounded-full">
                    <div id="sugar-bar" class="bg-[#188ea0] h-3 rounded-full" style="width: 0%;"></div>
                </div>
                <div class="flex justify-between mt-2">
                    <button id="sugar-minus" class="px-3 py-1 bg-[#188ea0] text-white rounded-lg" onclick="adjustLevel('sugar', -1)">−</button>
                    <button id="sugar-plus" class="px-3 py-1 bg-[#188ea0] text-white rounded-lg" onclick="adjustLevel('sugar', 1)">+</button>
                </div>
            </div>
            <button class="w-full bg-red-500 text-white py-2 rounded-lg" onclick="closeModal()">بستن</button>
        </div>
    </div>

    <!-- Button to Prefactor Page -->
    <button class="fixed bottom-3 ml-auto mr-auto bg-[#188ea0] hover:bg-[#145e6e] text-white px-4 py-2 rounded-lg" onclick="goToPrefactorPage()"> تایید و پرداخت </button>

    <script>
        let selectedPaymentMethod = 'gateway'; // Default to 'gateway'

        // Set default selected payment method when the page loads
        document.addEventListener('DOMContentLoaded', () => {
            selectPaymentMethod('gateway');
        });

        // Use the `$drinks` data passed from the backend (converted to JSON)
        const drinks = @json($drinks); // Laravel's Blade directive to pass PHP array to JS

        // Get URL parameters for selected drinks and their quantities
        const urlParams = new URLSearchParams(window.location.search);
        const orders = {};

        // Parse the URL parameters (e.g., drink_7=2 means 2 macchiatos)
        urlParams.forEach((value, key) => {
            if (key.startsWith('drink_')) {
                const drinkId = key.split('_')[1];
                const quantity = parseInt(value, 10);
                const drink = drinks.find(d => d.id == drinkId);
                if (drink) {
                    orders[drinkId] = { quantity, drink }; // Store drink object with quantity
                }
            }
        });

        // Render the order list dynamically based on the orders
        function renderOrderList() {
            const orderList = document.getElementById('order-list');
            orderList.innerHTML = Object.values(orders)
                .map(order => {
                    const { drink, quantity } = order;
                    return `
                        <div class="flex justify-between items-center border-b border-gray-600 py-2">
                            <p>${drink.name}</p>
                            <p>${quantity} عدد</p>
                            <p>${calculatePrice(drink.id, quantity)} تومان</p>
                            <button class="bg-[#188ea0] hover:bg-[#145e6e] text-white px-3 py-1 rounded-lg" onclick="customizeDrink(${drink.id})">شخصی‌سازی</button>
                        </div>
                    `;
                }).join('');
            updateTotalPrice();
        }

        // Example of customization level (milk, caffeine, sugar) initialization
        const levels = {
            milk: 0,
            caffeine: 0,
            sugar: 0,
        };

        function adjustLevel(type, change) {
            levels[type] = Math.min(3, Math.max(0, levels[type] + change));
            updateBar(type);
            updateCustomization();
        }

        function updateBar(type) {
            const bar = document.getElementById(`${type}-bar`);
            const minusButton = document.getElementById(`${type}-minus`);
            const plusButton = document.getElementById(`${type}-plus`);

            bar.style.width = `${(levels[type] / 3) * 100}%`;

            minusButton.disabled = levels[type] === 0;
            minusButton.classList.toggle("opacity-50", levels[type] === 0);

            plusButton.disabled = levels[type] === 3;
            plusButton.classList.toggle("opacity-50", levels[type] === 3);
        }

        function calculatePrice(drinkId, count) {
            const drink = drinks.find(d => d.id == drinkId);
            let price = drink.price * count;
            price += levels.milk * 1000; // Each level of milk adds 1000 Toman
            price += levels.caffeine * 1500; // Each level of caffeine adds 1500 Toman
            price += levels.sugar * 500; // Each level of sugar adds 500 Toman
            return price;
        }

        function updateTotalPrice() {
            let total = 0;
            for (let drinkId in orders) {
                total += calculatePrice(drinkId, orders[drinkId].quantity);
            }
            document.getElementById('total-price').textContent = `مجموع: ${total} تومان`;
        }

        function updateCustomization() {
            const customizations = document.getElementById('customizations');
            customizations.innerHTML = Object.values(orders).map(order => {
                const { drink, quantity } = order;
                return ` 
                    <div class="border-b border-gray-600 py-2">
                        <p class="text-white">شخصی‌سازی ${drink.name}: </p>
                        <p class="text-white">شیر: ${levels.milk}, کافئین: ${levels.caffeine}, شکر: ${levels.sugar}</p>
                    </div>
                `;
            }).join('') + `
                <button class="w-full bg-red-500 text-white py-2 rounded-lg" onclick="closeModalCustomizations()">بستن</button>
            `;
        }

        function closeModal() {
            const modal = document.getElementById("modal");
            modal.classList.add("hidden");
        }

        function openModal() {
            const modal = document.getElementById("modal");
            modal.classList.remove("hidden");
        }

        function closeModalCustomizations() {
            const modal = document.getElementById("modal-customizations");
            modal.classList.add("hidden");
        }

        function openModalCustomizations() {
            const modal = document.getElementById("modal-customizations");
            modal.classList.remove("hidden");
        }

        function closeOnOutsideClick(event) {
            if (!event.target.closest(".bg-[#1e293b]")) {
                closeModal();
            }
        }

        function customizeDrink(drinkId) {
            const modalTitle = document.getElementById("modal-title");
            modalTitle.textContent = `شخصی‌سازی ${drinks.find(d => d.id == drinkId).name}`;
            openModal();
        }

        function selectPaymentMethod(method) {
            selectedPaymentMethod = method;
            document.getElementById("gateway-option").classList.remove("selected");
            document.getElementById("pos-option").classList.remove("selected");
            if (method === 'gateway') {
                document.getElementById("gateway-option").classList.add("selected");
            } else if (method === 'pos') {
                document.getElementById("pos-option").classList.add("selected");
            }
        }

        function goToPrefactorPage() {
            console.log("Button clicked, function executed!");

            const orderData = {
                drinks: Object.values(orders).map(order => ({
                    drink_id: order.drink.id,
                    quantity: order.quantity,
                })),
                payment_method: selectedPaymentMethod,
            };

            // Create a form element dynamically
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/order/submit';  // Submit to the appropriate route

            // Add CSRF token
            const csrfTokenInput = document.createElement('input');
            csrfTokenInput.type = 'hidden';
            csrfTokenInput.name = '_token';
            csrfTokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfTokenInput);

            // Add the order data as hidden inputs
            const drinksInput = document.createElement('input');
            drinksInput.type = 'hidden';
            drinksInput.name = 'drinks';
            drinksInput.value = JSON.stringify(orderData.drinks); 
            form.appendChild(drinksInput);

            const paymentMethodInput = document.createElement('input');
            paymentMethodInput.type = 'hidden';
            paymentMethodInput.name = 'payment_method';
            paymentMethodInput.value = orderData.payment_method;
            form.appendChild(paymentMethodInput);

            // Append and submit the form
            document.body.appendChild(form);
            form.submit();  // This triggers the backend process
        }



        // Initial render
        renderOrderList();
    </script>
</body>
</html>
