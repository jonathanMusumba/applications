<div id="nextOfKin" class="mt-4">
<form id="nextOfKinForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fullName" class="required">Full Name</label>
                        <input type="text" class="form-control form-control-sm" id="fullName" required pattern="[A-Za-z\s]+" title="Only alphabets are allowed">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telephone" class="required">Telephone</label>
                        <input type="tel" class="form-control form-control-sm" id="telephone" required pattern="^\+[0-9]{1,3}-[0-9]{9,10}$" title="Phone number with country code">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Valid email address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="relationship" class="required">Relationship</label>
                        <input type="text" class="form-control form-control-sm" id="relationship" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="districtOfResidence" class="required">District of Residence</label>
                        <input type="text" class="form-control form-control-sm" id="districtOfResidence" required pattern="[A-Za-z\s]+" title="Only alphabets are allowed">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="saveNextOfKin">Save Next of Kin</button>
        </form>
    </div>