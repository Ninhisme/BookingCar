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
                    <li class="breadcrumb-item active" aria-current="page">Sửa thông tin xe</li>
                </ol>
            </nav>
        </div>
       
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Sửa thông tin xe</h5>
            <hr/>
            
            <form id="myForm" class="form-body mt-4" method="POST" action="{{route('car.detail.update')}}" enctype="multipart/form-data">
                @csrf         
                <input type="hidden" name="id" value="{{$carDetail->id}}">
              <div class="row">
                 <div class="col-lg-8">
                 <div class="border border-3 p-4 rounded">
                  <div class="mb-3 form-group">
                      <label for="inputProductTitle" class="form-label">Tên xe</label>
                      <input type="text" name="car_name" class="form-control" value="{{$carDetail->car_name}}" id="inputProductTitle" placeholder="Nhập tên xe">
                    </div>

                    <div class="mb-3">
                        <label for="inputProductType" class="form-label">Loại xe</label>
                        <select name="car_category_id" class="form-select" id="inputProductType">
                            <option></option>
                    

                            @foreach ($carCategory as $item )
                                <option value="{{$item->id}}" {{$item->id  == $carDetail->car_category_id ? 'selected' : ''}}>{{$item->car_category_name}}</option>
                            @endforeach
                            
                          
                          </select>
                      </div>

                      <div class="mb-3 form-group">
                        <label for="inputProductTitle" class="form-label">Sức chứa đồ</label>
                        <input type="text" name="storage" value="{{$carDetail->storage}}" class="form-control" id="inputProductTitle" placeholder="Nhập sức chứa">
                      </div>

                    
                
                  </div>
                 </div>
                 <div class="col-lg-4">
                  <div class="border border-3 p-4 rounded">
                    <div class="row g-3">
                      <div class="col-md-6 form-group">
                          <label for="inputPrice" class="form-label">Số lượng chỗ:</label>
                          <input type="number" min="0" value="{{$carDetail->seat}}"  name="seat" class="form-control" id="inputPrice" placeholder="0">
                        </div>
                        <div class="col-md-6 form-group">
                          <label for="inputCompareatprice" class="form-label">Giá tiền</label>
                          <input type="text" name="price" value="{{$carDetail->price}}" class="form-control" id="inputCompareatprice" placeholder="120.000">
                        </div>

                        <div class="col-12">
                            <label for="inputVendor" class="form-label">Trạng thái</label>
                            <select class="form-select" name="status" id="inputVendor">
                                <option></option>
                                <option {{$carDetail->status ==='Hoạt động' ? 'selected' : ''}} value="Hoạt động">Hoạt động</option>
                                <option {{$carDetail->status ==='Dừng hoạt động' ? 'selected' : ''}} value="Dừng hoạt động">Dừng hoạt động</option>
                              </select>
                          </div>
                    
                        
                        
                        <div class="col-12">
                            <div class="d-grid">
                               <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </div>
                    </div> 
                </div>
                </div>
             </div><!--end row-->
          </form>
        </div>
    </div>


    <script type="text/javascript">
    
        $(document).ready(function (){
            
            $('#myForm').validate({
              
                rules: {
                    car_name:{
                        required: true,
                    },

                    storage:{
                        required: true,
                    },

                    seat:{
                        required: true,
                    },

                    price:{
                        required: true,
                    },
                },

                messages: {
                    car_name: {
                        required: 'Hãy nhập thông tin tên xe!',
                    },

                    storage: {
                        required: 'Hãy nhập sức chứa đồ!',
                    },

                    seat:{
                        required: 'Hãy nhập số lượng chỗ!',
                    },

                    price:{
                        required: 'Hãy nhập giá tiền!',
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

@endsection