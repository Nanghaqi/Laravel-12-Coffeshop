<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0a0a0a;
            color: #e0e0e0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .industrial-bg {
            background:
                linear-gradient(rgba(10, 10, 10, 0.9), rgba(10, 10, 10, 0.9)),
                url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="%231a1a1a"/><path d="M0,50 L100,50 M50,0 L50,100" stroke="%23222" stroke-width="1"/></svg>');
        }
        .metal-border {
            border: 1px solid #333;
            background: linear-gradient(145deg, #1a1a1a, #111);
            box-shadow: 4px 4px 12px rgba(0,0,0,0.5),
                       -2px -2px 8px rgba(60,60,60,0.1);
        }
        .coffee-brown { color: #d4a574; }
        .copper-accent { color: #b87333; }
        .steel-bg { background-color: #2a2a2a; }
        .grid-pattern {
            background-image:
                linear-gradient(rgba(42, 42, 42, 0.5) 1px, transparent 1px),
                linear-gradient(90deg, rgba(42, 42, 42, 0.5) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .hover-glow:hover {
            box-shadow: 0 0 15px rgba(180, 115, 51, 0.3);
            transition: all 0.3s ease;
        }
        .table-row {
            border-bottom: 1px solid #333;
            transition: background-color 0.2s;
        }
        .table-row:hover {
            background-color: #2a2a2a;
        }
        .btn-industrial {
            background: linear-gradient(145deg, #3a3a3a, #2a2a2a);
            border: 1px solid #444;
            padding: 10px 20px;
            border-radius: 6px;
            color: #d4a574;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-industrial:hover {
            background: linear-gradient(145deg, #4a4a4a, #3a3a3a);
            border-color: #b87333;
        }
        .form-input {
            background-color: #1a1a1a;
            border: 1px solid #444;
            color: #fff;
            padding: 10px 15px;
            border-radius: 6px;
            width: 100%;
        }
        .form-input:focus {
            border-color: #b87333;
            outline: none;
            box-shadow: 0 0 0 2px rgba(180, 115, 51, 0.2);
        }
    </style>
</head>
<body class="industrial-bg">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 steel-bg metal-border">
            <div class="p-6 border-b border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="text-3xl copper-accent">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">INDUSTRIAL</h1>
                        <h2 class="text-sm coffee-brown tracking-widest">COFFEE LAB</h2>
                    </div>
                </div>
            </div>

            <nav class="mt-8">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-4 hover-glow {{ request()->routeIs('dashboard') ? 'bg-gray-900 border-r-4 border-coffee-brown' : '' }}">
                    <i class="fas fa-tachometer-alt w-6 coffee-brown"></i>
                    <span class="ml-4 font-medium">Dashboard</span>
                </a>
                <a href="{{ route('kategori.index') }}" class="flex items-center px-6 py-4 hover-glow {{ request()->routeIs('kategori.*') ? 'bg-gray-900 border-r-4 border-coffee-brown' : '' }}">
                    <i class="fas fa-tags w-6 coffee-brown"></i>
                    <span class="ml-4 font-medium">Kategori</span>
                </a>
                <a href="{{ route('menu.index') }}" class="flex items-center px-6 py-4 hover-glow {{ request()->routeIs('menu.*') ? 'bg-gray-900 border-r-4 border-coffee-brown' : '' }}">
                    <i class="fas fa-mug-hot w-6 coffee-brown"></i>
                    <span class="ml-4 font-medium">Menu</span>
                </a>
                <a href="{{ route('pesanan.index') }}" class="flex items-center px-6 py-4 hover-glow {{ request()->routeIs('pesanan.*') ? 'bg-gray-900 border-r-4 border-coffee-brown' : '' }}">
                    <i class="fas fa-receipt w-6 coffee-brown"></i>
                    <span class="ml-4 font-medium">Pesanan</span>
                </a>
                <a href="{{ route('inventori.index') }}" class="flex items-center px-6 py-4 hover-glow {{ request()->routeIs('inventori.*') ? 'bg-gray-900 border-r-4 border-coffee-brown' : '' }}">
                    <i class="fas fa-pallet w-6 coffee-brown"></i>
                    <span class="ml-4 font-medium">Inventori</span>
                </a>
                <a href="{{ route('laporan.index') }}" class="flex items-center px-6 py-4 hover-glow {{ request()->routeIs('laporan.*') ? 'bg-gray-900 border-r-4 border-coffee-brown' : '' }}">
                    <i class="fas fa-chart-line w-6 coffee-brown"></i>
                    <span class="ml-4 font-medium">Laporan</span>
                </a>
            </nav>

            <div class="absolute bottom-0 w-64 p-6 border-t border-gray-800">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                        <i class="fas fa-user-cog text-coffee-brown"></i>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium">Admin</p>
                        <p class="text-sm text-gray-400">Coffee Master</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto p-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-white mb-2">@yield('title')</h2>
                <p class="text-gray-400">@yield('subtitle', 'Industrial Coffee Shop Management System')</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-gray-800 border border-green-900 text-green-300 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-gray-800 border border-red-900 text-red-300 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>
