document.addEventListener("DOMContentLoaded", () => {
    const header = document.querySelector(".lp-header");
    const minorHeader = document.querySelector(".lp-minor-header");

    header.style.transform = "translateY(0px)";
    minorHeader.style.transform = "translateY(0px)";

    header.style.opacity = "1";
    minorHeader.style.opacity = "1";
});

const lpHeader = document.querySelector(".lp-header");
const lpMinorHeader = document.querySelector(".lp-minor-header");

const wordList = ["Archwiz", "3D Architecture", "Animation", "VFX"];
const descriptions = [
    "Photorealistic architectural wizualizations",
    "Interiors, Houses, Cities",
    "Motion graphics, 3D animation",
    "Visual Effects"
];

lpHeader.innerHTML = wordList[0];
lpMinorHeader.innerHTML = descriptions[0];

let i = 0;

setInterval(() => {
    if (i >= wordList.length) i = 0;
    lpHeader.innerHTML = wordList[i];
    lpMinorHeader.innerHTML = descriptions[i++];
}, 10000);