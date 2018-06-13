export default
{
	/**
	 * Set a custom message
	 *
	 * @param state
	 * @param message
	 */
	message( state, message )
	{
		state.message = message;
		state.alert = true;
	},

	/**
	 * Hide an alert
	 *
	 * @param state
	 * @param alert
	 */
	hideAlert( state, alert )
	{
		state.alert = false;
	},

	/**
	 * Store request success
	 *
	 * @param state
	 * @param success
	 */
	success( state, success )
	{
		state.success = success;
		state.alert = true;
	},

	/**
	 * Store request errors
	 *
	 * @param state
	 * @param errors
	 */
	errors( state, errors )
	{
		state.errors = errors;
		state.alert = true;
	},

	/**
	 * Set the current date
	 * This makes sure a user can't search before this date
	 * @param state
	 */
	currentDate( state )
	{
		let date = new Date(),
			dd = date.getDate(),
			mm = date.getMonth() + 1,
			yy = date.getFullYear();

		if( dd < 10 ) {
			dd = `0${dd}`;
		}

		if( mm < 10 ) {
			mm = `0${mm}`;
		}

		state.currentDate = `${yy}-${mm}-${dd}`;
	},

	/**
	 * Change map center if needed
	 * @param state
	 * @param center
	 */
	mapCenter( state, center )
	{
		state.mapCenter = center;
	}
}
