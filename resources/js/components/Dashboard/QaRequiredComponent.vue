<template>
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">QA Required</h3>
          <div class="card-options">
            <a
              href="javascript:void(0);"
              class="card-options-collapse me-2 text-white"
              data-bs-toggle="card-collapse"
              ><i class="fe fe-chevron-up"></i
            ></a>
            <a
              href="javascript:void(0);"
              class="card-options-remove text-white"
              data-bs-toggle="card-remove"
              ><i class="fe fe-x"></i
            ></a>
          </div>
        </div>
        <div class="card-body">
          <table
            class="table table-bordered text-nowrap no-footer"
            id="qa_required_box"
            role="grid"
            aria-describedby="example1_info"
          >
            <thead>
              <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Word Count</th>
                <th>Deadline</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="result in results" :key="result.id">
                <td>{{ result.id }}</td>
                <td>{{ result.title }}</td>
                <td>{{ result.word_count }}</td>
                <td>{{ result.deadline }}</td>
                <td>
                  <a :href="$hostname + 'writers/task_details/' + result.id"
                    ><i class="fa fa-eye"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

        <div class="col-lg-6">
      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">QA Required</h3>
          <div class="card-options">
            <a
              href="javascript:void(0);"
              class="card-options-collapse me-2 text-white"
              data-bs-toggle="card-collapse"
              ><i class="fe fe-chevron-up"></i
            ></a>
            <a
              href="javascript:void(0);"
              class="card-options-remove text-white"
              data-bs-toggle="card-remove"
              ><i class="fe fe-x"></i
            ></a>
          </div>
        </div>
        <div class="card-body">
          <table
            class="table table-bordered text-nowrap no-footer"
            id="qa_required_box"
            role="grid"
            aria-describedby="example1_info"
          >
            <thead>
              <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Word Count</th>
                <th>Deadline</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="result in results" :key="result.id">
                <td>{{ result.id }}</td>
                <td>{{ result.title }}</td>
                <td>{{ result.word_count }}</td>
                <td>{{ result.deadline }}</td>
                <td>
                  <a :href="$hostname + 'writers/task_details/' + result.id"
                    ><i class="fa fa-eye"></i
                  ></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      results: [],
    };
  },
  async created() {
    await axios.get(this.$hostname + "orders/qaRequired").then((response) => {
      if (response.data.status == "success") {
        this.results = response.data.result;
      }
    });
  },
};
</script>

<style>
</style>