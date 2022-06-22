<template>
<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="card-title text-white">Order Details</h3>
          <div class="card-options">
            <a href="javascript:void(0);" class="card-options-collapse me-2 text-white"
              data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="javascript:void(0);" class="card-options-remove text-white" data-bs-toggle="card-remove"><i
                class="fe fe-x"></i></a>
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
      <form class="row g-3" @submit.prevent="submit_details" enctype="multipart/form-data">
        <div class="row">
          <div class="col">
            <label for="">Task Status</label>


             <!-- <select v-if="selected == 'Re-pending' && (role == 'Admin' || role == 'Writer' || role == 'Writer Manager')" class="form-select text-warnings"
              @change="change_task_statement($event)">
               <option :selected="selected == 'Re-pending' ? 'selected' : ''" :value="'Re-pending'">Re-pending</option>
               <option :selected="selected == 'Pending' ? 'selected' : ''" :value="'Pending'">Pending</option>
              
            </select> -->
          
              <select v-if="selected == 'Completed' && (role == 'Admin' || role == 'Writer' || role == 'Writer Manager')" class="form-select text-warnings"
              @change="change_task_statement($event)">
               <option :selected="selected == 'Completed' ? 'selected' : ''" :value="'Completed'">Completed</option>
              
            </select>
            <select v-else-if="selected == 'Delivered' && (role == 'Admin' || role == 'Writer' || role == 'Writer Manager')" class="form-select text-warnings"
              @change="change_task_statement($event)">
               <option :selected="selected == 'Delivered' ? 'selected' : ''" :value="'Delivered'">Delivered</option>
              
            </select>

            <select v-else-if="selected == 'Failed' && (role == 'Admin' || role == 'Writer' || role == 'Writer Manager')" class="form-select text-warnings"
              @change="change_task_statement($event)">
              
               <option :selected="selected == 'Failed' ? 'selected' : ''" :value="'Failed'">
                Failed
              </option>
              
               <option :selected="selected == 'Re-pending' ? 'selected' : ''" :value="'Re-pending'">
                Re-pending
              </option>
            </select>

           

            <select v-else-if="selected == 'Feedback' && (role == 'Admin' || role == 'Sale Manager' || role == 'Sale Agent')" class="form-select text-warnings"
              @change="change_task_statement($event)">
              
               <option :selected="selected == 'Feedback' ? 'selected' : ''" :value="'Feedback'">
                Feedback
              </option>
            </select>

           
 <select v-else-if="selected == 'Failed' && (role == 'Admin' || role == 'Sale Manager' || role == 'Sale Agent')" class="form-select text-warnings"
              @change="change_task_statement($event)">
               <option :selected="selected == 'Failed' ? 'selected' : ''" :value="'Failed'">
                Failed
              </option>
            </select>

           <select v-else-if="selected == 'Completed' && (role == 'Admin' || role == 'Sale Manager' || role == 'Sale Agent')" class="form-select text-warnings"
              @change="change_task_statement($event)">
    
               <option :selected="selected == 'Completed' ? 'selected' : ''" :value="'Completed'">
                Completed
              </option>
            </select>

            <select v-else-if="selected == 'Delivered' && (role == 'Admin' || role == 'Sale Manager' || role == 'Sale Agent')" class="form-select text-warnings"
              @change="change_task_statement($event)">
                <option disabled="disabled" :selected="selected == 'QA Approved' ? 'selected' : ''" :value="'QA Approved'">
                QA Approved
              </option>
              <option  disabled="disabled" :selected="selected == 'Delivered' ? 'selected' : ''" :value="'Delivered'">
                Delivered
              </option>
              <option :selected="selected == 'Failed' ? 'selected' : ''" :value="'Failed'">
                Failed
              </option>
               <option :selected="selected == 'Completed' ? 'selected' : ''" :value="'Completed'">
                Completed
              </option>
            </select>

            <select v-else-if="selected == 'QA Approved' && (role == 'Admin' || role == 'Sale Manager' || role == 'Sale Agent')" class="form-select text-warnings"
              @change="change_task_statement($event)">
                <option disabled="disabled" :selected="selected == 'QA Approved' ? 'selected' : ''" :value="'QA Approved'">
                QA Approved
              </option>
              <option :selected="selected == 'Delivered' ? 'selected' : ''" :value="'Delivered'">
                Delivered
              </option>
            </select>

            <select v-else-if="selected == 'QA Approved'" class="form-select text-warnings"
              @change="change_task_statement($event)">
              <option :selected="selected == 'QA Approved' ? 'selected' : ''" :value="'QA Approved'">
                QA Approved
              </option>
            </select>
            
            <select v-else-if="is_qa" class="form-select text-warnings" @change="change_task_statement($event)">
              <option disabled="disabled" :value="'New'">New</option>
              <option  :value="'Pending'" :selected="selected == 'Pending' ? 'selected' : ''">
                Pending
              </option>
              <option  :value="'In Progress'"
                :selected="selected == 'In Progress' ? 'selected' : ''">
                In Progress
              </option>

              <option  :value="'Ready to QA'"
                :selected="selected == 'Ready to QA' ? 'selected' : ''">
                Ready to QA
              </option>

              <option :selected="selected == 'QA In Progress' ? 'selected' : ''" :value="'QA In Progress'">
                QA In Progress
              </option>
              <option :selected="selected == 'QA Rejected' ? 'selected' : ''" :value="'QA Rejected'">
                QA Rejected
              </option>
              <option :selected="selected == 'QA Approved' ? 'selected' : ''" :value="'QA Approved'">
                QA Approved
              </option>

            </select>

            <select v-else-if="selected == 'Delivered'" class="form-select text-warnings"
              @change="change_task_statement($event)">

              <option disabled="disabled" :value="'Delivered'" :selected="selected == 'Delivered' ? 'selected' : ''">
                Delivered
              </option>

            </select>

            <select v-else class="form-select text-warnings" @change="change_task_statement($event)">

              <option disabled="disabled" :value="'New'">New</option>

              <option :value="'Pending'" :selected="selected == 'Pending' ? 'selected' : ''">
                Pending
              </option>
              <option :value="'In Progress'" :selected="selected == 'In Progress' ? 'selected' : ''">
                In Progress
              </option>
              <option :value="'Ready to QA'" :selected="selected == 'Ready to QA' ? 'selected' : ''">
                Ready to QA
              </option>


              <option disabled="disabled" :selected="selected == 'QA In Progress' ? 'selected' : ''"
                :value="'QA In Progress'">
                QA In Progress
              </option>
              <option disabled="disabled" :selected="selected == 'QA Rejected' ? 'selected' : ''"
                :value="'QA Rejected'">
                QA Rejected
              </option>
              <option disabled="disabled" :selected="selected == 'QA Approved' ? 'selected' : ''"
                :value="'QA Approved'">
                QA Approved
              </option>

              <!-- <option v-if="lead_manager_admin" :selected="selected == 'QA Approved' ? 'selected' : ''"
                value="QA Approved">
                QA Approved
              </option>
              <option :value="'Feedback'" v-if="selected == 'Feedback'"
                :selected="selected == 'Feedback' ? 'selected' : ''">Feedback</option> -->
            </select>
          </div>
        </div>
        <br />
        <br />
        <div class="row">
          <div class="col-lg-12">
            <label for="">Document Title</label>

            <input type="text" class="form-control" v-model="form.name" name="document_text" />
          </div>
          <div class="col-lg-12 upload_docs">
            <label for="validationCustom01" class="form-label"></label>
            <div class="form-group mb-0">
              <input name="files" @change="processFileDocumentUpload($event)" type="file" id="task_documents_uploadd"
                accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple />
            </div>
          </div>
          <div class="col-lg-12" style="margin-top: 10px" v-if="selected != 'QA Approved' && selected != 'Delivered'">
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
            <a href="javascript:void(0);" class="card-options-collapse me-2 text-white"
              data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="javascript:void(0);" class="card-options-remove text-white" data-bs-toggle="card-remove"><i
                class="fe fe-x"></i></a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-2" v-for="(task_doc,index) in task_documents" :key="index">
              <a :href="task_doc.url" target="_blank">
                <img :src="task_doc.url" v-if="
                  task_doc.file_type == 'jpg' ||
                  task_doc.file_type == 'png' ||
                  task_doc.file_type == 'gif' ||
                  task_doc.file_type == 'jpeg'
                " style="
                    border-radius: 5px;
                    box-shadow: 0px 0px 3px 0px;
                    width: 80px;
                  " :title="task_doc.name" /></a>

              <a :href="task_doc.url" target="_blank">
                <img style="width: 80px" :src="$hostname + '../public/assets/images/files/file.jpg'" alt="" v-if="
                  task_doc.file_type != 'jpg' &&
                  task_doc.file_type != 'png' &&
                  task_doc.file_type != 'gif' &&
                  task_doc.file_type != 'jpeg'
                " :title="task_doc.name" /></a>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">Writers Documents</h3>
          <div class="card-options">
            <a href="javascript:void(0);" class="card-options-collapse me-2 text-white"
              data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="javascript:void(0);" class="card-options-remove text-white" data-bs-toggle="card-remove"><i
                class="fe fe-x"></i></a>
          </div>
        </div>
        <div class="card-body" style="height: 300px; overflow: auto">
          <!-- sale_order_uploaded_document -->

          <table class="table table-bordered text-nowrap dataTable no-footer" id="writer_uplaoded_documents" role="grid"
            aria-describedby="example1_info">
            <thead>
              <tr>

                <th>Select</th>
                <th>File Name</th>
                <th>Link</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody v-if="role == 'Sale Manager' || role == 'Sale Agent'">
              <tr v-for="(doc,index) in writer_documetns" :key="index" v-if="doc.doc_status == 'Sent' || doc.doc_status == 'Failed'" >
                <td>
                  <div v-if="doc.doc_status">
                    <!-- <input type="checkbox"  :value="doc.sale_document_id"  :id="'doc_id_'+doc.sale_document_id" v-model="form.select_files"></input> -->
                    {{ doc.doc_status }}
                  </div>
                  <div v-else>
                    <input type="checkbox" :value="doc.sale_document_id" :id="'doc_id_' + doc.sale_document_id"
                      v-model="form.select_files" />
                  </div>

                </td>
                <td>{{ doc.document_name }}</td>
                <td><a :href="doc.url">download link</a></td>
                <td><i class="fa fa-trash"></i></td>
              </tr>
            </tbody>
             <tbody v-else>
              <tr v-for="doc in writer_documetns" :key="doc.sale_document_id" >
                <td>


                  <div v-if="doc.doc_status">
                    <!-- <input type="checkbox"  :value="doc.sale_document_id"  :id="'doc_id_'+doc.sale_document_id" v-model="form.select_files"></input> -->
                    {{ doc.doc_status }}
                  </div>
                  <div v-else>
                    <input type="checkbox" :value="doc.sale_document_id" :id="'doc_id_' + doc.sale_document_id"
                      v-model="form.select_files" />
                  </div>

                </td>
                <td>{{ doc.document_name }}</td>
                <td><a :href="doc.url">download link</a></td>
                <td><i class="fa fa-trash"></i></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="card">
        <div class="card-header bg-secondary">
          <h3 class="card-title text-white">Task Progress Status</h3>
          <div class="card-options">
            <a href="javascript:void(0);" class="card-options-collapse me-2 text-white"
              data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="javascript:void(0);" class="card-options-remove text-white" data-bs-toggle="card-remove"><i
                class="fe fe-x"></i></a>
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
                <div class="col-12 ">
                  <!-- Timeline Area-->
                  <div class="apland-timeline-area" v-for="(prog, index) in order_details.order_statuses" :key="index">
                    <!-- Single Timeline Content-->
                    <div class="single-timeline-area" >
                      <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="
                          visibility: visible;
                          animation-delay: 0.1s;
                          animation-name: fadeInLeft;
                        ">
                        <p>
                          {{ moment(prog.created_at).fromNow() }}
                        </p>
                      </div>
                      <div class="row">
                        <div class="col-12 col-md-12 col-lg-12" >
                          <div class="
                              single-timeline-content
                              d-flex
                              wow
                            " data-wow-delay="0.3s" 
                             style="
                              visibility: visible;
                              animation-delay: 0.3s;
                              animation-name: fadeInLeft;
                            "
                            :class="prog.title.replace(/\s+/g, '-').toLowerCase()">
                            <div class="timeline-icon">
                              <i class="fa fa-address-card" aria-hidden="true"></i>
                            </div>
                            <div class="timeline-text" >
                              <b style="font-size:15px;">
                                <h6>{{ prog.title }}</h6>
                              </b>
                               <b style="font-size:10px; ">
                                  <h6>Changed by: {{ prog.status_first_name }} {{ prog.status_last_name }},  Changed at: {{ moment(prog.created_at).format("Y-M-D H:m")  }}</h6>
                              
                              </b>
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
            <a href="javascript:void(0);" class="card-options-collapse me-2 text-white"
              data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="javascript:void(0);" class="card-options-remove text-white" data-bs-toggle="card-remove"><i
                class="fe fe-x"></i></a>
          </div>
        </div>
        <div class="card-body" style="height: 300px; overflow: auto">
          <!-- sale_order_uploaded_document -->
          <div class="form-group col-md-12"
            v-if="lead_manager_admin && selected != 'Ready to QA' && selected != 'QA In Progress' && selected != 'QA Approved' && selected != 'QA Rejected' && selected != 'Delivered'">
            <div class="input-group">
              <!-- <input type="text" name="" id="" class="form-control" placeholder="Assign More"> -->
              <select style='width: 200px;' class="form-select" @change="assign_writer($event, task_id)">
                <option value=""></option>
                <option v-for="(writer,index) in all_writers" :key="index" :value="writer.id">
                  {{ writer.name }} ({{ writer.order_assigns_count }})
                </option>

              </select>
            </div>
          </div>
          <table class="table table-bordered text-nowrap dataTable no-footer" id="lead_docs_table" role="grid"
            aria-describedby="example1_info">
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
              <tr v-for="(assign,index) in order_assigns" :key="index">
                <td>{{ assign.user_id }}</td>

                <td>{{ assign.first_name }} {{ assign.last_name }}</td>

                <td @click="editStatus(assign.assign_id)">
                  <div v-if="edit_status == true && status_id == assign.assign_id">
                    <select v-if="is_qa" name="" id="" class="form-select"
                      @change="assign_task_update($event, assign.user_id)">
                      <option value=""></option>

                      <option value="Pending" :selected="
                        assign.status_id == 'Pending' ? 'selected' : ''
                      ">Pending</option>

                      <option value="In Progress" :selected="
                        assign.status_id == 'In Progress' ? 'selected' : ''
                      ">In Progress</option>

                      <option value="Ready to QA" :selected="
                        assign.status_id == 'Ready to QA' ? 'selected' : ''
                      ">Ready to QA</option>

                      <option value="QA Approved" v-if="lead_manager_admin"
                        :selected="assign.status_id == 'QA Approved' ? 'selected' : ''">
                        QA Approved
                      </option>
                    </select>
                    <select v-else name="" id="" class="form-select"
                      @change="assign_task_update($event, assign.user_id)">
                      <option value=""></option>

                      <option value="Pending" :selected="
                        assign.status_id == 'Pending' ? 'selected' : ''
                      ">Pending</option>

                      <option value="In Progress" :selected="
                        assign.status_id == 'In Progress' ? 'selected' : ''
                      ">In Progress</option>

                      <option value="Ready to QA" :selected="
                        assign.status_id == 'Ready to QA' ? 'selected' : ''
                      ">Ready to QA</option>

                      <option :disabled="'disabled'" value="QA Approved"
                        :selected="assign.status_id == 'QA Approved' ? 'selected' : ''">
                        QA Approved
                      </option>
                    </select>
                  </div>
                  <div v-else>
                    {{ assign.status_id }}
                  </div>
                  <!-- <b-button v-b-modal.modal-1>Launch demo modal</b-button> -->
                </td>

                <td @click="editProgress(assign.assign_id)">
                  <div v-if="
                    edit_progress == true && progress_id == assign.assign_id
                  ">
                    <input type="number" max="100" class="form-control"
                      @change="change_task_progrees($event, assign.user_id)" :value="assign.completed" />
                  </div>
                  <div class="progress progress-md mb-3" v-else>
                    <div class="
                        progress-bar progress-bar-striped progress-bar-animated
                        bg-green
                      " :style="'width:' + assign.completed + '%'">
                      {{ assign.completed }}%
                    </div>
                  </div>
                </td>
                <td>{{ moment(assign.created_at).fromNow() }}</td>
                <td>
                  <div>
                    <b-button @click="modalShow(assign.user_id)" v-if="assign.status_id == 'QA Approved' && (lead_manager_admin || is_qa) "
                      v-b-modal.modal-1>Rating</b-button>
                  </div>

                  <div v-if="lead_manager_admin">
                    <i class="fa fa-trash" title="remove task" style="cursor: pointer"
                      @click="delete_assigned_user(assign.assign_id)"></i>

                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
<div v-if="myFailedModal">
   <b-modal v-model="myFailedModal" id="modal-2" :title="'Kindly give a reason for fail this ORDER-'+task_id+'.'" ok-title="Submit" @ok="submit_reason()">
      <div>

          <label for="">
            <b style="font-size:15px;">Reason</b>
          </label>
            <textarea name="" id="" cols="30" rows="5" class="form-control" v-model="reasons.reason"></textarea>
            
          <label for="">
            <b style="font-size:15px;">Files</b>
          </label>
            <input type="file" class="form-control" multiple @change="processFileReasonDocumentUpload($event)">

          
            
      </div>
   </b-modal>
</div>

    <div v-if="myModel">

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
  props: ["task_id","role"],
  components: {
    BButton,
    BModal
  },
  directives: {
    'b-modal': VBModal
  },
  data() {
    return {
      myModel: false,
      myFailedModal :false,
      cchecked1: false,
      cchecked2: false,
      cchecked3: false,
      cchecked4: false,
      ochecked1: false,
      ochecked2: false,
      ochecked3: false,
      ochecked4: false,
      rchecked1: false,
      rchecked2: false,
      rchecked3: false,
      rchecked4: false,
      rating: 0,
      form: new Form({
        title: "",
        name: "",
        files: "",
        user_id: "",
        status: false,
        select_files: []
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
      ratings: {
        order_id: '',
        user_id: '',
        rating: {
          compliance_and_relevance: 0,
          overall_quality_of_the_content: 0,
          referencing: 0,
        },
      },
      reasons: new Form({
        reason: "",
        files: [],
        status: 'Failed',

      }),
      all_writers: [],
      assign_writer_post: {},
      page_reload: false,
      is_qa: false,
      reason_added: false,
    };
  },

  methods: {
    moment,
    handleOk(bvModalEvent) {
      alert();
    },
    async modalShow(user_id) {
      this.ratings.user_id = user_id;
      this.cchecked1 = false,
      this.cchecked2 = false,
      this.cchecked3 = false,
      this.cchecked4 = false,
      this.ochecked1 = false,
      this.ochecked2 = false,
      this.ochecked3 = false,
      this.ochecked4 = false,
      this.rchecked1 = false,
      this.rchecked2 = false,
      this.rchecked3 = false,
      this.rchecked4 = false,
      this.myModel   = true;
    },
    async assign_writer(e, ele) {

      const _this = this;

      this.assign_writer_post.user_id = e.target.value;

      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      };

      var item = this.assign_writer_post.user_id;

      await axios.post(this.$hostname + "writers/check_user_assignments/" + ele, this.assign_writer_post, { headers }).then((response) => {

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
          function (isConfirm) {

            if (isConfirm) {

              $.ajax({

                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

                type: "post",

                url: main_url + '/writers/assigned_user/' + ele,

                data: { user_id: item },

                dataType: "json",

                success: function (response) {

                  if (response.status == 'success') {

                    swal('Congratulations!', response.message, response.success);

                    // reload_page = 'yes';
                    _this.show_task_details();
                    // setTimeout(function () {
                    //   location.reload(true);
                    // }, 1000);
                    // $( "#lead_docs_table" ).load(window.location.href + " #lead_docs_table" );

                  }

                }

              });
            } else {
              swal("Cancelled", "Task Not Aassigned", "error");
            }
          });

        // this.show_task_details();
        // console.log(reload_page)



      });



    },
    async fetch_writers(e) {
      axios.get(this.$hostname + "writers/fetch_all_writers").then((response) => {
        this.all_writers = response.data;
        // console.log(this.all_writers)
      });
    },

    async submit_reason(){
      
      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      };
     await this.reasons
        .post(this.$hostname + "orders/failed_reason/" + this.task_id, null, {
          headers,
        })
        .then((response) => {
          console.log(response.data.status)
          if(response.data.status =='success')
          {
            this.reason_added = true; 
            this.myFailedModal = false;
            this.change_task_statement(response.data.title);
          }

        });
    
    },

    async submit_ratings() {

      this.ratings.order_id = this.task_id;

      const headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      };
      if (this.ratings.rating) {

        await axios.post(this.$hostname + "writers/submit_ratings", this.ratings, { headers }).then((response) => {

          if (response.data.status == 'success') {

            swal('Success!', response.data.message, response.data.status);
          }
        });
      } else {
        alert('please select atleast 1 ratings');
      }
    },
    async editStatus(ele) {
      this.edit_status = true;
      this.edit_progress = false;
      this.progress_id = ele;
      this.status_id = ele;
    },

    async ostars_rating(ele) {

      var rating = 0;
      // this.ratings.rating = ele;
      if (ele == 1) {
        rating = 1;
        this.ochecked1 = true;
      } else {
        this.ochecked1 = false;
      }

      if (ele == 2) {
        rating = 2
        this.ochecked1 = true;
        this.ochecked2 = true;
      } else {
        this.ochecked2 = false;
      }

      if (ele == 3) {
        rating = 3
        this.ochecked1 = true;
        this.ochecked2 = true;
        this.ochecked3 = true;
      } else {
        this.ochecked3 = false;
      }

      if (ele == 4) {
        rating = 4
        this.ochecked1 = true;
        this.ochecked2 = true;
        this.ochecked3 = true;
        this.ochecked4 = true;
      } else {
        this.ochecked4 = false;
      }


      this.ratings.rating.overall_quality_of_the_content = rating;
    },

    async cstars_rating(ele) {


      // this.ratings.rating = ele;
      var rating = 0;
      if (ele == 1) {
        rating = 1
        this.cchecked1 = true;
      } else {
        this.cchecked1 = false;
      }

      if (ele == 2) {
        rating = 2
        this.cchecked1 = true;
        this.cchecked2 = true;
      } else {
        this.cchecked2 = false;
      }

      if (ele == 3) {
        rating = 3
        this.cchecked1 = true;
        this.cchecked2 = true;
        this.cchecked3 = true;
      } else {
        this.cchecked3 = false;
      }

      if (ele == 4) {
        rating = 4
        this.cchecked1 = true;
        this.cchecked2 = true;
        this.cchecked3 = true;
        this.cchecked4 = true;
      } else {
        this.cchecked4 = false;
      }
      // console.log(this.ratings.rating,rating);
      this.ratings.rating.compliance_and_relevance = rating;
    },

    async rstars_rating(ele) {

      var rating = 0;
      if (ele == 1) {
        this.rchecked1 = true;
        rating = 1;
      } else {
        this.rchecked1 = false;
      }

      if (ele == 2) {
        this.rchecked1 = true;
        this.rchecked2 = true;
        rating = 2;
      } else {
        this.rchecked2 = false;
      }

      if (ele == 3) {
        this.rchecked1 = true;
        this.rchecked2 = true;
        this.rchecked3 = true;
        rating = 3;
      } else {
        this.rchecked3 = false;
      }

      if (ele == 4) {
        this.rchecked1 = true;
        this.rchecked2 = true;
        this.rchecked3 = true;
        this.rchecked4 = true;
        rating = 4;
      } else {
        this.rchecked4 = false;
      }

      this.ratings.rating.referencing = rating;
      //  rating: {
      //           compliance_and_relevance: 0,
      //           overall_quality_of_the_content: 0,
      //           referencing: 0,
      //         },
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


          this.is_qa = response.data.is_qa


          this.fetch_writers();
        });
    },
 
    async processFileReasonDocumentUpload(e) {

      let file = e.target.files;

      let reader = new FileReader();

      this.reasons.files = e.target.files;

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

    async selectedDocuments(ele) {



    },

    async change_task_statement(e) {

      if (e.target) {

        if (e.target.value) {

          this.form.title = e.target.value;

        }

      } else {

        this.form.title = e;
      }

    if(this.form.title == 'Failed' && this.reason_added== false){

        this.myFailedModal = true;

    }

    if( this.myFailedModal == false){

          this.form.status = true;

          const headers = {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),

            "Content-Type": "multipart/form-data",
          };


          if (this.form.title == 'QA Approved') {

            if (this.form.select_files.length <= 0) {

              alert('please select documents');

              e.target.value = this.selected

              return false;

            }

          }


          await this.form
            .post(this.$hostname + "writers/task_status_update/" + this.task_id, null, {
              headers,
            })
            .then((response) => {

              if (response.data.stop_reload == false) {
                swal(
                  response.data.alert_message,
                  response.data.message,
                  "success"
                );
                this.show_task_details();
              } else {

                e.target.value = response.data.title;

                swal(
                  response.data.alert_message,
                  response.data.message,
                  "error"
                );

              }

            });
    }

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
      if (e.target.value == 'QA Approved') {


        this.ratings.user_id = user_id;

      }

      await this.task_update_form
        .post(
          this.$hostname + "writers/user_task_details_update/" + this.task_id,
          null,
          { headers }
        )
        .then((response) => {

          if (response.data.status == 'error') {

            e.target.value = response.data.status_id;

            swal('Oops!', response.data.message, 'error');

          }

          this.edit_status = false;

          this.status_id = user_id;

          for (let i = 0; i < this.order_assigns.length; i++) {

            if (this.order_assigns[i].user_id == user_id) {

              this.order_assigns[i].status_id = e.target.value;

            }
          }

        });
    },
    async delete_assigned_user(assigned_id) {
      const __this = this;
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
        function (isConfirm) {

          if (isConfirm) {
            const headers = {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),

              "Content-Type": "multipart/form-data",
            };

            $.ajax({

              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

              type: "post",

              url: main_url + '/writers/delete_assigned_user',

              data: { order_id: assigned_id },

              dataType: "json",

              success: function (response) {

                if (response.status == 'success') {

                  swal('Congratulations!', response.message, response.status);

                  __this.show_task_details();

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
              if (response.data.status == 'success' && response.data.stop_reload == false) {
                setTimeout(function () {
                  location.reload(true);
                }, 1000);
                //  this.show_task_details();
              } else {
                // setTimeout(function () {
                //   location.reload(true);
                // }, 4000);
              }

              // window.scrollTo(0,0);


            }
          });
      }
    },
  },
  async mounted() {

    this.show_task_details();

    this.interval = setInterval(() => this.show_task_details(), 10000);
    
    // this.show_task_details();

    // this.fetch_writers();



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
  background-color: #6b6b6b;
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
  padding: 10px 10px ;
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
  background-color: #000000;
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

.stars:hover {

  color: red;
}

.checked {
  color: red;
}




.new{font-size:8px;padding:5px;background:#D3D3D3}
.pending{font-size:8px;padding:5px;background:#616161; color:#ebebeb }

.in-progress{font-size:8px;color:#000000;padding:5px;background:#ffde73;}
.ready-to-qa {font-size:8px;color:#000000;padding:5px;background:rgb(253, 238, 162);}
.qa-in-progress {font-size:8px;color:#ebebeb;padding:5px;background:#00C851;}
.qa-approved {font-size:8px;color:#ebebeb;padding:5px;background:#33b5e5;}
.delivered {font-size:8px;color:#ebebeb;padding:5px;background:#007E33;}
.completed {font-size:8px;color:#ebebeb;padding:5px;background:#007E33;}
.failed {font-size:8px;color:#FFFFFF;padding:5px;background:#ff4444;}
.qa-rejected {font-size:8px;color:#FFFFFF;padding:5px;background:rgb(222 , 94 , 94) ;}



</style>