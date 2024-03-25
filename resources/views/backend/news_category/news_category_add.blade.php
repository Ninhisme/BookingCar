@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tin tức</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-news'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chuyên mục tin tức</li>
                </ol>
            </nav>
        </div>
       
    </div>

    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                        
                        <form id="myForm" method="POST" action="{{route('news.category.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Tên mục tin tức</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input   type="text" name="news_category_name" class="form-control"  value="" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Thêm tin tức" />
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
                    news_category_name:{
                        required: true,
                    },

                },

                messages: {
                    news_category_name: {
                        required: 'Hãy nhập thông tin mục tin tức!',
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