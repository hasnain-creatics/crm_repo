<template>
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title text-white">Order Details</h3>
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
          <div class="row">
            <div class="col font-weight-bold">Title</div>
            <div class="col font-weight-bold">Word Count</div>
          </div>

          <div class="row">
            <div class="col">{{ order_details.title }}</div>
            <div class="col">{{ order_details.word_count }}</div>
          </div>

          <div class="row">
            <div class="col font-weight-bold">Deadline</div>
            <div class="col font-weight-bold">Notes</div>
          </div>

          <div class="row">
            <div class="col">{{ order_details.deadline }}</div>
            <div class="col">{{ order_details.notes }}</div>
          </div>

          <div class="row">
            <div class="col font-weight-bold">Additional Notes</div>
            <div class="col font-weight-bold">Subjects</div>
          </div>

          <div class="row">
            <div class="col">{{ order_details.additional_notes }}</div>
            <div class="col">
              {{ order_details.subjects ? order_details.subjects.name : "" }}
            </div>
          </div>
        </div>
      </div>
      <br />
      <form
        class="row g-3"
        @submit.prevent="submit_details"
        enctype="multipart/form-data"
      >
        <div class="row">
          <div class="col">
            <label for="">Task Status</label>
           
            <select
              class="form-select text-warnings"
              @change="change_task_statement($event)"
            >
              <option disabled="disabled" :value="'New'">New</option>
              <option
                :value="'Pending'"
                :selected="selected == 'Pending' ? 'selected' : '123'"
              >
                Pending
              </option>
              <option
                :value="'In Progress'"
                :selected="selected == 'In Progress' ? 'selected' : '321'"
              >
                In Progress
              </option>
              <option
                :value="'Ready to QA'"
                :selected="selected == 'Ready to QA' ? 'selected' : '123'"
              >
                Ready to QA
              </option>
              <option 
                v-if="lead_manager_admin ? (selected == 'QA Approved' ? 'selected' : '') : ''"
                value="QA Approved">
                QA Approved
              </option>
              
              <option 
                v-if="lead_manager_admin"
                value="QA Approved">
                QA Approved
              </option>

              <option :value="'Feedback'" v-if="selected == 'Feedback'" :selected="selected == 'Feedback' ? 'selected' : ''" >Feedback</option>
              
            </select>

          </div>
        </div>
        <br />
        <br />
        <div class="row">
          <div class="col-lg-12">
            <label for="">Document Title</label>

            <input
              type="text"
              class="form-control"
              v-model="form.name"
              name="document_text"
            />
          </div>
          <div class="col-lg-12 upload_docs">
            <label for="validationCustom01" class="form-label"></label>
            <div class="form-group mb-0">
              <input
                name="files"
                @change="processFileDocumentUpload($event)"
                type="file"
                id="task_documents_uploadd"
                accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf"
                multiple
              />
            </div>
          </div>
          <div class="col-lg-12" style="margin-top: 10px">
            <button class="btn btn-primary" type="submit">
              Submit Details
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">Task Documents</h3>
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
          <div class="row">
            <div
              class="col-lg-2"
              v-for="task_doc in task_documents"
              :key="task_doc.id"
            >
              <a :href="task_doc.url" target="_blank">
                <img
                  :src="task_doc.url"
                  v-if="
                    task_doc.file_type == 'jpg' ||
                    task_doc.file_type == 'png' ||
                    task_doc.file_type == 'gif' ||
                    task_doc.file_type == 'jpeg'
                  "
                  style="
                    border-radius: 5px;
                    box-shadow: 0px 0px 3px 0px;
                    width: 80px;
                  "
                  :title="task_doc.name"
              /></a>

              <a :href="task_doc.url" target="_blank"
                ><img
                  style="width: 80px"
                  :src="$hostname + '../public/assets/images/files/file.jpg'"
                  alt=""
                  v-if="
                    task_doc.file_type != 'jpg' &&
                    task_doc.file_type != 'png' &&
                    task_doc.file_type != 'gif' &&
                    task_doc.file_type != 'jpeg'
                  "
                  :title="task_doc.name"
              /></a>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">Writers Documents</h3>
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
        <div class="card-body" style="height: 300px; overflow: auto">
          <!-- sale_order_uploaded_document -->

          <table
            class="table table-bordered text-nowrap dataTable no-footer"
            id="writer_uplaoded_documents"
            role="grid"
            aria-describedby="example1_info"
          >
            <thead>
              <tr>
                
                <th>Select</th>
                <th>File Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="doc in writer_documetns" :key="doc.id">
                <td><input type="checkbox" @click="selectedDocuments(doc.id)"></td>
                <td>{{ doc.document_name }}</td>
                <td><a :href="doc.url">download link</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">Task Progress Status</h3>
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
        <div class="card-body" style="height: 400px; overflow: auto">
          <section class="timeline_area section_padding_130">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-lg-6">
                  <!-- Section Heading-->
                  <div class="section_heading text-center"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <!-- Timeline Area-->
                  <div
                    class="apland-timeline-area"
                    v-for="prog in order_details.order_statuses"
                    :key="prog.id"
                  >
                    <!-- Single Timeline Content-->
                    <div class="single-timeline-area">
                      <div
                        class="timeline-date wow fadeInLeft"
                        data-wow-delay="0.1s"
                        style="
                          visibility: visible;
                          animation-delay: 0.1s;
                          animation-name: fadeInLeft;
                        "
                      >
                        <p>
                          {{ moment(prog.created_at).fromNow() }}
                        </p>
                      </div>
                      <div class="row">
                        <div class="col-12 col-md-12 col-lg-12">
                          <div
                            class="
                              single-timeline-content
                              d-flex
                              wow
                              fadeInLeft
                            "
                            data-wow-delay="0.3s"
                            style="
                              visibility: visible;
                              animation-delay: 0.3s;
                              animation-name: fadeInLeft;
                            "
                          >
                            <div class="timeline-icon">
                              <i
                                class="fa fa-address-card"
                                aria-hidden="true"
                              ></i>
                            </div>
                            <div class="timeline-text">
                              <b
                                ><h6>{{ prog.title }}</h6></b
                              >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">Assign User Task</h3>
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
        <div class="card-body" style="height: 300px; overflow: auto">
          <!-- sale_order_uploaded_document -->
                        <div class="form-group col-md-12" v-if="lead_manager_admin"> 
                            <div class="input-group">
                                <!-- <input type="text" name="" id="" class="form-control" placeholder="Assign More"> -->
                                <select style='width: 200px;' class="form-select" @change="assign_writer($event,task_id)">
                                   <option value=""></option>
                                   <option v-for="writer in all_writers" :key="writer.id"  :value="writer.id">
                                      {{writer.name}} ({{writer.order_assigns_count}})
                                    </option>

                                </select>
                            </div>
                        </div>
          <table
            class="table table-bordered text-nowrap dataTable no-footer"
            id="lead_docs_table"
            role="grid"
            aria-describedby="example1_info"
          >
            <thead>
              <tr>
                <th>S.no</th>
                <th>Assigned To</th>
                <th>Current Status</th>
                <th>Progress</th>
                <th>Assigned Date</th>
                <th v-if="lead_manager_admin">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="assign in order_assigns" :key="assign.id">
                <td>{{ assign.user_id }}</td>

                <td>{{ assign.first_name }} {{ assign.last_name }}</td>

                <td  @click="editStatus(assign.assign_id)">
                  <div
                    v-if="edit_status == true && status_id == assign.assign_id"
                  >
                    <select
                      name=""
                      id=""
                      class="form-select"
                      @change="assign_task_update($event, assign.user_id)"
                    >
                      <option value=""></option>

                      <option
                        value="Pending"
                        :selected="
                          assign.status_id == 'Pending' ? 'selected' : ''
                        "
                      >Pending</option>

                      <option
                        value="In Progress"
                        :selected="
                          assign.status_id == 'In Progress' ? 'selected' : ''
                        "
                      >In Progress</option>

                      <option
                        value="Ready to QA"
                        :selected="
                          assign.status_id == 'Ready to QA' ? 'selected' : ''
                        "
                      >Ready to QA</option>

                      <option
                        value="QA Approved"
                        v-if="lead_manager_admin"
                        :selected="assign.status_id == 'QA Approved' ? 'selected' : ''"
                      >
                        QA Approved
                      </option>
                    </select>
                  </div>
                  <div v-else>
                    {{ assign.status_id }}
                  </div>
                   <b-button v-b-modal.modal-1>Launch demo modal</b-button>
                </td>

                <td @click="editProgress(assign.assign_id)">
                  <div
                    v-if="
                      edit_progress == true && progress_id == assign.assign_id
                    "
                  >
                    <input
                      type="number"
                      max="100"
                      class="form-control"
                      @change="change_task_progrees($event, assign.user_id)"
                      :value="assign.completed"
                    />
                  </div>
                  <div class="progress progress-md mb-3" v-else>
                    <div
                      class="
                        progress-bar progress-bar-striped progress-bar-animated
                        bg-green
                      "
                      :style="'width:' + assign.completed + '%'"
                    >
                      {{ assign.completed }}%
                    </div>
                  </div>
                </td>
                <td>{{ moment(assign.created_at).fromNow() }}</td>
                <td v-if="lead_manager_admin">
                  <i
                    class="fa fa-trash"
                    title="remove task"
                    style="cursor: pointer"
                    @click="delete_assigned_user(assign.assign_id)"
                  ></i>
                
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
    </div>
 <div v-if="myModel">
    <b-modal id="modal-1" title="BootstrapVue" ok-title = "Submit"  @ok="submit_ratings()" >
    
       
   <div>
           <i :class="'fa fa-star stars star1 '+(checked1 == true ? 'checked' : '')"  @click="stars_rating(20)" :data-stars="1" style="font-size:40px"></i>
           <i :class="'fa fa-star stars star2 '+(checked2 == true ? 'checked' : '')"   @click="stars_rating(40)" :data-stars="2" style="font-size:40px"></i>
           <i :class="'fa fa-star stars star3 '+(checked3 == true ? 'checked' : '')"   @click="stars_rating(60)" :data-stars="3" style="font-size:40px"></i>
           <i :class="'fa fa-star stars star4 '+(checked4 == true ? 'checked' : '')"   @click="stars_rating(80)" :data-stars="4" style="font-size:40px"></i>
           <i :class="'fa fa-star stars star5 '+(checked5 == true ? 'checked' : '')"   @click="stars_rating(100)" :data-stars="5" style="font-size:40px"></i>
           <!-- <button class="btn btn-primary" @click="submit_ratings()" style="margin-left:20%">Submit</button>
           <button class="btn btn-danger"  @click="myModel=false">Cancel</button> -->
   
</div>
      
   </b-modal>


  </div>
  </div>
</template>

<script>
import Form from "vform";
import moment from "moment";
import axios from "axios";
import $ from "jquery";
    import { BButton, BModal, VBModal } from "bootstrap-vue";
export default {
  props: ["task_id"],
    components: {
            BButton,
            BModal
    },
    directives: { 
            'b-modal': VBModal 
    },
  data() {
    return {
       myModel:false,
        checked1:false,
        checked2:false,
        checked3:false,
        checked4:false,
        checked5:false,
        rating:0,
      form: new Form({
        title: "",
        name: "",
        files: "",
        user_id: "",
        status: false,
        select_files:[]
      }),
      progress_id: "",
      status_id: "",
      edit_progress: false,
      edit_status: false,
      order_details: {},
      selected: "",
      task_documents: [],
      writer_documetns: [],
      lead_manager_admin: false,
      order_assigns: [],
      modal_show: false,
      task_update_form: new Form({
        status: "",
        completed: "",
      }),
      ratings:{
        order_id:'',
        user_id:'',
        rating:'',
      },
      all_writers:[],
      assign_writer_post:{},
      page_reload: false,

    };
  },

  methods: {
    moment,
     handleOk(bvModalEvent) {
       alert();
      },
    async selectedDocuments(ele){
        this.form.select_files.push({'file':ele});
        for(var i =0;i<this.form.select_files.length;i++){
          
          form.select_file.files[i] = ele
        }
    },
    async assign_writer(e,ele){
      //console.log(e.target,ele);return false;


      this.assign_writer_post.user_id = e.target.value;
      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      };
      var item=this.assign_writer_post.user_id;
      var reload_page = false;
          await axios.post(this.$hostname + "writers/check_user_assignments/"+ele,this.assign_writer_post,{headers}).then((response)=>{
    
                  swal({
                        title: "Are you sure?",
                        text: response.data.message,
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Continue it!",
                        cancelButtonText: "No, Cancel Asigning!",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                              customClass: {
                              confirmButton: 'btn btn-primary',
                              cancelButton: 'btn btn-secondary',
                          }
                      },
                      function(isConfirm){
    
                        if (isConfirm) {
              
                                    $.ajax({
    
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                
                                        type: "post",
                                    
                                        url : main_url+'/writers/assigned_user/'+ele,
                                    
                                        data: {user_id:item},
                                    
                                        dataType: "json",
                                    
                                        success:function(response){
    
                                            if(response.status == 'success'){
    
                                                swal('Congratulations!', response.message, response.success);
    
                       

                                setTimeout(function () {
                                  location.reload(true);
                                }, 1000);
                                                // $( "#lead_docs_table" ).load(window.location.href + " #lead_docs_table" );
                 
                                            }
                                            
                                        }
                                    
                                    });
                        } else {
                          swal("Cancelled", "Task Not Aassigned", "error");
                        }
                      });
    
            
          });
     
          
    
    },
    async fetch_writers(e){
        axios.get(this.$hostname + "writers/fetch_all_writers").then((response)=>{
          this.all_writers = response.data;
          console.log(this.all_writers)
        });  
    },
    async submit_ratings(){

      this.ratings.order_id = this.task_id;
      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      };
      if(this.ratings.rating){
        
      await axios.post(this.$hostname + "writers/submit_ratings",this.ratings,{headers}).then((response)=>{

          if(response.data.status == 'success'){
 
            swal('Success!', response.data.message, response.data.status);
          }
        }); 
      }else{
        alert('please select atleast 1 ratings');
      }
    },
    async editStatus(ele) {
      this.edit_status = true;
      this.edit_progress = false;
      this.progress_id = ele;
      this.status_id = ele;
    },
  async stars_rating(ele){
    this.rating = ele;
      //  order_id:'',
      //   user_id:'',
      //   rating:'',
      this.ratings.rating = ele;
    if(ele == 20){
      this.checked1 = true;
    }else{
      this.checked1 = false;
    }
  
    if(ele == 40){
      this.checked1 = true;
            this.checked2 = true;
    }else{
      this.checked2 = false;
    }
  
    if(ele == 60){
       this.checked1 = true;
            this.checked2 = true;
            this.checked3 = true;
    }else{
      this.checked3 = false;
    }
     
    if(ele == 80){
         this.checked1 = true;
            this.checked2 = true;
            this.checked3 = true;
         this.checked4 = true;
    }else{
      this.checked4 = false;
    }
    if(ele == 100){
      this.checked1 = true;
      this.checked2 = true;
      this.checked3 = true;
      this.checked4 = true;
      this.checked5 = true;
    }else{
      this.checked5 = false;
    }
    
  },
    async editProgress(ele) {
      this.edit_progress = true;
      this.edit_status = false;
      this.progress_id = ele;
      this.status_id = ele;
    },
    async show_task_details() {
      await axios

        .get(this.$hostname + "writers/fetch_order/" + this.task_id)

        .then((response) => {
          this.order_details = response.data.data;

          this.lead_manager_admin = response.data.lead_manager_admin;
          console.log(this.lead_manager_admin); 
          this.selected = this.order_details.order_status;
  
          if (this.order_details.sale_order_documents) {
            this.task_documents = this.order_details.sale_order_documents;
          }

          if (this.order_details.sale_order_uploaded_document) {
            this.writer_documetns =
              this.order_details.sale_order_uploaded_document;
          }

          if (this.order_details.order_assigns) {
            this.order_assigns = this.order_details.order_assigns;
          }

          this.form.title = this.order_details.order_status.title;

          // this.change_task_statement(this.form.title);
        });
    },
    async processFile123(e) {
      let file = e.target.files;

      let reader = new FileReader();

      this.form.files = e.target.files;
    },
    async processFileDocumentUpload(e) {
      let file = e.target.files;

      let reader = new FileReader();

      this.form.files = e.target.files;
    },

    async change_task_statement(e, useR_id) {
      if (e.target) {
        if (e.target.value) {
          this.form.title = e.target.value;
        }
      } else {
        this.form.title = e;
      }  
  this.form.status = true;
  const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),

        "Content-Type": "multipart/form-data",
      };

        await this.form
          .post(this.$hostname + "writers/task_status_update/" + this.task_id, null, {
            headers,
          })
          .then((response) => {
      
              swal(
                response.data.alert_message,
                response.data.message,
                "success"
              );
            if(response.data.status == 'success' && response.data.stop_reload == false){
                setTimeout(function () {
                  location.reload(true);
                }, 1000);
            }else{
              //  setTimeout(function () {
              //     location.reload(true);
              //   }, 4000);
            }
           
          });

    },

    async change_task_progrees(e, user_id) {
      this.task_update_form.completed = e.target.value;

      this.task_update_form.user_id = user_id;

      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),

        "Content-Type": "multipart/form-data",
      };
      if (e.target.value >= 0 && e.target.value <= 100) {
        
        await this.task_update_form
          .post(
            this.$hostname + "writers/user_task_details_update/" + this.task_id,
            null,
            { headers }
          )
          .then((response) => {
            this.edit_progress = false;

            for (let i = 0; i < this.order_assigns.length; i++) {
              if (this.order_assigns[i].user_id == user_id) {
                this.order_assigns[i].completed = e.target.value;
              }
            }
          });
      } else {
        alert("progress must less then equal to 100 and greater then equal 0");

        for (let i = 0; i < this.order_assigns.length; i++) {
          if (this.order_assigns[i].user_id == user_id) {
            this.order_assigns[i].completed = this.order_assigns[i].completed;
          }
        }
      }
    },

    async assign_task_update(e, user_id) {
      this.task_update_form.status = e.target.value;
      // this.task_update_form.status = e.target.value;
      this.task_update_form.user_id = user_id;

      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),

        "Content-Type": "multipart/form-data",
      };
      if(e.target.value == 'QA Approved'){
          this.myModel = true;
  
          this.ratings.user_id = user_id;
      }

      await this.task_update_form
        .post(
          this.$hostname + "writers/user_task_details_update/" + this.task_id,
          null,
          { headers }
        )
        .then((response) => {
          // swal('Congratulations!', 'Document Uploaded successfully', 'success');

          this.edit_status = false;

          this.status_id = user_id;

          for (let i = 0; i < this.order_assigns.length; i++) {
            if (this.order_assigns[i].user_id == user_id) {
              this.order_assigns[i].status_id = e.target.value;
            }
          }
        });
    },
  async delete_assigned_user(assigned_id){

    swal({
        title: "Are you sure?",
        text: 'Click on yes, continue then assgined task will delete permenantly',
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, Cancel Deleting!",
        closeOnConfirm: false,
        closeOnCancel: false,
              customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-secondary',
          }
      },
      function(isConfirm){

        if (isConfirm) {
                  const headers = {
                      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),

                      "Content-Type": "multipart/form-data",
                    };

                    $.ajax({

                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                
                        type: "post",
                    
                        url : main_url+'/writers/delete_assigned_user',
                    
                        data: {order_id:assigned_id},
                    
                        dataType: "json",
                    
                        success:function(response){

                            if(response.status == 'success'){

                                swal('Congratulations!', response.message, response.status);

                                setTimeout(function () {
                                  location.reload(true);
                                }, 1000);
         
                            }
                            
                        }
                    
                    });
        } else {
          swal("Cancelled", "Task Not Deleted", "error");
        }
      });

  },
    async submit_details(e) {
      this.form.status = false;
      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),

        "Content-Type": "multipart/form-data",
      };
      if (this.form.name == "") {
        alert("document name field is required");
      } else {
        await this.form
          .post(this.$hostname + "writers/task_update/" + this.task_id, null, {
            headers,
          })
          .then((response) => {
            if (response.data.message.files) {
              alert("files field is require");
            } else {
              swal(
                response.data.alert_message,
                response.data.message,
                "success"
              );
            if(response.data.status == 'success' && response.data.stop_reload == false){
                setTimeout(function () {
                  location.reload(true);
                }, 1000);
            }else{
               setTimeout(function () {
                  location.reload(true);
                }, 4000);
            }
              // window.scrollTo(0,0);

          
            }
          });
      }
    },
  },
  async mounted () {
   

      this.show_task_details();

      this.fetch_writers();

 
    
  },
};
</script>

<style>
.timeline_area {
  position: relative;
  z-index: 1;
}
.single-timeline-area {
  position: relative;
  z-index: 1;
  padding-left: 180px;
}
@media only screen and (max-width: 575px) {
  .single-timeline-area {
    padding-left: 100px;
  }
}
.single-timeline-area .timeline-date {
  position: absolute;
  width: 180px;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 1;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -ms-grid-row-align: center;
  align-items: center;
  -webkit-box-pack: end;
  -ms-flex-pack: end;
  justify-content: flex-end;
  padding-right: 60px;
}
@media only screen and (max-width: 575px) {
  .single-timeline-area .timeline-date {
    width: 100px;
  }
}
.single-timeline-area .timeline-date::after {
  position: absolute;
  width: 3px;
  height: 100%;
  content: "";
  background-color: #ebebeb;
  top: 0;
  right: 30px;
  z-index: 1;
}
.single-timeline-area .timeline-date::before {
  position: absolute;
  width: 11px;
  height: 11px;
  border-radius: 50%;
  background-color: #f1c40f;
  content: "";
  top: 50%;
  right: 26px;
  z-index: 5;
  margin-top: -5.5px;
}
.single-timeline-area .timeline-date p {
  margin-bottom: 0;
  color: #020710;
  font-size: 13px;
  text-transform: uppercase;
  font-weight: 500;
}
.single-timeline-area .single-timeline-content {
  position: relative;
  z-index: 1;
  padding: 30px 30px 25px;
  border-radius: 6px;
  margin-bottom: 15px;
  margin-top: 15px;
  -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
  box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
  border: 1px solid #ebebeb;
}
@media only screen and (max-width: 575px) {
  .single-timeline-area .single-timeline-content {
    padding: 20px;
  }
}
.single-timeline-area .single-timeline-content .timeline-icon {
  -webkit-transition-duration: 500ms;
  transition-duration: 500ms;
  width: 30px;
  height: 30px;
  background-color: #f1c40f;
  -webkit-box-flex: 0;
  -ms-flex: 0 0 30px;
  flex: 0 0 30px;
  text-align: center;
  max-width: 30px;
  border-radius: 50%;
  margin-right: 15px;
}
.single-timeline-area .single-timeline-content .timeline-icon i {
  color: #ffffff;
  line-height: 30px;
}
.single-timeline-area .single-timeline-content .timeline-text h6 {
  -webkit-transition-duration: 500ms;
  transition-duration: 500ms;
}
.single-timeline-area .single-timeline-content .timeline-text p {
  font-size: 13px;
  margin-bottom: 0;
}
.single-timeline-area .single-timeline-content:hover .timeline-icon,
.single-timeline-area .single-timeline-content:focus .timeline-icon {
  background-color: #020710;
}
.single-timeline-area .single-timeline-content:hover .timeline-text h6,
.single-timeline-area .single-timeline-content:focus .timeline-text h6 {
  color: #3f43fd;
}
/* 
   .modal-mask {
     position: fixed;
     z-index: 9998;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
     background-color: rgba(0, 0, 0, .5);
     display: table;
     transition: opacity .3s ease;
   }

   .modal-wrapper {
     display: table-cell;
     vertical-align: middle;
   } */

   .stars:hover{
     color:red;
   }

   .checked{
     color:red;
   }
  </style>