
// get the DOM elements 
const login = document.getElementById('login');
const reg_div = document.getElementById('register');
const main = document.getElementById("main").querySelectorAll("div");
const welcome = document.getElementById("welcome");
const img = document.getElementById('image');
const close = document.getElementById('x');
const welcome_div = document.getElementById("welcome").querySelectorAll("div");
const preloader = document.getElementById("preloader");
const full_content = document.getElementById("full-content");
const menu = document.getElementById("menu");

console.log(preloader);

    setTimeout(()=>{
        preloader.classList.add("hidden")
       full_content.classList.remove("hidden") 
    },3000)

document.addEventListener('click', (e) => {
    switch (e.target.id) {
        case 'btn_login': login.classList.toggle('hidden');
            reg_div.classList.add('hidden');
            break;

        case 'btn_register': reg_div.classList.toggle('hidden');
            login.classList.add('hidden');
            break;
        case 'x': 
            reg_div.classList.add('hidden')
            break

        case 'c':
            login.classList.add('hidden')
            break

        case "acct": login.classList.remove('hidden');
            reg_div.classList.add('hidden');
            console.log("hello world")
            break;

        case "login_2": login.classList.toggle('hidden');
            login.style.bottom=0 +"px";
            reg_div.classList.add('hidden');
            break;
        case "hamburger": menu.classList.toggle("hidden");
            break;
    }
})
main.forEach(el=>{
    el.classList.add("anim")
})


document.addEventListener("scroll",()=>{

    //Main section animation
   main.forEach((elem,index,arr)=>{
       if(elem.getBoundingClientRect().top  <= window.innerHeight){
        elem.classList.add("reform")
       }
       else{
        elem.classList.remove("reform")
       }

 
     })
})
