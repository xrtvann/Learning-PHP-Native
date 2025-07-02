$(document).ready(function () {
  $("#keyword").on("keyup", function () {
    $("#table-container").load(
      "ajax/product.php?keyword=" + $("#keyword").val()
    );
  });
});
