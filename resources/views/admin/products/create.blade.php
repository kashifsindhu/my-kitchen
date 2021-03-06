@extends('admin.layouts.admin')
@section('page_title')
    Add Product
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="btn btn-dark">Back</a>
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
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('product.store') }}" method="POST" onsubmit="return validateForm()" id="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Name <span class="required-star">*</span></label>
                                        <input type="text" maxlength="50"
                                            class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                            value="{{ old('name') }}" placeholder="Enter Product Name" >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Price <span class="required-star">*</span></label>
                                        <input type="number"  step="any"
                                            class="form-control price @error('price') is-invalid @enderror" name="price" id="price"
                                            value="{{ old('price') }}" placeholder="Enter Product Price" >
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <label>Image <span class="required-star">*</span></label>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" id="image_url"
                                                    class="custom-file-input @error('image_url') is-invalid @enderror "
                                                    name="image_url" accept=".png, .jpg, .jpeg" >
                                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                        </div>
                                        @error('image_url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <img src="" id="image" class="hidden w-25" />
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Sku<span class="required-star">*</span></label>
                                        <input type="number" maxlength="50"
                                            class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku"
                                            value="{{ old('sku') }}" placeholder="Enter Product Sku" >
                                        @error('sku')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>New<span class="required-star">*</span></label>
                                        <select name="new" class="form-control @error('new') is-invalid @enderror" id="">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('new')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Pack Size<span class="required-star">*</span></label>
                                        <input type="text" maxlength="50"
                                            class="form-control price  @error('pack_size') is-invalid @enderror" id="pack_size" name="pack_size"
                                            value="{{ old('pack_size') }}" placeholder="Enter Pack Size" >
                                        @error('pack_size')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 col-sm-6 col-xs-12">
                                        <label>Active<span class="required-star">*</span></label>
                                        <select name="active" class="form-control @error('active') is-invalid @enderror"
                                            id="">
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('active')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6">
                                        <label>Descriptions <span class="required-star">*</span></label>
                                        <textarea name="description" id="description" cols="15" rows="2"
                                            class="form-control text-area" >{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <table class="table table-sm table-bordered">
                                            <tr style="background-color:#95d60c !important;color:white; text-align: center;" >
                                                <th>Heading</th>
                                                <th>CTN Price</th>
                                                <th>Bottle Price</th>
                                                <th>Saleable in the market</th>
                                            </tr>
                                            @if($groups->count() > 0)
                                                @foreach ($groups as $group)
                                                    <tr>
                                                        <td style="text-align: center;">{{ $group->group_name }}</td>
                                                        <td>
                                                            <input type="hidden" value="{{ $group->id }}"
                                                                name="group_id[]">
                                                            <input type="text" maxlength="100" class="form-control price ctnPrice" name="ctn_price[]"
                                                                id="ctnPrice-{{$group->id}}" data-id="{{$group->id}}" placeholder="Enter Ctn Price E.g 00.0"
                                                                value="{{ old('ctn_price[]') }}" >
                                                        </td>
                                                        <td>
                                                            <input type="text" maxlength="100" class="form-control price bottlePrice" name="bottle_price[]"
                                                                id="bottlePrice-{{$group->id}}" data-id="{{$group->id}}" placeholder="Bottle Price"
                                                                value="{{ old('bottle_price[]') }}" readonly >
                                                        </td>
                                                        <td class="text-center"><input type="checkbox" class="form-control"
                                                            value="1" name="saleable[]" data-size="xs" data-toggle="toggle">
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" role="alert">
                                                        <div style="text-align: center;">
                                                            No Result(s) Found !
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" >Save</button>
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

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
   <script>
    $(document).ready(function () {
        
        function named(){
            $("ctn_price").each(function(){
                alert("djd");
                $(this).rules("add", {
                required: true,
                email: true,
                messages: {
                    required: "Required"
                }  
            });
            });
        }
        $('#form').validate({ 
        function : named,
        rules: {
            name: {
                required: true
            },
            sku: {
                required: true,
            },
            description: {
                required: true,
                
            },
            price: {
                required: true,    
            },
            pack_size: {
                required: true,  
            },
            // 'ctn_price[]':{
            //     required: true,  
            // },
            // 'bottle_price[]':{
            //     required: true,  
            // },
        },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
    });
});
</script> 
<script>
   
    var validateForm = function(event){
        var groups=<?php echo $groups->count(); ?> 
        
           if(groups == 0)
           {
            Swal.fire({
                position: 'top-end',
                toast: true,
                showConfirmButton: false,
                timer: 4000,
                icon: 'error',
                title: 'First Create Customer Groups',
            });
            return false;
           }
           else
           return true;
              
    };

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
                $('#image').removeClass("hidden");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_url").change(function() {
        readURL(this);
    });

    // Get Input File Name
    $('.custom-file input').change(function(e) {
        var files = [];
        for (var i = 0; i < $(this)[0].files.length; i++) {
            files.push($(this)[0].files[i].name);
        }
        $(this).next('.custom-file-label').html(files.join(','));
    });

    $(document).on('change', '.ctnPrice',function () {
        var id = $(this).data('id');
        var ctn_price = $('#ctnPrice-'+id).val();     
        var pack_size = $('#pack_size').val();
        var value = ctn_price / pack_size;
        var B_value = value.toFixed(2)
        $('#bottlePrice-'+id).val(B_value);
    });
</script>
@endsection
