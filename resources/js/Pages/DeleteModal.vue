<template>
	<section class="modal-overlay" v-if="show">
		<div class="del-modal">
			<div class="modal__items">
				<h2 class="modal__title">Удаление записи {{ name }}</h2>
				<div class="modal__buttons">
					<a href="javascript:void(0);" @click="close" class="modal__close">
						<CloseModalImg/>
					</a>
				</div>
			</div>
			<div class="modal__wrapper">
				<h2 class="modal__h5 del-modal__text">Вы дейсвительно хотите удалить {{ name }}?</h2>
				<div class="modal__del-buttons">
					<a href="javascript:void(0);" @click="deleteItem(id)" class="del-button">Да</a>
					<a href="javascript:void(0);" @click="close" class="button">Нет</a>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
import CloseModalImg from "@/Components/CloseModal.vue";


export default {
	props: [
		'id',
		'name'
		],
	components: {
		CloseModalImg
	},
	data() {
		return {
			show: false,
		}
	},
	methods: {
		close() {
			this.show = false;
		},
		deleteItem(id) {
			this.$inertia.delete(`/${id}`, id);
			this.close();
		}
	}
}
</script>