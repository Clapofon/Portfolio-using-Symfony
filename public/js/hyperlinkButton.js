const buttons = document.querySelectorAll(".hyperlink-button");

for (let i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click", () => {
        const link = buttons[i].nextElementSibling.value;
        window.location.href = link;
    });
}