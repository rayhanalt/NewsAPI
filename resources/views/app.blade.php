<!doctype html>
<html data-theme="cmyk">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/flatpckr.min.css') }}">
</head>

<body>
    {{-- drawer --}}
    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            {{-- Navbar --}}
            <div class="navbar rounded-xl bg-base-100 shadow-xl">
                <div class="flex-none">
                    <label for="my-drawer" class="btn-ghost btn-square btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block h-5 w-5 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1">
                    <a class="btn-ghost btn text-xl normal-case">daisyUI</a>
                </div>
                <div class="flex-none">
                    <a href="/login" class="btn-outline btn-info btn">
                        Login
                    </a>
                </div>
            </div>
            {{-- end navbar --}}
            {{-- content --}}
            <div class="flex w-full flex-col">
                <div class="card rounded-box mt-1 grid h-[530px] place-items-center">
                    @yield('content')
                    <input type="date" class="datepicker input-bordered input-secondary input w-full max-w-xs">
                </div>
            </div>
            {{-- end content --}}
            {{-- footer --}}
            <footer class="footer footer-center fixed bottom-0 bg-base-300 p-4 text-base-content">
                <div>
                    <p>Copyright © 2023 - Created By Rayhan Althaf</p>
                </div>
            </footer>
            {{-- end footer --}}
        </div>
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu w-80 bg-base-100 p-4 text-base-content">
                <!-- Sidebar content here -->
                <li><a>Customer</a></li>
                <li><a>Mobil</a></li>
                <li><a>Rental</a></li>
                <li><a>Denda</a></li>

            </ul>
        </div>
    </div>
    {{-- end drawer --}}
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script>
        flatpickr('.datepicker', {
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d'
        });
    </script>

</body>

</html>
