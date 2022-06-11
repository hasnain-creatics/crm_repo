<template>
  
      <b-modal id="modal-1" title="Add User Ratings" ok-title="Submit" @ok="submit_ratings()">

        <div>

          <label for="">
            <b style="font-size:15px;"> Compliance and Relevance</b>
          </label>
          <div>
            <i :class="'fa fa-star stars star1 ' + (cchecked1 == true ? 'checked' : '')" @click="cstars_rating(1)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star2 ' + (cchecked2 == true ? 'checked' : '')" @click="cstars_rating(2)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star3 ' + (cchecked3 == true ? 'checked' : '')" @click="cstars_rating(3)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star4 ' + (cchecked4 == true ? 'checked' : '')" @click="cstars_rating(4)"
              style="font-size:30px"></i>
          </div>
          <div v-if="cchecked1 == true && cchecked2 == false && cchecked3 == false && cchecked4 == false">
            Poor. Requirements are overlooked completely/brief wrongly understood/wrong topic chosen/ possibly a
            failure/majority of content is irrelevant
          </div>
          <div v-if="cchecked2 == true && cchecked1 == true && cchecked3 == false && cchecked4 == false">
            Satisfactory. Few points in the requirements are missed/course material slightly used if given/content is
            relevant to an appropriate extent
          </div>
          <div v-if="cchecked3 == true && cchecked1 == true && cchecked2 == true && cchecked4 == false">
            Good. Majority of the requirements are fulfilled and course material is used if given and relevant.
          </div>
          <div v-if="cchecked4 == true && cchecked1 == true && cchecked2 == true && cchecked3 == true">
            Exceptional. All requirements fulfilled and course material used/special instructions fulfilled
            exceptionally/content is exceptionally relevant.
          </div>
        </div>
        <hr>

        <div>

          <label for="">
            <b style="font-size:15px;"> Overall Quality of the Content</b>
          </label>
          <div>

            <i :class="'fa fa-star stars star1 ' + (ochecked1 == true ? 'checked' : '')" @click="ostars_rating(1)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star2 ' + (ochecked2 == true ? 'checked' : '')" @click="ostars_rating(2)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star3 ' + (ochecked3 == true ? 'checked' : '')" @click="ostars_rating(3)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star4 ' + (ochecked4 == true ? 'checked' : '')" @click="ostars_rating(4)"
              style="font-size:30px"></i>
          </div>
          <div v-if="ochecked1 == true && ochecked2 == false && ochecked3 == false && ochecked4 == false">
            No logical flow and coherency in overall, no clarity in sentences, Poor writing, and excessive repetition
            ideas.
          </div>
          <div v-if="ochecked2 == true && ochecked1 == true && ochecked3 == false && ochecked4 == false">
            Satisfactory flow and coherency, satisfactory writing skills, no repetition of ideas. .
          </div>
          <div v-if="ochecked3 == true && ochecked1 == true && ochecked2 == true && ochecked4 == false">
            Good overall content
          </div>
          <div v-if="ochecked4 == true && ochecked1 == true && ochecked2 == true && ochecked3 == true">
            The content is well researched having useful ideas, facts, and concepts, there is no repetition of ideas,
            diagrams, and statistics are used where necessary
          </div>
        </div>
        <hr>
        <div>

          <label for="">
            <b style="font-size:15px;"> Referencing</b>
          </label>
          <div>

            <i :class="'fa fa-star stars star1 ' + (rchecked1 == true ? 'checked' : '')" @click="rstars_rating(1)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star2 ' + (rchecked2 == true ? 'checked' : '')" @click="rstars_rating(2)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star3 ' + (rchecked3 == true ? 'checked' : '')" @click="rstars_rating(3)"
              style="font-size:30px"></i>
            <i :class="'fa fa-star stars star4 ' + (rchecked4 == true ? 'checked' : '')" @click="rstars_rating(4)"
              style="font-size:30px"></i>
          </div>
          <div v-if="rchecked1 == true && rchecked2 == false && rchecked3 == false && rchecked4 == false">
            Inauthentic and inauthentic references or very less references and citations
          </div>
          <div v-if="rchecked2 == true && rchecked1 == true && rchecked3 == false && rchecked4 == false">
            Satisfactory referencing and citations
          </div>
          <div v-if="rchecked3 == true && rchecked1 == true && rchecked2 == true && rchecked4 == false">
            Good referencing and citation
          </div>
          <div v-if="rchecked4 == true && rchecked1 == true && rchecked2 == true && rchecked3 == true">
            Exceptional referencing
          </div>

        </div>
      </b-modal>

</template>

<script>
export default {

}
</script>

<style>

</style>