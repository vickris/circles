<template>
<div class="container">
    <form action="#" @submit.prevent="showCircle">
        <div class="form-group">
            <label for="circles">Search for circle below to join</label>
            <input type="search" id="circles" class="form-control">
        </div>
    </form>
    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ circle.title }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul>
                <li v-for="member in circle.members">{{ member.name }}</li>
            </ul>
          </div>
          <div class="modal-footer">
                <a v-show="circleMember" :href="'/circles/' + circle.title + '/join'">Request to join circle</a>
          </div>
        </div>
      </div>
    </div>
</div>
</template>

<script>
    import { userautocomplete } from '../helpers/autocomplete.js'
    export default {
        props: [
            'user_id'
        ],
        data () {
            return {
                circle: {
                    title: '',
                    members: [],
                    member_ids: [],
                },
                circleMember: false
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
                    this.circle.title = response.data.title
                    this.circle.members = response.data.members
                    this.circle.member_ids = response.data.member_ids

                    if(this.circle.member_ids.indexOf(this.user_id) == -1) {
                        this.circleMember = true
                    }
                })

                $('#exampleModal').modal({ show: true, backdrop: false })
                circles.autocomplete.setVal('');
            })
        }
    }
</script>
