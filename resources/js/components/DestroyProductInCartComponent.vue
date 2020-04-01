<template>
    <div id="app">
            <img @click="destroy" :src="this.image" alt="IMG">
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "DestroyProductInCartComponent",
        props :{
            image:String,
            id:String,
        },
        methods:{
            destroy(){
                let csrfToken = document.getElementById("csrf-token").getAttribute("content");
                axios.post("/add",{

                })
                let db = new IDBTransaction();
                db.addEventListener("error", () => {},)
            }
        }
    }
</script>

<style scoped>

</style>
