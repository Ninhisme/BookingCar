$(document).ready(function () {
  var count = 0;

  $(".pause-btn").click(function () {
    count++;
    if (count <= 2) {
      var newPauseInput = $(".ctrl-input.hidden").first().clone();
      newPauseInput.removeClass("hidden");
      $(".pause-container").append(newPauseInput);
    }
    if (count >= 2) {
      $(this).hide();
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var cDrop = document.querySelector(".c-drop");
  var dropdownContent = document.querySelector(".dropdown-content");

  cDrop.addEventListener("click", function () {
    dropdownContent.classList.toggle("show");
  });

  document.addEventListener("click", function (event) {
    var isClickInside = cDrop.contains(event.target);
    if (!isClickInside) {
      dropdownContent.classList.remove("show");
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Lấy phần tử div label input và dropdown content
  const selectedOption = document.getElementById("selectedOption");
  const dropdownContent = document.querySelector(".dropdown-content");
  const carTypeIdInput = document.getElementById("carTypeId");

  // Lấy tất cả các mục trong dropdown
  const dropdownItems = dropdownContent.querySelectorAll("li");

  // Duyệt qua từng mục và thêm sự kiện click
  dropdownItems.forEach(function (item) {
    item.addEventListener("click", function () {
      // Lấy giá trị data-id của mục được chọn
      const selectedId = this.querySelector("a").getAttribute("data-id");
      // Lấy nội dung của mục được chọn
      const selectedText = this.querySelector("a").textContent.trim();

      // Cập nhật giá trị của input hidden
      carTypeIdInput.value = selectedId;

      // Cập nhật nội dung của div label input
      selectedOption.textContent = selectedText;
    });
  });
});
