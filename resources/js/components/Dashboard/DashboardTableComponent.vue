<template>
  <div>
    <table
          class="table table-bordered text-nowrap dataTable no-footer"
          id="urgent_task_dashboard_table"
          role="grid"
          aria-describedby="example1_info"
        >
          <thead>
            <tr>
              <th>S.no</th>
              <th>OrderID</th>
              <th>Title</th>
              <th>Word Count</th>
              <th>Deadline</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(results, index) in result" :key="index">
              <td>{{index+=1}}</td>
              <td>{{results.order_id }}</td>
              <td>{{results.title }}</td>
              <td>{{results.word_count }}</td>
              <td>{{results.deadline }}</td>
              <td><a :href="$hostname+'writers/task_details/'+results.id"><i class="fa fa-edit"></i></a></td>
            </tr>
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="6">Total Records: {{total_record}}</td>
                  
              </tr>
          </tfoot>
        </table>

  </div>
</template>

<script>
export default {
   props:['result','total_record']
}
</script>

<style>

</style>