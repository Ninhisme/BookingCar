@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit User</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Infor User</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Edit Info User</h5>
          <hr/>
           <div class="form-body mt-4">
            <form method="POST" action="{{route('admin.user.store')}}" enctype="multipart/form-data">
                @csrf 
            <input type="hidden" name="id" value="{{$dataUser->id}}">
            <div class="row">
               <div class="col-lg-8">
                
               <div class="border border-3 p-4 rounded">
                <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" id="inputProductTitle" placeholder="Enter full name" value="{{$dataUser->name}}">
                  </div>

                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">User Name</label>
                    <input type="text" name="username" class="form-control" id="inputProductTitle" placeholder="Enter user name" value="{{$dataUser->username}}">
                  </div>

                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputProductTitle" disabled placeholder="Enter email" value="{{$dataUser->email}}">
                  </div>

                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" id="inputProductTitle" placeholder="Enter phone" value="{{$dataUser->phone}}">
                  </div>

                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="inputProductTitle" placeholder="Enter address" value="{{$dataUser->address}}">
                  </div>

                </div>
               </div>
               <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">
                    
                      <div class="col-12">
                        <label for="inputProductType" class="form-label">Role</label>
                        <select name="role" class="form-select" id="inputProductType" >
                            <option></option>
                            <option {{$dataUser->role ==='admin' ? 'selected' : ''}} value="admin">Admin</option>
                            <option {{$dataUser->role ==='author' ? 'selected' : ''}} value="author">Author</option>
                            <option {{$dataUser->role ==='user' ? 'selected' : ''}} value="user">User</option>
                          </select>
                      </div>
                      <div class="col-12">
                        <label for="inputVendor" class="form-label">Status</label>
                        <select name="status" class="form-select" id="inputVendor">
                            <option></option>
                            <option {{$dataUser->status ==='active' ? 'selected' : ''}} value="active">Active</option>
                            <option {{$dataUser->status ==='inactive' ? 'selected' : ''}} value="inactive">Inactive</option>
                            
                          </select>
                      </div>
                      
                      <div class="col-12">
                          <div class="d-grid">
                             <button type="submit" class="btn btn-primary">Save Product</button>
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

</div>

@endsection