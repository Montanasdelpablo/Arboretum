import { Bar } from 'vue-chartjs';
import chartConfig from "@/defaultChartConfig";

export default {
	extends: Bar,
	props: [ 'datasets', 'labels' ],

	mounted() {
		this.renderBarChart();
	},

	methods: {
		renderBarChart() {
			this.renderChart(
				{
					labels: this.labels,
					datasets: this.datasets
				},
				chartConfig
			);
		}
	},

	watch: {
		datasets( after )
		{
			this.$data._chart.destroy();
			this.renderBarChart();
		},
	}
};