<div class="component-1" role="navigation" aria-label="Main navigation">
    <img src="{{ asset('images/logo1.png') }}" alt="Grand Archives Logo" class="logo-1"/>
    <div class="grand-archives">GRAND ARCHIVES</div>
    <div class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('catalogs') }}" class="nav-link {{ request()->routeIs('catalogs') ? 'active' : '' }}" aria-current="{{ request()->routeIs('catalogs') ? 'page' : 'false' }}">
            <i class="fas fa-book"></i>
            <span>Catalogs</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('transaction') }}" class="nav-link {{ request()->routeIs('transaction') ? 'active' : '' }}" aria-current="{{ request()->routeIs('transaction') ? 'page' : 'false' }}">
            <i class="fas fa-history"></i>
            <span>Borrowed Books</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('favorites') }}" class="nav-link {{ request()->routeIs('favorites') ? 'active' : 'false' }}" aria-current="{{ request()->routeIs('favorites') ? 'page' : 'false' }}">
            <i class="fas fa-heart"></i>
            <span>Favorites</span>
        </a>
    </div>
    <div class="nav-item">
        <a href="{{ route('user.profile') }}" class="nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}" aria-current="{{ request()->routeIs('user.profile') ? 'page' : 'false' }}">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>
</div>

<style>
    /* Base navigation styles */
    .component-1 {
        width: 250px;
        height: 100vh;
        background: linear-gradient(180deg, #ded9c3 0%, #e8e2cc 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem 0;
        box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        z-index: 2;
    }

    /* Logo styling */
    .logo-1 {
        width: 100px;
        height: auto;
        object-fit: contain;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }

    .logo-1:hover {
        transform: scale(1.05);
    }

    /* Title styling */
    .grand-archives {
        font-family: "JacquesFrancoisShadow-Regular", "Cinzel Decorative", serif;
        font-size: 24px;
        font-weight: 400;
        text-align: center;
        background: linear-gradient(to right, #121246 0%, #b5835a 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 4px rgba(181, 131, 90, 0.3);
        transition: transform 0.3s ease;
    }

    .grand-archives:hover {
        transform: scale(1.02);
    }

    /* Navigation items */
    .nav-item {
        width: 100%;
        height: 50px;
        position: relative;
        margin: 0.25rem 0;
    }

    .nav-link {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        padding: 0 1.5rem;
        color: #121246;
        font-family: "Inter-Regular", sans-serif;
        font-size: 18px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border-radius: 8px;
        position: relative;
    }

    .nav-link i {
        width: 24px;
        margin-right: 0.75rem;
        font-size: 18px;
        text-align: center;
    }

    .nav-link span {
        flex: 1;
    }

    .nav-link:hover {
        background: rgba(181, 131, 90, 0.2);
        transform: translateX(4px);
    }

    /* Active link styling */
    .nav-link.active {
        background: rgba(181, 131, 90, 0.3);
        color: #121246;
        border-left: 4px solid #b5835a;
        font-weight: 600;
    }

    /* Focus state for accessibility */
    .nav-link:focus {
        outline: 2px solid #121246;
        outline-offset: 2px;
        border-radius: 8px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .component-1 {
            width: 250px;
        }

        .logo-1 {
            width: 80px;
        }

        .grand-archives {
            font-size: 20px;
            margin-bottom: 1.5rem;
        }

        .nav-link {
            font-size: 16px;
            padding: 0 1rem;
            height: 45px;
        }

        .nav-link i {
            font-size: 16px;
            margin-right: 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .component-1 {
            width: 200px;
        }

        .logo-1 {
            width: 70px;
        }

        .grand-archives {
            font-size: 18px;
            margin-bottom: 1rem;
        }

        .nav-link {
            font-size: 14px;
            padding: 0 0.75rem;
            height: 40px;
        }

        .nav-link i {
            font-size: 14px;
            margin-right: 0.5rem;
        }
    }

    @media (max-height: 600px) {
        .component-1 {
            padding: 1rem 0;
        }

        .logo-1 {
            width: 60px;
            margin-bottom: 0.5rem;
        }

        .grand-archives {
            font-size: 16px;
            margin-bottom: 1rem;
        }

        .nav-item {
            height: 40px;
            margin: 0.2rem 0;
        }

        .nav-link {
            font-size: 14px;
            padding: 0 1rem;
        }

        .nav-link i {
            font-size: 14px;
            margin-right: 0.5rem;
        }
    }
</style>