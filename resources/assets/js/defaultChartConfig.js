/**
 * Config as described in https://www.chartjs.org/
 */
const chartConfig = {
	responsive: true,
	maintainAspectRatio: false,
	layout: {
		padding: {
			top: 16
		}
	},
	legend: {
		labels: {
			fontFamily: 'Roboto, sans-serif',
			fontColor: '#fff'
		}
	},
	tooltips: {
		titleFontFamily: 'Roboto, sans-serif',
		bodyFontFamily: 'Roboto, sans-serif'
	},
	scales: {
		yAxes: [
			{
				ticks: {
					beginAtZero: true
				}
			}
		]
	},
	ticks: {
		fontFamily: 'Roboto, sans-serif',
		fontColor: '#fff'
	}
};

export default chartConfig;