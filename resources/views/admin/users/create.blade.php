<style>
    .swal2-container {
        z-index: 10000000;
    }
</style>
<div class="container py-5 max-w-700px">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <h3 class="card-title">
                Create User
            </h3>
        </div>
        <form class="form" id="users_form" method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Full Name <span class="text-danger">*</span></label>
                    <div class="col-lg-8 col-8">
                        <input type="text" class="form-control border-primary" id="name" placeholder="Input Fullname" name="fullname">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Email <span class="text-danger">*</span></label>
                    <div class="col-lg-8 col-8">
                        <input type="email" class="form-control border-primary" id="email" placeholder="Input Email" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Password <span class="text-danger">*</span></label>
                    <div class="col-lg-8 col-8">
                        <input id="password" type="password" class="form-control border-primary" name="password" placeholder="Masukkan Password" required autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Repeat Password <span class="text-danger">*</span></label>
                    <div class="col-lg-8 col-8">
                        <input id="password-confirm" type="password" class="form-control border-primary" name="password_confirmation" required placeholder="Ulangi Password" autocomplete="new-password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-4 col-form-label">Role <span class="text-danger">*</span></label>
                    <div class="col-lg-8 col-8 col-form-label">
                        <div class="checkbox-list">
                            @foreach($roles as $role)
                            <label class="checkbox">
                                <input id="{{ $role->roles.$role->id }}" type="radio" name="role" value="{{ $role->id }}">
                                <span></span>{{ $role->roles }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right ">
                <button type="submit" id="btnSubmit" class="btn btn-primary mr-2">Simpan</button>
                <button type="button" class="btn btn-warning" onclick="$.fancybox.close()">Batal</button>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
<script type="text/javascript">

    jQuery(document).ready(function () {
        $('#users_form').on('submit', function (e) {
            e.preventDefault();
            $("#btnSubmit").prop("disabled", true);
            $.ajax({
                url: $(this).attr("action"),
                type: 'POST',
                dataType: "JSON",
                timeout: 10000,
                data: $(this).serialize(),
                success: function (data) {
                    if (data.status == "failed") {
                        toastr.error("Ops, " + data.msg);
                        $("#btnSubmit").prop("disabled", false);
                    } else {
                        Swal.fire({
                            title: 'Berhasil Tersimpan',
                            text: data.msg,
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = "{{ route('users.index') }}";
                        })
                    }
                },
                error: function (x, t, m) {
                    $("#btnSubmit").prop("disabled", false);
                }
            });
        });
    });
</script>