const header=document.getElementById('header');
const verticalBar=document.querySelector('.vertical-bar');
function showNavBar(){
    verticalBar.style.display='flex';
}
function hideNavBar(){
    verticalBar.style.display='none';
}
let lastScrollY=0;
let isHeaderHidden=false;
window.addEventListener('scroll',function(){
    const currentScrollY=window.scrollY;
    if(currentScrollY > lastScrollY && !isHeaderHidden){
        header.style.top='-100px'
        isHeaderHidden=true;
    }
    if(currentScrollY < lastScrollY && isHeaderHidden){
        header.style.top='0'
        isHeaderHidden=false;
    }
    lastScrollY=currentScrollY;
});
window.addEventListener('screen',function(){
    if(screen.maxWidth>800){
        verticalBar.style.display='none'; 
    }
})
function showBar(){
    const verticalBar=document.querySelector('.vertical-menu');
    const horizontalBar=document.querySelector('.horizontal-menu');
    verticalBar.style.display='flex';
    horizontalBar.style.display='none';
}
function hideBar(){
    const verticalBar=document.querySelector('.vertical-menu');
    const horizontalBar=document.querySelector('.horizontal-menu');
    verticalBar.style.display='none';
    horizontalBar.style.display='flex';
}

