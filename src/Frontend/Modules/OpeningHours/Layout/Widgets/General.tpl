{*
	variables that are available:
	{days} iteration
		- {$days.closedExtraordinary} set when it's a holiday or something like that
		- {$days.closed} set when no opening hours given
		- {$days.start1} and {$days.stop1} set when the first period is given
		- {$days.start2} and {$days.stop2} set when the second period is given
		- {$days.bothTimes} set start1 and start2 are given. Might make things simpler to make the template
		- {$days.today} set if is this day is today.
		Note: it's possible that start2 is given, when start1 is not.

*}


{option:days}

	<h3>{$lblOpeningHours|ucfirst}</h3>

	<table>
		<tr>
			<th></th>
			<th>{$lblFrom}</th>
			<th>{$lblUntil}</th>
			{option:partOneAndTwo}
				<th>{$lblFrom}</th>
				<th>{$lblUntil}</th>
			{/option:partOneAndTwo}
		</tr>

		{iteration:days}
			<tr>
				<th>{$days.dayName}</th>

				{option:days.closed}
					<td colspan="{option:partOneAndTwo}5{/option:partOneAndTwo}{option:!partOneAndTwo}2{/option:!partOneAndTwo}">{$msgClosedShort}</td>
				{/option:days.closed}

				{option:!days.closed}

					{option:days.start1}
						<td>{$days.start1}</td><td>{$days.stop1}</td>
					{/option:days.start1}

					{option:days.start2}
						<td>{$days.start2}</td><td>{$days.stop2}</td>
					{/option:days.start2}
					{option:!days.start2}
						{option:partOneAndTwo}<td colspan="2"></td>{/option:partOneAndTwo}
					{/option:!days.start2}

				{/option:!days.closed}

			</tr>
		{/iteration:days}
	</table>

	{option:closed}

		<h3>{$lblClosed|ucfirst}</h3>
		<ul>
		{iteration:closed}
			<li>{$closed.date|date:{$dateFormatLong}:{$LANGUAGE}}</li>
		{/iteration:closed}
		</ul>
	{/option:closed}


{/option:days}