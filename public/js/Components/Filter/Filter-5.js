FilterValue5 = document.querySelectorAll(".filter-list-wrapper-5 .filter-value-5");function filterFunction5() {
    var input5, filter5;
    input5 = document.getElementById("FILTER_Input5"); 
    filter5 = input5.value.toUpperCase();
    div5 = document.querySelector(".filter-list-wrapper-5");
    EmptyFilter5 = document.querySelector(".filter-list-wrapper-5 .empty5");
    FilterValue_SHOW = document.querySelectorAll(".filter-list-wrapper-5 .Show");
 
    for (i = 0; i < FilterValue5.length; i++) {
      txtValue = FilterValue5[i].textContent || FilterValue5[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter5) > -1) {
        FilterValue5[i].style.display = "";
        EmptyFilter5.classList.remove('Show');  
    } else {
        FilterValue5[i].style.display = "none";
        EmptyFilter5.classList.add('Show');  
      }
    } 
  }
 
  let FILTER_Input5 = document.getElementById("FILTER_Input5"); 
  let FilterListWrapper5 = document.querySelector(".filter-list-wrapper-5"); 
 
FILTER_Input5.addEventListener('keyup', (e) => {
    FilterListWrapper5.classList.add('Show');   
    e.stopPropagation();  
})  
 
document.addEventListener('click', () => {
    FilterListWrapper5.classList.remove('Show'); 
})
FilterListWrapper5.addEventListener('click', (e) => { 
    e.stopPropagation();  
})  

let EngineMake_ = document.querySelector('.AddGeneratorAvailabilityForm input[name=EngineMake]');
let GeneratorId = document.querySelector('.AddGeneratorAvailabilityForm input[name=GeneratorId]');
FilterValue5.forEach(Value => {
  Value.addEventListener('click', () => {
        FILTER_Input5.value = Value.firstElementChild.textContent; 
        EngineMake_.value = Value.firstElementChild.nextElementSibling.firstElementChild.textContent;
        GeneratorId.value = Value.firstElementChild.nextElementSibling.firstElementChild.nextElementSibling.nextElementSibling.textContent;
        FilterListWrapper5.classList.remove('Show');  
    })
});
 