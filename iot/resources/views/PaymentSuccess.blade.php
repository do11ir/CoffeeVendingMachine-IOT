<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت موفق</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="tailwind.css">
    <style>
        body {
            overflow-x: hidden; /* Prevent horizontal scrolling */
        }
    </style>
</head>
<body class="bg-gray-900 text-white flex items-center h-[100%] justify-center w-[100%] min-h-screen overflow-y-hidden l">
    <div id="screenshotArea" class="rounded-lg p-6 h-[100%] w-96">
        <div class="w-[100%] flex justify-center h-[100%] items-baseline">
            <div class="lg:w-[380px]  mt-[-20px] lg:h-[170px] w-[300px] h-[150px] bgimage mx-auto"></div>
        </div>

        <div class="overflow-x-auto mt-[20px] lg:mt-[10px] bg-gray-800 rounded-lg p-4">
            <table class="w-full text-right text-[15px] text-gray-300">
                <thead class="bg-gray-700 text-gray-300 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2">نام</th>
                        <th class="px-4 py-2">تعداد</th>
                        <th class="px-4 py-2">قیمت کل</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->drinks as $drink)
                        <tr class="border-b border-gray-700">
                            <td class="px-4 py-2">{{ $drink->name }}</td>
                            <td class="px-4 py-2">{{ $drink->pivot->quantity }}</td>
                            <td class="px-4 py-2">{{ $drink->price * $drink->pivot->quantity }} تومان</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-700 text-gray-300 uppercase text-xs">
                    <tr>
                        <td class="px-4 py-2 font-bold">جمع کل</td>
                        <td class="px-4 py-2 font-bold">{{ $order->drinks->sum(function($drink) { return $drink->pivot->quantity; }) }}</td>
                        <td class="px-4 py-2 font-bold">{{ $order->drinks->sum(function($drink) { return $drink->price * $drink->pivot->quantity; }) }} تومان</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="border-t border-gray-700 my-4"></div>

        <div class="text-[18px] mb-4">
            <div class="flex justify-between border-b-[3px] border-dotted border-[#ffffffaf] mb-[10px] pb-[10px]">
                <span>زمان</span>
                <span>{{ \Carbon\Carbon::parse($order->created_at)->format('H:i l j F Y') }}</span>
            </div>
            <div class="flex justify-between border-b-[3px] border-dotted border-[#ffffffaf]  mb-[10px] pb-[10px]">
                <span>وضعیت</span>
                <span>{{ ucfirst($order->status) }}</span>
            </div>
            
            <div class="flex justify-between">
                <span>شناسه</span>
                <span>{{ $order->random_code }}</span>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <button id="downloadButton" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded flex items-center justify-center w-full border-2 border-blue-500 hover:border-blue-600 bg-opacity-30">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-6-9v10m-4-4l4 4m0 0l4-4" />
                </svg>
                ذخیره فاکتور
            </button>
            <button onclick="location.href='/'" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded w-full">
                بازگشت به خانه
            </button>
        </div>
        
    </div>

    <script>
        document.getElementById('downloadButton').addEventListener('click', function () {
            const screenshotArea = document.getElementById('screenshotArea');
            const buttons = screenshotArea.querySelectorAll('button');
    
            // Hide buttons before capturing the screenshot
            buttons.forEach(button => button.style.display = 'none');
    
            // Scroll to the top of the page to capture the full page
            window.scrollTo(0, 0);
    
            // Optional: Delay to allow the page to render fully
            setTimeout(() => {
                // Capture the screenshot of the entire body
                html2canvas(document.body, {
                    useCORS: true, // Enable CORS support for images
                    allowTaint: false, // Prevent tainting of the canvas by external resources
                    logging: true, // Optional: Show logging info for debugging
                }).then(canvas => {
                    // Show buttons back after capturing
                    buttons.forEach(button => button.style.display = '');
    
                    // Create download link for the screenshot
                    const link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = 'screenshot.png';
                    link.click();
                }).catch(error => {
                    // Handle errors
                    alert('Error capturing screenshot: ' + error.message);
                });
            }, 100); // Delay of 100ms to ensure page renders fully
        });
    </script>
</body>
</html>
