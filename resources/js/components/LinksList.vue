<template>
    <div class="col-md-5 mb-5">
   ``  <div v-if="data.msg" class="alert alert-success">{{ data.msg }}</div>
       <div class="card  links p-2">``
      <div class="card-body">
        <h4 class="mb-2 p-2 raounded border text-center  bg-dark text-white">All Links</h4>
      </div>
      <div class="list-group">
        <ul class="list-group" v-for="link in store.getLinks" :key="link.id">
          <li  @mouseover="data.user_id = link.id"  @mouseleave="data.user_id === ''"
          class="list-group-item list-group-item-action " id="list-links" style="cursor: pointer">
            <div class="d-flex w-100 justify-content-between">
              <h6>
                {{ link.shorten_url }}
              </h6>
              <small>
                {{ link.created_at }}
              </small>
            </div>
            <div class="b-2 text-danger " v-if="link.visits==0">
              <p>
                {{ link.visits }}
                <i class="fas fa-eye"></i>
              </p>
            </div>
            <div class="b-2 text-success" v-if="link.visits !=0">
              <p>
                {{ link.visits }}
                <i class="fas fa-eye "></i>
              </p>
            </div>
          </li>
          <li v-if="data.user_id === link.id"
            class="list-group-item list-group-item-action d-flex justify-content-around " id="actions">
            <button @click="store.deleteLink(link.shorten_url)" class="btn btn-danger">
              <i class="fas fa-trash"></i>
            </button>
            <button class="btn btn-warning" @click="store.editLink(link.shorten_url)" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fas fa-edit"></i>
            </button>
            <button @click="copy(link.shorten_url)" class="btn btn-dark">
              <i class="fas fa-copy"></i>
            </button>
            <a @click="store.fetchLinks(link.user_id)" :href="`http://127.0.0.1:8000/visit/${link.shorten_url}`" target="_blank" class="btn btn-primary w-100">
              <i class="fas fa-arrow-up-right-from-square"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div  class="d-flex justify-content-between">
     
          <button class="btn pag m-1" href="#" :disabled="!store.links.prev_page_url" 
          @click.prevent="store.previous(user_id)">
            Previous
          </button>

          <button class="btn pag  m-1" href="#" :disabled="!store.links.next_page_url" 
          @click.prevent="store.next(user_id)">
            Next
          </button>

    </div>

     <mostVisited />
        <!-- modale -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">update link</h1>
        </div>
        
        <form class="p-2" @submit.prevent="store.updateLink(user_id)" method="post">
                <div class="form-group mb-2">
                    <input v-model="store.edit.full_url" type="text" class="form-control" placeholder="fill url">
                </div>
                <div class="form-group mb-2">
                  <textarea v-model="store.edit.url_desc" name="" class="form-control mb-3" cols="30" rows="8" placeholder="description">

                  </textarea>
                </div>
                <div class="form-group mb-3">
                  <button type="submit" class="btn btn-primary">
                      submit
                  </button>
                </div>
            </form>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>



</div>
</template>

<script setup>
import Edit from './Edit.vue'
import mostVisited from './mostVisited.vue'
import { reactive, inject, onMounted } from 'vue';
import { storeLinks } from '@/stores/storeLinks'
import Swal from 'sweetalert2'

components:{mostVisited}

const store = storeLinks()

const user_id = inject('user_id')
const data = reactive({
  current_page: 1,
  user_id: '',
  msg: ''
})

onMounted(() => { store.fetchLinks(user_id) })

const copy = (shorten_url) => {
  navigator.clipboard.writeText(`http://127.0.0.1:8000/visit/${shorten_url}`)
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: 'coped '
  })
}

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