let addEdit = document.getElementById("navigation-button");
let containerNavigation = document.getElementById("container-navigation");
let containerContent = document.getElementById("container-content");
let tableProducts = document.getElementById("data-table");

addEdit.addEventListener("click", () => {
  if (!containerNavigation.classList.contains("active")) {
    containerNavigation.classList.add("active");
    containerContent.classList.add("active");
    tableProducts.style.width = "100%";
  } else {
    containerNavigation.classList.remove("active");
    containerContent.classList.remove("active");
    tableProducts.style.width = "100%";
  }
});
