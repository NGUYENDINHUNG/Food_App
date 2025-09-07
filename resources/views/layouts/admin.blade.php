<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - FoodApp</title>
    @vite(['resources/css/admin/sidebar.css', 'resources/js/app.js'])
    @livewireStyles
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('livewire.admin.partials.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @include('livewire.admin.partials.navbar')
                <div class="container-fluid">
                    {{-- //thành công --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- lỗi --}}
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>
    @livewireScripts
    @stack('scripts')
</body>

</html>
