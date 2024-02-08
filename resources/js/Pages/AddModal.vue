<template>
	<section class="modal-overlay" v-if="show">
        <div class="modal modal-add">
            <div class="modal__items">
                <h2 class="modal__title">Добавить продукт</h2>
                <a href="javascript:void(0);" @click="close" class="modal__close">
                    <CloseModalImg/>
                </a>
            </div>
            <div class="modal__wrapper">
                <form @submit.prevent="store" class="modal__form">
                    <label for="" class="modal__text">Артикул</label>
                    <input type="text" class="modal__input" v-model="article">
                    <div class="modal__error" v-if="errors.article">{{ errors.article }}</div>
                    <label for="" class="modal__text">Название</label>
                    <input type="text" class="modal__input" v-model="name">
                    <div class="modal__error" v-if="errors.name">{{ errors.name }}</div>
                    <label for="" class="modal__text">Статус</label>
                    <select class="modal__input" v-model="status">
                        <option value="available"  class="modal__input">Доступен</option>
                        <option value="unavailable" class="modal__input">Не доступен</option>
                    </select>
                    
                    <h5 class="modal__h5">Атрибуты</h5>
                    <div class="modal__wrapitems" v-for="(item, index) in data" :key="index">
                        <div class="modal__list">
                            <div class="modal__item">
                                <label for="" class="modal__text">Название</label>
                                <input type="text" class="modal__input" v-model="data[index].key" required>
                            </div>
                            <div class="modal__item">
                                <label for="" class="modal__text">Значение</label>
                                <input type="text" class="modal__input" v-model="data[index].value" required>
                            </div>
                            <div class="modal__item">
                                <a href="#" class="modal__del-attr" @click.prevent="deleteAttributes(index)">
                                    <DataItemDeleteImg/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="modal__add-attr" @click="addAttributes">+ Добавить атрибут</a>
                    <button class="modal__button button">Добавить</button>
                </form>
            </div>
        </div>
    </section>
</template>
<script>
import CloseModalImg from "@/Components/CloseModal.vue";
import DataItemDeleteImg from "@/Components/DataItemDelete.vue";

export default {
    data() {
        return {
            article: null,
            name: null,
            status: 'available',
            data: [],
            show: false,
        }
    },
    components: {
        CloseModalImg,
        DataItemDeleteImg
    },
    props: [
        'errors'
        ],
    methods: {
        store() {
            this.$inertia.post('/', {
                article: this.article,
                name: this.name,
                status: this.status,
                data: JSON.stringify(this.data)
            }, {
                onSuccess: () => { 
                    this.close(); 
                    this.resetForm();
                },
            });
        },
        close() {
            this.show = false;
        },
        resetForm() {
            this.article = null;
            this.status = 'available';
            this.name = null;
            this.data = [];
        },
        addAttributes() {
            this.data.push({key: '', value: ''});
        },
        deleteAttributes(index) {
            this.data.splice(index, 1);

        }
    }
}
</script>