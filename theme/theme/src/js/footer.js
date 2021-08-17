/* for resize throttling */ 
var resizeID;

//end sticky header

var scrolling_element = document.querySelector('#content');
scrolling_element.addEventListener('scroll', () => {  
    var navbar = document.querySelector('.siteheader'); //let topspace = navbar.offsetTop ;
    var stickpoint = 20;
    if (scrolling_element.scrollTop >= stickpoint) {
      navbar.classList.add("sticky");
    } else {
      navbar.classList.remove("sticky");
    }
});

document.addEventListener('DOMContentLoaded', () => {
    window.played = [];
    window.playOnce = function( caller ) {
        if(! window.played.includes( caller ) ){
            caller.play();
            window.played.push( caller );
        }
    }

    addMobileClick();
    addVidClick();
    addLearnMoreClick();
    if(window.innerWidth <= 768){
        mobilenavToggler();
    }
});

function addLearnMoreClick(){
    let buttons = document.querySelectorAll('.button.learnmore');
    for(let button of buttons){
        button.addEventListener( 'click', (event) => {
            let card = event.target.closest('.card');
            let button = (event.target.classList.contains('button')) ? event.target : event.target.closest('.button');
            let text = card ? card.querySelector('.card-text') : false;
            let bg = card ? card.querySelector('.card-background') : false;
            let buttonwrap = card ? card.querySelector('.buttonwrap') : false;
            card.classList.toggle('open');
            
            if(card && bg && !card.classList.contains('open')) {
              button.innerText = 'Learn More'
            } else { 
              button.innerText = 'Coming Soon'
            }
        })
    }
    
}
export function doPlay(e){
    if(e.target.paused === true){
        e.target.play();
    }
}
function addVidClick(){
    let videos= document.getElementsByClassName('chromevid');
    if(videos){
        for(let video of videos){
            video.addEventListener('click', (e) => {
                console.log(window);
                console.log(window.playOnce);
                window.playOnce( e.target );
            });
        }
    }
}


function addMobileClick(){
    let hamburger = document.getElementById('mobilenav_button');
    if(hamburger){
        hamburger.addEventListener('click', (e)=>{
            let target = e.target.id == "mobilenav_button" ? e.target : e.target.closest('#mobilenav_button');
            target.classList.toggle('active');
            let hamburger = target.querySelector('.burger.burger-squeeze');
            if(hamburger) hamburger.classList.toggle('open');
            let body = document.querySelector('BODY');
            if(target.classList.contains('active')){
                body.setAttribute('style', 'overflow:hidden;overflow-y: hidden;overflow-x: hidden');
            } else {
                body.removeAttribute('style');
            }
     
        })
    }
}


function mobilenavToggler(){
    let mobileToggler = document.querySelectorAll(".footer-nav h5");
    if(mobileToggler.length){
        mobileToggler.forEach((button) => {
            button.addEventListener('click', (event) => {
                var targetElement = event.target || event.srcElement;
    
                let footerNav = targetElement.closest(".footer-nav")
                if(footerNav.classList.contains("open")){
                    footerNav.classList.remove("open");
                }else{
                    footerNav.classList.add("open");
                }
            });
        });
    }
}

