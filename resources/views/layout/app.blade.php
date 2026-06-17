
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
{{-- <title>{{ $seo->{$title} ?? '' }}</title> --}}
<base href="/" />
{{-- <meta name="keywords" content="{{ $seo->{$keywords} ?? '' }}">
<meta name="description" content="{{ $seo->{$description} ?? '' }}">
    <link rel="canonical" href="{{ url()->current() }}" /> --}}
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="{{ asset('/assests/icons/favicon.png') }}">
 
<meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
{{-- <meta property="og:title" content="{{ $seo->{$title} ?? '' }}">
  <meta property="og:description" content="{{$seo->$description??''}}"> --}}
 {{-- <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@whizz_act">
    <meta name="twitter:creator" content="@whizz_act">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index">
    <meta name="robots" content="index, follow">
 <meta property="og:url" content="{{Request::fullUrl()}}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="whizzact.com"> --}}
    
       <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'crimson-red': {
                            500: '#dc2626', 
                            600: '#b91c1c', 
                        },
                    },
                    // Define a custom screen size '2xl' to be 1980px 
                    // (though we will use a custom width utility for the container itself)
                    screens: {
                        'lg': '1024px', 
                        '2xl': '1980px', // Used for larger layouts if needed
                    },
                    // Define a custom max-width utility class: max-w-1980
                    maxWidth: {
                        '1980': '1980px', 
                    }
                }
            }
        }
    </script>
      @yield('style')
  </head>

  <body class="bg-gray-50 font-sans antialiased text-gray-800">
    @yield('content')

</body>
@yield('script')
    <script>
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const body = document.body;

        function toggleSidebar() {
            const isSidebarOpen = sidebar.classList.contains('translate-x-0');
            
            if (isSidebarOpen) {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                backdrop.classList.remove('opacity-50', 'pointer-events-auto');
                backdrop.classList.add('opacity-0', 'pointer-events-none');
                body.classList.remove('overflow-hidden'); // Allow scrolling again
            } else {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                backdrop.classList.remove('opacity-0', 'pointer-events-none');
                backdrop.classList.add('opacity-50', 'pointer-events-auto');
                body.classList.add('overflow-hidden'); // Prevent background scrolling
            }
        }

        // Attach event listeners
        menuButton.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar); // Close sidebar when clicking backdrop

        // Close sidebar on large screens if it was opened on mobile
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) { // 1024px is the 'lg' breakpoint in Tailwind
                // Ensure sidebar is in its desktop state when resizing up
                sidebar.classList.remove('-translate-x-full', 'translate-x-0');
                backdrop.classList.remove('opacity-50', 'pointer-events-auto');
                backdrop.classList.add('opacity-0', 'pointer-events-none');
                body.classList.remove('overflow-hidden');
            }
        });
    </script>

  
</html>
