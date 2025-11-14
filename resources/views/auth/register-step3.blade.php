<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrade - Step 3: Facial Recognition</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        :root {
            --primary-green: #38a169; /* Success Green */
            --dark-green: #2d6b49;    /* Darker green for hover/shadows */
            --failure-red: #e53e3e;   /* Failure Red */
            --progress-grey: #cbd5e0; /* Grey for inactive progress bar */
            --text-color: #4a5568;    /* General text color */
            --link-color: #38a169;
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
        }

        .logo-text span:last-child {
            color: white;
        }

        .registration-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 600px;
            margin-top: 40px;
            text-align: center;
        }

        .title-section {
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
            background-color: var(--primary-green); /* All steps active for step 3 */
        }

        .step-info {
            color: var(--text-color);
            font-size: 14px;
            margin-bottom: 40px;
        }

        .facial-recognition-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* --- SCAN FRAME STYLES --- */

        .scan-frame {
            position: relative;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            border: 4px solid var(--primary-green);
            overflow: hidden;
            background-color: #f0fff4; /* Placeholder background */
            transition: all 0.5s ease;
            box-shadow: 0 0 15px rgba(56, 161, 105, 0.5);
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Video/Camera Feed Placeholder */
        #cameraFeed {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            /* Stylized camera feed look for UI demo */
            filter: grayscale(80%) brightness(1.2); 
            background: #f0fff4; 
        }

        /* Scanning Line Animation */
        .scan-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(to right, transparent, var(--primary-green) 50%, transparent);
            box-shadow: 0 0 8px var(--primary-green);
            animation: scan-move 3s infinite linear;
            transform: translateY(-100%);
        }

        @keyframes scan-move {
            0% { transform: translateY(-100%); opacity: 0.5; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(calc(100% + 8px)); opacity: 0.5; }
        }
        
        /* --- STATUS STATES --- */

        /* Success State */
        .scan-frame.verified {
            border-color: var(--primary-green);
            background-color: white;
            box-shadow: 0 0 20px rgba(56, 161, 105, 0.7);
        }
        
        .verified-check {
            width: 140px;
            height: 140px;
            fill: none;
            stroke: var(--primary-green);
            stroke-width: 8;
            stroke-linecap: round;
            stroke-linejoin: round;
            animation: scale-up 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }
        
        /* Failure State */
        .scan-frame.failed {
            border-color: var(--failure-red);
            background-color: var(--light-red);
            animation: shake 0.5s;
            box-shadow: 0 0 15px rgba(229, 62, 62, 0.5);
        }

        .failure-cross {
            width: 140px;
            height: 140px;
            fill: none;
            stroke: var(--failure-red);
            stroke-width: 8;
            stroke-linecap: round;
            stroke-linejoin: round;
            animation: scale-up 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        @keyframes scale-up {
            from { transform: scale(0.5); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* --- TEXT & BUTTONS --- */
        
        .instruction-text {
            color: var(--text-color);
            font-size: 18px;
            font-weight: 500;
            min-height: 25px; /* Prevent layout shift */
        }
        
        .result-text {
            font-size: 20px;
            font-weight: 600;
            margin-top: 10px;
        }

        .result-text.success {
            color: var(--primary-green);
        }
        .result-text.failure {
            color: var(--failure-red);
        }

        .button-group {
            margin-top: 40px;
            min-height: 50px; /* Prevent layout shift */
        }

        .action-button {
            padding: 14px 40px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            max-width: 300px;
        }

        .continue-button {
            background: linear-gradient(to bottom, var(--primary-green), var(--dark-green));
            color: white;
        }

        .continue-button:hover {
            background: linear-gradient(to top, var(--primary-green), var(--dark-green));
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .retry-button {
            background: #e2e8f0; /* Light grey */
            color: var(--text-color);
        }

        .retry-button:hover {
            background: #cbd5e0;
        }

    </style>
</head>
<body onload="startScanning()">

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
            <!-- All steps active for step 3 -->
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
        </div>

        <p class="step-info">Step 3 of 3: Facial Recognition</p>

        <div class="facial-recognition-area">
            
            <div class="scan-frame" id="scanFrame">
                <!-- Camera Feed Placeholder (simulated) -->
                <video id="cameraFeed" autoplay playsinline loop>
                    <!-- In a real app, the video stream would go here -->
                </video>
                <!-- Scanner Line (Visible during scanning) -->
                <div class="scan-line" id="scanLine"></div>
            </div>
            
            <p class="instruction-text" id="instructionText">Initializing camera...</p>
            
            <div class="button-group" id="actionButtons">
                <!-- Buttons will be injected by JavaScript -->
            </div>

        </div>
    </div>
    
    <script>
     const scanFrame = document.getElementById('scanFrame');
    const cameraFeed = document.getElementById('cameraFeed');
    const scanLine = document.getElementById('scanLine');
    const instructionText = document.getElementById('instructionText');
    const actionButtons = document.getElementById('actionButtons');

    let cameraStream = null; // Variable to hold the camera stream

    // --- Core Functions ---

    async function startCamera() {
        try {
            cameraStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
            cameraFeed.srcObject = cameraStream;
            instructionText.textContent = "Please center your face and hold still...";
        } catch (err) {
            console.error("Camera access denied:", err);
            instructionText.innerHTML = '<span class="result-text failure">Camera access is required for verification.</span>';
            actionButtons.innerHTML = `<button class="action-button retry-button" type="button" onclick="startCamera()">Enable Camera</button>`;
        }
    }

    function handleSuccess() {
        instructionText.innerHTML = '<span class="result-text success">Face Captured!</span> Verifying against your ID...';
        
        // This button will trigger the backend call
        actionButtons.innerHTML = `
            <button class="action-button continue-button" type="button" onclick="verifyWithBackend()">Continue</button>
        `;
    }

    function tryAgain() {
        startCamera();
        actionButtons.innerHTML = ''; // Clear buttons while camera starts
    }

    function captureImage() {
        // Create a canvas to draw the current frame from the video
        const canvas = document.createElement('canvas');
        canvas.width = cameraFeed.videoWidth;
        canvas.height = cameraFeed.videoHeight;
        canvas.getContext('2d').drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);
        
        // Stop the camera stream
        if (cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());
        }
        
        // Convert the canvas to a Base64 image string
        return canvas.toDataURL('image/jpeg');
    }

    async function verifyWithBackend() {
        const continueButton = document.querySelector('.continue-button');
        continueButton.disabled = true;
        continueButton.textContent = 'Verifying...';

        const faceImage = captureImage();

        try {
            const response = await fetch("{{ route('register.step3.post') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ face_image: faceImage })
            });

            const result = await response.json();

            if (!response.ok) {
                // Handle API or validation errors from the backend
                throw new Error(result.error || 'An unknown error occurred.');
            }
            
            // On success, backend provides a URL to redirect to
            if (result.success && result.redirect_url) {
                window.location.href = result.redirect_url;
            }

        } catch (error) {
            console.error('Verification Error:', error);
            instructionText.innerHTML = `<span class="result-text failure">${error.message}</span>`;
            actionButtons.innerHTML = `<button class="action-button retry-button" type="button" onclick="tryAgain()">Try Again</button>`;
        }
    }

    // Start the camera automatically when the page loads
    window.addEventListener('load', () => {
        startCamera();
        // We now trigger the capture on a button press, not a timer
        // Let's add a button to capture the image
        setTimeout(() => { // Give camera time to initialize
             actionButtons.innerHTML = `<button class="action-button continue-button" type="button" onclick="handleSuccess()">Capture Face</button>`;
        }, 1500);
    });

    </script>
</body>
</html>