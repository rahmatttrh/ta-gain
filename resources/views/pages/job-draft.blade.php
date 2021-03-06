<x-app-layout>
  @section('title')
  Draft Job Order
  @endsection
  <x-header><span class="font-bold">LIST</span> DRAFT JOB ORDER</x-header>

  <!-- <x-menu-job></x-menu-job> -->
  <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
    <div class="w-full overflow-x-auto">

      <table class="w-full whitespace-no-wrap">
        <thead>
          <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Client</th>
            <th class="px-4 py-3">Jumlah Site</th>
            <th class="px-2 py-3"></th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
          @foreach ($joborders as $key => $pelanggan)
          <tr class="text-gray-500 dark:text-gray-400 ">
            <td class="px-4 py-3">
              {{ ($joborders->currentpage()-1) * $joborders->perpage() + $key + 1 }}
            </td>
            <td class="px-4 py-3">
              <p class="text-sm ">
                {{$pelanggan->nama}}
              </p>
            </td>
            <td class="px-4 py-3">
              <p class="text-sm">
                {{$pelanggan->jumlah_site}}
              </p>
              
            </td>
            <td class="px-2 py-3 text-xs ">
              <a href="{{route('job.draft.detail', $pelanggan->id)}}" class=" bg-teal-600   text-gray-100 py-1 px-4 pr-8 rounded-full leading-tight hover:bg-blue-400">
                Detail</a>
                
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</x-app-layout>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
  $(document).ready(function() {
    $('.tanggal').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
  });

  var total = document.getElementById("total");

  $(function() {

    $("#selectall").change(function() {
      if (this.checked) {
        $(".case").each(function() {
          this.checked = true;
        });
        var jumlahCheck = $(".case").length;
      } else {
        $(".case").each(function() {
          this.checked = false;
        });
        var jumlahCheck = 0;
      }

      // menampilkan output ke elemen hasil
      total.innerHTML = jumlahCheck;
      // console.log(jumlahCheck);
    });

    $(".case").click(function() {
      if ($(this).is(":checked")) {
        var isAllChecked = 0;
        var jumlahCheck = $('input:checkbox:checked').length;

        $(".case").each(function() {
          if (!this.checked)
            isAllChecked = 1;
        });

        if (isAllChecked == 0) {
          $("#selectall").prop("checked", true);

          jumlahCheck = $(".case").length;
        }


      } else {
        $("#selectall").prop("checked", false);

        jumlahCheck = $('input:checkbox:checked').length;
      }
      total.innerHTML = jumlahCheck;
      console.log(jumlahCheck);

    });


  });

  function konfirmasi() {
    confirm("Apakah anda yakin ingin mensubmit penyaluran ?");
  }
</script>