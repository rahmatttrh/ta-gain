<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>PT GAIN - @yield('title')</title>
  <link rel="icon" href="{{asset('img/logo.png')}}">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

  <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />


  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/init-alpine.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

  <style>
    #main::-webkit-scrollbar {
      width: 8px;
    }

    #main::-webkit-scrollbar-track {
      background: #ececec;
    }

    #main::-webkit-scrollbar-thumb {
      background: rgb(41, 115, 252);
    }

    aside::-webkit-scrollbar {
      width: 5px;
    }

    aside::-webkit-scrollbar-track {
      background: #ececec;
    }

    aside::-webkit-scrollbar-thumb {
      background: rgb(23, 101, 245);
    }
  </style>
</head>

<body class="font-sans antialiased">
  <div class="flex h-screen bg-gray-50 dark:bg-gray-800" :class="{ 'overflow-hidden': isSideMenuOpen }">

    @include('layouts.sidebar')
    @include('layouts.sidebar-mobile')

    <div class="flex flex-col flex-1 w-full">
      @include('layouts.navigation')
      <!-- Page Content -->
      <main id="main" class="h-full overflow-y-auto">
        <div class="container px-6 py-4 mx-auto grid">
          {{ $slot }}
        </div>
      </main>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

  <!-- jQuery Modal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2();
    });

    $(".delete").click(function(e) {
      // event.preventDefault();
      event.preventDefault();
      id = e.target.dataset.id;
      swal({
          title: "Anda yakin?",
          text: "Anda akan menghapus data.",
          icon: "warning",
          buttons: ["Batal", "Hapus"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Berhasil! Data telah dihapus!", {
              icon: "success",
            });
            $(`#delete`).submit();
          } else {
            swal("Batal menghapus.");
          }
        });
    })
    
  </script>

  <script>
  function deleteRow(id)
    {
      swal({
          title: "Yakin?",
          text: "Data akan terhapus!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
              $('#data-'+id).submit();
          }
      });
      }
  </script>
  
  <script>
    $(".payment").click(function(e) {
      // event.preventDefault();
      event.preventDefault();
      id = e.target.dataset.id;
      swal({
          title: "Payment",
          text: "Anda yakin sudah melakukan Payment?",
          icon: "warning",
          buttons: ["Batal", "Ya"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Berhasil! Konfirmasi payment!", {
              icon: "success",
            });
            $(`#payment`).submit();
          } else {
            swal("Batal.");
          }
        });
    })
  </script>


  <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
  @stack('maps')
  @if (session('berhasil'))
  <script>
    $(document).ready(function() {
      swal("OK!", "{!! Session::get('berhasil') !!}", "success");
    })
  </script>
  @endif

  @if (session('warning'))
  <script>
    $(document).ready(function() {
      swal("GAGAL!", "{!! Session::get('warning') !!}", "warning");
    })
  </script>
  @endif

</body>

</html>