  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
          class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets-landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets-landing/vendor/php-email-form/validate.js"></script>
  <script src="assets-landing/vendor/aos/aos.js"></script>
  <script src="assets-landing/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets-landing/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets-landing/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets-landing/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets-landing/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets-landing/js/main.js"></script>
  <script>
      function previewImage(input) {
          const preview = document.getElementById('image-preview');
          const fileNameDisplay = document.getElementById('file-name');

          if (input.files && input.files[0]) {
              const reader = new FileReader();
              fileNameDisplay.textContent = "Dipilih: " + input.files[0].name;

              reader.onload = function(e) {
                  preview.src = e.target.result;
                  preview.style.display = "block";
              }
              reader.readAsDataURL(input.files[0]);
          } else {
              preview.style.display = "none";
              fileNameDisplay.textContent = "";
          }
      }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
      flatpickr("#tanggal_lahir", {
          dateFormat: "d-F-Y",
          locale: {
              firstDayOfWeek: 1,
              weekdays: {
                  shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                  longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
              },
              months: {
                  shorthand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                      'September', 'Oktober', 'November', 'Desember'
                  ],
                  longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                      'September', 'Oktober', 'November', 'Desember'
                  ],
              }
          }
      });
  </script>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create(document.querySelector('#editor'), {
      toolbar: [
        'insertImage', 'uploadImage', '|', 'undo', 'redo'
      ],
      ckfinder: {
        // You can configure custom upload URL here
        uploadUrl: '/upload' // <-- ganti dengan handler upload milikmu jika ingin langsung upload ke server
      }
    })
    .then(editor => {
      console.log('CKEditor berhasil diinisialisasi:', editor);
    })
    .catch(error => {
      console.error('CKEditor gagal dimuat:', error);
    });
</script>



  @yield('script')
