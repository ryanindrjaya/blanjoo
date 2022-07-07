var nav = document.querySelector("nav");
var title = document.querySelector(".logo")

window.addEventListener('scroll', () => {
  if (window.pageYOffset > 100) {
    nav.classList.add("shadow-sm", "bg-light", "border-bottom");
    title.classList.add("text-dark")
  } else {
    nav.classList.remove("shadow-sm", "bg-light", "border-bottom");
    title.classList.remove("text-dark")
  }
})