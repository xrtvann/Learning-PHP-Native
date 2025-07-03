$(document).ready(function () {
  $("#searchButton").hide();

  $("#searchInput").on("keyup", function () {
    $("#table-container").load(
      "ajax/product.php?keyword=" + $("#searchInput").val()
    );
  });
});
