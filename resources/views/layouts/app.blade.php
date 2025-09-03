<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

@include('includes.head')

<body>
    @include('includes.svg')
    @include('layouts.nav')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>
    @include('includes.script')
</body>

</html>
