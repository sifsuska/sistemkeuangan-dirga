      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Kantor Desa Tarai Bangun 2021</span>
          </div>
        </div>
      </footer>
      <script type="text/javascript">
    $(document).ready(function() {
      $('#input-tanggal1').datepicker({
        dateFormat: 'yy-mm-dd'
      });
      $('#form-tanggal, #form-bulan, #form-tahun').hide();
      $('#filter').change(function() {
        if ($(this).val() == '1') {
          $('#form-bulan, #form-tahun').hide();
          $('#form-tanggal').show();


        } else if ($(this).val() == '2') {
          $('#form-tanggal').hide();
          $('#form-bulan, #form-tahun').show();
        } else {
          $('#form-tanggal, #form-bulan').hide();
          $('#form-tahun').show();
        }

        $('#form-tanggal input, #form-bulan select, #form-tahun select').val('');
      })
    })
  </script>
      <!-- End of Footer -->