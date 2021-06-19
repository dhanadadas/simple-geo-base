/**
 * Функция loadJson принимает событие, текущий элемент и загружает JSON с api.php
 *
 * @param action  событие GET
 * @param select текущий элемент
 * @returns {boolean}
 */
function loadJson(action, select = false) {

	let element = document.querySelector(`select[name=${action}]`);
	let city = document.querySelector("select[name='city']");

	element.setAttribute('disabled', 'disabled'); // делаем список городов не активным

	if (action === 'region') city.setAttribute('disabled', 'disabled');

	let value = select.value;

	fetch(`api.php?action=${action}&id=${value}`) // получаем JSON
		.then((response) => {
			return response.json();
		})
		.then((JSON) => {
			removeChild(element); // очищаем список текущих елементов
			if (action === 'region') {
				removeChild(city); // очищаем города
				city.insertAdjacentHTML("beforeend", '<option value="">Выберите регион</option>');
			}
			changeHTML(element, JSON);
		});
	return true;
}

/**
 * Функция changeHTML принимае JSON и текущий элемент, и изменяет DOM
 *
 * @param element
 * @param JSON
 */
function changeHTML(element, JSON) {
	if (JSON.status === false) { // если подключения нет
		let country = document.querySelector("select[name='country']");
		removeChild(country);
		country.insertAdjacentHTML("beforeend", '<option value="">Укажите подключение к базе данных</option>');
	} else if (JSON.data === false) { // если нет подходящих данных в DB
		element.insertAdjacentHTML("beforeend", '<option value="">Нет данных</option>');
		element.attr('disabled', 'disabled');
	}
	// заполняем список новыми пришедшими данными
	else {
		element.insertAdjacentHTML("beforeend", '<option value="">Выбрать</option>');
		JSON.data.map(function(item) {
			element.insertAdjacentHTML("beforeend", '<option value="' + item.id + '">' + item.name + '</option>');
		});
		element.removeAttribute('disabled'); // делаем список городов активным
	}
}

/**
 * Функция очистки дочерних option
 *
 * @param element
 */
function removeChild(element) {
	while (element.firstChild) {
		element.removeChild(element.firstChild);
	}
}

loadJson('country'); // загрузка стран