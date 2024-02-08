<template>
	<section class="modal-overlay" v-if="show">
		<div class="modal">
			<div class="modal__items">
				<h2 class="modal__title">{{ name }}</h2>
				<div class="modal__buttons">
					<a href="javascript:void(0);" @click="update(id)">
						<ItemEditImg />
					</a>
					<a href="javascript:void(0);" @click="showDelete()">
						<ItemDeleteImg />
					</a>
					<a href="javascript:void(0);" @click="close" class="modal__close">
						<CloseModalImg/>
					</a>
				</div>
			</div>
			<div class="modal__wrapper">
				<label for="" class="modal__text">Артикул:
					<span>{{ article }}</span>
				</label>
				<label for="" class="modal__text">Название:
					<span>{{ name }}</span>
				</label>
				<label for="" class="modal__text">Статус:
					<template v-if="status === 'available'">
					     <span>Доступен</span>
					</template>
					<template v-else>
					     <span>Не доступен</span>
					</template>
				</label>
				<label for="" class="modal__text">Характеристики:
					<template v-if="data.length > 0">
						<template v-for="item in data">
							<span class="attr-text">{{ item['key'] }}: {{ item['value'] }}</span>
						</template>
					</template>
					<template v-else>
						<span>Отсутствуют</span>
					</template>

				</label>
			</div>
		</div>
	</section>
	<UpdateModal ref="showUpdate" :id='id' :errors="errors" :article="article" :name="name" :role="role" :status="status" :data="data"/>
	<DeleteModal ref="showDelete" :id='id' :article="article" :name="name"/>
</template>
<script>
import UpdateModal from "@/Pages/UpdateModal.vue";
import DeleteModal from "@/Pages/DeleteModal.vue";
import ItemDeleteImg from "@/Components/ItemDelete.vue";
import ItemEditImg from "@/Components/ItemEdit.vue";
import CloseModalImg from "@/Components/CloseModal.vue";

export default {
	name: 'ShowModal',

	components: {
		UpdateModal,
		DeleteModal,
		ItemDeleteImg,
		ItemEditImg,
		CloseModalImg
	},
	props: [
		'id',
		'article',
		'name',
		'status',
		'data',
		'role',
		'errors',
	],
	data() {
		return {
			show: false
		}
	},
	methods: {
		close() {
			this.show = false;
		},
		update(id) {
			this.$refs.showUpdate.show = true;
			this.show = false;
		},
		showDelete() {
			this.$refs.showDelete.show = true;
			this.show = false;
		}
	}

}
</script>