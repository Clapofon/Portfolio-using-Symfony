const returnButton = document.querySelector(".return-to-top-button");

returnButton.addEventListener("click", () => {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    });
});