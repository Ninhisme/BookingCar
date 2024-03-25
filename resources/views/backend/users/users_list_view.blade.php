@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Quản lý user</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-user' ></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý user</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Quản lý tài khoản</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>STT</th>
										<th>Name</th>
										<th>Username</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>
                                     

									</tr>
								</thead>
								<tbody>
                                    @php ($i = 1)
                                    @foreach ($dataUser as $item )
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->username}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->role}}</td>
                                            <td>
                                                @if($item->status == 'active')
                                                    <div class="badge rounded-pill bg-light-success text-success w-100">{{$item->status}}</div>
                                                @elseif ($item->status == 'inactive')
                                                    <div class="badge rounded-pill bg-light-danger text-danger w-100">{{$item->status}}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex order-actions">	
                                                    <a href="{{route('edit.account.user', $item->id) }}" class=""><i class="bx bx-cog"></i></a>
                                                    <a href="{{route('delete.account.user', $item->id) }}" class="ms-4 " id="delete"><i class='bx bxs-trash-alt'></i></i></a>
                                                </div>
                                            </td>
                                            {{-- <td>{{$item->status}}</td> --}}

                                    
                                        </tr>
                                    @endforeach    
                                    
									
									
								</tbody>
								<tfoot>
									<tr>
										<th>STT</th>
										<th>Name</th>
										<th>Username</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>


@endsection