@extends('frontend.master_layout')

@section('main_content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIfSyryL0vRpxCCDilpmgnYhC98A_E8EQ&libraries=places&region=vn&language=vi"></script>

@php
  $carCategory = App\Models\CarCategory::orderBy('car_category_name', 'ASC')->get();
@endphp

  <div class="md-booking bg" style="background-color: #fff">
      <div class="container">
        <div class="book-wrap">
          <div class="row">
            <div class="col-lg-5">
              <div class="bk-form">
                <div class="head">
                  <h2 class="title">Đặt xe</h2>
                  <div class="bk-tab">
                    <div class="toggle-switch">
                      <input type="radio" id="green" name="toggle" checked />

                      <label for="green">
                        <span><i class="ic ic-plane"></i> Sân bay</span></label
                      >
                      <input type="radio" id="white" name="toggle" />
                      <label for="white"
                        ><span
                          ><i class="ic ic-road"></i> Đường dài</span
                        ></label
                      >
                    </div>
                  </div>
                </div>
                {{-- Khoảng cách --}}
                <input type="hidden" id="distance" value="">
                {{-- Loại xe --}}
                <input type="hidden" id="type_car" value="">
                {{-- Time --}}
                <input type="hidden" id="time" value="">


                <form id="CreateTrip">
                  <div class="label lblTripfrom" bis_skin_checked="1">
                    Bạn đi từ:
                  </div>
                  <div class="ctrl-input" bis_skin_checked="1">
                    <span class="ic ic-circle"></span>
                    <input class="input pac-target-input" type="text" id="txtDiemDi" placeholder="Điểm đi" name="" data-placename=""
        data-lat="0" data-lng="0" autocomplete="off" onfocus="AutoComplete(this)">

                    <button class="butn pause-btn" type="button">
                      <i class="ic ic-plus"></i>
                    </button>
                  </div>

                  <div class="pause-container">
                    <div class="ctrl-input hidden" bis_skin_checked="1">
                      <span
                        style="margin-top: -6px"
                        class="ic ic-circle-stop"
                      ></span>
                      <input
                        class="input pause-point"
                        type="text"
                        data-lat=""
                        data-placename=""
                        data-lng=""
                        placeholder="Điểm dừng tiếp theo"
                        name="pause[]"
                      />
                      <button
                        class="butn remove-pause-point"
                        style="height: 96%"
                        type="button"
                      >
                        <i class="fas fa-minus" style="color: black"></i>
                      </button>
                    </div>
                  </div>

                  <div class="label lblTripto" bis_skin_checked="1">
                    Bạn muốn đến:
                  </div>
                  <div
                    class="ctrl-input v2"
                    id="ctn-diemDen"
                    bis_skin_checked="1"
                  >
                    <span class="ic ic-pin"></span>
                    <input class="input pac-target-input" type="text" id="txtDiemDien" placeholder="Điểm đến" name="" data-placename=""
        data-lat="0" data-lng="0" autocomplete="off" onfocus="AutoComplete(this)">

                  </div>

                  

                  <div
                    class="row col-mar-0 justify-content-between align-items-center"
                  >
                    <div class="col-auto" bis_skin_checked="1">
                      <div class="switch">
                        <input
                          type="checkbox"
                          id="switch1"
                          class="switch-input"
                        />
                        <label for="switch1" class="switch-label"
                          ><span class="switch-text">2chiều</span></label
                        >
                      </div>
                    </div>

                    <div class="col-auto" bis_skin_checked="1">
                      <div class="switch">
                        <input
                          type="checkbox"
                          id="switch2"
                          class="switch-input"
                        />
                        <label for="switch2" class="switch-label"
                          ><span class="switch-text">VAT</span></label
                        >
                      </div>
                    </div>
                    <span
                      class="btn-reverse"
                      onclick="ReverseTrip()"
                      id="btnReverse"
                    >
                      <i class="fa fa-random"></i>
                      <label style="color: #fff">Đảo chiều</label>
                    </span>
                  </div>
                  <div
                    class="row col-mar-10"
                    style="margin-top: 10px"
                    bis_skin_checked="1"
                  >
                    <div class="col-6" bis_skin_checked="1">
                      <div class="label" bis_skin_checked="1">Loại xe</div>
                      <div class="i-select c-drop i-drop" bis_skin_checked="1">
                        <i class="fa fa-car"></i>
                        <!-- <input type="text" class="input" placeholder="Loại xe" name=""> -->
                        <div
                          class="label input"
                          id="selectedOption"
                          bis_skin_checked="1"
                        >
                          4 chỗ cốp rộng
                        </div>
                        <input
                          type="hidden"
                          id="carTypeId"
                          class="carType"
                          value=""
                        />
                        <ul class="dropdown-content">
                          @foreach ($carCategory  as $item )
                            @if ($item->status == "active")
                              <li>
                                <a
                                  data-id="{{$item->id}}"
                                  class="smooth active car-option"
                                  title=""
                                  data-price=""
                                >
                                  <span
                                    ><img
                                      src="{{asset($item->car_category_img)}}"
                                      alt="4 chỗ cốp rộng"
                                      class="lazyloaded"
                                      src="https://noibai.vn/images/5seats.png"
                                  /></span>
                                  {{$item->car_category_name}}
                                </a>
                              </li>
                            @endif
                          @endforeach
                         
                          
                        </ul>
                      </div>
                    </div>
                    <div class="col-6" bis_skin_checked="1">
                      <div class="label" bis_skin_checked="1">Thời gian đi</div>
                      <div class="i-select c-drop" bis_skin_checked="1">
                        <i class="fa fa-calendar v2"></i>
                        <input
                          type="text"
                          class="input date-timepicker"
                          readonly=""
                          autocomplete="new-password"
                          name=""
                          id="txtStartDate"
                        />
                      </div>
                    </div>
                  </div>
                  <hr class="hr-form" />

                  <div
                    class="row justify-content-between fee-line"
                    bis_skin_checked="1"
                  >
                    <div class="col-auto" bis_skin_checked="1">
                      <i class="ic ic-money"></i>&nbsp;&nbsp; Cước phí
                    </div>
                    <div class="col-auto" bis_skin_checked="1">
                      <strong style="color: red" id="giaTien">0đ</strong>
                  </div>
                  </div>

                  <div
                    class="label"
                    style="margin-top: 20px"
                    bis_skin_checked="1"
                  >
                    Thông tin của bạn
                  </div>
                  <div class="row col-mar-10" bis_skin_checked="1">
                    <div class="col-md-6" bis_skin_checked="1">
                      <div class="ctrl-input" bis_skin_checked="1">
                        <span class="ic ic-phone"></span>
                        <input
                          class="input"
                          type="text"
                          placeholder="Số điện thoại"
                          name=""
                          id="txtPhone"
                        />
                      </div>
                    </div>
                    <div class="col-md-6" bis_skin_checked="1">
                      <div class="ctrl-input" bis_skin_checked="1">
                        <span
                          style="font-size: 15pt; color: #4aa927"
                          class="fa fa-user"
                        ></span>
                        <input
                          class="input"
                          type="text"
                          placeholder="Họ và tên"
                          name=""
                          id="txtName"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="row col-mar-10" bis_skin_checked="1">
                    <div class="col-md-6" bis_skin_checked="1">
                      <div
                        class="cExtra showAll"
                        data-toggle="collapse"
                        data-target="#extra"
                        bis_skin_checked="1"
                        aria-expanded="true"
                      >
                        + Thêm ghi chú
                      </div>
                    </div>
                  </div>

                  <div
                    id="extra"
                    class="collapse show"
                    bis_skin_checked="1"
                    style=""
                  >
                    <div class="d-input" bis_skin_checked="1">
                      <input
                        class="input"
                        type="text"
                        placeholder="Ghi chú"
                        name=""
                        id="txtNote"
                      />
                    </div>
                  </div>

                  <button
                    type="button"
                    class="submit"
                    data-toggle="modal"
                    onclick="Submit()"
                  >
                    Đặt xe <i class="ic ic-arrows"></i>
                  </button>
                </form>
              </div>
            </div>

            <div class="col-lg-7">
              <div class="cols-2">
                <div class="pad" bis_skin_checked="1">
                  <div
                    class="slider slick-initialized slick-slider"
                    id="sliderBanner"
                    bis_skin_checked="1"
                  >
                    <div class="slick-list draggable" bis_skin_checked="1">
                      <div
                        class="slick-track"
                        style="
                          opacity: 1;
                          width: 568px;
                          transform: translate3d(0px, 0px, 0px);
                        "
                        bis_skin_checked="1"
                      >
                        <div
                          class="slick-slide slick-current slick-active"
                          data-slick-index="0"
                          aria-hidden="false"
                          style="width: 568px"
                          bis_skin_checked="1"
                        >
                          <div bis_skin_checked="1">
                            <div
                              class="item slick-slide"
                              aria-hidden="true"
                              bis_skin_checked="1"
                              style="width: 100%; display: inline-block"
                            >
                              <div class="img" bis_skin_checked="1">
                                <a
                                  class="smooth"
                                  title="Xe sang gia hoi"
                                  tabindex="0"
                                  ><img
                                    class="lazyloaded"
                                    data-old="noi-bai-taxi-xe-sang-gia-hoi"
                                    data-src="/images/banner-2024.jpg"
                                    alt="Xe sang gia hoi"
                                    src="https://noibai.vn/images/banner-2024.jpg"
                                /></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="break" bis_skin_checked="1"></div>
                <div class="pad" bis_skin_checked="1">
                  <div class="bk-result" bis_skin_checked="1">
                    <div
                      class="result-cas slick-initialized slick-slider slick-vertical"
                      bis_skin_checked="1"
                    >
                      <div
                        class="slick-list draggable"
                        style="height: 205px"
                        bis_skin_checked="1"
                      >
                        <div
                          class="slick-track"
                          style="
                            opacity: 1;
                            height: 1025px;
                            transform: translate3d(0px, -205px, 0px);
                          "
                          bis_skin_checked="1"
                        >
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="-5"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Lê Tú 039.627.3***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi tỉnh
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="-4"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Ngọc Sơn 035.839.4***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="-3"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Lan 098.934.3***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi tỉnh
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="-2"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Quốc Cường 033.342.2***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="-1"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Quỳnh Hương 033.948.4***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-current slick-active"
                            data-slick-index="0"
                            aria-hidden="false"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Chị Ngọc 096.391.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-active"
                            data-slick-index="1"
                            aria-hidden="false"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: 036.913.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-active"
                            data-slick-index="2"
                            aria-hidden="false"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: 036.913.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-active"
                            data-slick-index="3"
                            aria-hidden="false"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Mai Hoa 036.875.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-active"
                            data-slick-index="4"
                            aria-hidden="false"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Trung Kiên 094.939.2***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide"
                            data-slick-index="5"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Lê Tú 039.627.3***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi tỉnh
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide"
                            data-slick-index="6"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Ngọc Sơn 035.839.4***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide"
                            data-slick-index="7"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Lan 098.934.3***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi tỉnh
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide"
                            data-slick-index="8"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Quốc Cường 033.342.2***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide"
                            data-slick-index="9"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Quỳnh Hương 033.948.4***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="10"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Chị Ngọc 096.391.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="11"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: 036.913.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="12"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: 036.913.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="13"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Mai Hoa 036.875.6***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="14"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Trung Kiên 094.939.2***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="15"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Lê Tú 039.627.3***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi tỉnh
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="16"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Ngọc Sơn 035.839.4***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="17"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Lan 098.934.3***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi tỉnh
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="18"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Quốc Cường 033.342.2***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe từ sân bay về
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="slick-slide slick-cloned"
                            data-slick-index="19"
                            aria-hidden="true"
                            tabindex="-1"
                            style="width: 568px"
                            bis_skin_checked="1"
                          >
                            <div bis_skin_checked="1">
                              <div
                                class="item"
                                style="width: 100%; display: inline-block"
                                bis_skin_checked="1"
                              >
                                <div class="title" bis_skin_checked="1">
                                  K.Hàng: Quỳnh Hương 033.948.4***
                                </div>
                                <div class="info" bis_skin_checked="1">
                                  vừa đặt xe đi sân bay
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="stote-btn" bis_skin_checked="1">
                  <a
                    class="smooth"
                    href="https://apps.apple.com/vn/app/noibai-taxi/id1461064578"
                    title=""
                    target="_blank"
                    bis_skin_checked="1"
                    bis_size='{"x":919,"y":728,"w":200,"h":78,"abs_x":919,"abs_y":728}'
                    ><img
                      src="https://noibai.vn/images/ios.svg"
                      alt="ios"
                      title=""
                      bis_size='{"x":919,"y":728,"w":200,"h":78,"abs_x":919,"abs_y":728}'
                      bis_id="bn_irt4sjlqhvvj4dkvj1q2e5"
                  /></a>
                  <a
                    class="smooth"
                    href="https://play.google.com/store/apps/details?id=com.bentic.noibai"
                    title=""
                    target="_blank"
                    bis_skin_checked="1"
                    ><img
                      src="https://noibai.vn/images/android.svg"
                      alt="android"
                      title=""
                  /></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="md-service bg"
      style="background-image: url('https://noibai.vn/images/bg2.jpg')"
      bis_skin_checked="1"
    >
      <div class="container" bis_skin_checked="1">
        <h2 class="md-title v2 text-center">DỊCH VỤ ĐẶT XE ĐƯA ĐÓN NỘI BÀI</h2>
        <div
          class="service-cas slick-initialized slick-slider"
          bis_skin_checked="1"
        >
          <img
            data-src="images/prev.svg"
            class="prev slick-arrow lazyloaded slick-disabled"
            alt="Prev"
            aria-disabled="true"
            src="https://noibai.vn/images/prev.svg"
            style="display: block"
          />
          <div class="slick-list draggable" bis_skin_checked="1">
            <div
              class="slick-track"
              style="
                opacity: 1;
                width: 1740px;
                transform: translate3d(0px, 0px, 0px);
              "
              bis_skin_checked="1"
            >
              <div
                class="slick-slide slick-current slick-active"
                data-slick-index="0"
                aria-hidden="false"
                style="width: 270px"
                bis_skin_checked="1"
              >
                <div bis_skin_checked="1">
                  <div
                    class="item"
                    style="width: 100%; display: inline-block"
                    bis_skin_checked="1"
                  >
                    <div class="service" bis_skin_checked="1">
                      <a
                        class="img"
                        href="/tin-tuc/dat-taxi-4-cho-noi-bai-gia-re-nhat-an-toan-nhat-chat-luong-nhat-91"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                      >
                        <img
                          class="ls-is-cached lazyloaded"
                          data-src="/images/4seats.png"
                          alt="Taxi Nội Bài 4 chỗ"
                          title=""
                          src="https://noibai.vn/images/5seats.png"
                        />
                      </a>
                      <h3 class="title">
                        <a
                          class="smooth"
                          href="/tin-tuc/dat-taxi-4-cho-noi-bai-gia-re-nhat-an-toan-nhat-chat-luong-nhat-91"
                          title=""
                          tabindex="0"
                          bis_skin_checked="1"
                        >
                          TAXI NỘI BÀI 4 CHỖ</a
                        >
                      </h3>
                      <div class="ct" bis_skin_checked="1">
                        <p>
                          <span><i class="ic ic-cap"></i></span> 1 Va li vừa + 1
                          túi xách
                        </p>
                        <p>
                          <span><i class="ic ic-user2"></i></span> Tối đa 3
                          khách hàng
                        </p>
                        <p>
                          <span><i class="ic ic-fee"></i></span> Từ 170.000 đ
                        </p>
                      </div>
                      <a
                        class="smooth butn"
                        href="/bang-gia#4cho"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                        >Đặt xe</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="slick-slide slick-active"
                data-slick-index="1"
                aria-hidden="false"
                style="width: 270px"
                bis_skin_checked="1"
              >
                <div bis_skin_checked="1">
                  <div
                    class="item"
                    style="width: 100%; display: inline-block"
                    bis_skin_checked="1"
                  >
                    <div class="service" bis_skin_checked="1">
                      <a
                        class="img"
                        href="/tin-tuc/dat-taxi-5-cho-noi-bai-gia-re-an-toan-chat-luong-nhat-93"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                      >
                        <img
                          class="ls-is-cached lazyloaded"
                          data-src="/images/5seats.png"
                          alt="5 chỗ"
                          title=""
                          src="https://noibai.vn/images/5seats.png"
                        />
                      </a>
                      <h3 class="title">
                        <a
                          class="smooth"
                          href="/tin-tuc/dat-taxi-5-cho-noi-bai-gia-re-an-toan-chat-luong-nhat-93"
                          title=""
                          tabindex="0"
                          bis_skin_checked="1"
                          >TAXI NỘI BÀI 5 CHỖ</a
                        >
                      </h3>
                      <div class="ct" bis_skin_checked="1">
                        <p>
                          <span><i class="ic ic-cap"></i></span> 2 Va li vừa + 1
                          túi xách
                        </p>
                        <p>
                          <span><i class="ic ic-user2"></i></span> Tối đa 4
                          khách hàng
                        </p>
                        <p>
                          <span><i class="ic ic-fee"></i></span> Từ 175.000 đ
                        </p>
                      </div>
                      <a
                        class="smooth butn"
                        href="/bang-gia#5cho"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                        >Đặt xe</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="slick-slide slick-active"
                data-slick-index="2"
                aria-hidden="false"
                style="width: 270px"
                bis_skin_checked="1"
              >
                <div bis_skin_checked="1">
                  <div
                    class="item"
                    style="width: 100%; display: inline-block"
                    bis_skin_checked="1"
                  >
                    <div class="service" bis_skin_checked="1">
                      <a
                        class="img"
                        href="/tin-tuc/dat-taxi-7-cho-dam-bao-an-toan-chat-luong-gia-tot-nhat-84"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                      >
                        <img
                          class="ls-is-cached lazyloaded"
                          data-src="/images/7seats.png"
                          alt="7 chỗ"
                          title=""
                          src="https://noibai.vn/images/5seats.png"
                        />
                      </a>
                      <h3 class="title">
                        <a
                          class="smooth"
                          href="/tin-tuc/dat-taxi-7-cho-dam-bao-an-toan-chat-luong-gia-tot-nhat-84"
                          title=""
                          tabindex="0"
                          bis_skin_checked="1"
                          >TAXI NỘI BÀI 7 CHỖ</a
                        >
                      </h3>
                      <div class="ct" bis_skin_checked="1">
                        <p>
                          <span><i class="ic ic-cap"></i></span> 3 Va li vừa + 1
                          túi xách
                        </p>
                        <p>
                          <span><i class="ic ic-user2"></i></span> Tối đa 6
                          khách hàng
                        </p>
                        <p>
                          <span><i class="ic ic-fee"></i></span> Liên hệ để biết
                          thêm chi tiết
                        </p>
                      </div>
                      <a
                        class="smooth butn"
                        href="/bang-gia#7cho"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                        >Đặt xe</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="slick-slide slick-active"
                data-slick-index="3"
                aria-hidden="false"
                style="width: 270px"
                bis_skin_checked="1"
              >
                <div bis_skin_checked="1">
                  <div
                    class="item"
                    style="width: 100%; display: inline-block"
                    bis_skin_checked="1"
                  >
                    <div class="service" bis_skin_checked="1">
                      <a
                        class="img"
                        href="/tin-tuc/dich-vu-xe-16-cho-di-san-bay-noi-bai-uy-tin-gia-re-94"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                      >
                        <img
                          class="ls-is-cached lazyloaded"
                          data-src="/images/16seats.png"
                          alt="16 chỗ"
                          title=""
                          src="https://noibai.vn/images/5seats.png"
                        />
                      </a>
                      <h3 class="title">
                        <a
                          class="smooth"
                          href="/tin-tuc/dich-vu-xe-16-cho-di-san-bay-noi-bai-uy-tin-gia-re-94"
                          title=""
                          tabindex="0"
                          bis_skin_checked="1"
                          >XE KHÁCH 16 CHỖ</a
                        >
                      </h3>
                      <div class="ct" bis_skin_checked="1">
                        <p>
                          <span><i class="ic ic-cap"></i></span> Liên hệ để biết
                          thêm chi tiết
                        </p>
                        <p>
                          <span><i class="ic ic-user2"></i></span> Liên hệ để
                          biết thêm chi tiết
                        </p>
                        <p>
                          <span><i class="ic ic-fee"></i></span> Liên hệ để biết
                          thêm chi tiết
                        </p>
                      </div>
                      <a
                        class="smooth butn"
                        href="/bang-gia#16cho"
                        title=""
                        tabindex="0"
                        bis_skin_checked="1"
                        >Đặt xe</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="slick-slide"
                data-slick-index="4"
                aria-hidden="true"
                style="width: 270px"
                bis_skin_checked="1"
                tabindex="-1"
              >
                <div bis_skin_checked="1">
                  <div
                    class="item"
                    style="width: 100%; display: inline-block"
                    bis_skin_checked="1"
                  >
                    <div class="service" bis_skin_checked="1">
                      <a
                        class="img"
                        href="/tin-tuc/kinh-nghiem-goi-xe-29-cho-di-noi-bai-xe-sang-gia-re-96"
                        title=""
                        tabindex="-1"
                        bis_skin_checked="1"
                      >
                        <img
                          class="ls-is-cached lazyloaded"
                          data-src="/images/29seats.png"
                          alt="29 chỗ"
                          title=""
                          src="/images/29seats.png"
                        />
                      </a>
                      <h3 class="title">
                        <a
                          class="smooth"
                          href="/tin-tuc/kinh-nghiem-goi-xe-29-cho-di-noi-bai-xe-sang-gia-re-96"
                          title=""
                          tabindex="-1"
                          bis_skin_checked="1"
                          >XE KHÁCH 29 CHỖ</a
                        >
                      </h3>
                      <div class="ct" bis_skin_checked="1">
                        <p>
                          <span><i class="ic ic-cap"></i></span> Liên hệ để biết
                          thêm chi tiết
                        </p>
                        <p>
                          <span><i class="ic ic-user2"></i></span> Liên hệ để
                          biết thêm chi tiết
                        </p>
                        <p>
                          <span><i class="ic ic-fee"></i></span> Liên hệ để biết
                          thêm chi tiết
                        </p>
                      </div>
                      <a
                        class="smooth butn"
                        href="/bang-gia#29cho"
                        title=""
                        tabindex="-1"
                        bis_skin_checked="1"
                        >Đặt xe</a
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="slick-slide"
                data-slick-index="5"
                aria-hidden="true"
                style="width: 270px"
                bis_skin_checked="1"
                tabindex="-1"
              >
                <div bis_skin_checked="1">
                  <div
                    class="item"
                    style="width: 100%; display: inline-block"
                    bis_skin_checked="1"
                  >
                    <div class="service" bis_skin_checked="1">
                      <a
                        class="img"
                        href="/tin-tuc/kinh-nghiem-thue-xe-45-cho-gia-re-tai-ha-noi-98"
                        title=""
                        tabindex="-1"
                        bis_skin_checked="1"
                      >
                        <img
                          class="ls-is-cached lazyloaded"
                          data-src="/images/45seats.png"
                          alt="45 chỗ"
                          title=""
                          src="/images/45seats.png"
                        />
                      </a>
                      <h3 class="title">
                        <a
                          class="smooth"
                          href="/tin-tuc/kinh-nghiem-thue-xe-45-cho-gia-re-tai-ha-noi-98"
                          title=""
                          tabindex="-1"
                          bis_skin_checked="1"
                          >XE KHÁCH 45 CHỖ</a
                        >
                      </h3>
                      <div class="ct" bis_skin_checked="1">
                        <p>
                          <span><i class="ic ic-cap"></i></span> Liên hệ để biết
                          thêm chi tiết
                        </p>
                        <p>
                          <span><i class="ic ic-user2"></i></span> Liên hệ để
                          biết thêm chi tiết
                        </p>
                        <p>
                          <span><i class="ic ic-fee"></i></span> Liên hệ để biết
                          thêm chi tiết
                        </p>
                      </div>
                      <a
                        class="smooth butn"
                        href="/bang-gia#45cho"
                        title=""
                        tabindex="-1"
                        bis_skin_checked="1"
                        >Đặt xe</a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <img
            data-src="images/next.svg"
            class="next slick-arrow ls-is-cached lazyloaded"
            alt="Next"
            aria-disabled="false"
            src="https://noibai.vn/images/next.svg"
            style="display: block"
          />
        </div>
      </div>
    </div>

    <!-- JavaScript section -->
  
    <script>
      function AutoComplete(input) {
          var autocomplete = new google.maps.places.Autocomplete(input);
  
          autocomplete.addListener('place_changed', function () {
              var place = autocomplete.getPlace();
              var lat = place.geometry.location.lat();
              var lng = place.geometry.location.lng();
  
              // Cập nhật data-lat và data-lng của input
              input.setAttribute('data-lat', lat);
              input.setAttribute('data-lng', lng);
  
              // Kiểm tra xem cả hai input đã có dữ liệu địa điểm hay chưa
              var diemDi = document.getElementById('txtDiemDi');
              var diemDien = document.getElementById('txtDiemDien');
              var latDiemDi = parseFloat(diemDi.getAttribute('data-lat'));
              var latDiemDien = parseFloat(diemDien.getAttribute('data-lat'));
  
              if (latDiemDi !== 0 && latDiemDien !== 0) {
                  // Nếu cả hai input đã có dữ liệu địa điểm, gửi yêu cầu tính giá tiền
                  getPrice();
              }
          });
      }
  
      function getPrice() {
    // Lấy giá trị data-lat và data-lng từ input điểm đi
    var originLat = document.getElementById('txtDiemDi').getAttribute('data-lat');
    var originLng = document.getElementById('txtDiemDi').getAttribute('data-lng');
    
    // Lấy giá trị data-lat và data-lng từ input điểm đến
    var destinationLat = document.getElementById('txtDiemDien').getAttribute('data-lat');
    var destinationLng = document.getElementById('txtDiemDien').getAttribute('data-lng');

    // Kiểm tra nếu có dữ liệu
    if (originLat && originLng && destinationLat && destinationLng) {
        // Tạo chuỗi địa chỉ từ dữ liệu lat và lng
        var origin = originLat + ',' + originLng;
        var destination = destinationLat + ',' + destinationLng;

        // Lấy giá trị thời gian và loại xe
        var selectedTime = document.getElementById('time').value;
        var selectedCarId = document.getElementById('type_car').value;

        // Lấy token CSRF
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Tạo đối tượng dữ liệu để gửi thông tin đến controller
        var data = {
            origin: origin,
            destination: destination,
            selectedTime: selectedTime,
            carId: selectedCarId,
            _token: csrfToken
        };

        // Gọi ajax để gửi yêu cầu đến controller
        $.ajax({
            url: '/home/getprice',
            method: 'POST',
            data: data,
            success: function(response) {

            if (response.hasOwnProperty('fare')) {
            // Nếu có giá cước trong phản hồi
            var fare = response.fare;
            var roundedFare = Math.round(fare);
            // Format giá tiền thành chuỗi tiền tệ Việt Nam
            var formattedFare = parseFloat(roundedFare).toLocaleString('vi-VN');
            // Thêm đơn vị tiền tệ vào cuối chuỗi
            formattedFare += '.000đ';
            document.getElementById('giaTien').textContent = formattedFare;
            } else {
                console.error('Không tìm thấy giá cước trong phản hồi');
            }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        console.error('Không có đủ dữ liệu để tính toán giá tiền');
    }
  }
  
      // Gọi hàm AutoComplete cho cả 2 input
      document.addEventListener("DOMContentLoaded", function() {
          AutoComplete(document.getElementById('txtDiemDi'));
          AutoComplete(document.getElementById('txtDiemDien'));
  
          // Sự kiện khi chọn loại xe
          var carOptions = document.querySelectorAll('.car-option');
          carOptions.forEach(function(option) {
              option.addEventListener('click', function() {
                  var carId = this.getAttribute('data-id');
                  document.getElementById('type_car').value = carId;
  
                  // Sau khi chọn loại xe, cần tính lại giá cước
                  getPrice();
              });
          });
      });
  
      // Sự kiện khi datetimepicker thay đổi giá trị
      document.getElementById('txtStartDate').addEventListener('change', function() {
          var selectedTime = this.value;
          document.getElementById('time').value = selectedTime;
  
          // Sau khi datetimepicker thay đổi giá trị, cần tính lại giá cước
          getPrice();
      });
  </script>

  
@endsection
