
const initSlider = () => {
    const imageList = document.querySelector(".slider-wrapper .image-list ");
    const slideButtons = document.querySelectorAll(".slider-wrapper button ");

    const sliderScrollbar = document.querySelector(".container .slider-scrollbar ");
    const scrollbarThumb = document.querySelector(".scrollbar-thumb ");

    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;

     //handle scroll bar thumb drag
    scrollbarThumb.addEventListener("mousedown", (e) =>{
        const sartX = e.clientX;
        const thumbPosition = scrollbarThumb.offsetLeft;

     // update thumb position on mouse move
        const handleMouseMove = (e)  =>{
            const deltaX = e.clientX - sartX;
            const newthumbPosition = thumbPosition + deltaX;
            const maxThumbPosition = sliderScrollbar.getBoundingClientRect().width - scrollbarThumb.offsetWidth;

            const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newthumbPosition ));
            const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;


            scrollbarThumb.style.left = `${boundedPosition}px`;
            imageList.scrollLeft = scrollPosition;

        }
        //remove eventt listener on mouse up
        const handlemouseup = () =>{
         document.removeEventListener("mousemove", handleMouseMove);
        document.removeEventListener("mouseup", handlemouseup);


        }
       //add event listener for drag inetraction
        document.addEventListener("mousemove", handleMouseMove);
        document.addEventListener("mouseup", handlemouseup);

    });

    //slide image accordind to the slide button click
    slideButtons.forEach(button =>{
        button.addEventListener("click", () =>{
           const direction = button.id == "slide-left" ? -1 : 1;
           const scrollAmount = imageList.clientWidth * direction;
           imageList.scrollBy({left: scrollAmount, behavior: "smooth" });

        });
    });

    const handleSlideButtons = () =>{
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "block";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ?  "none" : "block";

    }

   //update scollthumb posittion base on image scroll
    const updateScrollThumbPosition = () =>{
        const scrollPosition = imageList.scrollLeft;
        const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderScrollbar.clientWidth - scrollbarThumb.offsetWidth );
        scrollbarThumb.style.left = `${thumbPosition}px`;
    }
    imageList.addEventListener("scroll", () =>{
        handleSlideButtons();
        updateScrollThumbPosition();

    });
}


  
window.addEventListener("load", initSlider);