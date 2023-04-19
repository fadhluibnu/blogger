function openCard(action, id){
    const headerCard = document.getElementById('headercard'+id)
    const contentHeader = document.getElementById('contentheader'+id)
    const content = document.getElementById('content'+id)
    const onClickHandler = document.getElementById('onclick'+id)
    const btnExpand = document.getElementById('btnexpand'+id) 
    if (action == "open") {
        headerCard.classList.remove('drop-shadow-xl')
        headerCard.classList.add('ddrop-shadow-none')

        contentHeader.classList.add('md:p-10')
        contentHeader.classList.add('md:pt-6')
        contentHeader.classList.remove('md:h-0')
        contentHeader.classList.add('md:min-h-0')

        contentHeader.classList.add('p-10')
        contentHeader.classList.add('pt-6')
        contentHeader.classList.remove('h-0')
        contentHeader.classList.add('min-h-0')
        contentHeader.classList.add('transition-all')
        contentHeader.classList.add('duration-200')
        onClickHandler.setAttribute('onClick', "openCard('close', '1')")
    }else{
        headerCard.classList.add('drop-shadow-xl')
        headerCard.classList.remove('ddrop-shadow-none')

        contentHeader.classList.remove('md:p-10')
        contentHeader.classList.remove('md:pt-6')
        contentHeader.classList.add('md:h-0')
        contentHeader.classList.remove('md:min-h-0')
        contentHeader.classList.remove('p-10')
        contentHeader.classList.remove('pt-6')
        contentHeader.classList.add('h-0')
        contentHeader.classList.remove('min-h-0')
        onClickHandler.setAttribute('onClick', "openCard('open', '1')")
    }
}

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