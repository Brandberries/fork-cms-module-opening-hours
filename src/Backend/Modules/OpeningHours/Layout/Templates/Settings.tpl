{include:{$BACKEND_CORE_PATH}/Layout/Templates/Head.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureStartModule.tpl}

<div class="pageTitle">
	<h2>{$lblModuleSettings|ucfirst}: {$lblOpeningHours}</h2>
</div>

{form:settings}
	<div class="box horizontal">
		<div class="heading">
			<h3>{$lblOpeningHours|ucfirst}</h3>
		</div>
		<div class="options">

			<p>{$msgDays}</p>
			<table>
				<tr>
					<td></td>
					<td><label for="mondayStart1">{$lblFrom}</label></td>
					<td><label for="mondayStop1">{$lblUntil}</label></td>
					<td><label>{$lblAnd}</label></td>
					<td><label for="mondayStart2">{$lblFrom}</label></td>
					<td><label for="mondayStop2">{$lblUntil}</label></td>
				</tr>

				<tr>
					<td><label for="mondayStart1">{$lblMonday}</label></td>
					<td>{$txtMondayStart1}</td>
					<td>{$txtMondayStop1}</td>
					<td></td>
					<td>{$txtMondayStart2}</td>
					<td>{$txtMondayStop2}</td>
				</tr>

				<tr>
					<td><label for="tuesdayStart1">{$lblTuesday}</label></td>
					<td>{$txtTuesdayStart1}</td>
					<td>{$txtTuesdayStop1}</td>
					<td></td>
					<td>{$txtTuesdayStart2}</td>
					<td>{$txtTuesdayStop2}</td>
				</tr>

				<tr>
					<td><label for="wednesdayStart1">{$lblWednesday}</label></td>
					<td>{$txtWednesdayStart1}</td>
					<td>{$txtWednesdayStop1}</td>
					<td></td>
					<td>{$txtWednesdayStart2}</td>
					<td>{$txtWednesdayStop2}</td>
				</tr>

				<tr>
					<td><label for="thursdayStart1">{$lblThursday}</label></td>
					<td>{$txtThursdayStart1}</td>
					<td>{$txtThursdayStop1}</td>
					<td></td>
					<td>{$txtThursdayStart2}</td>
					<td>{$txtThursdayStop2}</td>
				</tr>

				<tr>
					<td><label for="fridayStart1">{$lblFriday}</label></td>
					<td>{$txtFridayStart1}</td>
					<td>{$txtFridayStop1}</td>
					<td></td>
					<td>{$txtFridayStart2}</td>
					<td>{$txtFridayStop2}</td>
				</tr>

				<tr>
					<td><label for="saturdayStart1">{$lblSaturday}</label></td>
					<td>{$txtSaturdayStart1}</td>
					<td>{$txtSaturdayStop1}</td>
					<td></td>
					<td>{$txtSaturdayStart2}</td>
					<td>{$txtSaturdayStop2}</td>
				</tr>

				<tr>
					<td><label for="sundayStart1">{$lblSunday}</label></td>
					<td>{$txtSundayStart1}</td>
					<td>{$txtSundayStop1}</td>
					<td></td>
					<td>{$txtSundayStart2}</td>
					<td>{$txtSundayStop2}</td>
				</tr>




			</table>
		</div>
	</div>
	<div class="box horizontal">
		<div class="heading">
			<h3>{$lblClosed|ucfirst}</h3>
		</div>
		<div class="options">
			<p>{$msgClosed}</p>
			<p>
				<label for="closed">{$lblClosed|ucfirst}</label>
				{$txtClosed} {$txtClosedError}
			</p>
		</div>

	</div>

	<div class="fullwidthOptions">
		<div class="buttonHolderRight">
			<input id="save" class="inputButton button mainButton" type="submit" name="save" value="{$lblSave|ucfirst}" />
		</div>
	</div>
{/form:settings}

{include:{$BACKEND_CORE_PATH}/Layout/Templates/StructureEndModule.tpl}
{include:{$BACKEND_CORE_PATH}/Layout/Templates/Footer.tpl}
