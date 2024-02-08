<template>
    <Overlay />
    <Head title="Продукты" />
    <main>
        <aside class="aside">
            <div class="aside__items">
                <div class="aside__img">
                    <ApplicationLogo />
                </div>
                <p class="aside__text">
                    <span>Enterprice</span>
                    <span>Resource</span>
                    <span>Planning</span>
                </p>
            </div>
            <ul class="aside__list">
                <li><a href="#" class="aside__link">Продукты</a></li>
            </ul>
        </aside>
        <article>
            <header>
                <div class="article__items">
                    <ul class="article__list">
                        <li><a href="#" class="article__link">ПРОДУКТЫ</a></li>
                    </ul>
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                        >
                                        {{ $page.props.auth.user.name }}

                                        <svg
                                        class="ms-2 -me-0.5 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        >
                                        <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')"> Профиль </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Выйти
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                >
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path
                    :class="{
                        hidden: showingNavigationDropdown,
                        'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                    />
                    <path
                    :class="{
                        hidden: !showingNavigationDropdown,
                        'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
    </div>
</header>
<section class="main">
    <div class="main__items">
        <template v-if="products.length">
            <table>
                <tr class="row">
                    <th>Артикул</th>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Атрибуты</th>
                </tr>
                <template v-for="product in products"> 
                    <tr @click="showAnItem(product.id)">
                        <td>{{product.article}}</td>
                        <td>{{product.name}}</td>
                        <template v-if="product.status === 'available'">
                         <td>Доступен</td>
                     </template>
                     <template v-else>
                         <td>Не доступен</td>
                     </template>
                     <template v-if="JSON.parse(product.data).length > 0">
                        <td>
                            <template v-for="item in JSON.parse(product.data)">
                                <span class="attr-text">{{ item['key'] }}: {{ item['value'] }}</span>
                            </template>
                        </td>
                    </template>
                    <template v-else>
                        <td>Отсутствуют</td>
                    </template>
                </tr>  
            </template>  
        </table>
    </template>
    <template v-else>
        <p class="no-table">Позиции отсутствуют.</p>
        <p class="no-table">Используйте соответствующую кнопку для добавления новых.</p>
    </template>
</div>
<a href="javascript:void(0);" @click.prevent="addItemModal" class="main__btn button">Добавить</a>
</section>
</article>
<AddModal ref="modalAdd" :errors="errors" />
<ShowModal ref="modalShow" :errors="errors" :id="id" :article="article" :name="name" :status="status" :role="role" :data="data"/> 
</main>
</template>
<script>
import Overlay from "@/Pages/Overlay.vue";
import { Head } from '@inertiajs/vue3';
import ShowModal from '@/Pages/ShowModal.vue';
import AddModal from '@/Pages/AddModal.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

export default {
    name: 'Index',

    components: {
        Head,
        ShowModal,
        AddModal,
        DropdownLink,
        Dropdown,
        ApplicationLogo,
        Overlay
    },
    props: [
        'products',
        'role',
        'errors'
        ],
    data() {
        return {
            id: Number,
            article: String,
            name: String,
            status: String,
            data: Array,
            addItem: false,
        }
    },
    methods: {
        showAnItem(id) {
            this.products.map((item) => {
                if (id === item.id) {
                    this.id = item.id;
                    this.article = item.article;
                    this.name = item.name;
                    this.status = item.status;
                    this.data = JSON.parse(item.data);
                }

            });

            this.$refs.modalShow.show = true;
        },
        addItemModal() {
            this.$refs.modalAdd.show = true;
        },
    }
}
</script>