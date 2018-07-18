<template>
    <form class="navbar-form" role="search">
        <div class="input-group">
            <input type="text" class="form-control navbar-search" placeholder="Search" id="movies">
        </div>
        </form>
</template>

<script>
    import { movieautocomplete } from '../helpers/autocomplete.js'

    export default {
        mounted() {
            movieautocomplete('#movies', {
                hitsPerPage: 10
            })
        }
    }
</script>
