let searchInput = document.getElementById("searchInput");
let searchButton = document.getElementById("searchButton");
let tableContainer = document.getElementById("table-container");

searchInput.addEventListener("keyup", function () {
  let xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      tableContainer.innerHTML = xhr.responseText;
      console.log(searchInput.value);
    }
  };

  xhr.open("GET", "ajax/product.php?keyword=" + searchInput.value, true);

  xhr.send();
});
