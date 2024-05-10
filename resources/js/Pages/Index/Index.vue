<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import Barbecue from "@/Components/Index/Barbecue.vue";
import CreateBarbaqInput from "@/Components/CreateBarbaqInput/CreateBarbaqInput.vue";
import { useAuthStore } from "@/stores/auth";
import { useBarbecueStore } from "@/stores/barbecue";
import IndexRightAside from "@/Components/Asides/IndexRightAside.vue";
import { onMounted } from "vue";

const authStore = useAuthStore();
authStore.updateUserData();

const barbecueStore = useBarbecueStore();

onMounted(() => {
    const barbecueScroller = document.querySelector(".main-layout-content-wrapper");

    barbecueScroller.addEventListener("scroll", () => {
        const maxPossibleScroll = barbecueScroller.scrollHeight - barbecueScroller.clientHeight;
        if (barbecueScroller.scrollTop == maxPossibleScroll) {
            if (barbecueStore.barbecues.length === 0) return;
            console.log("Loading more barbecues");
            barbecueStore.fetchNext();
        }
    });
});

</script>

<template>
    <MainLayout title="Inici">
        <template #main-content>
            <CreateBarbaqInput v-if="authStore.user" />
            <div class="barbecues">
                <Barbecue v-for="barbecue in barbecueStore.preInsertedBarbecues.concat(barbecueStore.barbecues)" :key="barbecue.id" :barbecue="barbecue" />
            </div>
        </template>
        <template #right-aside>
            <IndexRightAside />
        </template>
    </MainLayout>
</template>

<style scoped>
.barbecues {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}

</style>