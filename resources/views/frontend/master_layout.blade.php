<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đặt xe TAXI NỘI BÀI đưa đón sân bay giá rẻ, trọn gói</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
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
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"
    />
    <link rel="stylesheet" href="{{asset('frontend/asset/css/main.css')}}" />
  </head>
  <body>
    @include('frontend.body.frontend_header')
    @include('frontend.body.frontend_menu')
    
    {{-- Content --}}
    
    @yield('main_content')

    @include('frontend.body.frontend_footer')

  </body>

  
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('frontend/asset/js/script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script
  type="text/javascript"
  src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
></script>

<script>
  // Lấy trường input
  const startDateInput = document.getElementById("txtStartDate");

  // Sử dụng Flatpickr để kích hoạt datetimepicker
  flatpickr(startDateInput, {
    enableTime: true,
    dateFormat: "d-m-Y H:i", // Định dạng ngày giờ
    onClose: function (selectedDates, dateStr, instance) {
      startDateInput.blur(); // Mất focus khi chọn xong
    },
  });
</script>
