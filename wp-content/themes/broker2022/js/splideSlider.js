
// https://splidejs.com/guides/getting-started/
let splideSliders = document.getElementsByClassName('js-splide-slider')

for (let i = 0; i < splideSliders.length; i++) {
	let splide = new Splide(splideSliders[ i ]).mount({})
}
