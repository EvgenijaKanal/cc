<div class="currency-row-outer">
	<div class="currency-converter">
		<h2>Currency Converter</h2>

		<div class="field grid-50-50">
			<div class="colmun col-left">
				<input type="number" class="form-input" id="number" placeholder="00000">
			</div>
			<div class="colmun col-right">
				<div class="select">
					<select name="currency" class="currency" onchange="updatevalue()"></select>
				</div>
			</div>
		</div>

		<div class="field grid-50-50">
			<div class="colmun col-left">
				<input type="text" class="form-input" id="output" placeholder="00000" disabled>
			</div>
			<div class="colmun col-right">
				<div class="select">
					<select name="currency" class="currency" onchange="updatevalue()"></select>
				</div>
			</div>
		</div>

	</div>
</div>
