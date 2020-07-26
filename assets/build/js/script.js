
$('.slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,

    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },{
            breakpoint: 720,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },{
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});



const navbarCheak = document.querySelector('.navbar-collapse');
const nav = document.querySelector('.navbar-toggler');
const header = document.querySelector('.header');

nav.addEventListener('click', () =>{

    if (navbarCheak.classList.contains('show')){
        header.style.background = 'transparent';
    }
    else{
        header.style.background = 'rgba(0,0,0,.8)';
    }
});



