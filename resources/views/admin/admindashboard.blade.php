<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | EcoTrade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100 text-gray-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-green-600">
            EcoTrade Admin
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('admin.traders') }}" class="flex items-center p-2 rounded hover:bg-green-600">
                🧑‍💼 <span class="ml-2">Trader Accounts</span>
            </a>
            <a href="{{ route('admin.transactions') }}" class="flex items-center p-2 rounded hover:bg-green-600">
                💱 <span class="ml-2">Transactions</span>
            </a>
            <a href="{{ route('admin.notifications') }}" class="flex items-center p-2 rounded hover:bg-green-600">
                🔔 <span class="ml-2">Notifications</span>
            </a>
            <a href="{{ route('admin.fraud') }}" class="flex items-center p-2 rounded hover:bg-green-600">
                🕵️ <span class="ml-2">Fraud Detection</span>
            </a>
            <a href="{{ route('admin.reports') }}" class="flex items-center p-2 rounded hover:bg-green-600">
                📋 <span class="ml-2">Manage Reports</span>
            </a>
        </nav>
        <div class="p-4 border-t border-green-600">
            <a href="{{ route('logout') }}" class="flex items-center p-2 rounded hover:bg-green-600">
                🚪 <span class="ml-2">Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <h1 class="text-3xl font-semibold mb-6">Dashboard Overview</h1>

        <!-- Example dashboard cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-bold">Total Traders</h2>
                <p class="text-3xl mt-2 font-semibold text-green-700">1,245</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-bold">Transactions</h2>
                <p class="text-3xl mt-2 font-semibold text-green-700">3,540</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-bold">Pending Reports</h2>
                <p class="text-3xl mt-2 font-semibold text-green-700">17</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-bold">Fraud Alerts</h2>
                <p class="text-3xl mt-2 font-semibold text-red-600">3</p>
            </div>
        </div>

        <!-- Placeholder table area -->
        <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
            <table class="min-w-full border border-gray-200">
                <thead>
                    <tr class="bg-green-50">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Trader Name</th>
                        <th class="px-4 py-2 border">Activity</th>
                        <th class="px-4 py-2 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">1</td>
                        <td class="border px-4 py-2">Flora D.</td>
                        <td class="border px-4 py-2">Completed a trade</td>
                        <td class="border px-4 py-2">2025-10-24</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">2</td>
                        <td class="border px-4 py-2">Juan C.</td>
                        <td class="border px-4 py-2">Flagged for review</td>
                        <td class="border px-4 py-2">2025-10-24</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
