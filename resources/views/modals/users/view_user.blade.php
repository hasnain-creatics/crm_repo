<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">  
   <style>	
body{margin-top:20px;}
.icon-box.medium {
    font-size: 20px;
    width: 50px;
    height: 50px;
    line-height: 50px;
}
.icon-box {
    font-size: 30px;
    margin-bottom: 33px;
    display: inline-block;
    color: #ffffff;
    height: 65px;
    width: 65px;
    line-height: 65px;
    background-color: #59b73f;
    text-align: center;
    border-radius: 0.3rem;
}
.social-icon-style2 li a {
    display: inline-block;
    font-size: 14px;
    text-align: center;
    color: #ffffff;
    background: #59b73f;
    height: 41px;
    line-height: 41px;
    width: 41px;
}
.rounded-3 {
    border-radius: 0.3rem !important;
}

.social-icon-style2 {
    margin-bottom: 0;
    display: inline-block;
    padding-left: 10px;
    list-style: none;
}

.social-icon-style2 li {
    vertical-align: middle;
    display: inline-block;
    margin-right: 5px;
}

a, a:active, a:focus {
    color: #616161;
    text-decoration: none;
    transition-timing-function: ease-in-out;
    -ms-transition-timing-function: ease-in-out;
    -moz-transition-timing-function: ease-in-out;
    -webkit-transition-timing-function: ease-in-out;
    -o-transition-timing-function: ease-in-out;
    transition-duration: .2s;
    -ms-transition-duration: .2s;
    -moz-transition-duration: .2s;
    -webkit-transition-duration: .2s;
    -o-transition-duration: .2s;
}

.text-secondary, .text-secondary-hover:hover {
    color: #59b73f !important;
}
.display-25 {
    font-size: 1.4rem;
}

.text-primary, .text-primary-hover:hover {
    color: #ff712a !important;
}

p {
    margin: 0 0 20px;
}

.mb-1-6, .my-1-6 {
    margin-bottom: 1.6rem;
}</style>  
	 
	 <div class="modal fade effect-slide-in-right " id="modaldemo8" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
			<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">User Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
					<div class="modal-body">
							

							<!-- detail start -->
		
                        
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-4 mb-5 mb-lg-0 wow fadeIn">
            <div class="card border-0 shadow">
                <img width="200" height="200"  src="<?php echo (trim($user_details->profile_image) ? url('storage/app/'.trim($user_details->profile_image)) : asset('public/assets/images/no_image.jpg')); ?>" alt="..." >
                <div class="card-body p-1-9 p-xl-5">
                    <div class="mb-4">
                        <h3 class="h4 mb-0" style="text-transform: capitalize;">{{$user_details->f_name}} </h3>
                       <span class="text-primary" style="text-transform: capitalize;" >{{($user_details->name)}}</span> 
                    </div>
                    <!-- <ul class="list-unstyled mb-4">
                        <li class="mb-3" style=";float:left;"><a  style="float:left;" href="#!"><i class="far fa-envelope display-25 me-3 text-secondary"></i><span style="width:100px; word-wrap:break-word; display:inline-block;"> {{$user_details->email}}</span></a></li>
                        <li class="mb-3" style="width:150px;float:left"><a  style="float:left;" href="#!"><i class="fas fa-mobile-alt display-25 me-3 text-secondary"></i>{{$user_details->phone_number}}</a></li>
                        <li class="mb-3" style="width:150px;float:left"><a  style="float:left;" href="#!"><i class="fas fa-user-alt display-25 me-3 text-secondary"></i>{{$user_details->nickname}}</a></li>
                        <li class="mb-3" style="width:150px;float:left"><a  style="float:left;" href="#!"><i class="fas fa-map-marker-alt display-25 me-3 text-secondary"></i>{{$user_details->title}}</a></li>
                    </ul> -->

                    <table class="table table-hover table-striped ">
  <thead>
    
  </thead>
  <tbody>
   
    <tr>
      <td style="width:5%; padding:10px" ><i class="far fa-envelope display-25 me-3 text-secondary"></i></th>
     
      <td style=" padding-top: 10px;padding-left: 0px;"><span style="width:100px; word-wrap:break-word; display:inline-block;">{{$user_details->email}}</span></th>
    
    </tr>
    <tr>
      <td style="width:5%; padding:10px" ><i class="fas fa-mobile-alt display-25 me-3 text-secondary"></i></th>
     
      <td style=" padding-top: 10px;padding-left: 0px;" >{{$user_details->phone_number}}</th>
    
    </tr>
    <tr>
      <td style="width:5%; padding:10px" ><i class="fas fa-user-alt display-25 me-3 text-secondary"></i></th>
     
      <td style=" padding-top: 10px;padding-left: 0px;" >{{$user_details->nickname}}</th>
    
    </tr>
    

    <tr>
      <td style="width:5%; padding:10px" ><i class="fas fa-map-marker-alt display-25 me-3 text-secondary"></i></th>
     
      <td style=" padding-top: 10px;padding-left: 0px;" >{{$user_details->title}}</th>
    
    </tr>
    

   

   
  </tbody>
</table>





                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ps-lg-1-6 ps-xl-5">
                <!-- <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">#About Me</h2>
                    </div>
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
                    <p class="mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                </div> -->
                <!-- <div class="mb-5 wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">#Education</h2>
                    </div>
                    <div class="row mt-n4">
                        <div class="col-sm-6 col-xl-4 mt-4">
                            <div class="card text-center border-0 rounded-3">
                                <div class="card-body">
                                    <i class="ti-bookmark-alt icon-box medium rounded-3 mb-4"></i>
                                    <h3 class="h5 mb-3">Education</h3>
                                    <p class="mb-0">University of defgtion, fecat complete ME of synage</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4 mt-4">
                            <div class="card text-center border-0 rounded-3">
                                <div class="card-body">
                                    <i class="ti-pencil-alt icon-box medium rounded-3 mb-4"></i>
                                    <h3 class="h5 mb-3">Career Start</h3>
                                    <p class="mb-0">After complete engineer join HU Signage Ltd as a project manager</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4 mt-4">
                            <div class="card text-center border-0 rounded-3">
                                <div class="card-body">
                                    <i class="ti-medall-alt icon-box medium rounded-3 mb-4"></i>
                                    <h3 class="h5 mb-3">Experience</h3>
                                    <p class="mb-0">About 20 years of experience and professional in signage</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="wow fadeIn">
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="mb-0 text-primary">User Details</h2>
                    </div>
                    <!-- <p class="mb-4">Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p> -->
                    <div class="progress-style1">

<table class="table table-hover table-striped">
  <thead>
    
  </thead>
  <tbody>
   
    <tr>
      <th scope="Col">Assign to</th>
     
      <th scope="row">{{$user_details->assigned_name}}</th>
    
    </tr>
    <tr>
      <th scope="Col">Lead</th>
      
      <th scope="row">{{$user_details->is_leadd=='1' ? 'YES' :'NO'}}</th>
     
    </tr>

    <tr>
      <th scope="Col">Salary</th>
      
      <th scope="row">{{number_format($user_details->salary)}} /=</th>
     
    </tr>

    <tr>
      <th scope="Col">Status</th>
      
      <th scope="row">{{$user_details->statuss}}</th>
     
    </tr>
  </tbody>
</table>
                      
                    </div>
                </div>

            <div style="height:300px;overflow-y:auto">

             <?php 
             if($user_details->is_leadd=='1' || $user_details->role_type == 'manager')   
             { $i=1;
              // print_r($teams);
                 ?>
                
                <table class="table table-hover table-striped" width="10%">
                    <thead>
                    <tr>
                        <td scope="Col" colspan="4">Team Details</td>
                    </tr>
                    <tr>
                        <th scope="row" width="5%">S.no</th>
                        <th scope="row" width="5%" >Username</th>
                        <th scope="row" width="5%" >Designation</th>
                        
                    </tr>

                    </thead>
                    <tbody>
                   
                    @foreach($teams as $value=>$team_value)
                    
                        <tr>
                            <td width="5%">{{$i++}}</td>
                            <td width="5%" style="text-transform: capitalize;">{{$team_value->f_namemm}}</td>
                            <td  width="5%" style="text-transform: capitalize;" >{{$team_value->name}}</td>
                           
                        </tr>
                        
                 @endforeach
                       
                    </tbody>
                    </table>

            <?php  } ?>

            </div>



            </div>
        </div>
    </div>
</div>
							<!-- detail end -->



					</div>
					<div class="modal-footer">
						 <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>