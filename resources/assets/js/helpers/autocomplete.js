import autocomplete from 'autocomplete.js'
import algolia from 'algoliasearch'

var index = algolia('59KW3LGTG9', '09c2e061712bed66f427f0551e98a355')

export const userautocomplete = (selector, { hitsPerPage }) => {
    index = index.initIndex('circles')

    return autocomplete(selector, {
        hint: true
    }, {
        source: autocomplete.sources.hits(index, { hitsPerPage: hitsPerPage }),
        displayKey: 'title',
        templates: {
            suggestion (suggestion) {
                return '<span>' + suggestion._highlightResult.title.value + '</span>'
            },
            empty: '<div class="aa-empty">No circles found</div>'
        }
    })
}

export const movieautocomplete = (selector, { hitsPerPage }) => {
    index = index.initIndex('movies')

    return autocomplete(selector, {
        hint: true
    }, {
        source: autocomplete.sources.hits(index, { hitsPerPage: hitsPerPage }),
        displayKey: 'title',
        templates: {
            suggestion (suggestion) {
                return '<span>' + suggestion._highlightResult.title.value + '</span>'
            },
            empty: '<div class="aa-empty">No movies found</div>'
        }
    })
}
