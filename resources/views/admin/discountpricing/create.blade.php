@extends('admin.layouts.admin')
@section('page_title')
    Add Discount Pricing
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Discount Pricing's</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('discountpricing.index') }}"
                                class="btn btn-dark">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Discount Pricing</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('discountpricing.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                        <label> Customer Group<span class="required-star">*</span></label>
                                        <select class="form-control" name="customer_group_id" style="width: 100%"
                                            required>
                                            <option value="1">Group 1</option>
                                            <option value="2">Group 2</option>
                                        </select>
                                        @error('groups')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Brand </label>
                                        <input type="text" maxlength="50" class="form-control" name="brand" id="brand"
                                            placeholder="Enter Brand ">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 ">
                                        <label> Product<span class="required-star">*</span></label>
                                        <select class="form-control" name="product_id" style="width: 100%" required>
                                            <option value="1">Product 1</option>
                                            <option value="2">Product 2</option>
                                        </select>
                                        @error('groups')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>CTN Quantity </label>
                                        <input type="number" min="1" class="form-control" name="ctn_qty" id="ctn_qty">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Discount Rate % </label>
                                        <input type="number" min="1" class="form-control" name="discount_rate"
                                            id="discount_rate">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">
                                        <label>Or More </label>
                                        <select class="form-control" name="or_more" style="width: 100%" required>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 col-xs-12">

                                        <label>Active </label>
                                        <select class="form-control" name="is_active" style="width: 100%" required>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>



                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Start Date </label>
                                        <input type="date" class="form-control" name="start_date" id="start_date">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <label>Finish Date </label>
                                        <input type="date" class="form-control" name="finish_date" id="finish_date">
                                    </div>


                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('scripts')

    <script>
        document.getElementById("registrationForm").onsubmit = function(e) {
            firstNameValidation();
            // lastNameValidation();
            emailAddressValidation();
            // mobileNumberValidation();
            passwordValidation();
            confirmPasswordValidation();

            if (firstNameValidation() == true &&
                emailAddressValidation() == true &&
                passwordValidation() == true &&
                confirmPasswordValidation() == true) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "POST",
                    data: formData,
                    url: '{{ route('customer.store') }}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        if (response.status == "success") {
                            $('#submit').hide();
                            Swal.fire({
                                position: 'top-end',
                                toast: true,
                                showConfirmButton: false,
                                timer: 2000,
                                icon: 'success',
                                title: response.message,
                            });
                            setTimeout(function() {
                                $(".alert-success").fadeOut("slow");
                                window.location.href = "{{ route('customer.index') }}";
                            }, 2000);
                        }

                    },
                });
            } else {
                return false;
            }
        }


        //  Name Validation
        var firstName = document.getElementById("firstName");

        var firstNameValidation = function() {
            firstNameValue = firstName.value.trim();
            // validFirstName = /^[A-Za-z]+$/;
            validFirstName = /^\w+$/;
            firstNameErr = document.getElementById('first-name-err');

            if (firstNameValue == "") {
                firstNameErr.innerHTML = "name is required";
            } else if (!validFirstName.test(firstNameValue)) {
                firstNameErr.innerHTML = " Username must contain only letters, numbers and underscores!";
            } else {
                firstNameErr.innerHTML = "";
                return true;
            }
        }
        firstName.oninput = function() {
            firstNameValidation();
        }

        // Email Address Validation
        var emailAddress = document.getElementById("emailAddress");
        var emailAddressValidation = function() {
            emailAddressValue = emailAddress.value.trim();
            validEmailAddress = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            emailAddressErr = document.getElementById('email-err');

            if (emailAddressValue == "") {
                emailAddressErr.innerHTML = "Email Address is required";
            } else if (!validEmailAddress.test(emailAddressValue)) {
                emailAddressErr.innerHTML = "Email Address must be in valid formate with @ symbol";
            } else {
                emailAddressErr.innerHTML = "";
                return true;
            }
        }

        emailAddress.oninput = function() {
            var startTimer;
            let email = $(this).val();
            startTimer = setTimeout(checkEmail, 500, email);
            emailAddressValidation();
        }


        function checkEmail(email) {
            emailAddressErr = document.getElementById('email-err');
            $('#email-error').remove();
            if (email.length > 1) {
                $.ajax({
                    type: 'post',
                    url: "{{ route('customer.checkEmail') }}",
                    data: {
                        email: email,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success == false) {
                            emailAddressErr.innerHTML = data.message[0];
                            // $('#email').after('<div id="email-err" class="text-danger" <strong>'+data.message[0]+'<strong></div>');
                        } else {
                            emailAddressErr.innerHTML = data.message;
                            // $('#email').after('<div id="email-err" class="text-success" <strong>'+data.message+'<strong></div>');
                        }

                    }
                });
            } else {
                $('#email').after(
                    '<div id="email-error" class="text-danger" <strong>Email address can not be empty.<strong></div>');
            }
        }



        // Password Validation
        var password = document.getElementById("password");;

        var passwordValidation = function() {
            passwordValue = password.value.trim();
            re = /[0-9]/;
            re1 = /[a-z]/;
            re2 = /[A-Z]/;
            passwordErr = document.getElementById('password-err');

            if (passwordValue == "") {
                passwordErr.innerHTML = "Password is required";
            } else if (!re.test(passwordValue)) {
                passwordErr.innerHTML = "Error: password must contain at least one number (0-9)!";
            } else if (!re1.test(passwordValue)) {
                passwordErr.innerHTML = "Error: password must contain at least one lowercase letter (a-z)!";
                return false;
            } else if (!re2.test(passwordValue)) {
                passwordErr.innerHTML = "Error: password must contain at least one uppercase letter (A-Z)!";
                return false;
            } else {
                passwordErr.innerHTML = "";
                return true;
            }
        }

        password.oninput = function() {

            passwordValidation();

            confirmPasswordValidation();

        }

        // Confirm Password Validation
        var confirmPassword = document.getElementById("confirmPassword");;

        var confirmPasswordValidation = function() {
            confirmPasswordValue = confirmPassword.value.trim();

            confirmPasswordErr = document.getElementById('confirm-password-err');
            if (confirmPasswordValue == "") {
                confirmPasswordErr.innerHTML = "Confirm Password is required";
            } else if (confirmPasswordValue != password.value) {
                confirmPasswordErr.innerHTML = "Confirm Password does not match";
            } else {
                confirmPasswordErr.innerHTML = "";
                return true;
            }
        }

        confirmPassword.oninput = function() {

            confirmPasswordValidation();
        }
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 select box
            $("select[name=\"validation-select2\"]").select2({
                allowClear: true,
                placeholder: "Select gear...",
            }).change(function() {
                $(this).valid();
            });
            // Initialize Select2 multiselect box
            $("select[name=\"groups[]\"]").select2({
                placeholder: "Select groups...",
            }).change(function() {
                $(this).valid();
            });
        });
    </script>
@endsection
