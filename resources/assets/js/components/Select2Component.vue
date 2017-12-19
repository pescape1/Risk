<template>
  <select>
    <slot></slot>
  </select>
</template>

<script>
	export default {
    props: ['options', 'value', 'url'],
    data: function() {
      return {
	    selected: 2,
	    options: [
	      { id: 1, text: 'Hello' },
	      { id: 2, text: 'World' }
	    ],
        ajaxOptions: {
          url: "",
          dataType: 'json',
          delay: 250,
          tags: true,
          data: function(params) {
            return {
              term: params.term, // search term
              page: params.page
            };
          },
          processResults: function(data, params) {
            params.page = params.page || 1;
            return {
              results: data,
              pagination: {
                more: (params.page * 30) < data.total_count
              }
            };
          },
          cache: true
        }
      };
    },
    mounted: function() {
      var vm = this
      $(this.$el)
        // init select2
        .select2({
          placeholder: "Click to see options",
          ajax: this.ajaxOptions
        })
        .val(this.value)
        .trigger('change')
        // emit event on change.
        .on('change', function() {
          vm.$emit('input', this.value)
        })
    },
    watch: {
      value: function(value) {
        // update value
        $(this.$el).val(value).trigger('change');
      },
      options: function(options) {
        // update options
        $(this.$el).empty().select2({
          data: options
        })
      },
      url: function(value) {
        this.ajaxOptions.url = this.url;
        $(this.$el).select2({
          ajax: this.ajaxOptions
        });
      }
    },
    destroyed: function() {
      $(this.$el).off().select2('destroy')
    }
}
</script>