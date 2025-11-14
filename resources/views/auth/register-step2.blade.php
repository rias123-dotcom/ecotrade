<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrade - Step 2: Identity Verification</title>
    <style>
        /* Your CSS styles remain the same */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --primary-green: #38a169;
            --dark-green: #2d6b49;
            --light-grey: #e2e8f0;
            --progress-grey: #cbd5e0;
            --text-color: #4a5568;
            --link-color: #38a169;
            --info-box-bg: #d1fae5;
            --info-box-border: #80e4b8;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* ... and so on ... */
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
            color: #d1fae5;
            /* Lighter color for 'ECO' */
        }

        .logo-text span:last-child {
            color: white;
            /* White color for 'TRADE' */
        }

        .registration-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin-top: 40px;
            /* Space for the fixed header */
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

        .progress-step.active {
            background-color: var(--primary-green);
        }

        /* Step 2 progress bar state (1st and 2nd step active) */
        .progress-bar .progress-step:nth-child(1),
        .progress-bar .progress-step:nth-child(2) {
            background-color: var(--primary-green);
        }

        .step-info {
            text-align: center;
            color: var(--text-color);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-content {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .form-group {
            position: relative;
        }

        .form-group h3 {
            color: var(--text-color);
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 10px 0;
            text-align: center;
        }

        /* Styling for the Select ID Type dropdown */
        .id-type-group {
            max-width: 400px;
            margin: 0 auto;
        }

        .id-type-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--primary-green);
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            color: var(--text-color);
            background-color: white;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            appearance: none;
            -webkit-appearance: none;
            padding-right: 40px;
            text-align: left;
        }

        .id-type-group::after {
            content: '▼';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(10px);
            /* Adjust to center with input line */
            color: var(--primary-green);
            pointer-events: none;
            font-size: 12px;
        }

        .id-type-group select:focus {
            outline: none;
            border-color: var(--dark-green);
            box-shadow: 0 0 0 3px rgba(56, 161, 105, 0.3);
        }

        /* Styling for the File Upload Section */
        .upload-group {
            max-width: 400px;
            margin: 0 auto;
        }

        .upload-field {
            display: flex;
            border: 2px solid var(--primary-green);
            border-radius: 6px;
            overflow: hidden;
            background-color: white;
            position: relative;
            /* Added for error message positioning */
            flex-wrap: wrap;
            /* Allows error to wrap */
        }

        .upload-placeholder {
            flex-grow: 1;
            padding: 12px 15px;
            color: #a0aec0;
            font-size: 16px;
            cursor: default;
            /* Ensure text wraps if file name is long */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .choose-file-btn {
            background-color: white;
            color: var(--primary-green);
            padding: 12px 20px;
            border: none;
            border-left: 1px solid var(--primary-green);
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .choose-file-btn:hover {
            background-color: #f0fff4;
        }

        .choose-file-btn svg {
            width: 18px;
            height: 18px;
            fill: var(--primary-green);
        }

        /* Hidden actual file input */
        .hidden-file-input {
            display: none;
        }

        /* Error message for file upload */
        .upload-group .error-message {
            width: 100%;
            padding-top: 5px; /* Added for spacing */
            color: red;
            font-size: 14px;
        }

        /* Info/Security Box */
        .info-box {
            background-color: var(--info-box-bg);
            border: 1px solid var(--info-box-border);
            border-radius: 6px;
            padding: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 15px;
            color: var(--dark-green);
            line-height: 1.5;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .info-box strong {
            font-weight: 600;
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

        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        .action-button {
            padding: 14px 30px;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            min-width: 150px;
        }

        .back-button {
            background: #cbd5e0;
            /* Grey from the image */
            color: var(--text-color);
        }

        .back-button:hover {
            background: #a0aec0;
        }

        .continue-button {
            background: linear-gradient(to bottom, var(--primary-green), var(--dark-green));
            color: white;
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
        @if (Session::has('error') || $errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 0.25rem; margin-bottom: 1.5rem; border: 1px solid #f5c6cb;">
            <p style="font-weight: bold; margin: 0 0 0.5rem 0;">Oops! Something went wrong.</p>
            <ul style="margin: 0; padding-left: 1.25rem;">
                @if (Session::has('error'))
                <li>{{ Session::get('error') }}</li>
                @endif
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="title-section">
            <h1>Register for EcoTrade</h1>
            <p>Join the community-based barter system</p>
        </div>

        <div class="progress-bar">
            <div class="progress-step active"></div>
            <div class="progress-step active"></div>
            <div class="progress-step"></div>
        </div>

        <p class="step-info">Step 2 of 3: Identity Verification</p>

        <form class="form-content" method="POST" action="{{route('register.step2.post')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group id-type-group">
                <h3>Government ID Type</h3>

                <!-- FIXED: Error message now checks for 'docType' -->
                @error('docType')
                <div class="error-message" style="color: red; font-size: 14px; margin-bottom: 5px;">{{ $message }}</div>
                @enderror
                
                <!-- FIXED: The 'name' attribute is now 'docType' to match the controller -->
                <select id="docType" name="docType" required>
                    <option value="" disabled selected>Select an ID Type</option>
                    <option value="Drivers License" {{ old('docType') == 'Drivers License' ? 'selected' : '' }}>Driver's License</option>
                    <option value="Passport" {{ old('docType') == 'Passport' ? 'selected' : '' }}>Passport</option>
                    <option value="UMID/SSS/GSIS" {{ old('docType') == 'UMID/SSS/GSIS' ? 'selected' : '' }}>UMID/SSS/GSIS</option>
                </select>
            </div>

            <div class="form-group upload-group">
                <h3>Upload Government ID</h3>
                <div class="upload-field">
                    <span class="upload-placeholder" id="uploadFileName">Upload File</span>
                    
                    <!-- FIXED: The 'for' attribute now matches the input's 'id' -->
                    <label for="identityDoc" class="choose-file-btn">
                        Choose File
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm-2 18H8v-2h4v2zm0-4H8v-2h4v2zm-2-4H8v-2h2v2zm7-6H13V3.5L18.5 9z" fill="var(--primary-green)" />
                        </svg>
                    </label>

                    <!-- The 'id' and 'name' are correct for the controller -->
                    <input type="file" id="identityDoc" name="identityDoc" class="hidden-file-input" required>
                </div>

                <!-- FIXED: Error message now checks for 'identityDoc' -->
                @error('identityDoc')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="info-box">
                Your government ID is required for **account verification and security purposes**. The information is **encrypted and stored securely**.
            </div>

            <div class="form-footer">
                <p class="login-link">Already have an account? <a href="{{ route('login') }}">Log in here</a></p>

                <div class="button-group">
                    <button class="action-button back-button" type="button" onclick="window.history.back()">Back</button>
                    <button class="action-button continue-button" type="submit">Continue</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // This JavaScript correctly targets 'identityDoc' and does not need to be changed.
        document.getElementById('identityDoc').addEventListener('change', function() {
            var fileName = this.files.length > 0 ? this.files[0].name : 'Upload File';
            document.getElementById('uploadFileName').textContent = fileName;
        });
    </script>
</body>
</html>