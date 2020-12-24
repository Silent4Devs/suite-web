
const btnDark = document.querySelector('#btnDark');

btnDark.addEventListenter('click', () => {
	document.body.classList.toggle('c-dark-theme');

	if (document.body.classList.contains('c-dark-theme')) {
		localStorage.setItem('dark-mode', 'true');
	}
	else{
		localStorage.setItem('dark-mode', 'false');
	}
});

if (localStorage.getItem('dark-mode') == 'true') {
	document.body.classList.add('c-dark-theme');
}
else{
	document.body.classList.remove('c-dark-theme');
}



