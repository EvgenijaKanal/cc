const select = document.querySelectorAll('.currency');
const number = document.getElementById("number");
const output = document.getElementById("output");
const currencies = document.getElementById("currencies-list");
const table = document.getElementById("table");
const tbodyElement = document.querySelector("table tbody");

$(document).ready(function() {
	$( function() {
		$('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();
	} );
});

$.ajax({
	url: 'http://cur.com/list',
	type: "POST",
	success: function(response) {
		console.log('responseresponse', response);
		display(response.results);
	},
	error: function(response) {
		alert(JSON.parse(response.responseText));
	}
});

function display(data) {
	const entries = Object.entries(data);
	for (var i = 0; i < entries.length; i++) {
		select[0].innerHTML += `<option value="${entries[i][0]}">${entries[i][0]} : ${entries[i][1].currencyName}</option>`;
		select[1].innerHTML += `<option value="${entries[i][0]}">${entries[i][0]} : ${entries[i][1].currencyName}</option>`;
	}
}

function updatevalue() {
	let baseCurrency = select[0].value;
	let targetCurrency = select[1].value;
	let value = number.value;

	if (baseCurrency != targetCurrency && value !== "") {
		convert(baseCurrency, targetCurrency, value);
	}
}

function convert(baseCurrency, targetCurrency, amount) {
	$.ajax({
		url: 'http://cur.com/convert',
		type: "POST",
		data: {
			amount: amount,
			baseCurrency: baseCurrency,
			targetCurrency: targetCurrency,
			},
		success: function(response) {
			console.log('responseresponse', response);

			output.value = response;
		},
		error: function(response) {
			alert(JSON.parse(response.responseText));
		}
	});
}

function historicaldata() {
	var date = $('#datepicker').datepicker("option", "dateFormat", 'yy-mm-dd' ).val();

	let value = currencies.value;
	if (value !== "") {
		let arr = value.split(',');
		$.ajax({
			url: 'http://cur.com/historicaldata',
			type: "POST",
			data: {
				list: arr,
				date: date,
			},
			success: function (response) {
				tbodyElement.innerHTML = '';
				var thElement = document.querySelector("table th");
				thElement.textContent = date;

				const curiencies = Object.entries(response);
				for (var i = 0; i < curiencies.length; i++) {
					var currency = Object.entries(curiencies[i][1]);
					tbodyElement.innerHTML += `
					<tr>
						<td>${currency[0][0]}</td>
						<td>${currency[0][1]}</td>
					</tr>`;
				}

				modal.classList.remove("hidden");
				overlay.classList.remove("hidden");
			},
			error: function (response) {
				alert(JSON.parse(response.responseText));
			}
		});
	}
}
