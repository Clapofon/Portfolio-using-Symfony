const main = document.querySelector(".main");

let video = document.createElement("video");
video.autoplay = true;
video.loop = true;
video.muted = true;
//video.src = "../video/franklinsHousePageVideo.mp4";
video.src = "video/landingPageVideo.mp4";
video.width = window.screen.width;
video.classList.add("landing-page-video");

main.insertBefore(video, main.firstChild);
