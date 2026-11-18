const FilterValue = document.querySelectorAll(".filter-list-wrapper .filter-value");
function filterFunction() {
    const input = document.getElementById("FILTER_Input");
    if (!input) return;
    const filter = input.value.toUpperCase();
    const wrapper = document.querySelector(".filter-list-wrapper");
    const emptyFilter = wrapper?.querySelector(".empty");
 
    for (i = 0; i < FilterValue.length; i++) {
      const txtValue = FilterValue[i].textContent || FilterValue[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        FilterValue[i].style.display = "";
        emptyFilter?.classList.remove('Show');
    } else {
        FilterValue[i].style.display = "none";
        emptyFilter?.classList.add('Show');
      }
    } 
  } 

const FILTER_Input = document.getElementById("FILTER_Input");
const FilterListWrapper = document.querySelector(".filter-list-wrapper");

if (FILTER_Input && FilterListWrapper) {
    FILTER_Input.addEventListener('keyup', (e) => {
        FilterListWrapper.classList.add('Show');
        e.stopPropagation();
    });

    document.addEventListener('click', () => {
        FilterListWrapper.classList.remove('Show');
    });
    FilterListWrapper.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}

FilterValue.forEach(Value => {
  Value.addEventListener('click', () => {
    const form = document.querySelector('.AddTestimonialForm');
    if (!FILTER_Input || !FilterListWrapper || !form) return;
    FILTER_Input.value = Value.firstElementChild?.textContent ?? '';
    FilterListWrapper.classList.remove('Show');
    const cells = [...Value.children];
    const setValue = (selector, value) => {
      const field = form.querySelector(selector);
      if (field) field.value = value;
    };
    setValue('input[name=StaffNumber]', cells[0]?.textContent ?? '');
    setValue('input[name=DateOfBirth]', cells[1]?.textContent ?? '');
    setValue('input[name=DischargeBook]', cells[2]?.textContent ?? '');
    setValue('input[name=PreviousVessel]', cells[3]?.textContent ?? '');
    setValue('select[name=Rank]', cells[4]?.textContent ?? '');
    setValue('select[name=Company]', cells[5]?.textContent ?? '');
  })
});
 