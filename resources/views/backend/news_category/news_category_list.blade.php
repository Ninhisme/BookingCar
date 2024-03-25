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
                    <li class="breadcrumb-item active" aria-current="page">Chuyên mục tin tức</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('news.category.add')}}" class="btn btn-primary">Thêm mục tin tức</a>
            </div>
        </div>
    </div>


    <h6 class="mb-0 text-uppercase">Chuyên mục tin tức</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>STT</th>
										<th>Tên danh mục tin tức</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                      
                                @foreach ($newsCategory as $key =>$item )
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->news_categories_name}}</td>
                                        <td>
                                            @if($item->status == 'active')
                                                <div class="badge rounded-pill bg-light-success text-success w-100">{{$item->status}}</div>
                                            @elseif ($item->status == 'inactive')
                                                <div class="badge rounded-pill bg-light-danger text-danger w-100">{{$item->status}}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('news.category.edit', $item->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('news.category.delete', $item->id)}}" class="btn btn-danger" id="delete">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
									
									
								</tbody>
								<tfoot>
									<tr>
										<th>STT</th>
										<th>Tên danh mục tin tức</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>



@endsection
