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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">


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

    /* Datatable */

    .dataTables_wrapper{
      padding: 10px;
    }
    .dataTables_wrapper select,
		.dataTables_wrapper .dataTables_filter input {
			color: #6b6b6b; 			/*text-gray-700*/
			padding-left: 1rem; 		/*pl-4*/
			padding-right: 1rem; 		/*pl-4*/
			padding-top: .5rem; 		/*pl-2*/
			padding-bottom: .5rem; 		/*pl-2*/
			line-height: 1.25; 			/*leading-tight*/
			border-width: 2px; 			/*border-2*/
			border-radius: .25rem; 		
			border-color: #edf2f7; 		/*border-gray-200*/
			background-color: #edf2f7; 	/*bg-gray-200*/
      size: 10ex;
		}

		/*Row Hover*/
		table.dataTable.hover tbody tr:hover, table.dataTable.display tbody tr:hover {
			background-color: #ebf4ff;	/*bg-indigo-100*/
		}
		
		/*Pagination Buttons*/
		.dataTables_wrapper .dataTables_paginate .paginate_button		{
			font-weight: 400;				/*font-bold*/
      font-size: 14px;
			border-radius: .25rem;			/*rounded*/
			border: 1px solid transparent;	/*border border-transparent*/
		}
    .dataTables_info,
    .dataTables_length {
    font-size: 14px;
    color: #a5a3a3 !important;
    }
		
		/*Pagination Buttons - Current selected */
		.dataTables_wrapper .dataTables_paginate .paginate_button.current	{
			color: #fff !important;				/*text-white*/
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); 	/*shadow*/
			font-weight: 500;					
			border-radius: .25rem;				/*rounded*/
			background: #667eea !important;		/*bg-indigo-500*/
			border: 1px solid transparent;		/*border border-transparent*/
		}

		/*Pagination Buttons - Hover */
		.dataTables_wrapper .dataTables_paginate .paginate_button:hover		{
			color: #fff !important;				/*text-white*/
			/* box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);	 shadow */
			/* font-weight: 700;					font-bold */
			border-radius: .25rem;				/*rounded*/
      cursor: pointer !important;
			background: #d5d5d8 !important;		/*bg-indigo-500*/
			border: 1px solid transparent;		/*border border-transparent*/
		}

    .dataTables_length, .dataTables_length select{ font-size: 1em;}
		
		/*Add padding to bottom border */
		table.dataTable.no-footer {
			border-bottom: 1px solid #e2e8f0;	/*border-b-1 border-gray-300*/
			margin-top: 0.75em;
			margin-bottom: 0.75em;
		}
		
		/*Change colour of responsive icon*/
		table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
			background-color: #667eea !important; /*bg-indigo-500*/
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
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  
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


  <script >
		$(document).ready(function() {
			$('.basic-datatables').DataTable({
        responsive: true
			})

			$('.multi-filter-select').DataTable( {
				"pageLength": 7,
        "lengthChange": false,
        // "scrollX": true,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control-sm"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>

</body>

</html>