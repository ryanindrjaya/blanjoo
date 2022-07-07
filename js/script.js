function showHideDiv() {
  var x = document.getElementById("tambahCategory");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function showEdit() {
  var a = document.getElementById("editCategory");
  if (a.style.display === "none") {
    a.style.display = "flex";
  } else {
    a.style.display = "none";
  }
}

function showHideDivProduk() {
  var x = document.getElementById("tambahProduk");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function addToast(){
  const toast = document.getElementById("toast");
  toast.innerText = "Produk ditambahkan ke cart.";
  toast.className = "show";
  setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}