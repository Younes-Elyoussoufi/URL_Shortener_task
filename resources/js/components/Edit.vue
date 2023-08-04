<template>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form class="p-2" @submit.prevent="store.updateLink(user_id)" method="post">
              <div class="form-group mb-2">
                  <input v-model="store.link.data.full_url" type="text" class="form-control" placeholder="enter url">
              </div>
              <div class="form-group mb-2">
                 <textarea v-model="store.link.data.url_desc" name="" class="form-control mb-3" cols="30" rows="8" placeholder="description">

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

</template>

<script setup>
     const data= reactive({
        url:'',
        description:''
     })
</script>