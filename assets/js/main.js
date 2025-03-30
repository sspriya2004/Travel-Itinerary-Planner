document.getElementById('menu-toggle').addEventListener('click', () => {
    document.getElementById('sidenav').classList.toggle('active'); 
    document.getElementById('menu-toggle').classList.toggle('active');
    document.getElementById('main-content').classList.toggle('blurred');
})
let logout = document.getElementById('btn-logout')
logout.addEventListener('click', () => {
    console.log(window.removeUser);
    console.log(window.removePassword);
})