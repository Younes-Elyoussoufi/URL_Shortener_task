<template>
    <div class="card  links p-2 mt-3">
        <div v-if="data.msg" class="alert alert-success">{{ data.msg }}</div>
      <div class="card-body">
        <h4 class="mb-2 p-2 raounded border text-center  bg-dark text-white">Most Visited</h4>
      </div>
      <div class="list-group">
        <ul class="list-group" v-for="link in store.getMostVisited" :key="link.id">
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
</template>


<script setup>
import { reactive, inject, onMounted } from 'vue';
import { storeLinks } from '@/stores/storeLinks'
import Swal from 'sweetalert2'

const store = storeLinks()

const user_id = inject('user_id')
const data = reactive({
  user_id: '',
  msg: ''
})

onMounted(() => {  store.fetchMostVisited(user_id)  })


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