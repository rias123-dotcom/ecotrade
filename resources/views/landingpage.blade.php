<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTrade - Sustainable Trading Platform</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            scroll-behavior: smooth;
        }

        .header {
            background: linear-gradient(135deg, #4a6741 0%, #7ba05b 100%);
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .logo::before {
            content: "◆";
            margin-right: 0.5rem;
            transform: rotate(45deg);
            display: inline-block;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: #c8e6c9;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-bar {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.9);
            min-width: 200px;
        }

        .signup-btn {
            background: #66bb6a;
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 20px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .signup-btn:hover {
            background: #4caf50;
        }

        .hero-section {
            background: linear-gradient(135deg, #4a6741 0%, #7ba05b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding-top: 80px;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeInUp 1s ease 0.3s forwards;
        }

        .main-section {
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            min-height: 100vh;
            padding: 4rem 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .tabs-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-around;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .tab {
            background: transparent;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #4a6741;
            cursor: pointer;
            border-radius: 10px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .tab:hover, .tab.active {
            background: #66bb6a;
            color: white;
            transform: translateY(-2px);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }

        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: transform 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4a6741;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .carousel-container {
            position: relative;
            background: #f5f5f5;
            border-radius: 15px;
            padding: 2rem;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(106, 187, 106, 0.8);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-nav:hover {
            background: #4caf50;
            transform: translateY(-50%) scale(1.1);
        }

        .carousel-nav.prev {
            left: 10px;
        }

        .carousel-nav.next {
            right: 10px;
        }

        .product-image {
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #ff6b6b, #ffa726);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin: 0 auto;
        }

        .food-image {
            background: url('https://images.pexels.com/photos/4187623/pexels-photo-4187623.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop') center/cover;
        }

        .makeup-image {
            background: url('https://images.pexels.com/photos/2533266/pexels-photo-2533266.jpeg?auto=compress&cs=tinysrgb&w=200&h=200&fit=crop') center/cover;
        }

        .scroll-indicator {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 2rem;
            animation: bounce 2s infinite;
            cursor: pointer;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
            from {
                opacity: 0;
                transform: translateY(30px);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-content h1 {
                font-size: 2rem;
            }
            
            .tabs-container {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        .additional-section {
            background: linear-gradient(135deg, #2e7d32 0%, #388e3c 100%);
            min-height: 100vh;
            padding: 4rem 2rem;
            color: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-container">
            <a href="{{ route('landing') }}" class="logo">ECO TRADE</a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#explore">Explore</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="nav-actions">
                <input type="text" class="search-bar" placeholder="Search products...">
                <a href="{{ route('register') }}" class="signup-btn">Sign up</a>
            </div>
        </div>
    </header>

    <section id="home" class="hero-section">
        <div class="hero-content">
            <h1>Welcome to EcoTrade</h1>
            <p>Your sustainable trading platform for eco-friendly products</p>
        </div>
        <div class="scroll-indicator" onclick="scrollToMain()">↓</div>
    </section>

    <section id="explore" class="main-section">
        <div class="container">
            <div class="tabs-container">
                <button class="tab active" onclick="switchTab('items')">ITEMS</button>
                <button class="tab" onclick="switchTab('service')">SERVICE</button>
                <button class="tab" onclick="switchTab('skills')">SKILLS</button>
            </div>

            <div class="content-grid">
                <div class="content-card">
                    <h3 class="card-title">FOOD</h3>
                    <div class="carousel-container">
                        <button class="carousel-nav prev" onclick="previousItem('food')">‹</button>
                        <div class="product-image food-image"></div>
                        <button class="carousel-nav next" onclick="nextItem('food')">›</button>
                    </div>
                </div>

                <div class="content-card">
                    <h3 class="card-title">MAKE UP</h3>
                    <div class="carousel-container">
                        <button class="carousel-nav prev" onclick="previousItem('makeup')">‹</button>
                        <div class="product-image makeup-image"></div>
                        <button class="carousel-nav next" onclick="nextItem('makeup')">›</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="additional-section">
        <div class="container">
            <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 2rem;">Why Choose EcoTrade?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🌱</div>
                    <h3>Sustainable Products</h3>
                    <p>All products are carefully curated to meet strict environmental standards</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3>Fair Trade</h3>
                    <p>Supporting ethical trading practices and fair compensation for producers</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔄</div>
                    <h3>Circular Economy</h3>
                    <p>Promoting reuse, recycling, and sustainable consumption patterns</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="hero-section">
        <div class="hero-content">
            <h1>Get Started Today</h1>
            <p>Join thousands of eco-conscious traders making a difference</p>
            <a href="{{ route('register') }}" class="signup-btn" style="font-size: 1.1rem; padding: 1rem 2rem; margin-top: 2rem;">Join EcoTrade</a>
        </div>
    </section>

    <script>
        function scrollToMain() {
            document.getElementById('explore').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }

        function switchTab(tabName) {
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            event.target.classList.add('active');
            console.log('Switched to tab: ' + tabName);
        }

        function previousItem(category) {
            console.log('Previous item for: ' + category);
        }

        function nextItem(category) {
            console.log('Next item for: ' + category);
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        let autoScrollInterval;
        
        function startAutoScroll() {
            const sections = ['#home', '#explore', '#about', '#contact'];
            let currentIndex = 0;
            
            autoScrollInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % sections.length;
                document.querySelector(sections[currentIndex]).scrollIntoView({
                    behavior: 'smooth'
                });
            }, 4000);
        }

        setTimeout(startAutoScroll, 3000);

        document.addEventListener('wheel', () => {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            }
        });

        document.addEventListener('touchstart', () => {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            }
        });
    </script>
</body>
</html>