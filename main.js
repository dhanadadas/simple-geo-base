function loadJson(action, select = false) {

	let element = document.querySelector(`select[name=${action}]`);
	let city = document.querySelector("select[name='city']");

	element.setAttribute('disabled', 'disabled'); // делаем список городов не активным

	if (action === 'region') city.setAttribute('disabled', 'disabled'); // если функция запрашивает регионы,

	let value = select.value;

	fetch(`api.php?action=${action}&id=${value}`) // отправляем
		.then((response) => {
			return response.json();
		})
		.then((dataList) => {
			removeChild(element);
			//element.html(''); // очищаем список текущих елементов
			if (action === 'region') {
				removeChild(city);
				//city.html('');
				city.insertAdjacentHTML("beforeend", '<option value="">Выберите регион</option>');
			}
			changeHTML(element, dataList);
		});
	return true;
}

function changeHTML(element, dataList) {
	if (dataList.status === false) { // если подключения нет
		let country = document.querySelector("select[name='country']");
		removeChild(country);
		country.insertAdjacentHTML("beforeend", '<option value="">Укажите подключение к базе данных</option>');
	} else if (dataList.data === false) { // если нет подходящих данных в DB
		element.insertAdjacentHTML("beforeend", '<option value="">Нет данных</option>');
		element.attr('disabled', 'disabled');
	}
	// заполняем список новыми пришедшими данными
	else {
		element.insertAdjacentHTML("beforeend", '<option value="">Выбрать</option>');
		dataList.data.map(function(item) {
			element.insertAdjacentHTML("beforeend", '<option value="' + item.id + '">' + item.name + '</option>');
		});
		element.removeAttribute('disabled'); // делаем список городов активным
	}
}

function removeChild(element) {
	while (element.firstChild) {
		element.removeChild(element.firstChild);
	}
}

loadJson('country'); // загрузка стран