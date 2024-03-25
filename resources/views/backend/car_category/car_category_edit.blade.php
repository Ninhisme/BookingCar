@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản lý xe</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-car'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa thông tin loại xe</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>

    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                        
                        <form id="myForm" method="POST" action="{{route('car.category.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$carCategory->id}}">
                            <input type="hidden" name="old_image" value="{{$carCategory->car_category_img}}">

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tên loại xe</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input  type="text" name="car_category_name" class="form-control"  value="{{$carCategory->car_category_name}}" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{!! 'Cước phí (<30km)' !!}</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" name="car_fare_under" value="{{$carCategory->car_fare_under_30}}" placeholder="10.000" class="form-control"   />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{!! 'Cước phí (>30km)' !!}</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" name="car_fare_up" value="{{$carCategory->car_fare_up_30}}" placeholder="10.000" class="form-control"  />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <select name="status" class="form-select" id="inputVendor">
                                    <option></option>
                                    <option {{$carCategory->status ==='active' ? 'selected' : ''}} value="active">Active</option>
                                    <option {{$carCategory->status ==='inactive' ? 'selected' : ''}} value="inactive">Inactive</option>
                                    
                                  </select>
                                </div>
                                
                              </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ảnh loại xe</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file"  name="car_category_img" class="form-control" value="" id="image"/>
                                </div>
                            </div>

                            

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"></h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{asset($carCategory->car_category_img)}}" alt="Admin"  style="width: 100px; height: 100px;">

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Lưu thay đổi" />
                                </div>
                            </div>
                        </div>
                            
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


 <script type="text/javascript">
    
        $(document).ready(function (){
            
            $('#myForm').validate({
              
                rules: {
                    car_category_name:{
                        required: true,
                    },

                   
                },

                messages: {
                    car_category_name: {
                        required: 'Hãy nhập thông tin loại xe',
                    },

                
                },
                errorElement : 'span',
                errorPlacement: function (error, element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    
 </script>

{{-- Đổi ảnh khi bắt sự kiện đổi trong input photo --}}
<script type="text/javascript">
    $(function(){
        $('input[type="file"]').change(function(e){ // Thay 'image' bằng 'input[type="file"]'
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result); // Thay 'e.targer' thành 'e.target'
            }
            reader.readAsDataURL(e.target.files[0]); // Thay 'e.targer' thành 'e.target' và 'files['0']' thành 'files[0]'
        });
    });
</script>


@endsection