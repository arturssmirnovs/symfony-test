<template>
	<div>
		<h1>Awesome weather app</h1>

		<p v-if="loading">Something is happening in background..</p>

		<pre v-if="data">{{ data }}</pre>

		<button @click.prevent="getWeatherDetails" v-if="!loading">Let's reload data</button>

		<button @click.prevent="clearCache" v-if="!loading">Let's get rid of old data</button>

	</div>
</template>

<script>
export default {
	methods: {
		getWeatherDetails() {
			this.loading = true;
			this.data = null;

			fetch('/weather')
				.then(res => res.json())
				.then(function (data) {
					this.loading = false;
					this.data = data;
				}.bind(this))
				.catch(function (err) {
					this.loading = false;
					alert(err.message);
				}.bind(this));
		},
		clearCache() {
			this.loading = true;

			fetch('/cache')
				.then(res => res.json())
				.then(function (data) {
					this.loading = false;
				}.bind(this))
				.catch(function (err) {
					this.loading = false;
					alert(err.message);
				}.bind(this));
		},
	},
	created() {
		this.getWeatherDetails();
	},
	data: () => ({
		loading: true,
		data: null,
	}),
}
</script>