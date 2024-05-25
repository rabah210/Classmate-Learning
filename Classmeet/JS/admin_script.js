document.body.style.zoom = "80%";

let profile = document.querySelector('.header .flex .profile');
let searchForm = document.querySelector('.header .flex #searchF');
let body = document.body;

document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
    searchForm.classList.remove('active');
}

console.log(searchForm);


document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    profile.classList.remove('active');
}

let sideBar = document.querySelector('.side-bar');

document.querySelector('#menu-btn').onclick = () =>{
    sideBar.classList.toggle('active');
    body.classList.toggle('active');
}

document.querySelector('.side-bar .close-side-bar').onclick = () =>{
    sideBar.classList.remove('active');
    body.classList.remove('active');
}

window.onscroll = () => {
    profile.classList.remove('active');

    if(window.innerWidth < 1200){
        sideBar.classList.remove('active');
        body.classList.remove('active');
    }
}

let toggleBtn = document.querySelector('#toggle-btn');
let darkMod = localStorage.getItem('dark-mode');

const enableDarkMode = () => {
    toggleBtn.classList.replace("fa-sun","fa-moon");
    body.classList.add('dark');
    localStorage.setItem('dark-mode','enabled');
}

const disableDarkMode = () => {
    toggleBtn.classList.replace("fa-moon","fa-sun");
    body.classList.remove('dark');
    localStorage.setItem('dark-mode','disabled');
}




// let fColor = document.getElementsByClassName('option-btn');
// let sColor = document.getElementsByClassName('fas fa-search');

if(darkMod === 'enabled'){
    enableDarkMode(); 
//     sColor[0].style.backgroundColor = '#2c3e50';
//     fColor[0].style.color = 'var(--main--color)';
//     fColor[1].style.color = 'var(--main--color)';
}





toggleBtn.onclick = (e) => {
    let darkMod = localStorage.getItem('dark-mode');
    if(darkMod === 'disabled') {
        enableDarkMode();
        // sColor[0].style.backgroundColor = '#2c3e50';
        // fColor[0].style.color = 'var(--main--color)';
        // fColor[1].style.color = 'var(--main--color)';
        
    } else {
        // sColor[0].style.backgroundColor = '#fff';
        // fColor[0].style.color = 'var(--main--color)';
        // fColor[1].style.color = 'var(--main--color)';
        disableDarkMode();

    }
}
