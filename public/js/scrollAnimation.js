window.addEventListener("scroll", () => {
    const icons = document.querySelectorAll(".anim");

    for (let i = 0; i < icons.length; i++) {
        if (icons[i].offsetTop - 800 <= window.scrollY)
        {
            icons[i].classList.add("begin-animation");
        }
    }
});