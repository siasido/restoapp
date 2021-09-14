<input type="hidden" value="<?=$this->session->flashdata('success')?>" id="success-trigger">
<input type="hidden" value="<?=$this->session->flashdata('danger')?>" id="danger-trigger">
<input type="hidden" value="<?=$this->session->flashdata('warning')?>" id="warning-trigger">

<?php if ($this->session->flashdata('success')) { ?>
    <div style="position: absolute; top: 4.5rem; right: 1rem;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast-success" data-autohide="false">
            <div class="toast-header bg-success text-white">
                <i data-feather="alert-circle"></i>
                <strong class="mr-auto">Success Text Toast</strong>
                <small class="text-white-50 ml-2">just now</small>
                <button class="ml-2 mb-1 close text-white" type="button"  data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">This toast uses the success background color utility on the toast header.</div>
        </div>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('info')) { ?>
    <div style="position: absolute; top: 4.5rem; right: 1rem;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-info text-white" id="toast-info">
                <i data-feather="alert-circle"></i>
                <strong class="mr-auto">Info Text Toast</strong>
                <small class="text-white-50 ml-2">just now</small>
                <button class="ml-2 mb-1 close text-white" type="button" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">This toast uses the info background color utility on the toast header.</div>
        </div>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('warning')) { ?>
    <div style="position: absolute; top: 4.5rem; right: 1rem;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-warning text-white" id="toast-warning">
                <i data-feather="alert-circle"></i>
                <strong class="mr-auto">Warning Text Toast</strong>
                <small class="text-white-50 ml-2">just now</small>
                <button class="ml-2 mb-1 close text-white" type="button" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">This toast uses the warning background color utility on the toast header.</div>
        </div>
    </div>
<?php } ?>

<?php if ($this->session->flashdata('danger')) { ?>
    <div style="position: absolute; top: 4.5rem; right: 1rem;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white" id="toast-danger">
                <i data-feather="alert-circle"></i>
                <strong class="mr-auto">Danger Text Toast</strong>
                <small class="text-white-50 ml-2">just now</small>
                <button class="ml-2 mb-1 close text-white" type="button" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">This toast uses the danger background color utility on the toast header.</div>
        </div>
    </div>
<?php } ?>