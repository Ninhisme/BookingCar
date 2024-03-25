@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản lý đặt xe</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-category'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách đặt xe</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('car.detail.add')}}" class="btn btn-primary">Thêm xe</a>
            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Danh sách đặt xe</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Phone</th>
                            <th>Điểm đến</th>
                            <th>Điểm đi </th>
                            <th>Chiều đường đi</th>
                            <th>Loại xe</th>
                            <th>Thời gian đến</th>
                            <th>Giá tiền</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                         

                        </tr>
                    </thead>
                    <tbody>
                          
                    {{-- @foreach ($carDetail as $key =>$item )
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->car_name}}</td>
                            <td>{{ $item['carCategory']['car_category_name']}}</td>
                            <td>{{$item->seat}}</td>
                            <td>{{$item->storage}}</td>
                            <td>{{$item->price}}</td>

    
                            <td>
                                @if($item->status == 'Hoạt động')
                                    <div class="badge rounded-pill bg-light-success text-success w-100">{{$item->status}}</div>
                                @elseif ($item->status == 'Dừng hoạt động')
                                    <div class="badge rounded-pill bg-light-danger text-danger w-100">{{$item->status}}</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('car.detail.edit', $item->id)}}" class="btn btn-info">Edit</a>
                                <a href="{{route('car.detail.delete', $item->id)}}" class="btn btn-danger" id="delete">Delete</a>

                            </td>
                        </tr>
                    @endforeach --}}
                        
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Phone</th>
                            <th>Điểm đến</th>
                            <th>Điểm đi </th>
                            <th>Chiều đường đi</th>
                            <th>Loại xe</th>
                            <th>Thời gian đến</th>
                            <th>Giá tiền</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                         

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection