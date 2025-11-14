<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>EcoTrade Dashboard</title>
<style>
/* ===== GENERAL STYLES (Lime Green Theme) ===== */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #ccffcc; /* LIME GREEN */
    overflow-y: auto;
    color: #333;
}

/* Color Variables */
:root{
    --color-primary: #2e632e;
    --color-secondary: #55a555;
    --color-light-bg: #f7fff7;
    --color-white: #fff;
    --color-text: #444;
    --color-star-gold: #ffc107;
    --color-action-edit: #ff9800;
    --color-action-trade: #007bff;
    --color-ai-match: #4CAF50;
    --color-ai-match-low: #ff5722;
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
header h2 { margin: 0; font-size: 22px; }
.header-controls { display:flex; align-items:center; gap:8px; flex-shrink: 0; }

/* Search */
.search-container {
    display:flex; align-items:center; flex-grow:1; max-width:480px; margin: 0 15px;
}
.search-container input {
    padding:10px; border:none; border-radius:8px 0 0 8px; font-size:14px; flex-grow:1;
}
.search-container button {
    padding:10px 15px; background:var(--color-secondary); color:var(--color-white);
    border:none; border-radius:0 8px 8px 0; cursor:pointer;
}

/* Buttons */
.button-secondary {
    background: rgba(255,255,255,0.1); color:var(--color-white);
    padding:8px 10px; border-radius:8px; border:1px solid rgba(255,255,255,0.2); cursor:pointer;
}
.button {
    background: var(--color-primary); color:var(--color-white);
    padding:10px 18px; border-radius:8px; border:none; cursor:pointer; font-weight:bold;
}
.button-close { /* New style for the 'x' button */
    background: transparent;
    border: none;
    color: var(--color-text); /* Use text color for visibility */
    font-size: 24px;
    font-weight: 300;
    line-height: 1;
    cursor: pointer;
    padding: 0;
    margin-left: 10px;
    opacity: 0.7;
    transition: opacity 0.2s;
}
.button-close:hover {
    opacity: 1;
    color: #dc3545;
}

/* Nav */
nav {
    background: var(--color-white);
    display:flex; justify-content:center; gap:28px; padding:12px; font-size:16px;
    box-shadow:0 2px 5px rgba(0,0,0,0.08);
    position: sticky; top:64px; z-index: 30;
}
nav a { text-decoration:none; color:var(--color-primary); padding-bottom:4px; }
nav a.nav-active { color:var(--color-secondary); font-weight:700; }

/* Layout: Left Panel + Main */
.left-panel {
    position: fixed;
    left: 0;
    top: 120px; /* below header and nav */
    bottom: 0;
    width: 340px;
    padding: 18px;
    background: linear-gradient(180deg, var(--color-white), var(--color-light-bg));
    box-shadow: 2px 0 8px rgba(0,0,0,0.06);
    overflow-y: auto;
    z-index: 20;
    border-right: 1px solid #e6f0e6;
}
.left-panel h3 { margin-top: 0; color: var(--color-primary); }

/* Left Panel Form specific update */
#leftMatchForm input {
    width: 95%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
#leftMatchForm label {
    display: block;
    margin-top: 10px;
}

/* Main content area */
.main-content {
    margin-left: 360px; /* allow for left-panel + gap */
    padding: 20px;
}

/* Card */
.card {
    background: var(--color-white);
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.04);
}

/* Trade Listing */
.trade-box {
    border: 1px solid #c8e4c8;
    padding: 15px;
    border-radius: 10px;
    background: var(--color-light-bg);
    margin-bottom: 15px;
}
.trade-box-header {
    display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;
    border-bottom:1px dashed #e6efe6; padding-bottom:8px;
}
.trader-info { display:flex; align-items:center; gap:8px; color:var(--color-primary); font-weight:700; }
.trade-listing-content { display:flex; gap:15px; align-items:flex-start; margin-top:8px; }
.trade-listing-img { width:100px; height:100px; object-fit:cover; border-radius:8px; border:2px solid #ccc; }

/* Details grid */
.trade-details-grid {
    display:grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap:8px; font-size:14px;
}
.detail-item strong { display:block; color:#000; margin-bottom:3px; }
.trade-box-actions { margin-top:12px; display:flex; gap:10px; flex-wrap:wrap; }

/* AI Score */
.ai-score { padding:6px 10px; border-radius:6px; font-weight:700; font-size:14px; display:inline-block; color:#fff; }
.ai-score-high { background: var(--color-ai-match); }
.ai-score-low { background: var(--color-ai-match-low); }

/* Status tag */
.status-tag { padding:6px 10px; border-radius:6px; font-size:12px; font-weight:700; text-transform:uppercase; }
.status-active { background:#d4edda; color:#155724; }
.status-ongoing { background:#cce5ff; color:#004085; }
.status-completed { background:#d1ecf1; color:#0c5460; }
.status-pending-admin { background:#fff3cd; color:#856404; }

/* Modal (Floating Create Post) */
.modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.35); display:none; align-items:center; justify-content:center;
    z-index: 60;
}
.modal {
    background: var(--color-white); width: 720px; max-width: 95%; border-radius: 12px; padding: 18px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}
.modal-header { display:flex; justify-content:space-between; align-items:center; gap:10px; }
.modal-body { margin-top:12px; }

/* Modal Form styling tweaks for better alignment */
.modal-body label {
    display: block;
    margin-top: 8px;
    margin-bottom: 4px;
    font-weight: bold;
    color: var(--color-text);
    font-size: 14px;
}
.modal-body input[type="text"], 
.modal-body input[type="number"], 
.modal-body select, 
.modal-body textarea {
    width: 95%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box; /* Crucial for width: 95% to work correctly */
    font-size: 14px;
}
.modal-body textarea {
    resize: vertical;
}


/* Image preview */
#imagePreview { width: 120px; height: 120px; object-fit:cover; border:1px dashed #ccc; border-radius:8px; }

/* Floating Create Button on Home */
.fab-create {
    position: fixed; right: 22px; bottom: 22px; z-index: 55;
    background: var(--color-secondary); color: #fff; border-radius: 12px; padding: 12px 16px; cursor:pointer; box-shadow: 0 8px 18px rgba(0,0,0,0.18);
    font-weight: bold;
}

/* Responsive: collapse left-panel for small screens */
@media (max-width: 980px) {
    .left-panel { display: none; }
    .main-content { margin-left: 0; padding: 12px; }
    header { flex-wrap:wrap; }
    nav { position: static; top: auto; }
    .fab-create { right: 12px; bottom: 12px; }
}

/* Misc small tweaks */
.profile-dropdown { position:relative; }
.dropdown-content { 
    display:none; 
    position:absolute; 
    right:0; 
    top:100%; 
    background:var(--color-white); 
    border-radius:8px; 
    padding:0; /* Removed padding:8px 0 here */
    min-width:160px; 
    box-shadow: 0 8px 18px rgba(0,0,0,0.12);
    overflow: hidden; /* Added to keep children contained within border-radius */
}
.profile-dropdown:hover .dropdown-content,
.profile-dropdown:focus-within .dropdown-content { display:block; } /* Added focus-within for better accessibility */

.dropdown-content a {
    display: block; /* Make links take up full width */
    padding: 8px 15px; /* Added padding to create menu items */
    text-decoration: none;
    color: var(--color-text); /* Set text color */
    font-size: 14px;
    transition: background-color 0.2s, color 0.2s;
}

.dropdown-content a:hover {
    background-color: var(--color-light-bg); /* Highlight on hover */
    color: var(--color-primary); /* Change text color on hover */
}
/* Scrollbars (subtle) */
.left-panel::-webkit-scrollbar, .main-content::-webkit-scrollbar { width: 8px; }
.left-panel::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.08); border-radius:4px; }
</style>
</head>
<body onload="readTradeListings('home')">

<header>
    <h2>EcoTrade</h2>

    <div class="search-container">
        <input id="globalSearch" type="text" placeholder="Search for items, services, or skills..." oninput="filterGlobal(this.value)" />
        <button onclick="filterGlobal(document.getElementById('globalSearch').value)">🔍</button>
    </div>

    <div class="header-controls">
        <button class="button-secondary" onclick="openSection('messages')">💬</button>
        <button class="button-secondary" onclick="openSection('transactions')">📈</button>
        <button class="button-secondary" onclick="openSection('notifications')">🔔</button>

        <div class="profile-dropdown">
            <button class="button-secondary">👤</button>
            <div class="dropdown-content">
                <a href="#" onclick="openSection('profile', this)">Profile</a>
                <a href="#" onclick="openSection('yourtrades', this)">Your Trades</a>
                <a href="<?php echo e(route('logout')); ?>" onclick="alert('Logging out...')">Logout</a>
            </div>
        </div>
    </div>
</header>

<nav id="main-nav">
  <a href="#" onclick="openSection('home', this)" class="nav-active">HOME</a>
  <a href="#" onclick="openSection('items', this)">ITEMS</a>
  <a href="#" onclick="openSection('service', this)">SERVICE</a>
  <a href="#" onclick="openSection('skills', this)">SKILLS</a>
  </nav>

<div class="left-panel" id="leftPanel">
    <h3>🤖 AI Trade Match Finder</h3>
    <p style="margin-top:4px; color:#666;">Describe what you offer and what you want. AI will recommend matches and show a match quality score.</p>

    <div style="margin-top:12px;">
        <form id="leftMatchForm" onsubmit="searchTradeMatchesFromPanel(event)">
            <label for="leftOffer"><strong>You Offer:</strong></label>
            <input id="leftOffer" type="text" placeholder="e.g., 5 kg organic bananas, 3 hours web design" required />

            <label for="leftSeeking"><strong>You Seek:</strong></label>
            <input id="leftSeeking" type="text" placeholder="e.g., used printer, basic carpentry service" required />

            <div style="display:flex; gap:8px; margin-top:8px;">
                <button class="button" type="submit" style="flex:1; background:var(--color-ai-match);">Search Match</button>
                <button type="button" class="button-secondary" onclick="clearMatchPanel()" style="background:var(--color-primary);">Clear</button>
            </div>
        </form>
    </div>

    <hr style="margin:14px 0; border:none; border-top:1px dashed #e6efe6;" />

    <div id="leftMatchResults" style="margin-top:14px;">
        <p style="color:#888; font-size:14px;">No searches yet. Enter your offer & seeking and click "Search Match".</p>
    </div>

    <div style="font-size:13px; color:#666; margin-top:14px;">
        <strong>Tip:</strong> Use short keywords, commas separate items (e.g., "soap, scarf, web design").
    </div>
</div>

<div class="main-content">
  <div class="container">

    <div id="home" class="section active">
      <h2>Welcome Back, <strong><?php echo e($user->firstName); ?> <?php echo e($user->lastName); ?></strong>!</h2>

      <div style="display:flex; justify-content:space-between; align-items:center; margin-top:12px;">
        <div>
            <h3 style="margin:0; color:var(--color-primary);">Trades in Lapu-Lapu City</h3>
            <p style="color:#666; margin:4px 0 0 0;">View recent trades posted by other members in your city.</p>
        </div>
        <div></div>
      </div>

      <div id="homeTradeListings" style="margin-top:18px;"></div>
    </div>

    <div id="tradematch" class="section" style="display:none;">
        <h2>🤖 AI Trade Match Finder</h2>
        <div class="card">
            <p>This full-page view displays the results from the left-side Trade Match panel. Use the panel on the left to input your offer and seeking criteria.</p>
        </div>
        <div id="matchResultsLarge"></div>
    </div>

    <div id="yourtrades" class="section" style="display:none;">
        <h2>👤 Your Trades Dashboard</h2>
        <div class="card">
            <div style="display:flex; gap:18px; align-items:center;">
                <img src="https://via.placeholder.com/70" alt="avatar" style="border-radius:8px;">
                <div>
                    <h3 style="margin:0;">Juan Dela Cruz</h3>
                    <div style="color:#666;">juan.delacruz@example.com • +63 917 123 4567</div>
                </div>
            </div>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 15px;">
            <h3 style="margin:0; color: var(--color-primary);">YOUR ACTIVE LISTINGS</h3>
            <button class="button" style="background:var(--color-secondary);" onclick="alert('Viewing posts pending admin approval...')">Pending Approvals</button>
        </div>

        <div id="userTradeListings"></div>
    </div>

    <div id="items" class="section" style="display:none;">
        <h2>Items for Trade in Lapu-Lapu City</h2>
        <div style="margin-top:20px;" id="itemTradeListings"></div>
    </div>

    <div id="service" class="section" style="display:none;">
        <h2>Services for Trade in Lapu-Lapu City</h2>
        <div style="margin-top:20px;" id="serviceTradeListings"></div>
    </div>

    <div id="skills" class="section" style="display:none;">
        <h2>Skills for Trade in Lapu-Lapu City</h2>
        <div style="margin-top:20px;" id="skillsTradeListings"></div>
    </div>

    <div id="messages" class="section" style="display:none;">
        <h2>Messages</h2>
        <div class="card">Chat UI Placeholder</div>
    </div>

    <div id="transactions" class="section" style="display:none;">
        <h2>Transactions</h2>
        <div class="card">Ongoing & Completed Trades Here</div>
    </div>

    <div id="notifications" class="section" style="display:none;">
        <h2>Notifications</h2>
        <div class="card">Notification List</div>
    </div>

    <div id="profile" class="section" style="display:none;">
        <h2>Profile</h2>
        <div class="card">Your profile summary. Approved trades are listed here.</div>
    </div>

  </div>
</div>

<button class="fab-create" onclick="openCreatePostModal()">➕ Create Post</button>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal" role="dialog" aria-modal="true">
        <div class="modal-header">
            <h3 id="modalTitle">Create Trade Post</h3>
            <div>
                <button class="button-close" onclick="closeCreatePostModal()" aria-label="Close Modal">×</button>
            </div>
        </div>
        <div class="modal-body">
            <form id="tradePostForm" onsubmit="createOrUpdateTradePost(event)">
                <input type="hidden" id="editingId" value="" />
                
                <div style="display:flex; gap:12px; align-items:flex-start;">
                    
                    <div style="flex:1;">
                        <label for="postTitle">Title:</label>
                        <input type="text" id="postTitle" required placeholder="e.g., Hand-Knitted Scarf" />

                        <label for="postDescription">Description:</label>
                        <textarea id="postDescription" required style="height:90px; width:98%;" placeholder="Describe the item, service, or skill in detail."></textarea>
                        
                        <div style="display:flex; gap:10px; margin-top: 10px;">
                            <div style="flex:1;">
                                <label for="tradeCategory">Category:</label>
                                <select id="tradeCategory" required onchange="toggleImageUpload(this.value)" style="width:100%;">
                                    <option value="Item">Item</option>
                                    <option value="Service">Service</option>
                                    <option value="Skill">Skill</option>
                                </select>
                            </div>

                            <div style="flex:1;">
                                <label for="tradeQuantity">Quantity:</label>
                                <input type="text" id="tradeQuantity" placeholder="e.g., 1, 5 kg, 2 hours" style="width:95%;" />
                            </div>
                        </div>

                        <label for="tradeSeeking" style="margin-top: 10px;">Trade Seeking (What you want):</label>
                        <input type="text" id="tradeSeeking" required placeholder="e.g., 1kg organic corn, basic carpentry service" />

                        <label for="tradeValue" style="margin-top: 10px;">Estimated Value (Eco-Units):</label>
                        <input type="number" id="tradeValue" required min="0" value="100" style="width:98%;" />

                        <div style="margin-top:15px;">
                            <button class="button" type="submit" id="modalSubmitBtn" style="background: var(--color-secondary);">Submit</button>
                            <button type="button" class="button-secondary" onclick="closeCreatePostModal()" style="margin-left:8px;">Cancel</button>
                        </div>
                    </div>

                    <div style="width:170px; flex-shrink: 0;">
                        <label>Upload Image:<br/><small id="imageMandatory" style="color:red;">(Required for Item)</small></label>
                        <input type="file" id="postImage" accept="image/*" onchange="handleImageUpload(event)" />
                        <input type="hidden" id="imageUrl" value="https://via.placeholder.com/100x100?text=Item+Image" />
                        <div style="margin-top:8px;">
                            <img id="imagePreview" src="https://via.placeholder.com/120x120?text=Preview" alt="preview">
                        </div>
                        <div style="margin-top:10px; font-size:12px; color:#666;">Note: Images are stored locally for demo. In real app, upload to server or cloud.</div>
                    </div>
                </div>
                <div id="postMessage" class="card" style="display:none; margin-top:12px; background:#d4edda; border:1px solid #c3e6cb; color:#155724;">Post submitted successfully!</div>
            </form>
        </div>
    </div>
</div>

<script>
/* ========================================================================================
   CORE CRUD DATA SIMULATION (keeps existing structure but extended for modal editing)
   ======================================================================================== */
let tradesData = [
    { id: 101, title: 'Handmade Soap', category: 'Item', seeking: 'Herbal Teas', quantity: '5 bars', value: 150, trader: 'Juan Dela Cruz', traderId: 1, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-13', status: 'Active', imageUrl: 'https://via.placeholder.com/100x100?text=Soap+Image', isUserPost: true, offers: 5 },
    { id: 102, title: 'Web Design Service', category: 'Service', seeking: 'Handmade Soaps', quantity: '1 project', value: 500, trader: 'Juan Dela Cruz', traderId: 1, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-01', status: 'Ongoing', imageUrl: '', isUserPost: true, offers: 0, currentPartner: 'Jane Doe' },
    { id: 103, title: 'Basic Carpentry Skill', category: 'Skill', seeking: 'Gardening Service', quantity: '2 hours', value: 300, trader: 'Juan Dela Cruz', traderId: 1, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-10-20', status: 'Completed', imageUrl: '', isUserPost: true, offers: 0, review: { rating: '★★★★★', text: 'Excellent carpentry work! Very professional and timely. Highly recommended trader.' } },
    { id: 104, title: 'Resume/CV Writing Service', category: 'Service', seeking: 'Fresh Produce', quantity: '1 CV', value: 200, trader: 'Juan Dela Cruz', traderId: 1, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-12', status: 'Active', imageUrl: '', isUserPost: true, offers: 2 },

    { id: 201, title: 'Organic Compost', category: 'Item', seeking: '2 Plant Pots', quantity: '10 kg', value: 250, trader: 'Ana Marie Santos', traderId: 2, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-13', status: 'Active', imageUrl: 'https://via.placeholder.com/100x100?text=Compost+Image', isUserPost: false },
    { id: 202, title: 'Hand-Knitted Scarf', category: 'Item', seeking: 'Craft Supplies', quantity: '1 scarf', value: 250, trader: 'Ana Marie Santos', traderId: 2, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-14', status: 'Active', imageUrl: 'https://via.placeholder.com/100x100?text=Scarf+Image', isUserPost: false },
    { id: 301, title: 'Basic Electrical Service', category: 'Service', seeking: 'Used Furniture', quantity: '1 hour', value: 400, trader: 'Pedro E. Lim', traderId: 3, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-10', status: 'Active', imageUrl: '', isUserPost: false },
    { id: 302, title: 'Appliance Repair', category: 'Service', seeking: 'Old Electronics', quantity: '1 repair', value: 300, trader: 'Pedro E. Lim', traderId: 3, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-11', status: 'Active', imageUrl: '', isUserPost: false },
    { id: 401, title: 'HTML/CSS Tutoring', category: 'Skill', seeking: 'Handmade Soaps / Produce', quantity: '1 hour', value: 200, trader: 'Maria C. Delos Reyes', traderId: 4, avatar: 'https://via.placeholder.com/50', location: 'Lapu-Lapu City', posted: '2025-11-09', status: 'Active', imageUrl: '', isUserPost: false },
];

/* Utility: simple DOM selector */
const $ = (s) => document.querySelector(s);

/* Open different sections */
function openSection(id, element=null) {
    document.querySelectorAll('.section').forEach(sec => sec.style.display = 'none');
    const el = document.getElementById(id);
    if (el) el.style.display = 'block';

    document.querySelectorAll('#main-nav a').forEach(a => a.classList.remove('nav-active'));
    const navLink = element || document.querySelector(`#main-nav a[onclick*="'${id}'"]`);
    if (navLink) navLink.classList.add('nav-active');

    // Re-render lists when viewing sections
    if (['home','yourtrades','items','service','skills'].includes(id)) {
        readTradeListings(id);
    }

    // If user opens the tradematch page, show larger results area so we copy left panel results
    if (id === 'tradematch') {
        const leftHtml = document.getElementById('leftMatchResults').innerHTML;
        document.getElementById('matchResultsLarge').innerHTML = leftHtml;
    }
}

/* Focus trade match left panel - kept for consistency even if nav link is removed */
function focusTradeMatch() {
    // show tradematch section (for mobile) and scroll / focus left panel (desktop)
    openSection('tradematch');
    // copy left panel content to large view
    const leftHtml = document.getElementById('leftMatchResults').innerHTML;
    document.getElementById('matchResultsLarge').innerHTML = leftHtml;
    // Scroll to left panel if visible
    const left = document.getElementById('leftPanel');
    if (left) left.scrollIntoView({behavior:'smooth', block:'start'});
}

/* Global filter (simple) */
function filterGlobal(q) {
    q = q.trim().toLowerCase();
    if (!q) {
        readTradeListings('home');
        return;
    }
    // filter tradesData and render to home
    const filtered = tradesData.filter(t => {
        return t.title.toLowerCase().includes(q) || (t.seeking && t.seeking.toLowerCase().includes(q)) || (t.trader && t.trader.toLowerCase().includes(q));
    });
    renderTradesToContainer(filtered, 'homeTradeListings', true);
}

/* Toggle image upload required */
function toggleImageUpload(category) {
    const mandatory = $('#imageMandatory');
    const quantityDiv = $('#tradeQuantity');
    if (category === 'Item') {
        mandatory.style.display = 'inline';
        // Removed required attribute, as the logic checks it in createOrUpdateTradePost
        // quantityDiv.required = true; 
    } else {
        mandatory.style.display = 'none';
        // quantityDiv.required = false;
    }
}

/* ===== CREATE / UPDATE (modal) ===== */
function openCreatePostModal(prefill=null) {
    // prefill optionally
    $('#modalOverlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    $('#postMessage').style.display = 'none';
    $('#modalTitle').innerText = prefill ? 'Update Trade Post' : 'Create Trade Post';
    // Changed button text
    $('#modalSubmitBtn').innerText = prefill ? 'Update Post' : 'Submit';
    if (prefill) {
        $('#editingId').value = prefill.id;
        $('#postTitle').value = prefill.title || '';
        // Description is not present in all data objects, use title as fallback if description not saved.
        // Assuming description is stored when created, but for existing objects it's title.
        const desc = prefill.description || tradesData.find(t => t.id === prefill.id).description || prefill.title || '';
        $('#postDescription').value = desc; 
        $('#tradeCategory').value = prefill.category || 'Item';
        $('#tradeQuantity').value = prefill.quantity || '';
        $('#tradeSeeking').value = prefill.seeking || '';
        $('#tradeValue').value = prefill.value || 0;
        $('#imageUrl').value = prefill.imageUrl || '';
        $('#imagePreview').src = prefill.imageUrl || 'https://via.placeholder.com/120x120?text=Preview';
        toggleImageUpload($('#tradeCategory').value);
    } else {
        $('#editingId').value = '';
        document.getElementById('tradePostForm').reset();
        // Reset image/url to default
        $('#imageUrl').value = 'https://via.placeholder.com/100x100?text=Item+Image';
        $('#imagePreview').src = 'https://via.placeholder.com/120x120?text=Preview';
        // Reset category to Item and trigger toggle
        $('#tradeCategory').value = 'Item';
        toggleImageUpload('Item'); 
    }
}

function closeCreatePostModal() {
    $('#modalOverlay').style.display = 'none';
    document.body.style.overflow = '';
    // clear editingId on close
    $('#editingId').value = '';
    document.getElementById('tradePostForm').reset();
}

/* Handle image upload (convert to base64 for demo) */
function handleImageUpload(e) {
    const file = e.target.files[0];
    if (!file) {
        // Reset to placeholder if no file selected
        $('#imageUrl').value = 'https://via.placeholder.com/100x100?text=Item+Image';
        $('#imagePreview').src = 'https://via.placeholder.com/120x120?text=Preview';
        return;
    }
    const reader = new FileReader();
    reader.onload = function(evt) {
        $('#imageUrl').value = evt.target.result;
        $('#imagePreview').src = evt.target.result;
    };
    reader.readAsDataURL(file);
}

/* Create or Update trade post from modal */
function createOrUpdateTradePost(evt) {
    evt.preventDefault();
    const editingId = $('#editingId').value;
    const title = $('#postTitle').value.trim();
    const description = $('#postDescription').value.trim();
    const category = $('#tradeCategory').value;
    const quantity = $('#tradeQuantity').value.trim();
    const seeking = $('#tradeSeeking').value.trim();
    const value = Number($('#tradeValue').value) || 0;
    const imageUrl = $('#imageUrl').value || '';

    if (category === 'Item' && imageUrl.includes('placeholder')) {
        alert('Image is required for Item category. Please upload an image.');
        return;
    }

    if (editingId) {
        // Update existing
        const id = Number(editingId);
        const idx = tradesData.findIndex(t => t.id === id);
        if (idx !== -1) {
            tradesData[idx].title = title;
            tradesData[idx].description = description;
            tradesData[idx].category = category;
            tradesData[idx].quantity = quantity;
            tradesData[idx].seeking = seeking;
            tradesData[idx].value = value;
            tradesData[idx].imageUrl = imageUrl;
            
            alert('Trade updated successfully.');
            closeCreatePostModal();
            readTradeListings('yourtrades');
            // Navigate to Your Trades Dashboard
            openSection('yourtrades'); 
            return;
        } else {
            alert('Unable to find the trade to update.');
            return;
        }
    }

    // Create new (Immediately Active, as per request)
    const newTrade = {
        id: Date.now(),
        title,
        description, // Added description to new object
        category,
        seeking,
        quantity,
        value,
        trader: 'Juan Dela Cruz',
        traderId: 1,
        avatar: 'https://via.placeholder.com/50',
        location: 'Lapu-Lapu City',
        posted: new Date().toISOString().slice(0,10),
        status: 'Active', // Status changed from 'Pending Admin' to 'Active'
        imageUrl,
        isUserPost: true,
        offers: 0
    };
    tradesData.push(newTrade);
    // Show success message briefly
    $('#postMessage').style.display = 'block';
    
    // --- CONFIRMATION AND NAVIGATION FIX ---
    setTimeout(() => {
        closeCreatePostModal();
        // ** Navigate to Your Trades Dashboard after creation **
        openSection('yourtrades'); 
    }, 700);
    // ---------------------------------------
}

/* Delete a trade post */
function deleteTradePost(id) {
    if (!confirm(`Are you sure you want to delete/cancel Trade ID: ${id}?`)) return;
    tradesData = tradesData.filter(t => t.id !== id);
    alert(`Trade ID: ${id} deleted successfully.`);
    readTradeListings('yourtrades');
}

/* Update trade post - open modal prefilled for editing */
function updateTradePost(id, action='edit') {
    const trade = tradesData.find(t => t.id === id);
    if (!trade) { alert('Trade not found.'); return; }
    // Only allow edit if owner
    if (trade.traderId !== 1) {
        alert('You can only edit your own posts.');
        return;
    }
    openCreatePostModal(trade);
}

/* Update trade status */
function updateTradeStatus(id, newStatus) {
    const idx = tradesData.findIndex(t => t.id === id);
    if (idx === -1) return;
    tradesData[idx].status = newStatus;
    alert(`Trade ${id} status updated to: ${newStatus}`);
    readTradeListings('yourtrades');
}

/* ========================================================================================
   READ (Render lists)
   ======================================================================================== */
function readTradeListings(targetSection='home') {
    // Determine containers
    const homeList = document.getElementById('homeTradeListings');
    const userList = document.getElementById('userTradeListings');
    const itemList = document.getElementById('itemTradeListings');
    const serviceList = document.getElementById('serviceTradeListings');
    const skillsList = document.getElementById('skillsTradeListings');

    // Clear
    if (homeList) homeList.innerHTML = '';
    if (userList) userList.innerHTML = '';
    if (itemList) itemList.innerHTML = '';
    if (serviceList) serviceList.innerHTML = '';
    if (skillsList) skillsList.innerHTML = '';

    tradesData.forEach(trade => {
        // Build HTML for each trade
        const statusClass = `status-${trade.status.toLowerCase().replace(/\s/g,'-')}`;
        const statusText = trade.status;

        const tradeBox = document.createElement('div');
        tradeBox.className = 'trade-box';

        let headerHtml = `<div class="trade-box-header">
            <div class="trader-info">
                ${trade.isUserPost ? `Trade Title: <strong>${escapeHtml(trade.title)}</strong>` : `<img src="${trade.avatar}" alt="Trader Avatar" style="width:35px;height:35px;border-radius:50%;"> ${escapeHtml(trade.trader)}`}
            </div>
            <span class="status-tag ${statusClass}">${statusText}</span>
        </div>`;

        const imagePart = trade.imageUrl && !trade.imageUrl.includes('placeholder') ? `<img class="trade-listing-img" src="${trade.imageUrl}" alt="${escapeHtml(trade.title)}">` : '';

        const detailsHtml = `
            <div class="trade-listing-content">
                ${imagePart}
                <div class="trade-listing-details" style="flex:1;">
                    <h4 style="margin:0; color:var(--color-primary);">${escapeHtml(trade.title)} (${trade.category})</h4>
                    <div class="trade-details-grid" style="margin-top:8px;">
                        <div class="detail-item"><strong>Category:</strong> <span>${escapeHtml(trade.category)}</span></div>
                        <div class="detail-item"><strong>Location:</strong> <span>${escapeHtml(trade.location)}</span></div>
                        <div class="detail-item"><strong>Seeking:</strong> <span>${escapeHtml(trade.seeking)}</span></div>
                        <div class="detail-item"><strong>Quantity:</strong> <span>${escapeHtml(trade.quantity)}</span></div>
                        <div class="detail-item"><strong>Posted:</strong> <span>${escapeHtml(trade.posted)}</span></div>
                    </div>
                    <div class="trade-box-actions">`;

        // Actions varies by ownership and status
        let actionsHtml = '';
        if (trade.isUserPost && trade.status === 'Active') {
            actionsHtml += `<button class="button" style="background:var(--color-action-edit);" onclick="updateTradePost(${trade.id}, 'edit')">Edit</button>`;
            actionsHtml += `<button class="button" style="background:var(--color-action-trade);" onclick="alert('Viewing offers for ${trade.id} (demo)')">Trade Offers (${trade.offers})</button>`;
            actionsHtml += `<button class="button" style="background:#dc3545;" onclick="deleteTradePost(${trade.id})">Delete</button>`;
        } else if (trade.isUserPost && trade.status === 'Ongoing') {
            actionsHtml += `<small style="margin-right:8px;">Currently trading with: <strong>${escapeHtml(trade.currentPartner||'—')}</strong></small>`;
            actionsHtml += `<button class="button" style="background:#28a745;" onclick="updateTradeStatus(${trade.id}, 'Completed')">Complete Trade</button>`;
        } else if (trade.isUserPost && trade.status === 'Pending Admin') {
            actionsHtml += `<button class="button" style="background:#dc3545;" onclick="deleteTradePost(${trade.id})">Cancel Post</button>`;
        } else if (!trade.isUserPost && trade.status === 'Active') {
            actionsHtml += `<button class="button" style="background:var(--color-action-trade);" onclick="initiateTrade(${trade.id})">Trade</button>`;
        } else {
            actionsHtml += `<span style="color:#666;">No actions available</span>`;
        }

        actionsHtml += `</div>`; // close actions div

        // Reviews or feedback area
        let reviewHtml = '';
        if (trade.status === 'Completed' && trade.review) {
            reviewHtml = `<div class="review-section" style="margin-top:12px;">
                <h4 style="margin-bottom:0;">Feedback</h4>
                <div class="review-box">
                    <div class="review-header">
                        <span class="star-rating">${trade.review.rating}</span>
                        <small>Received on: ${trade.posted}</small>
                    </div>
                    <p class="review-text">"${escapeHtml(trade.review.text)}"</p>
                </div>
            </div>`;
        } else if (trade.status === 'Completed' && trade.isUserPost) {
            reviewHtml = `<div class="review-section" style="margin-top:12px;">
                <div class="review-box" style="background:#ffe0e0;color:#884444;">
                    <p class="review-text" style="font-style:italic;margin:0;">Trade completed, but no feedback has been submitted by the partner.</p>
                </div>
            </div>`;
        }

        tradeBox.innerHTML = headerHtml + detailsHtml + actionsHtml + reviewHtml + `</div></div>`;
        // Append to appropriate container(s)
        if (trade.isUserPost && userList) {
            userList.appendChild(tradeBox.cloneNode(true));
        }
        if (!trade.isUserPost && trade.status === 'Active' && homeList) {
            homeList.appendChild(tradeBox.cloneNode(true));
        }
        // Category specific
        if (!trade.isUserPost) {
            if (trade.category === 'Item' && itemList) itemList.appendChild(tradeBox.cloneNode(true));
            if (trade.category === 'Service' && serviceList) serviceList.appendChild(tradeBox.cloneNode(true));
            if (trade.category === 'Skill' && skillsList) skillsList.appendChild(tradeBox.cloneNode(true));
        }
    });
}

/* Utility to render a filtered list to specific container (used by search) */
function renderTradesToContainer(list, containerId, replaceAll=false) {
    const container = document.getElementById(containerId);
    if (!container) return;
    container.innerHTML = '';
    if (list.length === 0) {
        container.innerHTML = '<div class="card"><p style="color:#666;">No trades found.</p></div>';
        return;
    }
    list.forEach(trade => {
        const div = document.createElement('div');
        div.className = 'trade-box';
        div.innerHTML = `<div class="trade-box-header">
            <div class="trader-info">${trade.isUserPost ? `<strong>${escapeHtml(trade.title)}</strong>` : `<img src="${trade.avatar}" alt="avatar" style="width:35px;height:35px;border-radius:50%;"> ${escapeHtml(trade.trader)}`}</div>
            <span class="status-tag status-${trade.status.toLowerCase().replace(/\s/g,'-')}">${trade.status}</span>
        </div>
        <div class="trade-listing-content">
            ${trade.imageUrl ? `<img class="trade-listing-img" src="${trade.imageUrl}" alt="${escapeHtml(trade.title)}">` : ''}
            <div class="trade-listing-details" style="flex:1;">
                <h4 style="margin:0; color:var(--color-primary);">${escapeHtml(trade.title)} (${trade.category})</h4>
                <p style="margin:6px 0;">${escapeHtml(trade.seeking)}</p>
            </div>
        </div>`;
        container.appendChild(div);
    });
}

/* Helper: sanitize text for HTML injection safety in this demo */
function escapeHtml(str) {
    if (!str && str !== 0) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/"/g, '&quot;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}

/* ========================================================================================
   TRADE INITIATION (demo)
   ======================================================================================== */
function initiateTrade(tradeId) {
    const t = tradesData.find(x => x.id === tradeId);
    if (!t) return;
    if (t.traderId === 1) { alert('This is your own post.'); return; }
    // Simulate making an offer
    if (confirm(`Send trade offer to ${t.trader} for "${t.title}"?`)) {
        // find target and increase offers
        t.offers = (t.offers || 0) + 1;
        alert('Offer sent (demo). The trader will review and respond.');
        readTradeListings('home');
    }
}

/* ========================================================================================
   AI MATCHING (Simulated) - left panel uses this
   ======================================================================================== */
async function performMatchSearchRender(offer, seeking, containerId) {
    const resultsDiv = document.getElementById(containerId);

    if (!offer || !seeking) {
        resultsDiv.innerHTML = '<p style="color:red;">Please enter both your offer and what you are seeking.</p>';
        return;
    }

    resultsDiv.innerHTML = '<p>Searching matches...</p>';

    try {
        const response = await fetch('http://127.0.0.1:8000/trade-match', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ offer, seek: seeking })
        });

        const data = await response.json();
        const matches = data.matches;

        if (!matches || matches.length === 0) {
            resultsDiv.innerHTML = '<div class="card" style="background:#fff3cd; color:#856404; font-weight:bold;"><p style="margin:0;">No high-quality matches found. Try different keywords.</p></div>';
            return;
        }

        // Render matches
        let html = '';
        matches.forEach(match => {
            const scoreClass = match.matchScore >= 50 ? 'ai-score-high' : 'ai-score-low';
            html += `<div class="trade-box">
                <div class="trade-box-header">
                    <div class="trader-info">${match.title} (${match.category})</div>
                    <span class="ai-score ${scoreClass}">Match: ${match.matchScore}%</span>
                </div>
                <div class="trade-box-content">
                    <p><strong>Reasons:</strong></p>
                    <ul>${match.matchReasons.map(r => `<li>${r}</li>`).join('')}</ul>
                </div>
            </div>`;
        });

        resultsDiv.innerHTML = html;

        // Optional: mirror to another container
        if (containerId === 'leftMatchResults' && document.getElementById('matchResultsLarge')) {
            document.getElementById('matchResultsLarge').innerHTML = html;
        }

    } catch (err) {
        console.error(err);
        resultsDiv.innerHTML = '<p style="color:red;">Error fetching matches. Try again later.</p>';
    }
}

/* Search handler from left panel form */
function searchTradeMatchesFromPanel(e) {
    if (e) e.preventDefault();
    const offer = $('#leftOffer').val().trim();
    const seeking = $('#leftSeeking').val().trim();
    performMatchSearchRender(offer, seeking, 'leftMatchResults');
}

function searchTradeMatches() {
    const offer = $('#matchOffer').val()?.trim() || '';
    const seeking = $('#matchSeeking').val()?.trim() || '';
    performMatchSearchRender(offer, seeking, 'matchResultsLarge');
}


/* Core render function for matches */
function performMatchSearchRender(offer, seeking, containerId) {
    const resultsDiv = document.getElementById(containerId);
    if (!offer || !seeking) {
        resultsDiv.innerHTML = '<p style="color:red;">Please enter both your offer and what you are seeking.</p>';
        return;
    }
    resultsDiv.innerHTML = '<p>Searching AI matches...</p>';
    // Simulate processing delay
    setTimeout(() => {
        const matches = aiMatchAlgorithm(offer, seeking);
        if (!matches || matches.length === 0) {
            resultsDiv.innerHTML = '<div class="card" style="background:#fff3cd; color:#856404; font-weight:bold;"><p style="margin:0;">No high-quality matches found. Try different keywords.</p></div>';
            return;
        }
        let html = '';
        matches.forEach(match => {
            const scoreClass = match.matchScore >= 50 ? 'ai-score-high' : 'ai-score-low';
            html += `<div class="trade-box">
                <div class="trade-box-header">
                    <div class="trader-info"><img src="${match.avatar}" style="width:35px;height:35px;border-radius:50%;"> ${escapeHtml(match.trader)}</div>
                    <span class="ai-score ${scoreClass}">Match: ${match.matchScore}%</span>
                </div>
                <div class="trade-listing-content" style="margin-top:10px;">
                    ${match.imageUrl ? `<img class="trade-listing-img" src="${match.imageUrl}">` : ''}
                    <div class="trade-listing-details" style="flex:1;">
                        <h4 style="margin:0; color:var(--color-primary);">${escapeHtml(match.title)} (${escapeHtml(match.category)})</h4>
                        <p style="margin:6px 0;"><strong>Trader offers:</strong> ${escapeHtml(match.title)} (${escapeHtml(match.quantity)})<br/><strong>Trader seeks:</strong> ${escapeHtml(match.seeking)}</p>
                        <div style="font-size:14px; color:#666;"><strong>Why this is a match:</strong>
                            <ul>${match.matchReasons.map(r => `<li>${escapeHtml(r)}</li>`).join('')}</ul>
                        </div>
                    </div>
                </div>
                <div class="trade-box-actions">
                    <button class="button" style="background:var(--color-action-trade);" onclick="initiateTrade(${match.id})">Trade</button>
                    <button class="button-secondary" onclick="openTraderProfile(${match.traderId})">View Profile</button>
                </div>
            </div>`;
        });
        resultsDiv.innerHTML = html;

        // If rendering to left panel, also copy to matchResultsLarge (consistency)
        if (containerId === 'leftMatchResults' && document.getElementById('matchResultsLarge')) {
            document.getElementById('matchResultsLarge').innerHTML = resultsDiv.innerHTML;
        }
    }, 500);
}

/* Clear match panel inputs/results */
function clearMatchPanel() {
    $('#leftOffer').value = '';
    $('#leftSeeking').value = '';
    $('#leftMatchResults').innerHTML = '<p style="color:#888;">No searches yet. Enter your offer & seeking and click "Search Match".</p>';
    if (document.getElementById('matchResultsLarge')) document.getElementById('matchResultsLarge').innerHTML = '';
}

/* Small helper to open trader profile (demo) */
function openTraderProfile(traderId) {
    alert('Open Trader Profile (demo) for traderId: ' + traderId);
}

/* ========================================================================================
   INITIALIZE
   ======================================================================================== */
document.addEventListener('DOMContentLoaded', () => {
    readTradeListings('home');
    // set default toggle for modal upload
    toggleImageUpload($('#tradeCategory').value);
});

/* Backwards compatibility: if other code calls searchTradeMatches() */
window.searchTradeMatches = searchTradeMatches;

/* End of script */
</script>
</body>
</html><?php /**PATH C:\Users\niiin\Downloads\ecotrade\ecotrade\resources\views/dashboard.blade.php ENDPATH**/ ?>