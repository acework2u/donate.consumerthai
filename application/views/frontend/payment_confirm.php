<div class="container d-flex" ref="body"">
<div class="thank-container pt-3 pb-3 mt-4 mb-4 " id="tranferconfirm">
    <div class="row pl-3 pr-3">

        <div class="col-md-12 form-group">
            <label class="label">Your name or Email</label>
            <input @keypress="donorSearch" class="form-control" v-model="donorName">
        </div>
        <div class="col-md-12 form-group">
            <label class="label">Donation No.</label>
           <select class="form-control">
               <option> No data</option>
               <option> Select Donation No.</option>
           </select>
        </div>
        <div class="col-md-12 form-group">
            <label class="label">Transfer Date</label>
            <input class="form-control" type="datetime-local">
        </div>
        <div class="col-md-12 form-group">
            <label class="label">Upload Transfer Slip</label>
            <input class="form-control" type="file">
        </div>

        <div class="col-md-12">
            <button class="btn btn-success form-group">Send</button>
        </div>

    </div>
</div>
</div>

