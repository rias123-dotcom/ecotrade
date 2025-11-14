<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EcoTrade Admin Dashboard</title>
    <style>
        /* ===== GENERAL STYLES (Lime Green Theme) ===== */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #ccffcc;
            /* LIME GREEN */
            overflow-y: auto;
            color: #333;
        }

        /* Color Variables */
        :root {
            --color-primary: #2e632e;
            --color-secondary: #55a555;
            --color-light-bg: #f7fff7;
            --color-white: #fff;
            --color-text: #444;
            --color-admin-bg: #f0f8ff;
            /* Light blue tint for Admin dashboard */
        }

        /* Header */
        header {
            background: var(--color-primary);
            color: var(--color-white);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        header h2 {
            margin: 0;
            font-size: 22px;
        }

        .header-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        /* Search */
        .search-container {
            display: flex;
            align-items: center;
            flex-grow: 1;
            max-width: 480px;
            margin: 0 15px;
        }

        .search-container input {
            padding: 10px;
            border: none;
            border-radius: 8px 0 0 8px;
            font-size: 14px;
            flex-grow: 1;
        }

        .search-container button {
            padding: 10px 15px;
            background: var(--color-secondary);
            color: var(--color-white);
            border: none;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
        }

        /* Buttons */
        .button-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--color-white);
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .button {
            background: var(--color-primary);
            color: var(--color-white);
            padding: 10px 18px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        /* --- START: SIDEBAR NAVIGATION STYLES --- */
        .sidebar {
            position: fixed;
            left: 0;
            top: 64px;
            /* Right below the header */
            bottom: 0;
            width: 250px;
            /* Width for the sidebar */
            padding: 18px 0;
            background: var(--color-white);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.06);
            overflow-y: auto;
            z-index: 20;
            border-right: 1px solid #e6f0e6;
        }

        .sidebar-nav a {
            display: block;
            /* Make links full width */
            padding: 10px 18px;
            /* Padding for menu items */
            text-decoration: none;
            color: var(--color-text);
            font-weight: 500;
            transition: background-color 0.2s;
            border-left: 3px solid transparent;
            /* For active indicator */
        }

        .sidebar-nav a:hover {
            background: var(--color-light-bg);
        }

        .sidebar-nav a.nav-active {
            color: var(--color-primary);
            font-weight: 700;
            background: var(--color-admin-bg);
            /* Highlight background */
            border-left: 3px solid var(--color-secondary);
            /* Active border */
        }

        /* Main content area shifted to the right */
        .main-content {
            margin-left: 270px;
            /* Sidebar width (250px) + gap (20px) */
            padding: 20px;
            background: var(--color-admin-bg);
        }

        /* --- END: SIDEBAR NAVIGATION STYLES --- */

        /* Card */
        .card {
            background: var(--color-white);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
        }

        /* Admin specific list/table styling */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .admin-table th,
        .admin-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .admin-table th {
            background-color: var(--color-light-bg);
            color: var(--color-primary);
            font-weight: bold;
        }

        .action-button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }

        .btn-approve {
            background: #28a745;
            color: white;
        }

        .btn-reject {
            background: #dc3545;
            color: white;
        }

        .btn-view {
            background: #007bff;
            color: white;
        }

        .btn-suspend {
            background: #ffc107;
            color: #333;
        }

        /* Dropdown styles retained */
        .profile-dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: var(--color-white);
            border-radius: 8px;
            padding: 0;
            min-width: 160px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        /* Use :focus-within on the parent div and :focus on the button for accessibility/tabbing */
        .profile-dropdown:hover .dropdown-content,
        .profile-dropdown button:focus+.dropdown-content,
        .profile-dropdown:focus-within .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            color: var(--color-text);
            font-size: 14px;
            transition: background-color 0.2s, color 0.2s;
        }

        .dropdown-content a:hover {
            background-color: var(--color-light-bg);
            color: var(--color-primary);
        }

        /* Responsive: sidebar collapse for small screens */
        @media (max-width: 980px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                border-right: none;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
                /* Re-add shadow for mobile nav bar */
                padding: 0;
                margin-bottom: 10px;
                top: auto;
            }

            .sidebar-nav {
                display: flex;
                /* Make links horizontal/scrollable on small screen */
                overflow-x: auto;
                white-space: nowrap;
                padding: 0;
                border-bottom: 1px solid #e6f0e6;
            }

            .sidebar-nav a {
                display: inline-block;
                border-left: none;
                border-bottom: 3px solid transparent;
                padding: 10px 15px;
                flex-shrink: 0;
            }

            .sidebar-nav a.nav-active {
                border-left: none;
                border-bottom: 3px solid var(--color-secondary);
                background: none;
            }

            .main-content {
                margin-left: 0;
                padding: 12px;
            }

            header {
                flex-wrap: wrap;
            }
        }

        /* Floating Create Button removed for Admin */
        .fab-create {
            display: none;
        }
    </style>
</head>

<body onload="openSection('admin-home')">

    <header>
        <h2><span style="color: yellow;">⭐</span> EcoTrade Admin Panel</h2>

        <div class="search-container">
            <input id="globalSearch" type="text" placeholder="Search accounts, transactions, or reports..." oninput="filterGlobal(this.value)" />
            <button onclick="filterGlobal(document.getElementById('globalSearch').value)">🔍</button>
        </div>

        <div class="header-controls">
            <button class="button-secondary" onclick="openSection('admin-notifications')">🔔</button>

            <div class="profile-dropdown">
                <button class="button-secondary" title="Admin Profile and Settings">👤</button>
                <div class="dropdown-content">
                    <a href="#" onclick="alert('Viewing Admin Profile')">Admin Profile</a>
                    <a href="#" onclick="alert('Logging out...')">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="sidebar" id="sidebarNav">
        <div class="sidebar-nav" id="main-nav">
            <a href="#" onclick="openSection('admin-home', this)" class="nav-active">Dashboard</a>
            <a href="#" onclick="openSection('admin-transactions', this)">Transactions/Disputes</a>
            <a href="#" onclick="openSection('admin-accounts', this)">Trader Accounts</a>
            <a href="#" onclick="openSection('admin-fraud', this)">Fraud Detection</a>
            <a href="#" onclick="openSection('admin-feedback', this)">Review Feedback</a>
            <a href="#" onclick="openSection('admin-reports', this)">Reports</a>
        </div>
    </div>
    <div class="main-content">
        <div class="container">

            <div id="admin-home" class="section active">
                <h2>Admin Dashboard Overview</h2>
                <div class="card">
                    <p>Welcome, Admin. Quick Stats:</p>
                    <div style="display: flex; gap: 20px;">
                        <div style="padding: 15px; border: 1px solid #ccc; border-radius: 8px; flex: 1;">
                            <strong>5</strong> Pending Trade Listings
                        </div>
                        <div style="padding: 15px; border: 1px solid #ccc; border-radius: 8px; flex: 1;">
                            <strong>2</strong> Active Disputes
                        </div>
                        <div style="padding: 15px; border: 1px solid #ccc; border-radius: 8px; flex: 1;">
                            <strong>10</strong> Fraud Alerts
                        </div>
                    </div>
                </div>
            </div>

            <div id="admin-transactions" class="section" style="display:none;">
                <h2>Transaction & Dispute Resolution</h2>
                <div class="card">
                    <p>Filter: <select>
                            <option>Disputes (2)</option>
                            <option>All Transactions</option>
                        </select></p>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Txn ID</th>
                                <th>Date</th>
                                <th>Traders</th>
                                <th>Status</th>
                                <th>Dispute?</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>901</td>
                                <td>2025-11-13</td>
                                <td>J. Cruz / A. Santos</td>
                                <td>Completed</td>
                                <td>No</td>
                                <td><button class="action-button btn-view">View</button></td>
                            </tr>
                            <tr>
                                <td>902</td>
                                <td>2025-11-14</td>
                                <td>S. Diaz / P. Lim</td>
                                <td>Ongoing</td>
                                <td>Yes</td>
                                <td><button class="action-button btn-view">Resolve Dispute</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="admin-accounts" class="section" style="display:none;">
                <h2>Trader Accounts Management</h2>
                <div class="card">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Credit Score</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        @foreach($tradersCount as $trader)
                        <tbody>
                            <tr>
                                <td>{{$trader->id}}</td>
                                <td>{{$trader-> firstName}} {{$trader->lastName}}</td>
                                <td>{{$trader->accountStatus}}</td>
                                <td>A+</td>
                                <td><button class="action-button btn-suspend">Suspend</button> <button class="action-button btn-view">View Profile</button></td>
                            </tr>
                        </tbody>
                        @endforeach

                    </table>
                </div>
            </div>

            <div id="admin-fraud" class="section" style="display:none;">
                <h2>Fraud Detection & Alerts</h2>
                <div class="card">
                    <p>Review Fraud Alerts (10):</p>
                    <ul style="padding-left: 20px;">
                        <li>**ALERT:** Multiple accounts linked to same IP (Trader ID 10, 11) - <button class="action-button btn-reject">Review/Flag</button></li>
                        <li>**LOG:** Unusual trade velocity (Trader ID 15) - <button class="action-button btn-view">View Log</button></li>
                    </ul>
                </div>
            </div>

            <div id="admin-feedback" class="section" style="display:none;">
                <h2>Review Trades Feedback</h2>
                <div class="card">
                    <p>Filter: <select>
                            <option>Flagged (1)</option>
                            <option>Recent</option>
                        </select></p>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Txn ID</th>
                                <th>Reviewer</th>
                                <th>Rating</th>
                                <th>Content</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>903</td>
                                <td>P. Lim</td>
                                <td>★★★☆☆</td>
                                <td>"Item was broken upon arrival. Disappointed."</td>
                                <td><button class="action-button btn-view">View Trade</button> <button class="action-button btn-reject">Flag Inappropriate</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="admin-reports" class="section" style="display:none;">
                <h2>Reports Generation</h2>
                <div class="card">
                    <p>Generate Report:</p>
                    <label for="reportType">Report Type:</label>
                    <select id="reportType" style="padding: 8px; margin-right: 10px;">
                        <option>Monthly Trader Activity</option>
                        <option>Trade Volume by Category</option>
                        <option>Credit Score Distribution</option>
                    </select>
                    <button class="button" onclick="alert('Generating Report...')">Generate & Export</button>
                </div>
            </div>

            <div id="admin-notifications" class="section" style="display:none;">
                <h2>Admin Notifications</h2>
                <div class="card">Notification List for Admin Actions (e.g., "New Dispute Filed," "Account Deletion Request")</div>
            </div>


        </div>
    </div>

    <div class="modal-overlay" id="modalOverlay" style="display:none;">
    </div>

    <script>
        /* ========================================================================================
   CORE JS FUNCTIONS
   ======================================================================================== */
        const $ = (s) => document.querySelector(s);

        /* Open different sections - handles both sidebar and section visibility */
        function openSection(id, element = null) {
            // 1. Hide all main content sections
            document.querySelectorAll('.section').forEach(sec => sec.style.display = 'none');

            // 2. Show the requested section
            const el = document.getElementById(id);
            if (el) el.style.display = 'block';

            // 3. Update active state on the sidebar navigation
            document.querySelectorAll('#main-nav a').forEach(a => a.classList.remove('nav-active'));

            // Find the clicked element or the corresponding nav link for the ID
            const navLink = element || document.querySelector(`#main-nav a[onclick*="'${id}'"]`);
            if (navLink) navLink.classList.add('nav-active');
        }

        /* Global filter (simple) */
        function filterGlobal(q) {
            q = q.trim().toLowerCase();
            alert(`Admin Search initiated for: "${q}" (In a full app, this would filter the current active admin list/table).`);
        }

        // Ensure the page loads into the Admin Dashboard view
        document.addEventListener('DOMContentLoaded', () => {
            openSection('admin-home');
        });
    </script>
</body>

</html>