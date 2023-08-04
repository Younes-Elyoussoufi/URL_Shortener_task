import { defineStore } from 'pinia'
import Swal from 'sweetalert2'

export const storeLinks = defineStore('Links', {
    state: () => ({ 
        links:[],
        mostVisited:[],
        current_page:1,
        error:null,
        link:{
            data:{
                full_url:'',
                url_desc:''
            }
        },
        edit:{
          id:0,
          full_url:'',
          url_desc:'',
          shorten_url:''
        }
     }),
    getters: {
      getLinks: (state) => state.links.data,
      getMostVisited: (state) => state.mostVisited,
      getVlidationsErrors: (state) => state.error,
      getEdit: (state) => state.edit,
    },
    actions: {
      editLink(shorten_url){
     
        const ed=this.getLinks.find(x=>x.shorten_url==shorten_url);
        this.edit.full_url=ed.full_url;
        this.edit.url_desc=ed.url_desc;
        this.edit.shorten_url=ed.shorten_url;
      },
     async updateLink(user_id){
         console.log(this.getEdit)
        try {
          const res=await axios.put(`api/url/update/${this.getEdit.shorten_url}`,
          {
            full_url:this.getEdit.full_url,
            url_desc:this.getEdit.url_desc,
            user_id:user_id
          })

          this.fetchLinks(user_id)
          

          const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 5000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'success',
              title: 'link updated successfully'
            })

      } catch (error) {
          console.log(error.message)
          this.error=error.response && error.response.data.errors
      }

      },
      async addLink(user_id) {
        try {
            const response=await axios.post('api/url/add',{
                  full_url:this.link.data.full_url,
                  url_desc:this.link.data.url_desc,
                  user_id
            } )
            //  this.links.unshift(response.data)
            this.link={
              data:{
                  full_url:'',
                  url_desc:''
              }
          }
          this.fetchLinks(user_id)

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'success',
                title: 'link added successfully'
              })

        } catch (error) {
            console.log(error)
            this.error=error.response && error.response.data.errors
        }
      },

       async fetchLinks(user_id) {
        try {
            const res=await axios.get(`api/user/urls/${user_id}`)

            this.links=res.data

               } catch (error) {
            console.log(error)
        }
     },
     async fetchMostVisited(user_id) {
      try {
          const res=await axios.get(`api/user/urls/visited/${user_id}`)
          this.mostVisited=res.data
             } catch (error) {
          console.log(error)
      }
   },
      deleteLink(shorten_url,user_id){
        try { 
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then(async(result) => {
                if (result.isConfirmed) {
                    await axios.delete(`api/url/delete/${shorten_url}`)
                    this.links.data=this.links.data.filter(x=>x.shorten_url!=shorten_url)
                    this.mostVisited=this.mostVisited.filter(x=>x.shorten_url!=shorten_url)

                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }

              })
           } catch (error) {
            console.log(error)
        }
    },
    async next(user_id) {
        try {
            const res=await axios.get(`api/user/urls/${user_id}?page=${this.current_page +=1}`)
            this.links=res.data
            } catch (error) {
            console.log(error)
        }
     },
     async previous(user_id) {
        try {
            const res=await axios.get(`api/user/urls/${user_id}?page=${this.current_page -=1}`)
            this.links=res.data
            } catch (error) {
            console.log(error)
        }
     },
      
    },
  })