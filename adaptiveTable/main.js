/**
 * jsonToTable
 *
 * @param json
 * @returns {string}
 */
function jsonToTable(json) {
	return JSON.parse(json).map(p =>
		`<tr>${[p.id, p.lastname, p.middlename, p.firstname, p.birthday]
			.map(el => `<td>${el}</td>`).join('')}</tr>`).join('');
}

const table = jsonToTable(`[
    {
        "id": "1",
        "lastname": "Иванов",
        "middlename": "Иван",
        "firstname": "Иванович",
        "birthday": "12.12.1976"
    },
    {
        "id": "2",
        "lastname": "Петров",
        "middlename": "Петр",
        "firstname": "Петрович",
        "birthday": "21.02.1984"
    },
    {
        "id": "3",
        "lastname": "Алексеев",
        "middlename": "Алексей",
        "firstname": "Алексеевич",
        "birthday": "03.05.1962"
    },
    {
        "id": "4",
        "lastname": "Владимиров",
        "middlename": "Владимир",
        "firstname": "Владимирович",
        "birthday": "03.05.1962"
    }
]`);

console.log(table);
Table= document.getElementById('table');
Table.insertAdjacentHTML('beforeEnd', table);