{*
	variables that are available:
	{$settings}
		- {$settings.closedExtraordinary} set when it's a holiday or something like that
		- {$settings.closed} set when no opening hours given
		- {$settings.start1} and {$settings.stop1} set when the first period is given
		- {$settings.start2} and {$settings.stop2} set when the second period is given
		- {$settings.bothTimes} set start1 and start2 are given. Might make things simpler to make the template
		Note: it's possible that start2 is given, when start1 is not.


*}

{option:settings}

	<h3>{$lblToday|ucfirst}</h3>

	{option:settings.closed}
		{$msgClosed}
	{/option:settings.closed}

	{option:settings.closedExtraordinary}
		{$msgClosedExtraordinary}
	{/option:settings.closedExtraordinary}

	{option:!settings.closedExtraOrdinary}

		{option:!settings.closed}

			{option:settings.bothTimes}
				{$msgYesWeAreOpenFromAndFrom|sprintf:{$settings.start1}:{$settings.stop1}:{$settings.start2}:{$settings.stop2}}
			{/option:settings.bothTimes}

			{option:!settings.bothTimes}

				{option:settings.start1}
					{$msgYesWeAreOpenFrom|sprintf:{$settings.start1}:{$settings.stop1}}
				{/option:settings.start1}

				{option:settings.start2}
					{$msgYesWeAreOpenFrom|sprintf:{$settings.start2}:{$settings.stop2}}
				{/option:settings.start2}

			{/option:!settings.bothTimes}

		{/option:!settings.closed}

	{/option:!settings.closedExtraOrdinary}

{/option:settings}