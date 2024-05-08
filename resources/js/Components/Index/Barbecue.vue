<script setup>

import { ref, defineProps } from 'vue';
import UserLink from "@/Components/User/UserLink.vue"
import { Link } from '@inertiajs/vue3';
import Timestamp from "@/Components/Time/Timestamp.vue";
import Gallery from '@/Components/Galleries/Gallery.vue';
import Comment from "@/Components/Comments/Comment.vue"
import { useAuthStore } from '@/stores/auth';
import axios from 'axios';

const auth = useAuthStore();

const props = defineProps({
    barbecue: {
        type: Object,
        required: true
    }
});

const answerComment = ref(null);
const answerPath = ref([]);

function writeComment(treePath) {
    answerPath.value = treePath;
    const deepSearch = (backtrackNode, treePath) => {
        for (let i = 0; i < treePath.length - 1; i++) {
            backtrackNode = backtrackNode.find(node => node.id === treePath[i]).replies;
        }
        return backtrackNode.find(node => node.id === treePath[treePath.length - 1]);
    }

    let currentNode = props.barbecue.comments;
    const lastNode = deepSearch(currentNode, treePath);
    answerComment.value = lastNode;

    const commentInput = document.getElementById(`comment-input-${props.barbecue.id}`);
    commentInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
    commentTextarea.value.focus();
}

function removeReply() {
    answerComment.value = null;
    answerPath.value = [];

    const commentInput = document.getElementById(`comment-input-${props.barbecue.id}`);
    commentInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
    commentTextarea.value.focus();
}

const commentContent = ref('');
const commentTextarea = ref(null);

function adjustTextareaHeight() {
    const textarea = commentTextarea.value;
    textarea.style.height = 'auto';
    textarea.style.height = `${textarea.scrollHeight + 2}px`;
}

function focusComment(commentId) {
    const comment = document.getElementById(`comment-${commentId}`);
    comment.scrollIntoView({ behavior: 'smooth', block: 'center' });
    comment.classList.add('highlight');
    setTimeout(() => {
        comment.classList.remove('highlight');
    }, 2000);
}

function sendComment() {
    axios.post(route('comments.store'), {
        comment_id: answerComment.value ? answerComment.value.id : null,
        barbecue_id: answerComment.value ? null : props.barbecue.id,
        comment: commentContent.value
    }).then(response => {
        const commentObject = {...response.data, replies: []};
        let currentNode = props.barbecue.comments;
        for (let i = 0; i < answerPath.value.length; i++) {
            currentNode = currentNode.find(node => node.id === answerPath.value[i]).replies;
        }
        currentNode.unshift(commentObject);
        commentContent.value = '';
        answerComment.value = null;
        answerPath.value = [];
    });
}

</script>

<template>
    <div class="barbecue-container" v-if="barbecue">
        <div class="barbecue-header">
            <div class="barbecue-left-section">
                <div class="barbecue-profile-image">
                    <Link :href="route('profile.show', barbecue.user.id)">
                        <img :src="barbecue.user.image" alt="Profile image">
                    </Link>
                </div>
                <div class="barbecue-left-texts">
                    <UserLink :userId="barbecue.user.id" :name="barbecue.user.name + ' ' + barbecue.user.surnames" />
                    <div class="barbecue-address">
                        <img src="/assets/svg/marker.svg" alt="Location" />
                        <span>{{ barbecue.address }}</span>
                    </div>
                </div>
            </div>
            <div class="barbecue-date">
                <Timestamp :datetime="barbecue.created_at" />
            </div>
        </div>
        <div class="barbecue-content-wrapper">
            <span class="barbecue-title">{{ barbecue.title }}</span>
            <div class="barbecue-content" v-html="barbecue.content"></div>
        </div>
        <div class="barbecue-gallery">
            <Gallery :images="barbecue.images.map(image => image.path)" />
        </div>
        <div class="barbecue-comment-input-wrapper">
        <span>Comentaris ({{ barbecue.comments.length }}) </span>
        <div class="barbecue-comment-input">
            <div class="barbecue-comment-profile-image">
                <img :src="auth.user.image" alt="Profile image">
            </div>
            <div class="barbecue-comment-input-itself" :id="'comment-input-' + barbecue.id">
                <div class="barbecue-comment-input-itself-answer" v-if="answerComment">
                    <div class="barbecue-comment-input-itself-answer-cross" @click="removeReply">
                        <img class="barbecue-comment-input-itself-answer-cross"
                        src="/assets/svg/cross.svg" alt="Answering" />
                    </div>
                    <div class="barbecue-comment-input-itself-answer-content">
                        <img src="/assets/svg/redo.svg" alt="Answering" />
                        <div class="barbecue-comment-input-itself-answer-content-text" @click="focusComment(answerComment.id)">{{ answerComment.user.name }} {{
                            answerComment.user.surnames }} | {{ answerComment.comment }}</div>
                    </div>
                </div>
                <textarea ref="commentTextarea" v-model="commentContent" @input="adjustTextareaHeight"
                    :placeholder="answerComment ? 'Respon a ' + answerComment.user.name + ' ' + answerComment.user.surnames : 'Escriu un comentari...'">
                </textarea>
            </div>
        </div>
        <button class="barbecue-comment-send" @click="sendComment" :disabled="!commentContent"
        >Enviar</button>
        </div>
        <div class="barbecue-footer">
            <div class="barbecue-comments" v-for="(comment, index) in barbecue.comments">
                <Comment @writeComment="writeComment" :comment="comment"
                    :isLast="index === barbecue.comments.length - 1" :isFirst="index === 0" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.barbecue-comment-send {
    background: #FF6100;
    color: #fff;
    margin-left: auto;
    padding: 5px 10px;
    border-radius: 10px;
    width: fit-content;
    border: 1px solid transparent;

}


.barbecue-comment-send:disabled {
    border: 1px solid #ddd;
    color: #ddd;
    background: none;
}



.barbecue-comment-input-itself-answer-content-text {
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.barbecue-comment-input textarea {
    resize: none;
    padding-inline: 10px;
    padding-top: 5px;
    width: 100%;
}

.barbecue-comment-input textarea:focus-visible {
    outline: none;
}

.barbecue-comment-input-itself {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}

.barbecue-comment-input-itself-answer {
    background: #f9f9f9;
    border-bottom: 1px solid #ddd;
    padding: 5px;
    display: flex;
    align-items: center;
    height: 30px;
    gap: 5px;
}

.barbecue-comment-input-itself-answer-cross {
    cursor: pointer;
    height: 100%;
    display: flex;
    align-items: center;
    border-radius: 5px;
}

.barbecue-comment-input-itself-answer-cross:hover {
    background: #dfdfdf;
}

.barbecue-comment-input-itself-answer-cross img {
    height: 60%;
    width: 20px;
}

.barbecue-comment-input-itself-answer-content {
    cursor: pointer;
    height: 100%;
    display: flex;
    align-items: center;
    border-radius: 5px;
    gap: 5px;
    font-size: 14px;
    padding: 5px;
    filter: opacity(0.6);
}

.barbecue-comment-input-itself-answer-content:hover {
    background: #dfdfdf;
    cursor: pointer;
}


.barbecue-comment-input-itself-answer-content img {
    width: 15px;
    height: 15px;
}

.barbecue-comment-input {
    border-radius: 10px;
    display: grid;
    grid-template-columns: 50px auto;
    gap: 10px;
}

.barbecue-comment-input-wrapper {
    padding: 10px;
    display: grid;
    gap: 5px;
} 

.barbecue-container {
    width: 100%;
    height: fit-content;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    padding: 12px 20px 19px 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.barbecue-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.barbecue-left-section {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    gap: 10px;
}

.barbecue-date {
    height: 100%;
    width: fit-content;
    display: flex;
    align-items: center;
    color: #888;
}

.barbecue-profile-image {
    display: flex;
    align-items: center;
    height: 100%;
}

.barbecue-profile-image img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.barbecue-comment-profile-image {
    display: flex;
    height: 100%;
}

.barbecue-comment-profile-image img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}

.barbecue-left-texts {
    display: flex;
    flex-direction: column;
}

.barbecue-address img {
    width: 13px;
    height: 13px;
    transform: translateY(-2px);
}

.barbecue-address {
    display: flex;
    align-items: center;
    gap: 3px;
    filter: opacity(0.6);
    font-size: 14px;
}

.barbecue-title {
    font-size: 24px;
}

.barbecue-content {
    font-size: 16px;
    line-height: 1.5;
    margin-top: 5px;
}

.barbecue-footer {
    border-radius: 10px;
    padding-inline: 20px;
    display: grid;
    gap: 10px;
}
</style>

<style>
h1 {
    font-size: 18px;
    font-weight: bold;
}
</style>