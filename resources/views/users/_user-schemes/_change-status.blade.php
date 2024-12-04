 <div class="card">

   <div class="card-body" style="text-align: center;">
     <div class="change-status-success"></div>

     <h5 class="card-title">Change Status</h5>


     <div class="row">
       <div class="card-body">
         <p> Change the Subscription Status whether it is closed or active</p>

       </div>

       <!-- Sales Card -->

       <div class="col-xxl-6 col-md-6">
         <div class="card info-card sales-card">



           <div class="card-body" id="maturity-status-box">
             <h5 class="card-title">Change The Maturity Closing Status</h5>



             <div class="ps-3">
               <h6 class="card-tt">Close the subscription once the plan reaches it's maturity</h6>
               <select class="form-control" id="maturity_status">
                 <option value="" selected disabled>Select to change the status</option>
                 <option value="1">Close the Subscription</option>
               </select>

             </div>

           </div>

           <div class="card-body" id="maturity-status-success-box" style="dislay:none">
             <h5 class="card-title alert alert-danger">The Subscription has been closed</h5>



           </div>



         </div>
       </div><!-- End Sales Card -->
       <div class="col-xxl-6 col-md-6">
         <div class="card info-card sales-card">



           <div class="card-body" id="scheme-status-box">
             <h5 class="card-title">Change the Subscription status</h5>
             <div class="ps-3">
               <h6 class="card-tt">Change the status of the account</h6>
               <select class="form-control" id="scheme_status" style="width: 100%;">
                 <option value="" selected disabled>Select to change the status</option>
                 <option value="1">Active</option>
                 <option value="2">Discontinue</option>
                 <option value="3">On Hold</option>
                 <option value="0">In Active</option>
               </select>

             </div><br>
             <div class="ps-3" id="discontinue-details">
               <h6 class="card-tt">Discontinue Details</h6>
               <div class="row mb-3">
                 <div class="col-sm-12">
                   <input type="text" id="final_amount" class="form-control" placeholder="Final Amount">
                 </div>
                 <div class="col-sm-12">
                   <input type="text" id="settlement_amount" class="form-control" placeholder="Settlement Amount">
                 </div>
                 <div class="col-sm-12">
                   <textarea name="reason" class="form-control" placeholder="Reason" id="reason"></textarea>
                 </div>
               </div>
             </div>
           </div>

           <div class="card-body" id="scheme-status-success-box" style="dislay:none">
             <h5 class="card-title alert alert-danger">The Subscription has been Discontinued</h5>
             <div id="discontinue-details-details"></div>
           </div>




         </div>
       </div><!-- End Sales Card -->

     </div>
     <div class="col-md-12" id="update-status-loading" style="text-align: center;display:none">
       <img src="{{asset('assets/img/loading.gif')}}" style="width: 25%;">
     </div>
     <input type="button" value="Update" class="btn btn-success" id="btn-update">

   </div>
 </div>
 @push('scripts')
 <script>
   $(document).delegate('#maturity_status', 'change', function() {
     var scheme_status = $('#scheme_status').val();
     if (scheme_status == 2) {
       $('#discontinue-details').show();
     } else {
       $('#discontinue-details').hide();
     }
   });
   $(document).delegate('#scheme_status', 'change', function() {
     var scheme_status = $('#scheme_status').val();
     if (scheme_status == 2) {
       $('#discontinue-details').show();
     } else {
       $('#discontinue-details').hide();
     }
   });
   $('#btn-update').on('click', function() {
     var subscription_id = "{{encrypt($user_subscription_id)}}";
     var scheme_status = $('#scheme_status').val();
     var maturity_status = $('#maturity_status').val();
     var final_amount = $('#final_amount').val();
     var settlement_amount = $('#settlement_amount').val();
     var reason = $('#reason').val();
     $.ajax({
       url: "{{route('users.update-plan-status')}}", // URL to your Laravel route
       type: 'POST',
       data: {
         subscription_id: subscription_id,
         scheme_status: scheme_status,
         maturity_status: maturity_status,
         final_amount: final_amount,
         settlement_amount: settlement_amount,
         reason: reason
       }, // Pass the serialized data
       dataType: 'json',
       beforeSend: function(xhr) {
         $('#update-status-loading').show();
         $('.change-status-success').removeClass('alert alert-success').html('');

       },
       success: function(response) {
         $('#update-status-loading').hide();
         if (response.maturity_status == '1') {
           $('#mat_status').html("");
           $('#maturity-status-box').hide();
           $('#maturity-status-success-box').show();
           $('#mat_status').html("Closed");
         }
         if (response.scheme_status == '2') {
           $('#sub_status').html("");
           $('#scheme-status-box').hide();
           $('#scheme-status-success-box').show();
           $('#discontinue-details-details').html(response.discontinued_details);
           $('#sub_status').html("Discontinued");

         } else {

           if (response.scheme_status == '1') {
             $('#sub_status').html("");
             $('#sub_status').html("Active");
           }
           if (response.scheme_status == '0') {
             $('#sub_status').html("");
             $('#sub_status').html("In Active");
           }
           if (response.scheme_status == '3') {
             $('#sub_status').html("");
             $('#sub_status').html("On Hold");
           }
           $("#scheme_status").val(response.scheme_status).change();
         }

         toastr.success('Status Updated Successfully');

         if (response.scheme_status == '2' && response.maturity_status == '1') {
           $('#btn-update').prop('disabled', true);
         } else {
           $('#btn-update').prop('disabled', false);
         }
       },
       error: function(error) {
          console.log(error);
       }
     });
   });
 </script>
 @endpush