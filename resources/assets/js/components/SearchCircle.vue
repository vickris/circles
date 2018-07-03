<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="#" @submit.prevent="showCircle">
                <div class="form-group">
                    <label for="circles">Search for circle below to join</label>
                    <input type="search" id="circles" class="form-control">
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>{{ circle.title }}</h4>
            <ul>
                <li v-for="member in circle.members">{{ member.name }}</li>
            </ul>
            <a href="#">Request to join circle</a>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
</div>
</template>

<script>
    import { userautocomplete } from '../helpers/autocomplete.js'
    export default {
        data () {
            return {
                circle: {
                    title: '',
                    members: []
                }
            }
        },
        methods: {
            showCircle() {
                $('#exampleModal').modal({ show: true})
            }
        },
        mounted() {
            var circles = userautocomplete('#circles', {
                hitsPerPage: 10
            }).on('autocomplete:selected', (e, selection) => {
                axios.get(`/circles/${selection.title}`).then((response) => {
                    this.circle.title = response.data.data.title
                    this.circle.members = response.data.data.members
                })
                $('#exampleModal').modal({ show: true, backdrop: false })
                circles.autocomplete.setVal('');
            })
        }
    }
</script>
