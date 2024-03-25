<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('adminbackend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin </h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Quản lý</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-user' ></i>
                </div>
                
                <div class="menu-title">Quản lý user</div>
            </a>
            <ul>
                <li> <a href="{{route('manage.users.list')}}"><i class="bx bx-right-arrow-alt"></i>Quản lý user</a>
                </li>

                
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-car'></i>
                </div>
                
                <div class="menu-title">Quản lý xe</div>
            </a>
            <ul>
                <li> <a href="{{route('car.category.list')}}"><i class="bx bx-right-arrow-alt"></i>Quản lý loại xe</a>
                </li>

                <li> <a href="{{route('car.detail.list')}}"><i class="bx bx-right-arrow-alt"></i>Thông tin chi tiết xe</a>
                </li>
                {{-- {{route('car.detail.list')}} --}}
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-news'></i>
                </div>
                <div class="menu-title">Tin tức</div>
            </a>
            <ul>
                <li> <a href="{{route('news.category.list')}}"><i class="bx bx-right-arrow-alt"></i>Chuyên mục tin tức</a>
                </li>
                <li> <a href="{{route('news.list')}}"><i class="bx bx-right-arrow-alt"></i>Quản lý tin tức</a>
                </li>
                
            </ul>
        </li>
        <li class="menu-label">Quản lý đặt xe</li>
        
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Danh sách đặt xe</div>
            </a>
            <ul>
                <li> <a href="{{route('booking.car.list')}}"><i class="bx bx-right-arrow-alt"></i>Danh sách đặt xe</a>
                </li>
                <li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Thêm đặt xe</a>
                </li>

                </li>
            </ul>
        </li>

       
    

       
      
      

        <li class="menu-label">Charts & Maps</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Charts</div>
            </a>
            <ul>
                <li> <a href="charts-apex-chart.html"><i class="bx bx-right-arrow-alt"></i>Apex</a>
                </li>
                <li> <a href="charts-chartjs.html"><i class="bx bx-right-arrow-alt"></i>Chartjs</a>
                </li>
                <li> <a href="charts-highcharts.html"><i class="bx bx-right-arrow-alt"></i>Highcharts</a>
                </li>
            </ul>
        </li>
  



        <li>
            <a href="" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>