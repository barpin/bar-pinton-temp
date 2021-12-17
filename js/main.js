const cols = 3;
const sliderWrapper = document.getElementById('sliderWrapper');
let parts = [];
let images = ['../images/asd1.jpg', '../images/asd2.jpg'];
let current = 0;

// Agrega las iamgenes al html
for(let col=0;col<cols;col++){
    alert('asd')
    let part = document.createElement('div'); // Aca creamos el elemento de tag Div
    part.className = 'part'; // Aca le damos el nombre a la clase

    sliderWrapper.appendChild(part);

    parts.push(part);
}