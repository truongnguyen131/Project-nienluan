const showSocial = (toggleCard, socialCard) => {

    const toggle = document.getElementById(toggleCard),
        social = document.getElementById(socialCard)

    toggle.addEventListener('click', () => {

        if (social.classList.contains('animation')) {
            social.classList.add('down-animation')
            setTimeout(() => {
                social.classList.remove('down-animation')
            }, 1000)
        }
        social.classList.toggle('animation')
    })
}
showSocial('card-toggle-1', 'card-social-1')
showSocial('card-toggle-2', 'card-social-2')
showSocial('card-toggle-3', 'card-social-3')