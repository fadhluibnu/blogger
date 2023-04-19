function openCard(action, id){
    const headerCard = document.getElementById('headercard'+id)
    const contentHeader = document.getElementById('contentheader'+id)
    const onClickHandler = document.getElementById('onclick'+id)
    const btnExpand = document.getElementById('btnexpand'+id) 
    if (action == "open") {
        headerCard.classList.remove('drop-shadow-xl')
        headerCard.classList.add('ddrop-shadow-none')

        contentHeader.classList.remove('h-0')
        contentHeader.classList.add('h-80')
        contentHeader.classList.add('transition-all')
        contentHeader.classList.add('duration-200')
        onClickHandler.setAttribute('onClick', "openCard('close', '1')")
    }else{
        contentHeader.classList.add('h-0')
        contentHeader.classList.remove('h-80')
        onClickHandler.setAttribute('onClick', "openCard('open', '1')")
    }
}