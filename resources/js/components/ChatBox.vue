<template>
  <div>
    
	<div class="chat-trigger" v-if="chat_button" @click="chatBtn">
	<i class="fa fa-comments-o my-chat-trigger"></i>
	</div>
	
	<div class="chat-box-here" style="position: fixed;width: 50%;bottom: 25px;right: 25px;" v-if="chat_box">
						<div class="card"  >
							<div class="row g-0">
								<div class="col-lg-5 col-xl-4">
									<div class="overflow-hidden mb-0 mb-lg-0">
										<div class="card-body p-0" >
											<div class="main-content-left main-content-left-chat">
												<div class="p-4 pb-0 border-bottom">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Search Friends...">
															<button type="button" class="btn btn-primary ">
																<i class="fa fa-search"></i>
															</button>
													</div>
												</div>
<!-- active_users -->
												<div class="main-chat-list ps">

                                                    <div  style="height: 350px;overflow: auto;">
													<a href="javascript:void(0);"  v-for="(user, index ) in active_users" :key="index" @click="select_chat(user.id)">
														<div class="media new">
															<div class="main-img-user online">
																<img alt="" :src="$hostname+'../storage/app/'+user.profile_image_id" class="avatar avatar-md brround"><span>0</span>
															</div>
															<div class="media-body">
																<div class="media-contact-name">
																	<span>{{user.first_name}} {{user.last_name}}</span> <span>2 hours</span>
																</div>
																<!-- <p>culpa qui officia deserunt...</p> -->
															</div>
														</div>
													</a></div>


												<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div><!-- main-chat-list -->
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-7 col-xl-8">
									<div class="border-start">
										<div class="main-content-body main-content-body-chat">
											<div class="main-chat-header">
												<div class="main-img-user"><img alt="" :src="selected_chat.user_image" class="avatar avatar-md brround"></div>
												<div class="main-chat-msg-name">
													<h6>{{selected_chat.user_name}}</h6>
                                                    <!-- <small>Last seen: 1 minute ago</small> -->
												</div>
												<!-- <nav class="nav">
													<a class="nav-link" href=""><i class="fe fe-more-vertical"></i></a>
													<a class="nav-link d-none d-sm-block" data-bs-toggle="tooltip" href="" title="" data-bs-original-title="Call" aria-label="Call"><i class="fe fe-phone text-muted"></i></a>
													<a class="nav-link d-none d-sm-block" data-bs-toggle="tooltip" href="" title="" data-bs-original-title="Archive" aria-label="Archive"><i class="fe fe-folder-plus text-muted"></i></a>
													<a class="nav-link d-none d-sm-block" data-bs-toggle="tooltip" href="" title="" data-bs-original-title="Trash" aria-label="Trash"><i class="fe fe-trash-2 text-muted"></i></a>
													<a class="nav-link d-none d-sm-block card-options-collapse me-2 " data-bs-toggle="tooltip" href="#" title="" data-bs-original-title="View Info" aria-label="View Info"  data-bs-toggle="card-collapse"><i class="fa fa-times"></i></a>
												</nav> -->

												<div class="card-options">
													<!-- <a href="javascript:void(0);" class="card-options-collapse me-2" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a> -->
													<a href="javascript:void(0);" class="card-options-remove" data-bs-toggle="card-remove" @click="hideChat"><i class="fe fe-x"></i></a>
												</div>
											</div><!-- main-chat-header -->
											<div class="main-chat-body ps" id="ChatBody" style="height:300px;">
												<div class="content-inner">
													<label class="main-chat-time"><span class="bg-primary-transparent">3 days ago</span></label>
													<div class="media flex-row-reverse">
														<div class="main-img-user online"><img alt="" :src="'../../assets/images/users/2.jpg'" class="avatar avatar-md brround"></div>
														<div class="media-body">
															<div class="main-msg-wrapper">
																 Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
															</div>
												
															<div>
																<span>9:48 am</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
															</div>
														</div>
													</div>
													<div class="media">
														<div class="main-img-user online"><img alt="" :src="'../../assets/images/users/14.jpg'" class="avatar avatar-md brround"></div>
														<div class="media-body">
															<div class="main-msg-wrapper">
																Nor again is there anyone who loves or pursues or desires to obtain pain of itself
															</div>
													
															<div>
																<span>9:32 am</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a>
															</div>
														</div>
													</div>
												
													
												</div>
											<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
											<div class="main-chat-footer">
												<nav class="nav">
													<a href="javascript:void(0)" class="nav-link" data-bs-toggle="tooltip" title="" data-original-title="Camera" data-bs-original-title=""><i class="fe fe-camera fs-20 text-muted"></i></a>
													<a href="javascript:void(0)" class="nav-link" data-bs-toggle="tooltip" title="" data-original-title="Emoji" data-bs-original-title=""><i class="fa fa-smile-o fs-20 text-muted"></i></a>
													<a href="javascript:void(0)" class="nav-link" data-bs-toggle="tooltip" title="" data-original-title="Attach" data-bs-original-title=""><i class="fe fe-paperclip fs-20 text-muted"></i></a>
												</nav>
												<input class="form-control" placeholder="Type your message here..." type="text"> <a class="main-msg-send" href=""><i class="fa fa-paper-plane-o text-muted"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
</div>
  </div>
</template>

<script>
export default {
data(){
    return {
        chat_button : true,
        chat_box: false,
        active_users: [],
        selected_chat:{
            user_name : "",
            user_image : "",
            chats: [],
        },
        login_chat:{
            user_name : "",
            user_image : "",
       
        }
    }
},
methods:{
     select_chat(ele){
    
        axios.get(this.$hostname + "fetch_my_message/"+ele).then((response) => {
            var records = response.data
            this.selected_chat.user_name = records.users.first_name + ' ' + records.users.last_name;
            this.selected_chat.user_image = this.$hostname + '../storage/app/'+records.users.profile_image_id;
            this.login_chat.user_name = records.users.first_name + ' ' + records.users.last_name;
            this.login_chat.user_image = this.$hostname + '../storage/app/'+records.users.profile_image_id;
        });
    },
    activeUsers(){
                axios.get(this.$hostname + "user/fetch_all_active_users").then((response) => {
                this.active_users = response.data.result;

            });
    },
    chatBtn(){
        
        this.chat_button = false;

        this.chat_box = true;

        if(this.chat_box){

             this.activeUsers();

        }

    },
    hideChat(){
 
        this.chat_box = false;

        this.chat_button = true;

    }

}

}
</script>

<style>

</style>