@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 form-group">
        <div class="breadcrumb-title pe-3">Tin tức</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-news'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm tin tức</li>
                </ol>
            </nav>
        </div>
       
    </div>

    	

      <div class="card">
          <div class="card-body p-4">
              <h5 class="card-title">Thêm tin tức</h5>
              <hr/>
              <form id="myForm" class="form-body mt-4" method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
                @csrf     
               
                <div class="row">
                   <div class="col-lg-8">
                   <div class="border border-3 p-4 rounded">
                    <div class="mb-3 form-group">
                        <label for="inputProductTitle" class="form-label">Tên bài viết</label>
                        <input type="text" name="news_title" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                      </div>

                      <div class="mb-3 form-group">
                        <label for="inputProductType" class="form-label">Thể loại bài viết</label>
                        <select name="id_news_category" class="form-select" id="inputProductType">
                            <option class="option-news"></option>
                            @foreach ($newsCategory as $item )
                                <option value="{{$item->id}}">{{$item->news_categories_name	}}</option>
                                 @endforeach
                          </select>
                      </div>

                      <div class="mb-3 form-group">
                        <label for="inputProductDescription" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="inputProductDescription" rows="3"></textarea>
                      </div>
                       <div class="row mb-3 form-group">
                            <label for="inputProductDescription" class="form-label">Thumbnail</label>
                                <div class="text-secondary">
                                    <input type="file" name="thumbnail" class="form-control" value="" id="image"/>
                                </div>
                        </div>

                            <div class="row mb-3 form-group">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"></h6>
                                </div>
                                <div class="text-secondary">
                                    <img id="showImage" src="{{url('upload/no_image.jpg')}}" alt="Admin"  style="width: 100px; height: 100px;">

                                </div>
                            </div>

                        <div class="mb-3 form-group">
                            <label for="inputProductDescription" class="form-label">Content</label>
                            <textarea style=""  name="content" id="content" rows="3"></textarea>
                        </div>
                    </div>
                   </div>
                   <div class="col-lg-4">
                    <div class="border border-3 p-4 rounded">
                      <div class="row g-3">
                        
                          <div class="col-12 form-group">
                            <label for="inputProductType" class="form-label">Status</label>
                            <select name="status" class="form-select" id="inputVendor">
                                <option></option>
                                <option value="active">Active</option>
                                <option  value="inactive">Inactive</option>
                            </select>
                                
                          </div>
                          
                          <div class="col-12">
                              <div class="d-grid">
                                 <button type="submit" class="btn btn-primary">Thêm tin tức</button>
                              </div>
                          </div>
                      </div> 
                  </div>
                  </div>
               </div><!--end row-->
            </form>
            </div>
          </div>
      </div>




    <script type="text/javascript">
    
        $(document).ready(function (){
            
            $('#myForm').validate({
              
                rules: {
                    news_title:{
                        required: true,
                    },

                    description:{
                        required: true,
                    },

                    content:{
                        required: true,
                    },

                    status:{
                        required: true,
                    },

                    id_news_category	:{
                        required: true,
                    },

                    thumbnail:{
                        required: true,
                    },

                },

                messages: {
                    news_title: {
                        required: 'Hãy nhập tên bài viết!',
                    },

                    description:{
                        required: 'Hãy nhập mô tả bài viết!',
                    },

                    content:{
                        required: 'Hãy nhập nội dung bài viết!',
                    },

                    status:{
                        required: 'Hãy chọn trạng thái bài viết!',
                    },

                    id_news_category	:{
                        required: 'Hãy chọn thể loại bài viết!',
                    },

                    thumbnail:{
                        required: 'Hãy chọn ảnh bài viết!',
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

<script>
    $('#content').summernote({
        placeholder: "Content...",
        tabsize:2,
        height:300
    })
</script>



@endsection