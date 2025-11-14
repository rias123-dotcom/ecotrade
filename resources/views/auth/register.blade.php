<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrade - Step 1: Account Details</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --primary-green: #38a169; /* Green from logo and buttons */
            --dark-green: #2d6b49;    /* Darker green for hover/shadows */
            --progress-grey: #cbd5e0; /* Grey for inactive progress bar */
            --text-color: #4a5568;    /* General text color */
            --link-color: #38a169;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9f7; /* Very light, off-white background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px 15px; /* Added padding for mobile safety */
            box-sizing: border-box;
        }

        .header-logo {
            background-color: var(--primary-green);
            height: 40px;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            padding-left: 5%;
            box-sizing: border-box;
        }

        .logo-text {
            color: white;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }

        .logo-text span:first-child {
            color: #d1fae5; /* Lighter color for 'ECO' */
        }

        .logo-text span:last-child {
            color: white; /* White color for 'TRADE' */
        }

        .registration-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px; /* Increased max-width for better two-column layout */
            margin-top: 40px;
        }

        .title-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .title-section h1 {
            color: var(--primary-green);
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .title-section p {
            color: var(--text-color);
            font-size: 16px;
            margin: 0;
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 8px;
            margin-bottom: 40px;
        }

        .progress-step {
            height: 100%;
            width: 30%; 
            border-radius: 4px;
            background-color: var(--progress-grey);
            transition: background-color 0.3s ease;
        }

        /* Step 1 progress bar state */
        .progress-bar .progress-step:nth-child(1) {
            background-color: var(--primary-green);
        }

        .step-info {
            text-align: center;
            color: var(--text-color);
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* --- New Grid Layout for Form Content --- */
        .form-content {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Default to two equal columns */
            gap: 25px 20px; /* Vertical gap 25px, Horizontal gap 20px */
        }
        
        /* On small screens, collapse to a single column */
        @media (max-width: 650px) {
            .form-content {
                grid-template-columns: 1fr;
            }
        }
        /* ------------------------------------- */

        .form-group {
            position: relative;
            width: 100%; /* Important for grid item */
        }


        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--progress-grey);
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            color: var(--text-color);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--progress-grey);
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            color: var(--text-color);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        /* Apply focus style to select fields as well */
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(56, 161, 105, 0.2);
        }


        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-color);
            transition: color 0.2s;
        }
        
        .password-toggle:hover {
            color: var(--primary-green);
        }

        /* Middle Name Checkbox Styling */
        .middle-name-options {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
            color: var(--text-color);
        }
        
        .middle-name-options label {
            cursor: pointer;
            margin-left: 5px;
        }
        
        .middle-name-options input[type="checkbox"] {
            width: auto;
            /* Reset default margin for checkboxes */
            margin: 0; 
            appearance: none;
            -webkit-appearance: none;
            height: 16px;
            width: 16px;
            border: 1px solid var(--progress-grey);
            border-radius: 3px;
            outline: none;
            transition: all 0.2s;
            cursor: pointer;
            position: relative;
        }

        .middle-name-options input[type="checkbox"]:checked {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }

        .middle-name-options input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 10px;
        }


        .form-footer {
            margin-top: 40px;
            text-align: center;
        }

        .login-link {
            color: var(--text-color);
            font-size: 16px;
            margin-bottom: 20px;
            display: block;
        }

        .login-link a {
            color: var(--link-color);
            text-decoration: none;
            font-weight: 600;
        }

        .continue-button {
            padding: 14px 40px;
            border: none;
            border-radius: 6px;
            background: linear-gradient(to bottom, var(--primary-green), var(--dark-green));
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 300px;
        }

        .continue-button:hover {
            background: linear-gradient(to top, var(--primary-green), var(--dark-green));
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>

    <div class="header-logo">
        <div class="logo-text">
            <span>ECO</span><span>TRADE</span>
        </div>
    </div>

    <div class="registration-container">
        <div class="title-section">
            <h1>Register for EcoTrade</h1>
            <p>Join the community-based barter system</p>
        </div>

        <div class="progress-bar">
            <!-- Step 1 Active -->
            <div class="progress-step active"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
        </div>

        <p class="step-info">Step 1 of 3: Account and Personal Details</p>

        <!-- The form content is now fully reordered to match the requested pairings (6 rows) -->
        <form class="form-content" method="POST" action="{{ route('register.post') }}">
            @csrf
            <!-- R1: First Name | Select Country -->
            <div class="form-group">
                <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
                @error('firstName')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <select id="country" name="country" required>
                    <option value="" disabled selected>Select Country</option>
                    <option value="philippines">Philippines</option>
                </select>
                @error('country')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- R2: Middle Name + Checkbox | Select City -->
            <div class="form-group" id="form-group-middle-name">
                <input type="text" id="middleName" name="middleName" placeholder="Middle Name">
                <div class="middle-name-options">
                    <input type="checkbox" id="noMiddleName" name="noMiddleName" onclick="toggleMiddleName(this)">
                    <label for="noMiddleName">I do not have a middle name</label>
                @error('middleName')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="form-group">
                <select id="city" name="city" required>
                    <option value="" disabled selected>Select City</option>
                    <option value="mandaue-city">Mandaue City</option>
                    <option value="lapu-lapu-city">Lapu-Lapu City</option>
                </select>
                @error('city')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- R3: Last Name | Select Province (NEW FIELD) -->
            <div class="form-group">
                <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>
                @error('lastName')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <select id="province" name="province">
                    <option value="" disabled selected>Select Province</option>
                    <option value="cebu">Cebu</option>
                </select>
                @error('province')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- R4: Email | Address -->
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email Address" required>
                @error('email')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" id="address" name="address" placeholder="Address" required>
                @error('address')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- R5: Contact # | Password -->
            <div class="form-group">
                <!-- Added maxlength for user experience -->
                <input type="tel" id="contactNumber" name="contactNumber" placeholder="Contact Number" required maxlength="11">
                @error('contactNumber')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                    <!-- Eye Icon SVG -->
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path id="password-icon-path" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
                @error('password')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- R6: Zip Code (New Placeholder) | Confirm Password -->
            <div class="form-group">
                <!-- Added maxlength for user experience. Type is text, but JS will enforce numeric only. -->
                <input type="text" id="zipCode" name="zipCode" placeholder="Zip Code (4 digits)" maxlength="4">
            </div>
            <div class="form-group">
                <input type="password" id="confirmPassword" name="password_confirmation" placeholder="password_confirmation" required>
                <span class="password-toggle" onclick="togglePasswordVisibility('confirmPassword')">
                    <!-- Eye Icon SVG -->
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path id="confirm-password-icon-path" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
                @error('confirmPassword')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        <div class="form-footer">
            <p class="login-link">Already have an account? <a href="{{route('login')}}">Log in here</a></p>
            <button class="continue-button" type="submit">Continue</button>
        </div>
        </form>
    </div>
    
    <script>
        function toggleMiddleName(checkbox) {
            const middleNameInput = document.getElementById('middleName');
            
            if (checkbox.checked) {
                middleNameInput.value = ''; // Clear value
                middleNameInput.setAttribute('disabled', 'disabled');
                middleNameInput.removeAttribute('required');
                middleNameInput.style.backgroundColor = '#f0f0f0';
            } else {
                middleNameInput.removeAttribute('disabled');
                middleNameInput.style.backgroundColor = '';
            }
        }

        // Updated function to handle password visibility for multiple fields
        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const pathElement = input.nextElementSibling.querySelector('path');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            // Toggle the eye icon to show visibility state
            const openEye = 'M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z'; 
            const closedEye = 'M17.94 17.94A10.07 10.07 0 0112 20c-7 0-10-6-10-6a10.07 10.07 0 015.94-5.94 M9.88 4.67A10.07 10.07 0 0112 4c7 0 10 6 10 6a10.07 10.07 0 01-5.94 5.94'; 
            
            // This is a simplified toggle logic for the SVG path
            if (type === 'text') {
                 // Path for the closed/slashed eye
                pathElement.setAttribute('d', closedEye);
            } else {
                 // Path for the open eye
                pathElement.setAttribute('d', openEye);
            }
        }


        document.addEventListener('DOMContentLoaded', () => {
            // --- INPUT RESTRICTIONS START ---
            
            // 1. Contact Number Input Restriction (only digits and limited to 11)
            const contactInput = document.getElementById('contactNumber');
            if (contactInput) {
                contactInput.addEventListener('input', function(e) {
                    // Remove any non-digit characters
                    let value = this.value.replace(/\D/g, '');
                    
                    // Limit to 11 digits
                    if (value.length > 11) {
                        value = value.slice(0, 11);
                    }
                    this.value = value;
                });
            }

            // 2. Zip Code Input Restriction (only digits and limited to 4)
            const zipInput = document.getElementById('zipCode');
            if (zipInput) {
                zipInput.addEventListener('input', function(e) {
                    // Remove any non-digit characters
                    let value = this.value.replace(/\D/g, '');
                    
                    // Limit to 4 digits
                    if (value.length > 4) {
                        value = value.slice(0, 4);
                    }
                    this.value = value;
                });
            }

            // --- INPUT RESTRICTIONS END ---

            // 3. Set up the initial Middle Name toggle state
            const noMiddleNameCheckbox = document.getElementById('noMiddleName');
            if (noMiddleNameCheckbox) {
                // Ensure Middle Name is optional/enabled by default (unchecked)
                noMiddleNameCheckbox.checked = false;
                toggleMiddleName(noMiddleNameCheckbox); 
            }
        });
    </script>
</body>
</html>