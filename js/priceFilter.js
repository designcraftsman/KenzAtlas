function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#C6C6C6', '#94863D', controlSlider);
    if (from > to) {
        fromSlider.value = to;
        fromInput.value = to;
    } else {
        fromSlider.value = from;
    }
}
    
function controlToInput(toSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#C6C6C6', '#94863D', controlSlider);
    setToggleAccessible(toInput);
    if (from <= to) {
        toSlider.value = to;
        toInput.value = to;
    } else {
        toInput.value = from;
    }
}

function controlFromSlider(fromSlider, toSlider, fromInput) {
  const [from, to] = getParsed(fromSlider, toSlider);
  fillSlider(fromSlider, toSlider, '#C6C6C6', '#94863D', toSlider);
  if (from > to) {
    fromSlider.value = to;
    fromInput.value = to;
  } else {
    fromInput.value = from;
  }
}

function controlToSlider(fromSlider, toSlider, toInput) {
  const [from, to] = getParsed(fromSlider, toSlider);
  fillSlider(fromSlider, toSlider, '#C6C6C6', '#94863D', toSlider);
  setToggleAccessible(toSlider);
  if (from <= to) {
    toSlider.value = to;
    toInput.value = to;
  } else {
    toInput.value = from;
    toSlider.value = from;
  }
}

function getParsed(currentFrom, currentTo) {
  const from = parseInt(currentFrom.value, 10);
  const to = parseInt(currentTo.value, 10);
  return [from, to];
}

function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
    const rangeDistance = to.max-to.min;
    const fromPosition = from.value - to.min;
    const toPosition = to.value - to.min;
    controlSlider.style.background = `linear-gradient(
      to right,
      ${sliderColor} 0%,
      ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
      ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
      ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} 100%)`;
}

function setToggleAccessible(currentTarget) {
  const toSlider = document.querySelector('#toSlider');
  if (Number(currentTarget.value) <= 0 ) {
    toSlider.style.zIndex = 2;
  } else {
    toSlider.style.zIndex = 0;
  }
}



const fromSlider = document.querySelector('#fromSlider');
const toSlider = document.querySelector('#toSlider');
const fromInput = document.querySelector('#fromInput');
const toInput = document.querySelector('#toInput');

const fromSliderMobile = document.querySelector('#fromSliderMobile');
const toSliderMobile = document.querySelector('#toSliderMobile');
const fromInputMobile = document.querySelector('#fromInputMobile');
const toInputMobile = document.querySelector('#toInputMobile');

fillSlider(fromSlider, toSlider, '#C6C6C6', '#94863D', toSlider);
setToggleAccessible(toSlider);

fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);


fillSlider(fromSliderMobile, toSliderMobile, '#C6C6C6', '#94863D', toSliderMobile);
setToggleAccessible(toSlider);

fromSliderMobile.oninput = () => controlFromSlider(fromSliderMobile, toSliderMobile, fromInputMobile);
toSliderMobile.oninput = () => controlToSlider(fromSliderMobile, toSliderMobile, toInputMobile);
fromInputMobile.oninput = () => controlFromInput(fromSliderMobile, fromInputMobile, toInputMobile, toSliderMobile);
toInputMobile.oninput = () => controlToInput(toSliderMobile, fromInputMobile, toInputMobile, toSliderMobile);





  const priceFilterBtn = document.getElementById('priceFilterBtn');

    priceFilterBtn.addEventListener('click', ($event) => {
      $event.preventDefault();
      var products = document.querySelectorAll('.shop__container__products__list__product');
      products.forEach((product) => {
        const productPrice = product.querySelector('.shop__container__products__list__product__price').textContent;
        const productPriceParse = parseFloat(productPrice);
        if (productPriceParse >= fromSlider.value && productPriceParse <= toSlider.value ){
          product.classList.remove('d-none');
        } else {
          product.classList.add('d-none');
        }
      });
  });

  const priceFilterBtnMobile = document.getElementById('priceFilterBtnMobile');
 

  priceFilterBtnMobile.addEventListener('click', ($event) => {
    var products = document.querySelectorAll('.shop__container__products__list__product');
    products.forEach((product) => {
      const productPrice = product.querySelector('.shop__container__products__list__product__price').textContent;
      const productPriceParse = parseFloat(productPrice);
      if (productPriceParse >= fromSliderMobile.value && productPriceParse <= toSliderMobile.value ){
        product.classList.remove('d-none');
      } else {
        product.classList.add('d-none');
      }
    }); 
 
    
});


//Products search bar fitler