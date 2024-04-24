<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import ProfileLayout from '@/Layouts/ProfileLayout.vue';
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
authStore.updateUserData();


</script>

<template>
    <ProfileLayout title="Inici">
        <template #main-content>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 overflow">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-[20px]">
                    <UpdateProfileInformationForm
                        class=""
                    />
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-[20px]">
                    <UpdatePasswordForm class="" />
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-[20px]">
                    <DeleteUserForm class="" />
                </div>
            </div>
        </template>
    </ProfileLayout>
</template>



<!-- <Head title="Profile" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div> -->

