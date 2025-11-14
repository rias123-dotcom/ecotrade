<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trader Dashboard | EcoTrade</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100 text-gray-800">

  <!-- Sidebar -->
  <aside class="w-64 bg-green-700 text-white flex flex-col">
    <div class="p-6 text-2xl font-bold border-b border-green-600">
      EcoTrade
    </div>
    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('trader.dashboard') }}" class="flex items-center p-2 rounded hover:bg-green-600">
        🏠 <span class="ml-2">Dashboard</span>
      </a>

      <a href="{{ route('trader.items') }}" class="flex items-center p-2 rounded hover:bg-green-600">
        🛒 <span class="ml-2">My Traded Items</span>
      </a>

      <a href="{{ route('trader.skills') }}" class="flex items-center p-2 rounded hover:bg-green-600">
        🧠 <span class="ml-2">My Skills</span>
      </a>

      <a href="{{ route('trader.services') }}" class="flex items-center p-2 rounded hover:bg-green-600">
        🧰 <span class="ml-2">My Services</span>
      </a>

      <a href="{{ route('trader.transactions') }}" class="flex items-center p-2 rounded hover:bg-green-600">
        💱 <span class="ml-2">Transactions</span>
      </a>

      <a href="{{ route('trader.notifications') }}" class="flex items-center p-2 rounded hover:bg-green-600">
        🔔 <span class="ml-2">Notifications</span>
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
    <h1 class="text-3xl font-semibold mb-6">Welcome, {{ Auth::user()->name ?? 'Trader' }}!</h1>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold">My Items</h2>
        <p class="text-3xl mt-2 font-semibold text-green-700">12</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold">My Skills</h2>
        <p class="text-3xl mt-2 font-semibold text-green-700">5</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold">My Services</h2>
        <p class="text-3xl mt-2 font-semibold text-green-700">3</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold">Pending Trades</h2>
        <p class="text-3xl mt-2 font-semibold text-yellow-600">2</p>
      </div>
    </div>

    <!-- My Items Table -->
    <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">My Traded Items</h2>
        <a href="{{ route('trader.items.add') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-600">+ Add Item</a>
      </div>
      <table class="min-w-full border border-gray-200">
        <thead>
          <tr class="bg-green-50">
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Item Name</th>
            <th class="px-4 py-2 border">Category</th>
            <th class="px-4 py-2 border">Status</th>
            <th class="px-4 py-2 border">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border px-4 py-2">1</td>
            <td class="border px-4 py-2">Electric Fan</td>
            <td class="border px-4 py-2">Appliances</td>
            <td class="border px-4 py-2 text-green-600">Available</td>
            <td class="border px-4 py-2 space-x-2">
              <button class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-500">Edit</button>
              <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500">Delete</button>
            </td>
          </tr>
          <tr>
            <td class="border px-4 py-2">2</td>
            <td class="border px-4 py-2">Old Books</td>
            <td class="border px-4 py-2">Education</td>
            <td class="border px-4 py-2 text-yellow-600">Traded</td>
            <td class="border px-4 py-2 space-x-2">
              <button class="bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-500">Edit</button>
              <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-500">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
