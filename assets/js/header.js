const navItems = [shop, profile, cart, women, men];


function activeNav(nav) {
    localStorage.setItem('activeNav', nav);
    navItems.forEach(item => item.classList.remove('active'));
    document.getElementById(nav).classList.add('active');
}

window.addEventListener('DOMContentLoaded', () => {
    const savedNav = localStorage.getItem('activeNav');
    if (savedNav) {
        document.getElementById(savedNav).classList.add('active');
    }
});