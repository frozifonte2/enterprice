<template>
	<section class="modal-overlay" v-if="show">
        <div class="modal modal-add">
            <div class="modal__items">
                <h2 class="modal__title">Редактировать <span>{{ name }}</span></h2>
                <a href="javascript:void(0);" @click="close" class="modal__close">
                    <CloseModalImg/>
                </a>
            </div>
            <div class="modal__wrapper">
                <form @submit.prevent="updateItem(id, article, name, status, data)" class="modal__form">
                    <template v-if="role === 'admin'">
                        <label for="" class="modal__text">Артикул</label>
                        <input type="text" class="modal__input" :value="articlearticle" @input="articlearticle = $event.target.value">
                        <div class="modal__error" v-if="errors.article">{{ errors.article }}</div>
                    </template>
                    <label for="" class="modal__text">Название</label>
                    <input type="text" class="modal__input" :value="name" @input="name = $event.target.value">
                    <div class="modal__error" v-if="errors.name">{{ errors.name }}</div>
                    <label for="" class="modal__text">Статус</label>
                    <select id="" class="modal__input" :value="status" @input="status = $event.target.value">

                        <option value="available"  class="modal__input" selected>Доступен</option>
                        <option value="unavailable" class="modal__input">Не доступен</option>

                    </select>
                    
                    <h5 class="modal__h5">Атрибуты</h5>
                    <div class="modal__wrapitems" v-for="(item, index) in data" :key="index">
                        <div class="modal__list">
                            <div class="modal__item">
                                <label for="" class="modal__text">Название</label>
                                <input type="text" class="modal__input" :value="data[index].key" @input="data[index].key = $event.target.value" required>
                            </div>
                            <div class="modal__item">
                                <label for="" class="modal__text">Значение</label>
                                <input type="text" class="modal__input" :value="data[index].value" @input="data[index].value = $event.target.value" required>
                            </div>
                            <div class="modal__item">
                                <a href="#" class="modal__del-attr" @click.prevent="deleteAttributes(index)">
                                    <DataItemDeleteImg/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="modal__add-attr" @click="addAttributes">+ Добавить атрибут</a>
                    <button class="modal__button button">Сохранить</button>
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
            show: false,
        }
    },
    components: {
        CloseModalImg,
        DataItemDeleteImg
    },
    props: [
        'id',
        'article',
        'name',
        'status',
        'role',
        'data',
        'errors'
        ],
    methods: {
        updateItem(id, article, name, status, data) {
            this.$inertia.patch(`/${id}`, {
                article: article, 
                name: name, 
                status: status, 
                data: JSON.stringify(this.data)
            },{
                onSuccess: () => { 
                    this.close(); 
                },
            });
            
        },
        close() {
            this.show = false;
        },
        deleteAttributes(index) {
            this.data.splice(index, 1);
        },
        addAttributes() {
            this.data.push({key: '', value: ''});
        },
    }
}
</script>