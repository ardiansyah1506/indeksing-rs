<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDERA - @yield('title', 'Indeks Data Elektronik RJ')</title>
    <link rel="shortcut icon" href="{{ asset('logo/favicon.ico') }}" type="image/x-icon">
    <!-- Tailwind CSS via CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script></script>
    @yield('css-custom')
    <style>
        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.3s ease-out, opacity 0.3s ease-out;
        }

        .dropdown-content.show {
            display: block;
            opacity: 1;
            max-height: 200px;
            transition: max-height 0.3s ease-in, opacity 0.3s ease-in;
        }
    </style>
</head>

<body class="flex m-0 p-0 font-sans bg-gray-100">
    <!-- Sidebar -->
    <div
        class="sidebar w-64 min-h-screen flex flex-col justify-between bg-sidebar p-5 fixed left-0 top-0 overflow-y-auto shadow-md z-10">
        <div>

            <div class="flex items-center gap-4 p-2.5 mb-6">
                <img src="{{ asset('logo/LOGO LAB-01.png') }}" alt="INDERA Logo" class="w-12 h-auto">
                <div class="flex flex-col">
                    <h2 class="m-0 text-2xl font-extrabold">INDERA</h2>
                    <p class="m-0 text-sm text-gray-500">Indeks Data Elektronik RJ</p>
                </div>
            </div>

            <nav class="w-64 bg-white shadow-sm rounded-lg p-4 overflow-hidden">
                <ul class="list-none p-0 space-y-2">
                    <!-- Dashboard -->
                    <li
                        class="rounded-md transition-colors @if (request()->routeIs('dashboard')) bg-blue-100 text-blue-700 font-medium @endif hover:bg-blue-50">
                        <a href="" class="flex items-center gap-3 p-3 text-gray-700 hover:text-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Indeks Rawat Jalan -->
                    <li
                        class="rounded-md transition-colors @if (request()->routeIs('indeks-rajal')) bg-blue-100 text-blue-700 font-medium @endif hover:bg-blue-50">
                        <a href="{{ route('indeksing.index') }}"
                            class="flex items-center gap-3 p-3 text-gray-700 hover:text-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <span>Indeks Rawat Jalan</span>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center justify-between p-3 text-gray-700 cursor-pointer hover:text-blue-700"
                            data-collapse-toggle='laporan-dropdown'>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span>Laporan Rawat Jalan</span>
                            </div>
                            <svg id="laporan-icon" class="w-4 h-4 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <ul id="laporan-dropdown"
                            class="hidden transition-all duration-200 list-none pl-10 pr-2 py-1 space-y-1">
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.penyakit')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ route('penyakit.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    <span>Laporan Indeks Penyakit</span>
                                </a>
                            </li>
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.dokter')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ route('indeksing-dokter.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    <span>Laporan Indeks Dokter</span>
                                </a>
                            </li>
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.tindakan')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ Route('indeksing-tindakan.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    <span>Laporan Indeks Tindakan</span>
                                </a>
                            </li>
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.kematian')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ Route('indeksing-kematian.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Laporan Indeks Kematian</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Laporan Rawat Jalan -->

                    <!-- Settings -->
                    <li class="rounded-md transition-colors hover:bg-blue-50">
                        <div class="flex items-center justify-between p-3 text-gray-700 cursor-pointer hover:text-blue-700"
                            data-collapse-toggle='settings-dropdown'>
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Settings</span>
                            </div>
                            <svg id="settings-icon" class="w-4 h-4 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <ul id="settings-dropdown"
                            class="hidden transition-all duration-200 list-none pl-10 pr-2 py-1 space-y-1">
                            @can('view-poli')
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.penyakit')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ route('poli.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    <span>Manajemen Poli</span>
                                </a>
                            </li>
                            @endcan
                            @can('view-dokter')
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.dokter')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ route('dokter.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    <span>Manajemen Dokter</span>
                                </a>
                            </li>
                            @endcan
                            @can('view-icd10')
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.tindakan')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ Route('icd10_primary.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <span>Icd10 Primary</span>
                                </a>
                            </li>
                            @endcan
                            @can('view-icd9')
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.kematian')) bg-blue-100 text-blue-700 @endif">
                                <a href="{{ route('icd9.index') }}"
                                    class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <span>Icd9</span>
                                </a>
                            </li>
                            @endcan
                            @can('view-role')
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.kematian')) bg-blue-100 text-blue-700 @endif">
                                  
                              <a href="{{ route('roles.index') }}"
                              class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                              xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span>Roles</span>
                    </a>
                </li>
                @endcan
                            @can('view-user')
                            <li
                                class="rounded-md p-2 hover:bg-blue-50 @if (request()->routeIs('laporan.kematian')) bg-blue-100 text-blue-700 @endif">
                                  
                              <a href="{{ route('users.index') }}"
                              class="flex items-center gap-2 text-gray-700 hover:text-blue-700">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                              xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span>User</span>
                    </a>
                </li>
                @endcan
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="mt-8">
            <a href="{{ route('logout') }}" type="submit"
                class="w-full flex items-center justify-center gap-2 bg-gray-500 text-white p-2.5 rounded cursor-pointer hover:bg-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </div>
    </div>
    <div class="ml-64 p-6 w-full min-h-screen bg-center bg-no-repeat bg-contain relative" @yield('content') </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <!-- Main Content -->
        @yield('js-custom')
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            sidebar: '#f8f9fa',
                            primary: '#007bff',
                            warning: '#ffc107',
                            header: '#f1f3f6',
                            table: {
                                header: '#1a56db',
                                hover: '#edf2f7'
                            }
                        }
                    }
                }
            }
            document.querySelectorAll('[data-collapse-toggle]').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-collapse-toggle');
                    const target = document.getElementById(targetId);
                    const icon = this.querySelector('svg');

                    if (target) {
                        target.classList.toggle('hidden');

                        // Optional: rotate icon
                        if (icon) {
                            icon.classList.toggle('rotate-180');
                        }
                    }
                });
            });
        </script>
</body>

</html>
