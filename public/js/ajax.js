const select = document.querySelectorAll('.currency');
const number = document.getElementById("number");
const output = document.getElementById("output");

$(document).ready(function() {
	$(function() {
		$('#datetimepicker6').datetimepicker();
		$('#datetimepicker7').datetimepicker({
			useCurrent: false //Important! See issue #1075
		});
		$("#datetimepicker6").on("dp.change", function(e) {
			$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
		});
		$("#datetimepicker7").on("dp.change", function(e) {
			$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
		});
	});
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
	console.log(baseCurrency, targetCurrency, amount);
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
