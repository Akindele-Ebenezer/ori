let DisplayChartButton = document.querySelector('.availability .dashboard-inner .dashboard-heading svg.-x');
DisplayChartButton.addEventListener('click', () => { 
    Chart1.style.display = 'flex !important'; 
});

let Location1 = document.querySelector('.Location1');
let VesselsOnSiteCloseButton = document.querySelector('.VesselsOnSiteCloseButton');
VesselsOnSiteCloseButton.addEventListener('click', () => { 
    Location1.style.display = 'none'; 
})

let DisplayVesselsOnSiteButton = document.querySelector('.DisplayVesselsOnSiteButton');

DisplayVesselsOnSiteButton.addEventListener('click', () => {
    Location1.style.display = 'flex'; 
})