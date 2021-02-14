<div class="card">
    <div class="card-header  font-weight-bold mr-auto">
        <!-- JavaScript Validation -->
    </div>
    <div class="card-body">
        <form class="needs-validation" novalidate>
            <div class="form-group">
                <label>Nama Siswa</label>
                <input type="text" class="form-control" required="">
                <div class="invalid-feedback">
                    Masukkan Nama
                </div>
            </div>
            <div class="form-group">
                <label>Kelas Siswa</label>
                <input type="email" class="form-control" required="">
                <div class="invalid-feedback">
                    Masukkan Kelas
                </div>
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input type="email" class="form-control">
                <div class="valid-feedback">
                    Masukkan Semester
                </div>
            </div>
            <div class="form-group mb-0">
                <label>Alamat</label>
                <textarea class="form-control" required=""></textarea>
                <div class="invalid-feedback">
                    Masukkan Alamat
                </div>
            </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
