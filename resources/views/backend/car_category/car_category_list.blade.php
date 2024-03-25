@extends('admin.admin_dashboard')

@section('admin')



<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản lý xe</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-car'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý loại xe</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('car.category.add')}}" class="btn btn-primary">Thêm loại xe</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Quản lý loại xe</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>STT</th>
										<th>Tên loại xe</th>
										<th>Ảnh</th>
										<th>Cước xe (dưới 30km)</th>
										<th>Cước xe (trên 30km)</th>
										<th>Status</th>
										<th>Action</th>
                            
									</tr>
								</thead>
								<tbody>
                                      
                                @foreach ($carcategory as $key =>$item )
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->car_category_name}}</td>
                                        <td><img src="{{asset($item->car_category_img)}}" style="width: 70px; height:40px;" ></td>
                                        <td>{{$item->car_fare_under_30}}đ/1km</td>
                                        <td>{{$item->car_fare_up_30}}đ/1km</td>
                                        <td>
                                            @if($item->status == 'active')
                                                <div class="badge rounded-pill bg-light-success text-success w-100">{{$item->status}}</div>
                                            @elseif ($item->status == 'inactive')
                                                <div class="badge rounded-pill bg-light-danger text-danger w-100">{{$item->status}}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('car.category.edit', $item->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{route('car.category.delete', $item->id)}}" class="btn btn-danger" id="delete">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
									
									
								</tbody>
								<tfoot>
									<tr>
										<th>STT</th>
										<th>Tên loại xe</th>
										<th>Ảnh</th>
										<th>Cước xe (dưới 30km)</th>
										<th>Cước xe (trên 30km)</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>


@endsection