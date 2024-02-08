<template>
	<div class="overlay" v-if="show">
		<div class="overlay__img">
			1111111111
			<LogoOverlay/>
		</div>
	</div>
</template>
<script>
import LogoOverlay from "@/Pages/LogoOverlay.vue";
export default {
	components: {
		LogoOverlay,
	},
	data() {
		return {
			show: true,
		};
	},
	mounted() {
		this.show = false;
	},
};
</script>