export default
{
	/**
	 * Get a message
	 *
	 * @param state
	 * @returns {string}
	 */
	message( state )
	{
		return state.message;
	},

	/**
	 * Get the message type
	 *
	 * @param state
	 * @returns {string}
	 */
	success( state )
	{
		return state.success;
	},

	/**
	 * Return alert
	 *
	 * @param state
	 * @returns {boolean}
	 */
	alert( state )
	{
		return state.alert;
	},

	/**
	 * Get errors
	 *
	 * @param state
	 * @returns {Array}
	 */
	errors( state )
	{
		return state.errors;
	},

	/**
	 * Get the current date
	 *
	 * @param state
	 * @returns {string}
	 */
	currentDate( state )
	{
		return state.currentDate;
	},

	/**
	 * Get map center point
	 *
	 * @param state
	 * @returns {{lat: number, lng: number}|state.mapCenter|{lat, lng}}
	 */
	mapCenter( state )
	{
		return state.mapCenter;
	}
}
