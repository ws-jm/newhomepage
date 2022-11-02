<!-- Create new campaign start here -->
					<!--begin::Modal Text Message-->
							<div class="modal fade" id="textmessage" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered mw-650px">
									<div class="modal-content">
										<div class="modal-header" id="kt_modal_create_api_key_header">
											<h2  class="text-primary">New Campaign Today : <?php

                                                $sort_date = date("Y-m-d");

                                                $conn1 = new mysqli($servername, $username, $password, $dbname);
                                                if ($conn1->connect_error) {
                                                    die("Connection failed: " . $conn1->connect_error);
                                                }
                                                $stmt1 = $conn1->prepare("SELECT count(login_id) FROM `send_wp_msgs` WHERE `login_id` = ? and `sort_date_wise` = ?");
                                                $stmt1->bind_param("is", $_SESSION['login_id'],$sort_date);
                                                $stmt1->execute();
                                                $stmt1->bind_result($today_total_cam_count);
                                                $stmt1->fetch();
                                                $conn1->close();
                                                if(empty($today_total_cam_count)){
                                                    echo "0";
                                                }else{
                                                    echo $today_total_cam_count;
                                                }
                                                ?></h2>
											<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
												<span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
														<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
													</svg>
												</span>
											</div>
										</div>
										<form id="kt_modal_create_api_key_form" class="form" method="post" action="process-send-message.php" enctype="multipart/form-data">
                                        <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id']; ?>">
											<div class="modal-body py-10 px-lg-17">
												<div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_api_key_header" data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">
													<div class="d-flex flex-column mb-10 fv-row">
														<label class="required fs-5 fw-bold mb-2" for="countryOption">Select Message Type</label>
													</div>
                                                    <!-- Phone Number -->
                                                    <div class="d-flex flex-column mb-10 fv-row">
                                                        <label for="exampleFormControlTextarea1" class="required fs-5 fw-bold mb-2">Mobile No.<span class="mandatory">
                                                            </span> </label>
                                                        <textarea onKeyUp="countline()" type="text" class="form-control form-control-solid" cols="10" rows="5" id="mobileno" name="mobileno" placeholder="Please Add 91 before Mobile No."></textarea>
                                                    </div>
                                                    <!-- Number Count -->
                                                    <div class="d-flex flex-column mb-10 fv-row">
                                                        <label for="userName" class="required fs-5 fw-bold mb-2">Number Count</label>
                                                        <input type="text" class="form-control form-control-solid" readonly id="numbercount" required
                                                                name="numbercount" value="">
                                                    </div>
                                                    <!-- Message -->
                                                    <div id = "show_message" class="flex-column mb-10 fv-row">
                                                        <label for="exampleFormControlTextarea1" class="required fs-5 fw-bold mb-2">Message</label>
                                                        <textarea name="description"  id="mytextarea" class="form-control form-control-solid" placeholder="Type your Message here..."
                                                                    cols="10" rows="5"></textarea>
                                                    </div>
                                                    <!-- Upload Image -->
                                                    <div id  ="show_image" class="flex-column mb-10 fv-row">
                                                        <div class="custom-file">

                                                        <label for="photo" class="required fs-5 fw-bold mb-2">Upload Image</label>
                                                        <input type="file" id="photo-1" name="photo-1" class="form-control form-control-solid"
                                                                accept="image/png,image/jpeg">
                                                                <p class="help-block text-danger">
                                                                <small>Photo should be smaller than 2 MB. Only JPG and PNG are allowed.</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- PDF , Video , Audio -->
                                                    <div id = "show_pdf" class="flex-column mb-10 fv-row">

                                                        <label for="pdf" id="pdf_f" class="required fs-5 fw-bold mb-2">Upload PDF
                                                        </label>
                                                        <div class="" id="pdf_file">
                                                            <input type="file" id="p_file" name="pdf_file" class="form-control form-control-solid"
                                                                accept="image/pdf">
                                                            <p class="help-block text-danger">
                                                                <small>PDF should be smaller than 5 MB.</small>
                                                            </p>
                                                        </div>

                                                        <label for="video" id="video_f" class="required fs-5 fw-bold mb-2">Send Video
                                                        </label>
                                                        <div class="" id="video_file">
                                                            <input type="file" id="v_file"  name="video_file" class="form-control form-control-solid"
                                                                accept="image/mp4,image/3gp, image/avi">
                                                            <p class="help-block text-danger">
                                                                <small>Video should be smaller than 5 MB.</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- Buttons -->
                                                    <div id = "show_button" class="flex-column mb-10 fv-row">
                                                        <label for="video" id="video_f" class="required fs-5 fw-bold mb-2"> Link Button
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row" id="video_file">
                                                            <input type="text" id="replybutton1"  name="replybtn1" class="form-control form-control-solid" placeholder="Enter button text">
                                                        </div>
                                                        <label for="video" id="video_f" class="required fs-5 fw-bold mb-2">Link for Button
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row" id="video_file">
                                                            <input type="text" id="ctabtn1"  name="ctabtn1" class="form-control form-control-solid" placeholder="https://google.com">
                                                        </div>
                                                        <label for="photo" class="required fs-5 fw-bold mb-2">Phone Number
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row">
                                                            <input type="text" id="ctabtn2"  name="ctabtn2" class="form-control form-control-solid" placeholder="+91XXXXXXXXXX">
                                                        </div>
                                                        <label for="photo" class="required fs-5 fw-bold mb-2"> Call Button
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row">
                                                            <input type="text" id="replybutton2"  name="replybtn2" class="form-control form-control-solid" placeholder="Enter button text">
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="modal-footer flex-center">
												<button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard</button>
												<button type="submit" name="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">
													<span class="indicator-label">Send Now</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
					<!--begin::Modal Text Message-->

					<!--begin Image Message-->
					<div class="modal fade" id="kt_modal_create_api_key" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered mw-650px">
									<div class="modal-content">
										<div class="modal-header" id="kt_modal_create_api_key_header">
											<h2  class="text-primary">New Campaign Today : <?php

                                                $sort_date = date("Y-m-d");

                                                $conn1 = new mysqli($servername, $username, $password, $dbname);
                                                if ($conn1->connect_error) {
                                                    die("Connection failed: " . $conn1->connect_error);
                                                }
                                                $stmt1 = $conn1->prepare("SELECT count(login_id) FROM `send_wp_msgs` WHERE `login_id` = ? and `sort_date_wise` = ?");
                                                $stmt1->bind_param("is", $_SESSION['login_id'],$sort_date);
                                                $stmt1->execute();
                                                $stmt1->bind_result($today_total_cam_count);
                                                $stmt1->fetch();
                                                $conn1->close();
                                                if(empty($today_total_cam_count)){
                                                    echo "0";
                                                }else{
                                                    echo $today_total_cam_count;
                                                }
                                                ?></h2>
											<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
												<span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
														<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
													</svg>
												</span>
											</div>
										</div>
										<form id="kt_modal_create_api_key_form" class="form" method="post" action="process-send-message.php" enctype="multipart/form-data">
                                        <input type="hidden" name="login_id" value="<?php echo $_SESSION['login_id']; ?>">
											<div class="modal-body py-10 px-lg-17">
												<div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_api_key_header" data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">
													<div class="d-flex flex-column mb-10 fv-row">
														<label class="required fs-5 fw-bold mb-2" for="countryOption">Select Message Type</label>
													</div>
                                                    <!-- Phone Number -->
                                                    <div class="d-flex flex-column mb-10 fv-row">
                                                        <label for="exampleFormControlTextarea1" class="required fs-5 fw-bold mb-2">Mobile No.<span class="mandatory">
                                                            </span> </label>
                                                        <textarea onKeyUp="countline()" type="text" class="form-control form-control-solid" cols="10" rows="5" id="mobileno" name="mobileno" placeholder="Please Add 91 before Mobile No."></textarea>
                                                    </div>
                                                    <!-- Number Count -->
                                                    <div class="d-flex flex-column mb-10 fv-row">
                                                        <label for="userName" class="required fs-5 fw-bold mb-2">Number Count</label>
                                                        <input type="text" class="form-control form-control-solid" readonly id="numbercount" required
                                                                name="numbercount" value="">
                                                    </div>
                                                    <!-- Message -->
                                                    <div id = "show_message" class="flex-column mb-10 fv-row">
                                                        <label for="exampleFormControlTextarea1" class="required fs-5 fw-bold mb-2">Message</label>
                                                        <textarea name="description"  id="mytextarea" class="form-control form-control-solid" placeholder="Type your Message here..."
                                                                    cols="10" rows="5"></textarea>
                                                    </div>
                                                    <!-- Upload Image -->
                                                    <div id  ="show_image" class="flex-column mb-10 fv-row">
                                                        <div class="custom-file">

                                                        <label for="photo" class="required fs-5 fw-bold mb-2">Upload Image</label>
                                                        <input type="file" id="photo-1" name="photo-1" class="form-control form-control-solid"
                                                                accept="image/png,image/jpeg">
                                                                <p class="help-block text-danger">
                                                                <small>Photo should be smaller than 2 MB. Only JPG and PNG are allowed.</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- PDF , Video , Audio -->
                                                    <div id = "show_pdf" class="flex-column mb-10 fv-row">

                                                        <label for="pdf" id="pdf_f" class="required fs-5 fw-bold mb-2">Upload PDF
                                                        </label>
                                                        <div class="" id="pdf_file">
                                                            <input type="file" id="p_file" name="pdf_file" class="form-control form-control-solid"
                                                                accept="image/pdf">
                                                            <p class="help-block text-danger">
                                                                <small>PDF should be smaller than 5 MB.</small>
                                                            </p>
                                                        </div>

                                                        <label for="video" id="video_f" class="required fs-5 fw-bold mb-2">Send Video
                                                        </label>
                                                        <div class="" id="video_file">
                                                            <input type="file" id="v_file"  name="video_file" class="form-control form-control-solid"
                                                                accept="image/mp4,image/3gp, image/avi">
                                                            <p class="help-block text-danger">
                                                                <small>Video should be smaller than 5 MB.</small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!-- Buttons -->
                                                    <div id = "show_button" class="flex-column mb-10 fv-row">
                                                        <label for="video" id="video_f" class="required fs-5 fw-bold mb-2"> Link Button
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row" id="video_file">
                                                            <input type="text" id="replybutton1"  name="replybtn1" class="form-control form-control-solid" placeholder="Enter button text">
                                                        </div>
                                                        <label for="video" id="video_f" class="required fs-5 fw-bold mb-2">Link for Button
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row" id="video_file">
                                                            <input type="text" id="ctabtn1"  name="ctabtn1" class="form-control form-control-solid" placeholder="https://google.com">
                                                        </div>
                                                        <label for="photo" class="required fs-5 fw-bold mb-2">Phone Number
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row">
                                                            <input type="text" id="ctabtn2"  name="ctabtn2" class="form-control form-control-solid" placeholder="+91XXXXXXXXXX">
                                                        </div>
                                                        <label for="photo" class="required fs-5 fw-bold mb-2"> Call Button
                                                        </label>
                                                        <div class="d-flex flex-column mb-10 fv-row">
                                                            <input type="text" id="replybutton2"  name="replybtn2" class="form-control form-control-solid" placeholder="Enter button text">
                                                        </div>
                                                    </div>
												</div>
											</div>
											<div class="modal-footer flex-center">
												<button type="reset" id="kt_modal_create_api_key_cancel" class="btn btn-light me-3">Discard</button>
												<button type="submit" name="submit" id="kt_modal_create_api_key_submit" class="btn btn-primary">
													<span class="indicator-label">Send Now</span>
													<span class="indicator-progress">Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
					<!--begin::Modal Image Message-->
