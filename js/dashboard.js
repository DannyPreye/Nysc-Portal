// Get the Dom Elements
const menu_content = document.getElementById('menu-content')
const preloader = document.getElementById("preloader");
const page = document.getElementById("main-page");



setTimeout(()=>{
    preloader.classList.add("hidden");
    page.classList.remove("hidden")
},3000)

document.addEventListener("click", (e)=>{
    switch (e.target.id){
        case 'menu-icon': menu_content.classList.toggle("hidden")
    }
})


