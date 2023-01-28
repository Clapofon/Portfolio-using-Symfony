const galleryItems = document.querySelectorAll(".gallery-item");

galleryItems.forEach((element, index) => {
    element.lastElementChild.addEventListener("click", () => {
        const currentImage = element.firstElementChild.firstElementChild.src;

        const html = document.querySelector("html");
        const body = document.querySelector("body");
        const main = document.querySelector(".main");
        const imageViewer = document.createElement("div");
        const header = document.createElement("div");
        const imageCaption = document.createElement("div");
        const exitButton = document.createElement("button");
        const forwardButton = document.createElement("div");
        const backwardButton = document.createElement("div");
        const imageContainer = document.createElement("div");
        const image = document.createElement("img");

        main.classList.add("blur");

        imageViewer.classList.add(...["image-viewer-container", "flex"]);
        body.insertBefore(imageViewer, body.firstChild);
        html.classList.add("prevent-scroll");

        header.classList.add(...["image-viewer-header", "flex"]);
        imageViewer.appendChild(header);

        imageCaption.classList.add("image-caption");
        imageCaption.innerHTML = element.children.item(1).innerHTML;
        header.appendChild(imageCaption);

        exitButton.classList.add("image-viewer-exit-button");
        header.appendChild(exitButton);

        imageContainer.classList.add(...["image-container", "flex"]);
        imageViewer.appendChild(imageContainer);

        image.src = currentImage;
        imageContainer.appendChild(image);

        forwardButton.classList.add(...["arrow", "forward", "flex"]);
        forwardButton.innerHTML = "&#62;";
        imageViewer.appendChild(forwardButton);

        backwardButton.classList.add(...["arrow", "backward", "flex"]);
        backwardButton.innerHTML = "&#60;";
        imageViewer.appendChild(backwardButton);

        const previousImage = () => {
            if (index > 0) {
                image.src = galleryItems[--index].firstElementChild.firstElementChild.src
            }
            else {
                index = galleryItems.length - 1;
                image.src = galleryItems[index].firstElementChild.firstElementChild.src
            }

            imageCaption.innerHTML = galleryItems[index].children.item(1).innerHTML;
        }

        const nextImage = () => {
            if (index < galleryItems.length - 1) {
                image.src = galleryItems[++index].firstElementChild.firstElementChild.src
            }
            else {
                index = 0;
                image.src = galleryItems[index].firstElementChild.firstElementChild.src
            }

            imageCaption.innerHTML = galleryItems[index].children.item(1).innerHTML;
        }

        const handleScroll = (event) => {
            event.preventDefault();

            if (event.deltaY > 0) {
                nextImage();
            }

            if (event.deltaY < 0) {
                previousImage();
            }
        }

        const exitImageViewer = () => {
            html.classList.remove("prevent-scroll");
            body.removeChild(imageViewer);
            main.classList.remove("blur");

            exitButton.removeEventListener("click", exitImageViewer);
            forwardButton.removeEventListener("click", nextImage);
            backwardButton.removeEventListener("click", previousImage);
            imageContainer.removeEventListener("wheel", handleScroll);
            document.removeEventListener("keydown", proccessKeyboardInput);
        }

        const proccessKeyboardInput = (event) => {
            switch (event.key) {
                case "Escape":
                    exitImageViewer();
                    break;
                case "ArrowLeft":
                    previousImage();
                    break;
                case "ArrowRight":
                    nextImage();
                    break;
                default:
                    break;
            }
        }

        imageContainer.addEventListener("wheel", handleScroll);
        exitButton.addEventListener("click", exitImageViewer);
        forwardButton.addEventListener("click", nextImage);
        backwardButton.addEventListener("click", previousImage);

        document.addEventListener("keydown", proccessKeyboardInput);
    });
});

