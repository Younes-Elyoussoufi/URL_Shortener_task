<template>
    <div class="col-md-7 mt-4">
       <div class="card  links">
           <div class="mb-2" v-if="store.getVlidationsErrors">
              <ul class="list-group" v-for="(arryError,index) in store.getVlidationsErrors" :key="index">
                     <li class="list-item bg-danger text-white b-2" v-for="(err,index) in arryError" :key="index">
                        {{ err }}
                    </li>
              </ul>
           </div>
           <form class="p-2" @submit.prevent="store.addLink(user_id)" method="post">
              <div class="form-group mb-2">
                  <input v-model="store.link.data.full_url" type="text" class="form-control" placeholder="enter url">
              </div>
              <div class="form-group mb-2">
                 <textarea v-model="store.link.data.url_desc" name="" class="form-control mb-3" cols="30" rows="10" placeholder="description">

                 </textarea>
              </div>
              <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">
                    submit
                </button>
              </div>
           </form>
       </div>
    </div>
</template>

<script setup>
 import {inject} from 'vue'
 import {storeLinks} from '@/stores/storeLinks'
   
   const store=storeLinks()
   const user_id=inject('user_id')

   

</script>

<style scoped>
input:focus{
    box-shadow: none !important;
}
textarea:focus{
    box-shadow: none !important;
}
textarea ,input,button,li,a,form,.links{
      border-radius: 0 !important  
}
.links{
    background-color:#e9e8e8 ;
    margin-top: -25px;
}

button{
    width: 100%;
  
}
button[type='submit'] {
    margin-bottom: -17px;
}
</style>