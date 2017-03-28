<template>
    <div class="direct-chat-messages">
        <div class="direct-chat-msg" :class="[isFromUser(message) ? 'right' : '']" v-for="message in messages">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name" :class="[isFromUser(message) ? 'pull-right' : 'pull-left']">{{ message.user.name }}</span>
                <span class="direct-chat-timestamp" :class="[isFromUser(message) ? 'pull-left' : 'pull-right']">{{ message.created_at }}</span>
            </div>
            <img class="direct-chat-img" :src="url(message)" alt="Message User Image"><!-- /.direct-chat-img -->
            <div class="direct-chat-text">
                {{ message.message }}
            </div>
        </div>
    </div>
</template>

<script>
    import gravatar from 'gravatar'
    export default {
        props: ['messages', 'user'],
        methods: {
            url: function (message) {
                return 'http:' + gravatar.url(message.user.email)
            },
            isFromUser: function(message){
                return message.user.email == this.user.email
            }
        }
    }
</script>
