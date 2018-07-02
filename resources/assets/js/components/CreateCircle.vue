<template>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-md-offset-5">
                <a href="" class="btn btn-primary" @click.prevent="launchModal">Create Circle</a>
            </div>
        </div>

        <!-- Modal -->
    <div class="modal" id="createCircleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Circle</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" @submit.prevent="createCircle">
                <div class="form-group">
                    <label for="title">Circle title</label>
                    <input type="text" class="form-control" v-model="title" @keyup.enter="createCircle">
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    </div>

</template>

<script>
    export default {
        data () {
            return {
                title: ''
            }
        },
        methods: {
            createCircle () {
                axios.post('/circles', {
                    title: this.title,
                }).then((response) => {
                    console.log(response);
                    // this.$router.push({ name: 'circles.show', params: {title:`${response.data.data.circle }`}})
                    // this.$router.push({name: 'circles.index'})
                    // window.location.href = `circles/${response.data.data.circle}`
                }).catch((error) => {
                    console.log(error)
                })
            },
            launchModal () {
                $('#createCircleModal').modal({ show: true, backdrop: false })
            }
        },
        mounted() {
            // console.log(this.user_id)
        }
    }
</script>
