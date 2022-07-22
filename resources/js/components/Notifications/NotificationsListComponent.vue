<template>
    <!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
    <div class="dropdown notification-dropdown header-notify d-flex" @click="check_notifications">
        <a class="nav-link icon" data-bs-toggle="dropdown">
            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24" viewBox="0 0 24 24">
                <path
                    d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z" />
            </svg>


            <span class="navbar-notice-number badge fs-10 bg-primary br-1 ms-auto"
                v-if="is_notification">{{ counts }}</span>

        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow  animated notification_drop_down_div">
            <div class="dropdown-header">
                <h6 class="mb-0">Notifications <span class="badge fs-10 bg-primary br-1 ms-auto">{{ result.new }}</span>
                </h6>
                <span class="badge fs-10 bg-danger br-1 ms-auto" style="cursor:pointer"
                    @click="clear_notifications">Clear All</span>
            </div>
            <div class="notify-menu" style="max-height:300px;overflow:auto;max-width:400px;">

               <div class="pull-right" v-if="message_loading">
					Processing <img style="width:100px;" src="https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/attachments/delivery/asset/c49c83ef51b0c4230f8f39560b8250a3-1596267998/navy_for-light_bg/make-animated-logo-loader-for-your-website.gif" alt="">
				</div>
				
                <div v-if="result" v-for="(notify, index) in result.result" :key="index">
                    <a :href="notify.data.url"
                        class="dropdown-item border-bottom d-flex ps-4">
                        <div>
                            <span class="fs-13">{{ notify.data.message }}.</span>
                            <div class="small text-muted">{{ moment(notify.created_at).format("Y-M-D H:m") }}</div>
                        </div>
                    </a>

                   </div>

                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>
            <div class=" text-center p-2">
                <a href="email-inbox.html" class="btn btn-primary btn-md fs-13 btn-block">View All</a>
            </div>
        </div>
    </div>
</template>

<script>


import moment from "moment";
export default {

    props: ['role','user_id'],
    data() {

        return {

            result: [],
            is_notification: false,
            counts: 0,
            check_my_notification:false,
            message_loading: true,

        }

    },

    methods: {
        moment,
        async check_some_notifications() {

            await axios.get(this.$hostname + "notifications/check_some_notifications").then((response) => {

                if (response.data.status == 'success') {

                    this.is_notification = true;

                    this.counts = response.data.notification > 20 ? '20+' : response.data.notification;
                    
                }

            });

        },

        async check_notifications() {

            await axios.get(this.$hostname + "notifications/fetch_new_notifications").then((response) => {
                
                this.result = response.data;

                if(this.result.status == 'success'){
                    
                    this.message_loading = false;
                }

            });

        },

        async clear_notifications() {
            if (confirm('Are you sure')) {
                await axios.get(this.$hostname + "notifications/notify_notification").then((response) => {
                    if (response.data.status == 'success') {
                        this.is_notification = false;
                    }
                });
            }
        }

    },

    async created() {

        this.check_some_notifications();
        
        const _this = this
        Pusher.logToConsole = true;
        var pusher = new Pusher('a9e17b308b857320b4bd', {

            cluster: 'ap2'

        });

        var channel = pusher.subscribe('my-channel');

        channel.bind('my-event', function (data) {

            if (data.update_notifications == 'yes') {

                _this.is_notification = true;

                _this.check_some_notifications();
                    // console.log(data.alert_id.length);
                    if(data.alert_id){
                        for(var i = 0;i<data.alert_id.length;i++){
                            console.log(data.alert_id[i],_this.user_id);
                            if(data.alert_id[i] == _this.user_id){
                                if(data.new_message){
                                    Vue.$toast.info('Check new message!', {
                                    // optional options Object
                                    });
                                }else{

                                    Vue.$toast.success('You have new notification kindly check', {
                                    // optional options Object
                                    });
                                }
                                
                            }
                        }
                    }
                    // console.log(_this.check_some_notifications())
                    // if(data.alert_id)
                        // Vue.$toast.success('You have new notification kindly check', {
                        //     // optional options Object
                        // });
            }

        });


    }

}
</script>

<style>
/* .navbar-notice-number .badge {
    position: absolute;
    top: 3px;
    right: 5px;
    display: block !important;
    padding: 3px 5px !important;
    width: 1.7rem !important;
    height: 1.7rem !important;
    border-radius: 100%;
    font-size: 11px !important;
    line-height: 23px !important;
} */
</style>