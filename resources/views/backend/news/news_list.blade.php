@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tin tức</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-news'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý tin tức</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('news.add')}}" class="btn btn-primary">Thêm tin tức</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Quản lý tin tức</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài viết</th>
                            <th>Thumbnail</th>
                            <th>Thể loại tin tức</th>
                            <th>Tác giả</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Action</th>                      
                        </tr>
                    </thead>
                    <tbody>
                          
                    @foreach ($news as $key =>$item )
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->news_title}}</td>
                            <td><img src="{{asset($item->thumbnail)}}" style="width: 70px; height:50px;" ></td>
                            <td><div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>{{ $item['newsCategory']['news_categories_name']}}</div></td>
                            <td>{{$item->author_name}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i d/m/Y') }}</td>
                            
                            

                            <td>
                                @if($item->status == 'active')
                                    <div class="badge rounded-pill bg-light-success text-success w-100">{{$item->status}}</div>
                                @elseif ($item->status == 'inactive')
                                    <div class="badge rounded-pill bg-light-danger text-danger w-100">{{$item->status}}</div>
                                @endif
                            </td>

                            <td>
                                <a href="{{route('new.detail', $item->id)}}" class="btn btn-secondary"><i style="margin-right: 1px;" class="fadeIn animated bx bx-search-alt"></i></a>
                                <a href="{{route('new.edit', $item->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{route('new.delete', $item->id)}}" class="btn btn-danger" id="delete">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                        
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài viết</th>
                            <th>Thumbnail</th>
                            <th>Thể loại tin tức</th>
                            <th>Tác giả</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Action</th> 
                         
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection