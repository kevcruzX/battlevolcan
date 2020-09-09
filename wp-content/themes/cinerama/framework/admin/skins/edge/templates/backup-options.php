<div class="edgtf-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="import">
            <div class="edgtf-tab-content">
                <h2 class="edgtf-page-title"><?php esc_html_e('Backup Options', 'cinerama'); ?></h2>
                <form method="post" class="edgtf_ajax_form edgtf-backup-options-page-holder">
                    <div class="edgtf-page-form">
                        <div class="edgtf-page-form-section-holder">
                            <h3 class="edgtf-page-section-title"><?php esc_html_e('Export/Import Options', 'cinerama'); ?></h3>
                            <div class="edgtf-page-form-section">
                                <div class="edgtf-field-desc">
                                    <h4><?php esc_html_e('Export', 'cinerama'); ?></h4>
                                    <p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'cinerama'); ?></p>
                                </div>
                                <div class="edgtf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="export_options" id="export_options" class="form-control edgtf-form-element" rows="10" readonly><?php echo cinerama_core_export_options(); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edgtf-page-form-section">
                                <div class="edgtf-field-desc">
                                    <h4><?php esc_html_e('Import', 'cinerama'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'cinerama'); ?></p>
                                </div>
                                <div class="edgtf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control edgtf-form-element" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="edgtf-page-form-section">
								<div class="edgtf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edgtf-import-theme-options-btn"><?php esc_html_e('Import', 'cinerama'); ?></button>
									<?php wp_nonce_field('edgtf_import_theme_options_secret_value', 'edgtf_import_theme_options_secret', false); ?>
									<span class="edgtf-bckp-message"></span>
								</div>
							</div>
                            <div class="edgtf-page-form-section edgtf-import-button-wrapper">
                                <div class="alert alert-warning">
                                    <strong><?php esc_html_e('Important notes:', 'cinerama') ?></strong>
                                    <ul>
                                        <li><?php esc_html_e('Please note that import process will overide all your existing options.', 'cinerama'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
						<div class="edgtf-page-form-section-holder">
							<h3 class="edgtf-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'cinerama'); ?></h3>
							<div class="edgtf-page-form-section">
								<div class="edgtf-field-desc">
									<h4><?php esc_html_e('Export', 'cinerama'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'cinerama'); ?></p>
								</div>
								<div class="edgtf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control edgtf-form-element" rows="10" readonly><?php echo cinerama_core_export_custom_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgtf-page-form-section">
								<div class="edgtf-field-desc">
									<h4><?php esc_html_e('Import', 'cinerama'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'cinerama'); ?></p>
								</div>
								<div class="edgtf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control edgtf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgtf-page-form-section">
								<div class="edgtf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edgtf-import-custom-sidebars-btn"><?php esc_html_e('Import', 'cinerama'); ?></button>
									<?php wp_nonce_field('edgtf_import_custom_sidebars_secret_value', 'edgtf_import_custom_sidebars_secret', false); ?>
									<span class="edgtf-bckp-message"></span>
								</div>
							</div>
							<div class="edgtf-page-form-section edgtf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'cinerama') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'cinerama'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="edgtf-page-form-section-holder">
							<h3 class="edgtf-page-section-title"><?php esc_html_e('Export/Import Widgets', 'cinerama'); ?></h3>
							<div class="edgtf-page-form-section">
								<div class="edgtf-field-desc">
									<h4><?php esc_html_e('Export', 'cinerama'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'cinerama'); ?></p>
								</div>
								<div class="edgtf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control edgtf-form-element" rows="10" readonly><?php echo cinerama_core_export_widgets_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgtf-page-form-section">
								<div class="edgtf-field-desc">
									<h4><?php esc_html_e('Import', 'cinerama'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'cinerama'); ?></p>
								</div>
								<div class="edgtf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control edgtf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="edgtf-page-form-section">
								<div class="edgtf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="edgtf-import-widgets-btn"><?php esc_html_e('Import', 'cinerama'); ?></button>
									<?php wp_nonce_field('edgtf_import_widgets_secret_value', 'edgtf_import_widgets_secret', false); ?>
									<span class="edgtf-bckp-message"></span>
								</div>
							</div>
							<div class="edgtf-page-form-section edgtf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'cinerama') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'cinerama'); ?></li>
									</ul>
								</div>
							</div>
						</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>