<template>
    <div id="all-admins">
        <div class="vx-row mt-5"> 
            <div v-for="item in users" class="flex flex-col flex-wrap vx-col w-full sm:w-1/2 lg:w-1/4 mb-base px-2.5" v-bind:key="item.id">
                <vx-card class="account shadow text-center flex-1">
                    <img :src="require('@assets/images/admin.png')" class="text-center mx-auto" width="100px"/>
                        <div class="mx-auto cursor-pointer flex justify-around action" style="width: 4rem">
                            <vs-button @click="gotoEdit(item.id)" color="rgb(255,255,255)" text-color="rgb(255,159,67)" size="small" radius icon-pack="feather" icon="icon-edit" class=" shadow"/>
                            <vs-button @click.stop="openDeleteConfirm(item.id)" color="rgb(255,255,255)" text-color="#EA5455" size="small" radius icon-pack="feather" icon="icon-trash-2" class=" shadow"/>
                        </div>
                    <h4 class="text-center">{{item.name || $t('NA')}}</h4>
                    <div class="flex justify-center">
                        <span>{{item.mobile}}</span>
                        <span class="px-1"> | </span>
                        <span>{{item.email}}</span>
                    </div>
                    <!--<h6 class="text-center">{{item.title}}</h6>-->
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'
export default {
        props:{
            search:{
                required: false
            },
            // users:{
            //     type: Array
            // },
        },
        data() {
        return {
            ItemToDelete: null
        }
        
    },
     watch:{
        search (val){
          this.getResults()
        },
     },
    computed: {
        users() {
            return this.$store.state.userManagement.users
        },
    },
    methods: {
        getResults(){
             this.$store.dispatch("userManagement/fetchUsers",{search:this.search}).catch(err => { console.error(err) })
        },
        gotoEdit(id){
        this.$router.push({path: 'admins/edit/' + id})
        },
        openDeleteConfirm(id) {
        this.ItemToDelete = id;
        this.$vs.dialog({
            type: 'confirm',
            color: 'danger',
            title: this.$t('Delete'),
            text: 'هل أنت متأكدأنك تريد حذف هذا المستخدم نهائياً؟',
            accept: this.deleteUser
        })
     },
        deleteUser(){
        this.$store.dispatch("userManagement/removeUser", this.ItemToDelete)
        .catch(err => { console.error(err) })
        },
        showDeleteSuccess() {
                this.$vs.notify({
                color: 'success',
                title: 'Successfull',
                text: 'تم بنجاح'
            })
        }
    },
    created() {
        if(!moduleUserManagement.isRegistered) {
            this.$store.registerModule('userManagement', moduleUserManagement)
            moduleUserManagement.isRegistered = true
        }
        this.getResults()

        // this.$store.dispatch("userManagement/fetchUsers").catch(err => { console.error(err) })
        },

    
 
    
}
</script>

<style lang="scss" scoped>
#all-admins{
    .account{
        margin-top: 2.5rem;
        img{
            margin-top: -4rem;
        }
        .action{
            margin-top: -1rem;
        }
        h4{
            font-size: .9rem;
            font-weight: bold;
            padding: 1rem 0 .5rem;
        }
        h6{
            font-size:.6rem ;
            padding-top:4px;
            color: #ACACAC;
        }
        span{
            font-size: .7rem;
            color: #ACACAC;
        }
        .vs-button.small:not(.includeIconOnly) {
            padding: 0 .9rem;
            border-radius: 30px;
            margin-bottom: -1.9rem;
            margin-left: .5rem;
        }
        .vs-button.small{
            font-size: .6rem;
            font-weight: bold;
        }
    }
}  
</style>