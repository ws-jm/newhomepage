<!--begin::Tab pane-->
										<div class="tab-pane fade" id="kt_aside_nav_tab_tasks1" role="tabpanel">
											<!--begin::Tasks-->
											<div class="mx-5">
												<!--begin::Header-->
												<h3 class="fw-bolder text-dark mb-10 mx-0">Manage Users & Credits</h3>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="mb-12">
													<!--begin::Item-->
													<?php if($user_type == 'reseller') { ?>
													<div class="d-flex align-items-center mb-7">
														<div class="symbol symbol-50px me-5">
															<span class="symbol-label bg-light-success">
															<span class="svg-icon svg-icon-warning svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"/>
																<rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"/>
																</svg>
																</span>
															</span>
														</div>
														<div class="d-flex flex-column">
															<a href="user.php" class="text-gray-800 text-hover-primary fs-6 fw-bold">Manage User</a>
															<span class="text-muted fw-bold">Create or Manage User</span>
														</div>
													</div>

													<div class="d-flex align-items-center mb-7">
														<div class="symbol symbol-50px me-5">
															<span class="symbol-label bg-light-success">
															<span class="svg-icon svg-icon-success svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="currentColor"/>
																<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="currentColor"/>
																<path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="currentColor"/>
																<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="currentColor"/>
																</svg>
																</span>
															</span>
														</div>
														<div class="d-flex flex-column">
															<a href="reseller.php" class="text-gray-800 text-hover-primary fs-6 fw-bold">Manage Reseller</a>
															<span class="text-muted fw-bold">Create or Manage Reseller</span>
														</div>
													</div>
													
													<hr>
                                                   
													<div class="d-flex align-items-center">
														<div class="symbol symbol-50px me-5">
															<span class="symbol-label bg-light-danger">
															<span class="svg-icon svg-icon-warning svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="currentColor"/>
															<path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="currentColor"/>
															</svg>
															</span>
															</span>
														</div>
														<div class="d-flex flex-column">
															<a href="reseller-report.php" class="text-gray-800 text-hover-primary fs-6 fw-bold">Reseller Credit Report</a>
															<span class="text-muted fw-bold">Manage Credit</span>
														</div>
														<!--end::Text-->
													</div>
													<?php } ?>
													<br>
													<div class="d-flex align-items-center">
														<div class="symbol symbol-50px me-5">
															<span class="symbol-label bg-light-danger">
															<span class="svg-icon svg-icon-danger svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z" fill="currentColor"/>
															<path opacity="0.3" d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z" fill="currentColor"/>
															<path opacity="0.3" d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z" fill="currentColor"/>
															</svg>
															</span>
															</span>
														</div>
														<div class="d-flex flex-column">
															<a href="user-report.php" class="text-gray-800 text-hover-primary fs-6 fw-bold">User Credit Report</a>
															<span class="text-muted fw-bold">Manage Credit</span>
														</div>
													</div>
													<hr>
													<div class="d-flex align-items-center">
														<div class="symbol symbol-50px me-5">
															<span class="symbol-label bg-light-danger">
															<span class="svg-icon svg-icon-primary svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="currentColor"/>
															<path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="currentColor"/>
															<path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="currentColor"/>
															</svg>
															</span>
															</span>
														</div>
														<div class="d-flex flex-column">
															<a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Download Report</a>
															<span class="text-muted fw-bold">One Click Download</span>
														</div>
													</div>
													<!--end::Item-->
												</div>
												<!--end::Body-->
											</div>
											<!--end::Tasks-->
										</div>
										<!--end::Tab pane-->