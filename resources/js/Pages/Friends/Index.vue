<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import 'flowbite';
</script>

<template>
    <MainLayout title="Inici">
        <template #main-content>
            <div class="grid grid-cols-3 gap-4">
                <div
                    class="w-40 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-2 pt-2">
                    </div>
                    <div class="flex flex-col items-center pb-3">
                        <img class="w-16 h-16 mb-2 rounded-full shadow-lg"
                            src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image" />
                        <h5 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Username</h5>
                        <div class="flex mt-2 md:mt-3">
                            <a href="#"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Eliminar
                                amic</a>
                        </div>
                    </div>
                </div>
                <div
                    class="w-40 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-2 pt-2">
                    </div>
                    <div class="flex flex-col items-center pb-3">
                        <img class="w-16 h-16 mb-2 rounded-full shadow-lg"
                            src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image" />
                        <h5 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Username</h5>
                        <div class="flex mt-2 md:mt-3">
                            <a href="#"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Eliminar
                                amic</a>
                        </div>
                    </div>
                </div>
                <div
                    class="w-40 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-2 pt-2">
                    </div>
                    <div class="flex flex-col items-center pb-3">
                        <img class="w-16 h-16 mb-2 rounded-full shadow-lg"
                            src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image" />
                        <h5 class="mb-1 text-sm font-medium text-gray-900 dark:text-white">Username</h5>
                        <div class="flex mt-2 md:mt-3">
                            <a href="#"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Eliminar
                                amic</a>
                        </div>
                    </div>
                </div>
            </div>

        </template>
        <template #right-aside>
            <div class="aside-menu">
            </div>
        </template>
    </MainLayout>
</template>

<style scoped>
.aside-menu {
    width: 100%;
    height: 400px;
    background: white;
    border-radius: 20px;
}
</style>