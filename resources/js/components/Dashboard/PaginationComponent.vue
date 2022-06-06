<template>
     <ul class="pagination">
        <li
          v-for="(links, index) in page_links"
          :key="index"
          class="paginate_button page-item"
          :data-url="links.label"
          @click="page_links_method(links.url)"
          
        >
          <i class="page-link" v-html="links.label"></i>
        </li>
      </ul>
</template>

<script>
export default {
    props:['page_links'],
    data() {
        return {
            s_no: 1,
            result: [],
            page_links: ""
        }
  },
}
</script>

<style>

</style>