function openMenu() {
    const menus = document.getElementById('menus');

    menus.classList.remove('hidden')
    menus.classList.add('flex')
    setTimeout(() => {
        menus.classList.remove('translate-y-full')
        menus.classList.add('translate-y-0')
    }, 100)
}

function closeMenu() {
    const menus = document.getElementById('menus');

    menus.classList.add('translate-y-full')
    menus.classList.remove('translate-y-0')
    setTimeout(() => {
        menus.classList.add('hidden')
        menus.classList.remove('flex')
    }, 100)
}