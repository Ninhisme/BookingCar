@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
/>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
/>

    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
/>

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
/>

<link rel="stylesheet" href="{{asset('adminbackend/assets/css/detail_blog.css')}}">
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tin tức</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-news'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết tin tức</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
          <div class="btn-group">
              <a href="{{route('new.edit', $news->id)}}" class="btn btn-primary">Sửa tin tức</a>
          </div>
      </div>
       
    </div>


    <div class="container">
        <nav id="breadcrumb">
          <a href="https://noibai.vn/">
            <span class="fa fa-home" aria-hidden="true"> </span> Trang chủ
          </a>
          <em class="delimiter">&gt;</em>
          <a href="https://noibai.vn/tin-tuc">Tin tức</a>
          <em class="delimiter">&gt;</em>
          <span class="current"
            >{{$news->news_title}}</span
          >
        </nav>
  
        <div class="single-page" bis_skin_checked="1">
          <div class="row col-mar-10" bis_skin_checked="1">
            <div class="col-lg-8" bis_skin_checked="1">
              <div class="page-detail" bis_skin_checked="1">
                <h1 class="i-title no-cabslock mar-bottom-20">
                    {{$news->news_title}}
                </h1>
                <div class="post-meta clearfix" bis_skin_checked="1">
                  <span class="single-author no-avatars">
                    <span class="meta-item meta-author-wrapper">
                      <span class="meta-item meta-author">
                        <span class="fa fa-user"></span>
                        {{$news->author_name}}
                      </span>
                    </span>
                  </span>
                  <span class="date meta-item fa-before"> {{ \Carbon\Carbon::parse($news->created_at)->format('H:i d/m/Y') }}</span>
                </div>
  
                <div class="post-footer post-footer-on-top" bis_skin_checked="1">
                  <div class="share-links" bis_skin_checked="1">
                    <div class="share-title" bis_skin_checked="1">
                      <span class="fa fa-share-alt" aria-hidden="true"></span>
                      <span> Chia sẻ</span>
                    </div>
                    <a
                      href="https://www.facebook.com/sharer.php?u=https://noibai.vn/tin-tuc/bi-kip-tranh-mat-do-tren-may-bay-bi-mat-do-tren-may-bay-phai-lam-gi-779"
                      rel="external noopener"
                      target="_blank"
                      class="facebook-share-btn large-share-button"
                    >
                      <span class="fab fa-facebook-f"></span>
                      <span class="screen-reader-text">Facebook</span>
                    </a>
                    <a
                      href="https://twitter.com/intent/tweet?text=Bí kíp tránh mất đồ trên máy bay, bị mất đồ trên máy bay phải làm gì?;url=https://noibai.vn/tin-tuc/bi-kip-tranh-mat-do-tren-may-bay-bi-mat-do-tren-may-bay-phai-lam-gi-779"
                      rel="external noopener"
                      target="_blank"
                      class="twitter-share-btn large-share-button"
                    >
                      <span class="fa fa-twitter"></span>
                      <span class="screen-reader-text">Twitter</span>
                    </a>
  
                    <a
                      href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://noibai.vn/tin-tuc/bi-kip-tranh-mat-do-tren-may-bay-bi-mat-do-tren-may-bay-phai-lam-gi-779;title=Bí kíp tránh mất đồ trên máy bay, bị mất đồ trên máy bay phải làm gì?"
                      rel="external noopener"
                      target="_blank"
                      class="linkedin-share-btn"
                    >
                      <span class="fa fa-linkedin"></span>
                      <span class="screen-reader-text">LinkedIn</span>
                    </a>
                    <div
                      class="zalo-share-button share-button"
                      data-href=""
                      data-oaid="579745863508352884"
                      data-layout="4"
                      data-color="blue"
                      data-customize="false"
                      style="
                        position: relative;
                        display: inline-block;
                        width: 40px;
                        height: 40px;
                      "
                      bis_skin_checked="1"
                    >
                      <iframe
                        id="d6c2bb2b-e40a-4c69-bd99-411a81bd8bb4"
                        name="d6c2bb2b-e40a-4c69-bd99-411a81bd8bb4"
                        frameborder="0"
                        allowfullscreen=""
                        scrolling="no"
                        width="40px"
                        height="40px"
                        src="https://button-share.zalo.me/share_inline?id=d6c2bb2b-e40a-4c69-bd99-411a81bd8bb4&amp;layout=4&amp;color=blue&amp;customize=false&amp;width=40&amp;height=40&amp;isDesktop=true&amp;url=https%3A%2F%2Fnoibai.vn%2Ftin-tuc%2Fbi-kip-tranh-mat-do-tren-may-bay-bi-mat-do-tren-may-bay-phai-lam-gi-779&amp;d=eyJ1cmwiOiJodHRwczovL25vaWJhaS52bi90aW4tdHVjL2JpLWtpcC10cmFuaC1tYXQtZG8tdHJlbi1tYXktYmF5LWJpLW1hdC1kby10cmVuLW1heS1iYXktcGhhaS1sYW0tZ2ktNzc5In0%253D&amp;shareType=0"
                        style="
                          position: absolute;
                          z-index: 99;
                          top: 0px;
                          left: 0px;
                        "
                      ></iframe>
                    </div>
                  </div>
                  <!-- .share-links /-->
                </div>
  
                <div class="s-content" bis_skin_checked="1">
                  <div id="toc_container" bis_skin_checked="1">
                    
                    <p class="toc_title">Mục lục</p>
                    <ul id="toc" style="">
                
                    </ul>
                  </div>
       
                  <div style="margin-top: 5.3rem;">
                    {!!$news->content!!}
                  </div>
                </div>
  

              </div>
            </div>
           
          </div>
        </div>
      </div>

      <script>
        // Tạo danh sách mục lục
        var toc = document.getElementById('toc');

        // Tìm tất cả các thẻ h2 trong tài liệu
        var headings = document.querySelectorAll('h2');

        // Lặp qua mỗi thẻ h2
        headings.forEach(function(heading) {
            // Tạo id từ nội dung của thẻ h2, mỗi từ cách nhau bởi dấu gạch dưới
            var id = heading.textContent.toLowerCase().replace(/ /g, '_');
            
            // Tạo thẻ a và thẻ li
            var a = document.createElement('a');
            var li = document.createElement('li');

            // Thiết lập thuộc tính href cho thẻ a
            a.setAttribute('href', '#' + id);

            // Thiết lập nội dung cho thẻ a và thẻ li
            a.textContent = heading.textContent;
            li.appendChild(a);

            // Thêm thẻ li vào danh sách mục lục
            toc.appendChild(li);

            // Thiết lập id cho thẻ h2
            heading.setAttribute('id', id);
        });
    </script>
@endsection