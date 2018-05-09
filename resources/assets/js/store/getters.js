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
	}
}