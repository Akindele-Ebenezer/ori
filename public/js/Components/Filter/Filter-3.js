const FilterValue3 = document.querySelectorAll(".filter-list-wrapper-3 .filter-value-3");
function filterFunction3() {
    const input3 = document.getElementById("FILTER_Input3");
    if (!input3) return;
    const filter3 = input3.value.toUpperCase();
    const wrapper3 = document.querySelector(".filter-list-wrapper-3");
    const emptyFilter3 = wrapper3?.querySelector(".empty3");
 
    for (i = 0; i < FilterValue3.length; i++) {
      const txtValue = FilterValue3[i].textContent || FilterValue3[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter3) > -1) {
        FilterValue3[i].style.display = "";
        emptyFilter3?.classList.remove('Show');
    } else {
        FilterValue3[i].style.display = "none";
        emptyFilter3?.classList.add('Show');
      }
    } 
  }
 
  const FILTER_Input3 = document.getElementById("FILTER_Input3");
  const FilterListWrapper3 = document.querySelector(".filter-list-wrapper-3");
 
  if (FILTER_Input3 && FilterListWrapper3) {
      FILTER_Input3.addEventListener('keyup', (e) => {
          FilterListWrapper3.classList.add('Show');
          e.stopPropagation();
      });

      document.addEventListener('click', () => {
          FilterListWrapper3.classList.remove('Show');
      });
      FilterListWrapper3.addEventListener('click', (e) => {
          e.stopPropagation();
      });
  }

FilterValue3.forEach(Value => {
  Value.addEventListener('click', () => {
    const form = document.querySelector('.UpdateTestimonialForm');
    if (!FILTER_Input3 || !FilterListWrapper3 || !form) return;
    FILTER_Input3.value = Value.firstElementChild?.textContent ?? '';
    FilterListWrapper3.classList.remove('Show');
    const cells = [...Value.children];
    const setValue = (selector, value) => {
      const field = form.querySelector(selector);
      if (field) field.value = value;
    };
    setValue('input[name=EditStaffNumber]', cells[0]?.textContent ?? '');
    setValue('input[name=EditDateOfBirth]', cells[1]?.textContent ?? '');
    setValue('input[name=EditDischargeBook]', cells[2]?.textContent ?? '');
    setValue('input[name=EditPreviousVessel]', cells[3]?.textContent ?? '');
    setValue('select[name=EditRank]', cells[4]?.textContent ?? '');
    setValue('select[name=EditCompany]', cells[5]?.textContent ?? '');
  })
});
 