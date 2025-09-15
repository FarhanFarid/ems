<div class="card-body">
            <div class="row mb-3 d-flex align-items-stretch">
                <div class="col-md-12 d-flex flex-column">
                    <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #FCBACB; margin: 0 !important; padding: 0 !important;">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #000000;">Details Form</h4>
                        </div>
                    </div>
                    <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                        <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                           <form id="arrdetailsform">
                            @csrf
                                <div class="row my-3 px-3">
                                    <label for="title" class="form-check-label" style="color: black; font-weight: 700; font-size: 13px;">Title :</label>
                                    <input class="form-control form-control-solid" type="text" name="title" id="title">
                                </div>
                                <div class="row my-3 px-3">
                                    <label for="category" class="form-check-label" style="color: black; font-weight: 700; font-size: 13px;">Category :</label>
                                    <select class="form-select form-select-solid" aria-label="Select example" name="category" id="category">
                                        <option>Select Option</option>
                                        <option value="Pre Wed">Pre Wed</option>
                                        <option value="Engagement">Engagement</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Post Wed">Post Wed</option>
                                    </select>
                                </div>
                                <div class="row my-3 px-3">
                                    <label for="type" class="form-check-label" style="color: black; font-weight: 700; font-size: 13px;">Type :</label>
                                    <select class="form-select form-select-solid" aria-label="Select example" name="type" id="type">
                                        <option>Select Option</option>
                                        <option value="Dress">Dress</option>
                                        <option value="Venue">Venue</option>
                                        <option value="Invitation">Invitation</option>
                                        <option value="Door Gifts">Door Gifts</option>
                                        <option value="Hantaran">Hantaran</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <div class="fv-row">
                                        <div class="mb-3">
                                            <label for="image" class="form-label" style="color: black; font-weight: 700; font-size: 12px;">Upload up to 5 image (Max size: 5mb)</label>
                                            <input class="form-control" type="file" id="image" name="image[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3" style="padding-left:3px; width:100%;">
                                    <label for="description" class="form-check-label" style="color:black; font-weight:700; font-size:13px;">Description :</label>
                                    <div style="width:100%;">
                                        <textarea name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="row my-3 px-3">
                                    <label for="costing" class="form-check-label" style="color: black; font-weight: 700; font-size: 13px;">Costing :</label>
                                    <div class="input-group input-group-solid mb-5">
                                        <span class="input-group-text">RM</span>
                                        <input type="text" class="form-control" name="costing" id="costing"/>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex justify-content-center gap-2">
                                        <button type="button" class="btn btn-light-primary font-weight-bold save-arrangment mt-2 px-10">
                                            {{ __('SUBMIT') }}
                                        </button>
                                    </div>
                                </div>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
