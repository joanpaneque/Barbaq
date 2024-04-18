<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import 'flowbite';
</script>

<template>
    <MainLayout title="Inici">
        <template #main-content>
            <div class="grid grid-cols-3 gap-4">
                <div v-for="user in users" class="flex justify-center">
                    <div class="w-40 bg-white border border-gray-200 rounded-2xl dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-end px-2 pt-3">
                        </div>
                        <div class="flex flex-col items-center pb-5">
                            <img class="w-32 h-32 mb-3 rounded-full shadow-lg" src="assets/img/user.png"
                                alt="User Image" />
                            <h5 class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</h5>
                            <div class="flex md:mt-2">
                                <a href="#"
                                    class="inline-flex items-center px-4 py-1 text-sm font-medium text-center text-white bg-red-700 rounded-2xl hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Eliminar
                                    amic</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <button type="button"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Mostrar
                    més</button>
            </div>
        </template>
        <template #right-aside>
            <div class="aside-menu">
            </div>
        </template>
    </MainLayout>
</template>
<script>
export default {
    data() {
        return {
            users: [1, 2, 3, 4, 5, 6]
        };
    }
};
</script>

<style scoped>
.aside-menu {
    width: 100%;
    height: 400px;
    background: white;
    border-radius: 20px;
}
</style>